<?php

namespace App\Services\Manuscripts;

use App\Models\Manuscript\File;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\Task;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TaskServices {
  private function validate($data, array $fieldRules = null): \Illuminate\Validation\Validator {
    return
      Validator::make(
        $data,
        Task::rules($fieldRules),
        Task::messages()
      );
  }
  private function moveFiles($filesId, Task $task) {
    collect($filesId)->each(function ($fileId) use ($task) {
      $file = File::find($fileId);

      $file->fileable()->associate($task);

      if (!$file->is_temporary)
        return;
      $newPath = "files/manuscripts/{$task->manuscript->id}/{$file->id}.{$file->extension}";
      Storage::move($file->path, $newPath);
      $file->update(['path' => $newPath]);
    });
  }

  public function delegateToEditorAssistant(Manuscript $manuscript) {
    $users = User::with(['roles', 'tasks'])->whereHas('roles', function (Builder $query) {
      $query->where('slug', 'editor-assistant');
    })->whereNot('users.id', Auth::user()->id)->get();

    $user = $users->map(function ($user) {
      $u = (object) [];
      $u->tasks = $user->tasks->groupBy('status')->map(function ($tasks) {
        return $tasks->count();
      });
      $u->id = $user->id;
      return $u;
    })->sort(function ($a, $b) {
      return $a->tasks['in_progress'] ?? 0 > $b->tasks['in_progress'] ??0;
    })->first();

    Task::create([
      'manuscript_id' => $manuscript->id,
      'user_id' => $user->id,
      'role_id' => Role::where('slug', 'editor-assistant')->first()->id,
      'status' => 'in_progress',
      'deadline' => now()->addDays(7),
    ]);
  }
  private function delegateToEditorInChief(Task $task) {
    $users = User::with(['roles', 'tasks'])->whereHas('roles', function (Builder $query) {
      $query->where('slug', 'editor-in-chief');
    })->whereNot('users.id', Auth::user()->id)->get();

    $user = $users->map(function ($user) {
      $u = (object) [];
      $u->tasks = $user->tasks->groupBy('status')->map(function ($tasks) {
        return $tasks->count();
      });
      $u->id = $user->id;
      return $u;
    })->sort(function ($a, $b) {
      return $a->tasks['in_progress'] ?? 0 > $b->tasks['in_progress'] ??0;
    })->first();

    Task::create([
      'manuscript_id' => $task->manuscript->id,
      'user_id' => $user->id,
      'role_id' => Role::where('slug', 'editor-in-chief')->first()->id,
      'status' => 'in_progress',
      'deadline' => now()->addDays(7),
    ]);
  }

  public function show(Task $task) {

    $data = [
      'task' => $task,
      'manuscript' => $task->manuscript,
    ];
    // dd($task->toArray());
    // validation data
    $validator = $this->validate($task->toArray());
    if ($validator->fails()) {
      $data['errors'] = $validator->errors();
      $messages = collect($validator->errors()->getMessages())->map(function ($messages) {
        return collect($messages)->values();
      })->values()->collapse();
      $data['alert'] = [
        'type' => 'error',
        'title' => 'Please fix the following issues then click "Submit":',
        'messages' => $messages->toArray(),
      ];
    }
    return $data;
  }


  public function update(Request $request, Task $task) {
    $request->merge([
      'notes' => json_decode($request->notes, true),
    ]);

    $validator = $this->validate($request->all(), [
      'decision',
      'notes',
      'filesId',
      'filesId.*'
    ]);

    $task->decision = $request->decision;
    $task->notes = $request->notes;

    $this->moveFiles($request->filesId, $task);

    if ($validator->fails()) {
      $task->save();
      return $task;
    }

    switch ($task->role->slug) {
      case 'editor-assistant':
        $task->status = 'done';
        break;
      case 'editor-in-chief':
      case 'academic-editor':
        $task->status = 'delegated';
        break;
      default:
        break;
    }

    $task->save();

    if ($request->submit == 'Submit') {
      $this->delegateToEditorInChief($task);
    }

    return $task;
  }
}
