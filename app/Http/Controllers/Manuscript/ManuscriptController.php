<?php

namespace App\Http\Controllers\Manuscript;

use App\Http\Controllers\Controller;
use App\Models\Manuscript\FileType;
use App\Models\Manuscript\Manuscript;
use App\Services\Manuscripts\SubmitNewManuscriptService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ManuscriptController extends Controller {
  use AuthorizesRequests;
  private SubmitNewManuscriptService $service;
  public function __construct(SubmitNewManuscriptService $service) {
    $this->service = $service;
  }
  /**
   * Display a listing of the resource.
   */
  public function index() {
    $manuscript = Manuscript::latest();
    return view('pages.manuscripts.index', [
      'manuscripts' => $manuscript->paginate(10),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request, Manuscript $manuscript = null) {
    if ($manuscript) {
      if ($manuscript->submitted_at) {
        return redirect()->route('manuscripts.show', $manuscript);
      }
      Gate::authorize('update', $manuscript);
    } else {
      Gate::authorize('create', Manuscript::class);
      $isAlready = $this->service->isAlreadySubmitted($request);
      if ($isAlready) {
        return redirect()->route('manuscripts.index')->with('already-submission', $isAlready);
      }
    }
    $data = $this->service->showSubmission($manuscript);

    return view('pages.manuscripts.form', $data);
  }

  public function changeStep(Request $request, Manuscript $manuscript = null) {
    if ($manuscript) {
      $manuscript->current_step = $request->step;
      $manuscript->save();
      return redirect()->route('manuscripts.create', $manuscript);
    }
    return redirect()->route('manuscripts.create')->with('alert', [
      'type' => 'error',
      'message' => 'Please upload a file first!',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function storeFile(Request $request, Manuscript $manuscript = null) {
    if ($manuscript) {
      Gate::authorize('update', $manuscript);
      $manuscript = $this->service->updateFile($request, $manuscript);
    } else {
      Gate::authorize('create', Manuscript::class);
      $manuscript = $this->service->create($request);
    }

    return redirect()->route('manuscripts.create', $manuscript);
  }

  public function storeBasicInformation(Request $request, Manuscript $manuscript) {
    Gate::authorize('update', $manuscript);
    $manuscript = $this->service->updateBasicInformation($request, $manuscript);

    return redirect()->route('manuscripts.create', $manuscript);
  }

  public function storeAuthors(Request $request, Manuscript $manuscript) {
    Gate::authorize('update', $manuscript);
    $manuscript = $this->service->updateAuthors($request, $manuscript);

    return redirect()->route('manuscripts.create', $manuscript);
  }

  public function storeDetails(Request $request, Manuscript $manuscript) {
    Gate::authorize('update', $manuscript);
    $manuscript = $this->service->updateDetails($request, $manuscript);

    return redirect()->route('manuscripts.create', $manuscript);
  }

  public function submit(Manuscript $manuscript) {
    Gate::authorize('update', $manuscript);
    $manuscript = $this->service->submit($manuscript);

    if (!$manuscript->submitted_at) {
      return redirect()->route('manuscripts.create', $manuscript);
    }

    return redirect()->route('manuscripts.index')->with('alert', [
      'type' => 'success',
      'messages' => 'Manuscript submitted successfully!',
    ]);
  }

  public function cancel(Manuscript $manuscript) {
    Gate::authorize('cancel', $manuscript);

    $this->service->cancel($manuscript);

    return redirect()->route('manuscripts.index')->with('alert', [
      'type' => 'success',
      'message' => 'Manuscript canceled successfully!',
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Manuscript $manuscript) {
    if (!$manuscript->submitted_at) {
      return redirect()->route('manuscripts.create', $manuscript);
    }
    Gate::authorize('view', $manuscript);

    return view('pages.manuscripts.show', [
      'manuscript' => $manuscript,
      'file_types' => FileType::orderBy('required', 'desc')->get(),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Manuscript $manuscript) {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Manuscript $manuscript) {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Manuscript $manuscript) {
    Gate::authorize('delete', $manuscript);

    $manuscript->delete();

    return redirect()->route('manuscripts.index')->with('alert', [
      'type' => 'success',
      'message' => 'Manuscript deleted successfully!',
    ]);
  }
}
