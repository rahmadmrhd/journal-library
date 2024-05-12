<?php

namespace App\Services\Manuscripts;

use App\Models\Manuscript\Category;
use App\Models\Manuscript\File;
use App\Models\Manuscript\FileType;
use App\Models\Manuscript\Keyword;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\StepSubmission;
use Illuminate\Http\Request;
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
    $steps = $steps->map(function ($step) use ($progress) {
      $step->status = $progress->find($step->id)->pivot->status ?? null;
      return $step;
    });


    // show data every step
    switch ($manuscript->current_step) {
      case 1:
        $rules = ['filesId', 'filesId.*'];
        $data['file_types'] = FileType::orderBy('required', 'desc')->get();
        $manuscript->filesId = $manuscript->files->pluck('id')->toArray();
        break;
      case 2:
        $data['categories'] = Category::all();
        $rules = ['title', 'category_id', 'abstract', 'keywords', 'keywords.*'];
        $manuscript->keywords = $manuscript->keywords->pluck('name')->toArray();
        break;
    }

    //set data manuscript
    $data['manuscript'] = $manuscript;

    // validation data
    if ($manuscript->steps()->get()->where('id', $manuscript->current_step)->first()) {
      $validator = $this->validate($manuscript->toArray(), $rules);
      if ($validator->fails()) {
        $data['errors'] = $validator->errors();
        $data['alert'] = [
          'type' => 'error',
          'messages' => collect($validator->errors()->getMessages())->map(function ($messages, $key) {
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

  public function create(Request $request) {
    $validator = $this->validate($request->filesId ?? [], ['filesId', 'filesId.*']);
    $validator->validate();

    $manuscript = Manuscript::create([]);

    $this->moveFiles($request->filesId, $manuscript);

    $manuscript->steps()->attach([1 => ['status' => 'success']]);

    $manuscript->current_step = 2;

    $manuscript->save();

    return $manuscript;
  }

  public function updateFile(Request $request, Manuscript $manuscript) {
    $validator = $this->validate($request->filesId, ['filesId', 'filesId.*']);
    $manuscript->steps()->updateExistingPivot(1, ['status' => 'success']);

    $this->moveFiles($request->filesId, $manuscript);

    $manuscript->current_step = $validator->fails() ?
      $manuscript->current_step : ($request->step ?? $manuscript->current_step + 1);

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

    $manuscript->steps()->syncWithoutDetaching([
      $manuscript->current_step => [
        'status' => 'error',
      ],
    ]);
    $manuscript->current_step = $validator->fails() ?
      $manuscript->current_step : ($request->step ?? $manuscript->current_step + 1);

    $manuscript->save();
    return $manuscript;
  }
}
