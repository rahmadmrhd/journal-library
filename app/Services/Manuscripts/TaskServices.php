<?php

namespace App\Services\Manuscripts;

use App\Models\Form\Form;
use App\Models\Log;
use App\Models\Manuscript\File;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\Task;
use App\Models\Manuscript\TaskDetail;
use App\Models\Role;
use App\Models\SubGate;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
  private function moveFiles($filesId, TaskDetail $taskDetail) {
    collect($filesId)->each(function ($fileId) use ($taskDetail) {
      $file = File::find($fileId);

      $file->fileable()->associate($taskDetail);

      if (!$file->is_temporary)
        return;
      $newPath = "files/manuscripts/{$taskDetail->task->manuscript->id}/{$file->id}.{$file->extension}";
      Storage::move($file->path, $newPath);
      $file->update(['path' => $newPath]);
    });
  }

  public function delegateToEditorAssistant(Manuscript $manuscript) {
    if ($manuscript->tasks()->count() > 0) {
      return false;
    }
    $users = User::with(['roles', 'tasks'])->whereHas('roles', function (Builder $query) {
      $query->where('slug', 'editor-assistant');
    })->whereNotIn('users.id', $manuscript->authors->pluck('id'))
      ->get();

    $user = $users->map(function ($user) {
      $u = (object) [];
      $u->tasks = $user->tasks->groupBy('status')->map(function ($tasks) {
        return $tasks->count();
      });
      $u->full_name = $user->getFullName();
      $u->id = $user->id;
      return $u;
    })->sort(function ($a, $b) {
      if ($a->tasks->isEmpty() || $b->tasks->isEmpty()) {
        if ($b->tasks->isEmpty())
          return true;
        return false;
      }
      $countA = ($a->tasks['in_progress'] ?? 0) + ($a->tasks['pending'] ?? 0);
      $countB = ($a->tasks['in_progress'] ?? 0) + ($a->tasks['pending'] ?? 0);

      if ($countA === $countB) {
        $countA = ($a->tasks['done'] ?? 0);
        $countB = ($a->tasks['done'] ?? 0);
        return $countA > $countB;
      }
      return $countA > $countB;
    })->first();

    // dd($user->toArray());
    $newTask = Task::create([
      'sub_gate_id' => $manuscript->subGate->id,
      'manuscript_id' => $manuscript->id,
      'user_id' => $user->id,
      'role_id' => Role::where('slug', 'editor-assistant')->first()->id,
      'status' => 'pending',
      'deadline' => 7,
    ]);

    $manuscript->logs()->create([
      'activity' => "This manuscript has been assigned to Editor Assistant",
    ]);
    return true;
  }

  private function delegateToEditorInChief(Task $task) {
    if ($task->children()->count() > 0) {
      return false;
    }
    $users = User::with(['roles', 'tasks'])->whereHas('roles', function (Builder $query) {
      $query->where('slug', 'editor-in-chief');
    })->whereNotIn('users.id', $task->manuscript->authors->pluck('id'))
      ->get();

    $user = $users->map(function ($user) {
      $u = (object) [];
      $u->tasks = $user->tasks->groupBy('status')->map(function ($tasks) {
        return $tasks->count();
      });
      $u->id = $user->id;
      return $u;
    })->sort(function ($a, $b) {
      if ($a->tasks->isEmpty() || $b->tasks->isEmpty()) {
        if ($b->tasks->isEmpty())
          return true;
        return false;
      }
      $countA = ($a->tasks['in_progress'] ?? 0) + ($a->tasks['pending'] ?? 0);
      $countB = ($a->tasks['in_progress'] ?? 0) + ($a->tasks['pending'] ?? 0);

      if ($countA === $countB) {
        $countA = ($a->tasks['done'] ?? 0) + ($a->tasks['delegated'] ?? 0);
        $countB = ($a->tasks['done'] ?? 0) + ($a->tasks['delegated'] ?? 0);
        return $countA > $countB;
      }
      return $countA > $countB;
    })->first();

    $newTask = Task::create([
      'sub_gate_id' => $task->subGate->id,
      'manuscript_id' => $task->manuscript->id,
      'parent_id' => $task->id,
      'user_id' => $user->id,
      'role_id' => Role::where('slug', 'editor-in-chief')->first()->id,
      'status' => 'in_progress',
      'deadline' => 7,
    ]);

    $task->manuscript->logs()->create([
      'activity' => "This manuscript has been assigned to Editor In Chief",
    ]);
    return true;
  }

  public function show(Task $task) {

    $data = [
      'task' => $task,
      'manuscript' => $task->manuscript,
    ];

    $detail = $task->details()->whereNull('submitted_at')->first();

    if ($task->status != 'in_progress' || $task->processed_at == null) {
      if ($task->processed_at == null) {
        $data['detail'] = $detail ?? ((object) []);
      }
      return $data;
    }

    $validator = $this->validate($detail->toArray(), [
      'decision',
      'notes',
      'notes.blocks',
      'filesId',
      'filesId.*'
    ]);

    if ($validator->fails() && $task->processed_at != null) {
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

    $data['detail'] = $detail;
    return $data;
  }

  private function createOrUpdateTaskDetails(Request $request, Task $task, Role $role) {
    switch ($role->slug) {
      case 'editor-assistant':
        return $task->details()->updateOrCreate([
          'task_id' => $task->id,
          'to_role_id' => Role::findWithSlug($request->decision == 'accept' ? 'editor-in-chief' : 'author')->id
        ], [
          'decision' => $request->decision,
          'notes' => $request->notes,
        ]);

      case 'editor-in-chief':
        return $task->details()->updateOrCreate([
          'task_id' => $task->id,
          'to_role_id' => Role::findWithSlug($request->decision == 'accept' ? 'publisher' : ($request->decision == 'continue' ? 'academic-editor' : 'author'))->id
        ], [
          'decision' => $request->decision,
          'notes' => $request->notes,
        ]);

      case 'academic-editor':
        return $task->details()->updateOrCreate([
          'task_id' => $task->id,
          'to_role_id' => Role::findWithSlug($request->decision == 'accept' ? 'editor-in-chief' : ($request->decision == 'continue' ? 'reviewer' : 'author'))->id
        ], [
          'decision' => $request->decision,
          'notes' => $request->notes,
        ]);

      case 'reviewer':
        return $task->details()->updateOrCreate([
          'task_id' => $task->id,
          'to_role_id' => Role::findWithSlug('academic-editor')->id
        ], [
          'decision' => $request->decision,
          'notes' => $request->notes,
        ]);
    }
  }

  public function update(Request $request, Task $task) {
    DB::beginTransaction();

    $request->merge([
      'notes' => json_decode($request->notes, true),
    ]);

    $validator = $this->validate($request->all(), [
      'decision',
      'notes',
      'filesId',
      'filesId.*'
    ]);

    $taskRole = $task->role;

    $detail = $this->createOrUpdateTaskDetails($request, $task, $taskRole);

    if ($task->processed_at == null) {
      $task->processed_at = now();
      $task->manuscript->logs()->create([
        'user_id' => Auth::user()->id,
        'activity' => "This manuscript is being processed by the " . $taskRole->name,
        'created_at' => now()->addSeconds(-3),
      ]);
    }

    $this->moveFiles($request->filesId, $detail);

    $responses = Form::updateAnswers($request);
    // dd($responses);

    if ($validator->fails()) {
      $task->save();
      DB::commit();
      return $task;
    }

    if ($request->decision == 'continue' && ($taskRole->slug == 'editor-in-chief' || $taskRole->slug == 'academic-editor')) {
      $usersInvitation = collect($request->users)->map(function ($user) use ($request, $detail, $taskRole) {
        return [
          $user['id'] => [
            'deadline' => $request->deadline,
            'status' => 'pending',
            'invited_at' => now(),
            'role_id' => $taskRole->slug == 'editor-in-chief' ? 5 : 2,
            'task_detail_id' => $detail->id
          ]
        ];
      })->collapse();

      $detail->invites()->sync($usersInvitation->toArray());
    }


    if ($request->submit == 'Submit') {

      $task->completed_at = now();

      switch ($taskRole->slug) {
        case 'editor-assistant':
          $task->status = 'done';

          if ($request->decision == 'accept') {
            $result = $this->delegateToEditorInChief($task);
          }
          break;
        case 'editor-in-chief':
        case 'academic-editor':
          if ($request->decision == 'continue') {
            $task->status = 'delegated';

            $detail->invites()->update(['status' => 'invited']);

            $task->manuscript->logs()->create([
              'user_id' => Auth::user()->id,
              'activity' => 'Invite ' . $taskRole->slug == 'editor-in-chief' ? 'Academic Editors' : 'Reviewers' . ' to review this manuscript',
              'created_at' => now()->addSeconds(-1),
            ]);
          } else {
            $task->status = 'done';
          }
          break;
        case 'reviewer':
          $task->status = 'done';
          break;
        default:
          break;
      }

      $detail->update([
        'submitted_at' => now(),
      ]);

      if ((isset($result) && $result) || $request->decision != 'accept') {
        $task->manuscript->logs()->create([
          'user_id' => Auth::user()->id,
          'activity' => $task->role->name . " has finished reviewing this manuscript",
          'created_at' => now()->addSeconds(-2),
        ]);
      }
    }

    $task->save();

    DB::commit();
    return $task;
  }

  public function invitationDecision(Request $request, SubGate $subGate, Task $task) {
    DB::beginTransaction();

    $taskDetail = $task->details()->where('to_role_id', $request->user()->currentRole->id)->first();

    $countAccepted = $taskDetail->invites()->wherePivot('status', 'accepted')->count();
    if ($countAccepted > 0) {
      if ($task->role->slug == 'academic-editor') {
        return;
      }
      $row = $taskDetail->invites()->wherePivot('status', '<>', 'accepted')->pluck('users.id')->map(function ($id) {
        return [
          $id => [
            'status' => 'expired',
          ]
        ];
      })->collapse();
      $taskDetail->invites()->syncWithoutDetaching($row);
      DB::commit();
      return;
    }

    if ($request->decision == 'reject') {
      $taskDetail->invites()->updateExistingPivot($request->user()->id, [
        'status' => 'rejected',
        'rejected_at' => now(),
      ]);

      DB::commit();
      return;
    }

    $invitation = $taskDetail->invites()->where('users.id', $request->user()->id)->first();
    $invitation->pivot->update(['status' => 'accepted', 'accepted_at' => now()]);

    if ($task->role->slug == 'editor-in-chief') {
      $row = $taskDetail->invites()->wherePivot('status', '<>', 'accepted')->pluck('users.id')->map(function ($id) {
        return [
          $id => [
            'status' => 'expired',
          ]
        ];
      })->collapse();
      $taskDetail->invites()->syncWithoutDetaching($row);
    }

    $task->manuscript->logs()->create([
      'user_id' => Auth::user()->id,
      'activity' => $task->role->name . " has accepted your invitation to review this manuscript",
      'created_at' => now()->addSeconds(-2),
    ]);

    $user = $request->user();
    $newTask = Task::create([
      'sub_gate_id' => $task->subGate->id,
      'manuscript_id' => $task->manuscript->id,
      'parent_id' => $task->id,
      'user_id' => $user->id,
      'role_id' => $user->currentRole->id,
      'status' => 'in_progress',
      'deadline' => $invitation->pivot->deadline,
    ]);
    if ($user->currentRole->slug == 'reviewer') {
      $detail = $this->createOrUpdateTaskDetails($request, $newTask, $user->currentRole);
      $detail->responses()->createMany(Form::getQuestions(Task::class, $subGate, $request->user()));
    }


    DB::commit();
  }
}
