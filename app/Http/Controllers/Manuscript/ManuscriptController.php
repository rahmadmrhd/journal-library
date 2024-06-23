<?php

namespace App\Http\Controllers\Manuscript;

use App\Http\Controllers\Controller;
use App\Models\Manuscript\FileType;
use App\Models\Manuscript\Manuscript;
use App\Models\SubGate;
use App\Services\Manuscripts\SubmitNewManuscriptServices;
use App\Services\Manuscripts\TaskServices;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class ManuscriptController extends Controller {
  use AuthorizesRequests;
  private SubmitNewManuscriptServices $service;
  private TaskServices $taskServices;
  public function __construct(SubmitNewManuscriptServices $service, TaskServices $taskServices) {
    $this->service = $service;
    $this->taskServices = $taskServices;
  }
  /**
   * Display a listing of the resource.
   */
  public function index(SubGate $subGate) {
    $manuscript = Manuscript::with('subGate')->latest();
    $manuscript->where('sub_gate_id', $subGate->id);

    return view('pages.manuscripts.index', [
      'manuscripts' => $manuscript->paginate(10),
      'subGate' => $subGate,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request, SubGate $subGate, Manuscript $manuscript = null) {
    if ($manuscript) {
      if ($manuscript->submitted_at) {
        return redirect()->route('manuscripts.show', ['subGate' => $subGate, 'manuscript' => $manuscript]);
      }
      if ($manuscript->sub_gate_id != $subGate->id) {
        return abort((404));
      }
      Gate::authorize('update', $manuscript);
    } else {
      Gate::authorize('create', Manuscript::class);

      $isAlready = $this->service->isAlreadySubmitted($request, $subGate);
      if ($isAlready) {
        return redirect()->route('manuscripts.index', ['subGate' => $subGate->slug])->with('already-submission', $isAlready);
      }
    }

    $data = $this->service->showSubmission($manuscript);

    return view('pages.manuscripts.form', [
      ...$data,
      'subGate' => $subGate,
    ]);
  }

  public function changeStep(Request $request, SubGate $subGate, Manuscript $manuscript = null) {
    if ($manuscript) {
      $manuscript->current_step = $request->step;
      $manuscript->save();
      return redirect()->route('manuscripts.create', ['manuscript' => $manuscript, 'subGate' => $subGate->slug]);
    }
    return redirect()->route('manuscripts.create', ['subGate' => $subGate])->with('alert', [
      'type' => 'error',
      'message' => 'Please upload a file first!',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function storeFile(Request $request, SubGate $subGate, Manuscript $manuscript = null) {
    if ($manuscript) {
      Gate::authorize('update', $manuscript);
      $manuscript = $this->service->updateFile($request, $subGate,  $manuscript);
    } else {
      Gate::authorize('create', Manuscript::class);
      $manuscript = $this->service->create($request, $subGate);
    }

    return redirect()->route('manuscripts.create', ['manuscript' => $manuscript, 'subGate' => $subGate->slug]);
  }

  public function storeBasicInformation(Request $request, SubGate $subGate, Manuscript $manuscript) {
    Gate::authorize('update', $manuscript);
    $manuscript = $this->service->updateBasicInformation($request, $subGate,  $manuscript);

    return redirect()->route('manuscripts.create', ['manuscript' => $manuscript, 'subGate' => $subGate->slug]);
  }

  public function storeAuthors(Request $request, SubGate $subGate, Manuscript $manuscript) {
    Gate::authorize('update', $manuscript);
    $manuscript = $this->service->updateAuthors($request, $subGate,  $manuscript);

    return redirect()->route('manuscripts.create', ['manuscript' => $manuscript, 'subGate' => $subGate->slug]);
  }

  public function storeDetails(Request $request, SubGate $subGate, Manuscript $manuscript) {
    Gate::authorize('update', $manuscript);
    $manuscript = $this->service->updateDetails($request, $subGate,  $manuscript);

    return redirect()->route('manuscripts.create', ['manuscript' => $manuscript, 'subGate' => $subGate->slug]);
  }

  public function submit(SubGate $subGate, Manuscript $manuscript) {
    // Gate::authorize('update', $manuscript);

    $manuscript = $this->service->submit($subGate, $manuscript);

    if (!$manuscript->submitted_at) {
      return redirect()->route('manuscripts.create', ['manuscript' => $manuscript, 'subGate' => $subGate->slug]);
    }

    return redirect()->route('manuscripts.index', ['subGate' => $subGate->slug])->with('alert', [
      'type' => 'success',
      'messages' => 'Manuscript submitted successfully!',
    ]);
  }

  public function cancel(SubGate $subGate, Manuscript $manuscript) {
    Gate::authorize('cancel', $manuscript);

    $this->service->cancel($manuscript);

    return redirect()->route('manuscripts.index', ['subGate' => $subGate->slug])->with('alert', [
      'type' => 'success',
      'message' => 'Manuscript canceled successfully!',
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(SubGate $subGate, Manuscript $manuscript) {
    if (!$manuscript->submitted_at) {
      return redirect()->route('manuscripts.create', ['subGate' => $subGate, 'manuscript' => $manuscript]);
    }
    Gate::authorize('view', $manuscript);

    return view('pages.manuscripts.show', [
      'manuscript' => $manuscript,
      'file_types' => FileType::orderBy('required', 'desc')->get(),
      'subGate' => $subGate,
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(SubGate $subGate, Manuscript $manuscript) {
    Gate::authorize('delete', $manuscript);

    $manuscript->delete();

    return redirect()->route('manuscripts.index', ['subGate' => $subGate->slug])->with('alert', [
      'type' => 'success',
      'message' => 'Manuscript deleted successfully!',
    ]);
  }
}
