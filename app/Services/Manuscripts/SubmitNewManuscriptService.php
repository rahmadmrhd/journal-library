<?php

namespace App\Services\Manuscripts;

use App\Models\Manuscript\Category;
use App\Models\Manuscript\File;
use App\Models\Manuscript\FileType;
use App\Models\Manuscript\Keyword;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\StepSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubmitNewManuscriptService {

  private function validate($data, array $fieldRules = null): \Illuminate\Validation\Validator {
    return
      Validator::make(
        $data,
        Manuscript::rules($fieldRules),
        Manuscript::messages()
      );
  }
  private function updateCurrentStep(Manuscript &$manuscript, $validator, $step) {
    $manuscript->steps()->syncWithoutDetaching([$manuscript->current_step => ['status' => $validator->fails() ? 'error' : 'success']]);

    if ($manuscript->current_step < 5) {
      $manuscript->current_step = $validator->fails() ?
        $manuscript->current_step : ($step ?? $manuscript->current_step + 1);
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
      $data['file_types'] = FileType::orderBy('required', 'desc')->get();
      return $data;
    }

    //get progress
    $progress = $manuscript->steps;
    $isSuccess = true;
    $steps = $steps->map(function ($step) use ($progress, &$isSuccess) {
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
        break;
    }

    //set data manuscript
    $data['manuscript'] = $manuscript;

    // validation data
    if ($manuscript->current_step == 5 || $progress->where('id', $manuscript->current_step)->first()) {
      $validator = $this->validate($manuscript->toArray(), $rules);
      if ($validator->fails()) {
        $data['errors'] = $validator->errors();
        $data['alert'] = [
          'type' => 'error',
          'title' => 'Please fix the following issues then click Save & Continue:',
          'messages' => collect($validator->errors()->getMessages())->map(function ($messages) {
            $messages = collect($messages)->join('\n');
            return $messages;
          })->values()->toArray(),
        ];
      }
    }


    return $data;
  }

  private function moveFiles($filesId, Manuscript $manuscript) {
    collect($filesId)->each(function ($fileId) use ($manuscript) {
      $file = File::find($fileId);
      $file->manuscript_id = $manuscript->id;
      if (!$file->is_temporary)
        return;
      $newPath = "files/manuscripts/{$manuscript->id}/{$file->id}.{$file->extension}";
      Storage::move($file->path, $newPath);
      $file->update(['path' => $newPath]);
    });
  }

  public function isAlreadySubmitted() {
    return Auth::user()->manuscripts()->whereNull('submited_at')->wherePivot('is_corresponding_author', true)->latest()->first();
  }

  public function create(Request $request) {
    $validator = $this->validate($request->all(), ['filesId', 'filesId.*']);
    $validator->validate();

    $manuscript = Manuscript::create([]);

    $this->moveFiles($request->filesId, $manuscript);

    $manuscript->authors()->attach([$request->user()->id => ['is_corresponding_author' => true]]);

    $manuscript->steps()->attach([1 => ['status' => 'success']]);

    $manuscript->current_step = 2;

    $manuscript->save();

    return $manuscript;
  }

  public function updateFile(Request $request, Manuscript $manuscript) {
    $validator = $this->validate($request->all(), ['filesId', 'filesId.*']);

    $this->moveFiles($request->filesId, $manuscript);

    $this->updateCurrentStep($manuscript, $validator, $request->step);

    $manuscript->save();

    return $manuscript;
  }

  public function updateBasicInformation(Request $request, Manuscript $manuscript) {
    $validator = $this->validate($request->all(), ['title', 'category_id', 'abstract', 'keywords', 'keywords.*']);

    $manuscript->fill($request->only(['title', 'category_id', 'abstract']));


    $keywords = [];
    foreach ($request->keywords ?? [] as $keyword) {
      $keywords[] = Keyword::firstOrCreate(['name' => $keyword])->id;
    }
    $manuscript->keywords()->sync($keywords);

    $this->updateCurrentStep($manuscript, $validator, $request->step);

    $manuscript->save();
    return $manuscript;
  }

  public function updateAuthors(Request $request, Manuscript $manuscript) {
    $validator = $this->validate($request->all(), ['authorsId', 'authorsId.*']);

    $manuscript->authors()->sync([
      $request->user()->id => ['is_corresponding_author' => true],
      ...($request->authorsId ?? [])
    ]);

    $this->updateCurrentStep($manuscript, $validator, $request->step);

    $manuscript->save();
    return $manuscript;
  }

  public function updateDetails(Request $request, Manuscript $manuscript) {
    $request->merge([
      'potential_conflict' => $request->has('potential_conflict') ? ($request->potential_conflict ?? false) : null,
      'paper_contain' => $request->has('paper_contain') ? ($request->paper_contain ?? false) : null,
      'open_access' => $request->has('open_access') ? ($request->open_access ?? false) : null,
      'using_paperpal' => $request->has('using_paperpal') ? ($request->using_paperpal ?? false) : null,
    ]);
    $validator = $this->validate($request->all(), ['parent_id', 'funders',  'funders.*.id',  'funders.*.name',  'funders.*.grants',  'funders.*.grants.*',   'potential_conflict',  'paper_contain',  'open_access',  'using_paperpal']);

    $manuscript->fill($request->only(['parent_id', 'potential_conflict', 'paper_contain', 'open_access', 'using_paperpal']));

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

    $this->updateCurrentStep($manuscript, $validator, $request->step);

    $manuscript->save();
    return $manuscript;
  }
  public function submit(Manuscript $manuscript) {
    $data = $manuscript->toArray();
    $validator = $this->validate($data);

    $this->updateCurrentStep($manuscript, $validator, 5);
    if (!$validator->fails()) {
      $manuscript->submited_at = now();
    }
    return $manuscript;
  }
}
