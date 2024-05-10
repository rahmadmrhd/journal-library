<?php

namespace App\Http\Controllers\Manuscript;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manuscript\CreateManuscriptRequest;
use App\Models\Manuscript\FileType;
use App\Models\Manuscript\Manuscript;
use App\Models\Manuscript\StepSubmission;
use App\Services\Manuscripts\SubmitNewManuscriptService;
use Illuminate\Http\Request;

class ManuscriptController extends Controller {
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
  public function create(Manuscript $manuscript = null) {
    $steps = StepSubmission::orderBy('id', 'asc')->get();
    if ($manuscript) {
      $progress = $manuscript->steps;
      $steps = $steps->map(function ($step) use ($progress) {
        $step->status = $progress->find($step->id)->pivot->status ?? null;
        return $step;
      });
    }

    if (isset($manuscript->current_step) && $manuscript?->current_step == 1) {
      $files = $manuscript->files;
      $file_types = FileType::orderBy('required', 'desc')->get();
    }

    return view('pages.manuscripts.form', [
      'steps' => $steps,
      'manuscript' => $manuscript,
      'files' => $files ?? null,
      'file_types' =>  $file_types ?? null,
    ]);
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
  public function storeFile(CreateManuscriptRequest $request, Manuscript $manuscript = null) {
    $request->validated(['filesId', 'filesId.*']);
    if ($manuscript) {
      $manuscript = $this->service->updateFile($manuscript, $request->filesId);
    } else {
      $manuscript = $this->service->create($request->filesId);
    }
    return redirect()->route('manuscripts.create', $manuscript);
  }

  /**
   * Display the specified resource.
   */
  public function show(Manuscript $manuscript) {
    //
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
    //
  }
}
