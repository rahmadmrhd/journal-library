<?php

namespace App\Services\Manuscripts;

use App\Models\Form\Form;
use App\Models\Form\FormAnswer;
use App\Models\Manuscript\Category;
use App\Models\Manuscript\File;
use App\Models\Manuscript\FileType;
use App\Models\Manuscript\Keyword;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\StepSubmission;
use App\Models\SubGate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubmitNewManuscriptServices {

  private TaskServices $taskServices;
  public function __construct(TaskServices $taskServices) {
    $this->taskServices = $taskServices;
  }

  private function validate($data, array $fieldRules = null): \Illuminate\Validation\Validator {
    return
      Validator::make(
        $data,
        Manuscript::rules($fieldRules),
        Manuscript::messages()
      );
  }
  private function updateCurrentStep(Manuscript &$manuscript, \Illuminate\Validation\Validator|bool $validator, $step) {
    if ($validator instanceof \Illuminate\Validation\Validator) {
      $manuscript->steps()->syncWithoutDetaching([$manuscript->current_step => ['status' => $validator->fails() ? 'error' : 'success']]);

      if ($manuscript->current_step < 5) {
        $manuscript->current_step = $validator->fails() ?
          $manuscript->current_step : ($step ?? $manuscript->current_step + 1);
      }
    } else {
      $manuscript->steps()->syncWithoutDetaching([$manuscript->current_step => ['status' => !$validator ? 'error' : 'success']]);

      if ($manuscript->current_step < 5) {
        $manuscript->current_step = !$validator ?
          $manuscript->current_step : ($step ?? $manuscript->current_step + 1);
      }
    }
  }

  public function showSubmission(Manuscript $manuscript = null): array {

    //init data
    $steps = StepSubmission::orderBy('id', 'asc')->get();
    $data = [
      'steps' => $steps,
      'file_types' => FileType::orderBy('required', 'desc')->get(),
    ];
    if (!$manuscript) {
      return $data;
    }

    //get progress
    $progress = $manuscript->steps;
    $isSuccess = true;
    $steps = $steps->map(function ($step) use ($progress, &$isSuccess,) {
      $status = $progress->find($step->id)->pivot->status ?? null;
      // if ($status == 'error')
      //   $isSuccess = false;

      // if ($step->id == 5)
      //   $step->status =  $isSuccess ? 'success' : 'error';
      // else
      $step->status = $status;
      return $step;
    });

    $rules = [];
    // show data every step
    switch ($manuscript->current_step) {
      case 1:
        $rules = ['filesId', 'filesId.*'];
        $file_types = FileType::orderBy('required', 'desc')->get();
        $manuscript->files = $manuscript->files->map(function ($file) use ($file_types) {
          $file->file_types = $file_types;
          return $file;
        });
        $manuscript->filesId = $manuscript->files->pluck('id')->toArray();
        break;
      case 2:
        $data['categories'] = Category::all();
        $rules = ['title', 'category_id', 'abstract', 'keywords', 'keywords.*'];
        $manuscript->keywords = $manuscript->keywords->pluck('name')->toArray();
        break;
      case 3:
        $manuscript->authors = $manuscript->authors()->with('country')->get()->map(function ($author) {
          $author->full_name = $author->getFullName();
          return $author;
        })->filter(function ($author) {
          return $author->id != Auth::user()->id;
        });
        $manuscript->authorsId = $manuscript->authors->pluck('id')->toArray();
        $manuscript->isSoleAuthor = $manuscript->authors->count() <= 0;
        $rules = ['authorsId', 'authorsId.*'];
        break;
      case 4:
        $manuscript->isConfirmed = $steps->find($manuscript->current_step)->status != null;
        $rules = ['parent_id', 'funders',  'funders.*.id',  'funders.*.name',  'funders.*.grants',  'funders.*.grants.*',   'potential_conflict',  'paper_contain',  'open_access',  'using_paperpal'];
        break;
      case 5:
        $manuscript->isConfirmed = $steps->find(4)->status != null;
        $manuscript->isReview = true;
        $manuscript->keywords = $manuscript->keywords->pluck('name')->toArray();
        $manuscript->authors = $manuscript->authors()->with('country')->get()->map(function ($author) {
          $author->full_name = $author->getFullName();
          return $author;
        })->filter(function ($author) {
          return $author->id != Auth::user()->id;
        });
        $manuscript->filesId = $manuscript->files->pluck('id')->toArray();
        $manuscript->isSoleAuthor = $manuscript->authors->count() <= 0;

        $data['categories'] = Category::all();
        break;
    }

    //set data manuscript
    $data['manuscript'] = $manuscript;

    // validation data
    if ($manuscript->current_step == 5 || $progress->where('id', $manuscript->current_step)->first()) {
      $validator = $this->validate($manuscript->toArray(), $rules);
      if ($validator->fails()) {
        $data['errors'] = $validator->errors();
        $messages = collect([]);
        if ($manuscript->current_step == 5) {
          $steps->each(function ($step) use (&$messages) {
            if ($step->id == 5)
              return;
            if ($step->status == null) {
              $messages->push('Please complete step ' . $step->id . ' first. ');
            }
          });
        }
        $messages->push(...collect($validator->errors()->getMessages())->map(function ($messages) {
          return collect($messages)->values();
        })->values()->collapse());
        $data['alert'] = [
          'type' => 'error',
          'title' => 'Please fix the following issues then click ' . ($manuscript->current_step == 5 ? '"Submit"' : '"Save & Continue"') . ':',
          'messages' => $messages->toArray(),
        ];
      }
    }


    return $data;
  }

  private function moveFiles($filesId, Manuscript $manuscript) {
    collect($filesId)->each(function ($fileId) use ($manuscript) {
      $file = File::find($fileId);

      $file->fileable()->associate($manuscript);

      if (!$file->is_temporary)
        return;
      $newPath = "files/manuscripts/{$manuscript->id}/{$file->id}.{$file->extension}";
      Storage::move($file->path, $newPath);
      $file->update(['path' => $newPath]);
    });
  }

  public function isAlreadySubmitted(Request $request, SubGate $subGate) {
    return $request->user()->manuscripts()->whereNull('submitted_at')->where('sub_gate_id', $subGate->id)->wherePivot('is_corresponding_author', true)->latest()->first();
  }

  public function create(Request $request, SubGate $subGate) {
    DB::beginTransaction();
    $validator = $this->validate($request->all(), ['filesId', 'filesId.*']);
    $validator->validate();

    $manuscript = Manuscript::create([
      'sub_gate_id' => $subGate->id,
    ]);

    $this->moveFiles($request->filesId, $manuscript);

    $manuscript->authors()->attach([$request->user()->id => ['is_corresponding_author' => true]]);

    $manuscript->steps()->attach([1 => ['status' => 'success']]);

    $manuscript->current_step = 2;

    $questions = Form::with('questions')->where('formable_type', Manuscript::class)
      ->where(function (Builder $query) use ($subGate) {
        $query->where('sub_gate_id', $subGate->id);
        $query->orWhereNull('sub_gate_id');
      })->orderByDesc('sub_gate_id')->first()->questions->map(function ($question) use ($request) {
        unset($question->id);
        $question->user_id = $request->user()->id;
        return $question->toArray();
      });

    $manuscript->responses()->createMany(Form::getQuestions(Manuscript::class, $subGate, $request->user()));

    $manuscript->logs()->create([
      'user_id' => Auth::user()->id,
      'activity' => 'This manuscript was created',
    ]);

    $manuscript->save();
    DB::commit();

    return $manuscript;
  }

  public function updateFile(Request $request, SubGate $subGate, Manuscript $manuscript) {
    DB::beginTransaction();
    $validator = $this->validate($request->all(), ['filesId', 'filesId.*']);

    $this->moveFiles($request->filesId, $manuscript);

    $this->updateCurrentStep($manuscript, $validator, $request->step);

    $manuscript->save();
    DB::commit();

    return $manuscript;
  }

  public function updateBasicInformation(Request $request, SubGate $subGate, Manuscript $manuscript) {
    DB::beginTransaction();
    $validator = $this->validate($request->all(), ['title', 'category_id', 'abstract', 'keywords', 'keywords.*']);

    $manuscript->fill($request->only(['title', 'category_id', 'abstract']));

    $keywords = [];
    foreach ($request->keywords ?? [] as $keyword) {
      $keywords[] = Keyword::firstOrCreate(['name' => $keyword])->id;
    }
    $manuscript->keywords()->sync($keywords);

    $this->updateCurrentStep($manuscript, $validator, $request->step);

    $manuscript->save();
    DB::commit();
    return $manuscript;
  }

  public function updateAuthors(Request $request, SubGate $subGate, Manuscript $manuscript) {
    DB::beginTransaction();
    $validator
      = $this->validate($request->all(), ['authorsId', 'authorsId.*']);

    $manuscript->authors()->sync([
      $request->user()->id => ['is_corresponding_author' => true],
      ...($request->authorsId ?? [])
    ]);

    $this->updateCurrentStep($manuscript, $validator, $request->step);

    $manuscript->save();
    DB::commit();
    return $manuscript;
  }

  public function updateDetails(Request $request, SubGate $subGate, Manuscript $manuscript) {
    DB::beginTransaction();
    // dd($request->all());
    $isValid = true;
    $responses = [];
    foreach ($request->all() as $key => $value) {
      $keys = explode('_', $key);
      if ($keys[0] == 'field') {
        $response = FormAnswer::find($keys[1]);
        if ($response) {

          $response->answer = $value;
          $response->save();

          $validator = $response->getValidator();

          if ($validator->fails()) {
            $isValid = false;
          }

          $responses[] = $response;
        }
      }
    }

    if ($isValid) {
      $validator = $this->validate($request->all(), ['parent_id', 'funders',  'funders.*.id',  'funders.*.name',  'funders.*.grants',  'funders.*.grants.*']);
    }

    $manuscript->fill($request->only(['cover_letter', 'parent_id']));

    $funders = $manuscript->funders()->get();
    if ($request->has('funders')) {
      foreach ($request->funders as $funder) {
        $manuscript->funders()->updateOrCreate([
          'id' => $funder['id'],
          'manuscript_id' => $manuscript->id,
        ], [
          'name' => $funder['name'],
          'grants' => $funder['grants'],
        ]);
      }
      if ($funders->count() > collect($request->funders)->count()) {
        $manuscript->funders()->whereNotIn('id', array_column($request->funders, 'id'))->delete();
      }
    } else {
      $manuscript->funders()->delete();
    }

    $this->updateCurrentStep($manuscript, $validator ?? $isValid, $request->step);

    $manuscript->save();
    DB::commit();
    return $manuscript;
  }

  public function submit(SubGate $subGate, Manuscript $manuscript) {
    DB::beginTransaction();
    $data = $manuscript->toArray();
    $data['filesId'] = $manuscript->files->pluck('id')->toArray();
    $data['keywords'] = $manuscript->keywords->pluck('name')->toArray();

    $validator = $this->validate($data);

    $this->updateCurrentStep($manuscript, $validator, 5);
    if (!$validator->fails()) {
      $manuscript->submitted_at = now();

      //generate code
      $latestManuscript = Manuscript::orderBy('submitted_at', 'desc')->first();
      $datenow = \Carbon\Carbon::now()->format('mY');
      $manuscript->number = $datenow !=
        \Carbon\Carbon::parse($latestManuscript->created_at)->format('mY') ? 1 : $latestManuscript->number + 1;
      $manuscript->code = config('app.name_alias') . "-" .
        $datenow . "-" . sprintf('%04d', $manuscript->number);
    }

    $result = $this->taskServices->delegateToEditorAssistant($manuscript);
    if ($result) {
      $manuscript->logs()->create([
        'user_id' => Auth::user()->id,
        'activity' => 'This manuscript has been submitted',
        'created_at' => now()->addSeconds(-1),
      ]);
    }

    $manuscript->save();
    DB::commit();

    return $manuscript;
  }

  public function cancel(Manuscript $manuscript) {
    DB::beginTransaction();
    $manuscript->canceled_at = now();

    $manuscript->steps()->detach();

    $manuscript->logs()->create([
      'user_id' => Auth::user()->id,
      'activity' => 'This manuscript was cancelled',
    ]);

    $manuscript->save();
    DB::commit();
  }
}
