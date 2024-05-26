<?php

namespace App\Http\Controllers\Manuscript;

use App\Http\Controllers\Controller;
use App\Models\Manuscript\Task;
use App\Services\Manuscripts\TaskServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller {
  private TaskServices $service;
  public function __construct(TaskServices $service) {
    $this->service = $service;
  }

  public function indexAssignment(Request $request) {
    Gate::authorize('viewAny', Task::class);

    $tasks = Task::latest()
      ->where('role_id', Auth::user()->current_role_id)
      ->where('user_id', Auth::user()->id)
      ->where('status', 'in_progress');

    return view('pages.tasks.index', [
      'type' => 'Assignment',
      'tasks' => $tasks->paginate(10),
    ]);
  }

  public function show(Request $request, Task $task) {
    Gate::authorize('view', $task);

    if ($task->processed_at == null) {
      $task->update(['processed_at' => now()]);
    }

    $data = $this->service->show($task);

    return view('pages.manuscripts.show', $data);
  }

  public function update(Request $request, Task $task) {
    // Gate::authorize('update', $task);

    $task = $this->service->update($request, $task);

    if ($task->status == 'in_progress') {
      return redirect()->route('tasks.show', $task)->with('alert', [
        'type' => 'error',
        'title' => 'Task has not been updated',
      ]);
    }

    return redirect()->route('tasks.indexAssignment')->with('alert', [
      'type' => 'success',
      'title' => 'Task has been updated',
    ]);
  }
}
