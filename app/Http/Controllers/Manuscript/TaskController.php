<?php

namespace App\Http\Controllers\Manuscript;

use App\Http\Controllers\Controller;
use App\Models\Manuscript\Task;
use App\Models\SubGate;
use App\Services\Manuscripts\TaskServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller {
  private TaskServices $service;
  public function __construct(TaskServices $service) {
    $this->service = $service;
  }

  public function indexInvitation(Request $request, SubGate $subGate) {
    return $this->index($request, 'Invitation', 'invitation', $subGate);
  }
  public function indexAssignment(Request $request, SubGate $subGate) {
    return $this->index($request, 'Assignment', 'in_progress', $subGate);
  }
  public function indexInProgress(Request $request, SubGate $subGate) {
    return $this->index($request, 'In Progress', 'delegated', $subGate);
  }
  public function indexFinalization(Request $request, SubGate $subGate) {
    return $this->index($request, 'Finalization', 'finalization', $subGate);
  }
  public function indexHistory(Request $request, SubGate $subGate) {
    return $this->index($request, 'History',  'done', $subGate);
  }

  private function index(Request $request, string $type, string $status, SubGate $subGate) {
    if ($status == 'invitation') {
      $invitations = $request->user()->invitations()
        ->where(function ($query) {
          $query->where('task_invitations.status', 'invited');
          $query->orWhereRaw(
            'DATEDIFF(`task_invitations`.`invited_at`, NOW()) > `task_invitations`.`deadline`',
          );
        })
        ->wherePivot('role_id', $request->user()->currentRole->id)
        ->with(['manuscript', 'subGate', 'manuscript.authors'])->latest();

      return view('pages.tasks.index', [
        'subGate' => $subGate,
        'type' => $type,
        'tasks' => $invitations->paginate(10),
      ]);
    }
    $tasks = Task::with(['subGate', 'manuscript', 'manuscript.authors'])->latest()
      ->where('role_id', Auth::user()->current_role_id)
      ->where('user_id', Auth::user()->id);

    if ($status == 'in_progress') {
      $tasks->where(function ($query) {
        $query->where('status', 'in_progress')
          ->orWhere('status', 'pending');
      });
    } else {
      $tasks->where('status', $status);
    }

    return view('pages.tasks.index', [
      'subGate' => $subGate,
      'type' => $type,
      'tasks' => $tasks->paginate(10),
    ]);
  }


  public function show(Request $request, SubGate $subGate, Task $task) {
    Gate::authorize('view', $task);

    if ($task->status == 'pending') {
      $task->update(['status' => 'in_progress']);
    }

    $data = $this->service->show($task);

    $data['subGate'] = $subGate;
    return view('pages.manuscripts.show', $data);
  }

  public function update(Request $request, SubGate $subGate, Task $task) {
    // Gate::authorize('update', $task);

    $task = $this->service->update($request, $task);

    if ($task->status == 'in_progress' && $request->submit == 'Submit') {
      return redirect()->route('tasks.show', ['subGate' => $subGate->slug, 'task' => $task])->with('alert', [
        'type' => 'error',
        'title' => 'Task has not been updated',
      ]);
    }

    return redirect()->route('tasks.indexAssignment', $subGate->slug)->with('alert', [
      'type' => 'success',
      'title' => 'Task has been updated',
    ]);
  }

  public function invitationDecision(Request $request, SubGate $subGate, Task $task) {
    $this->service->invitationDecision($request, $subGate, $task);

    if ($request->user()->invitations()->wherePivot('status', 'invited')->count() > 0) {
      return redirect()->route('tasks.indexInvitation', $subGate->slug);
    }

    return redirect()->route('tasks.indexAssignment', $subGate->slug);
  }
}
