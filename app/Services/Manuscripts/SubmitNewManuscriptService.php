<?php

namespace App\Services\Manuscripts;

use App\Models\Manuscript\File;
use App\Models\Manuscript\Manuscript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmitNewManuscriptService {
  public function __construct() {
  }

  private function moveFiles($filesId, Manuscript $manuscript) {
    collect($filesId)->each(function ($fileId) use ($manuscript) {
      $file = File::find($fileId);
      $file->manuscript_id = $manuscript->id;
      if (!$file->is_temporary)
        return;
      $newPath = "manuscript/{$manuscript->id}/{$file->id}.{$file->extension}";
      Storage::move($file->path, $newPath);
      $file->update(['path' => $newPath]);
    });
  }

  public function create($filesId) {
    $manuscript = Manuscript::create(['current_step' => 2]);

    $this->moveFiles($filesId, $manuscript);

    $manuscript->steps()->attach([1 => ['status' => 'success']]);

    $manuscript->save();

    return $manuscript;
  }

  public function updateFile(Manuscript $manuscript, $filesId) {
    $manuscript->current_step = 2;
    $manuscript->steps()->updateExistingPivot(1, ['status' => 'success']);

    $this->moveFiles($filesId, $manuscript);

    $manuscript->save();

    return $manuscript;
  }
}
