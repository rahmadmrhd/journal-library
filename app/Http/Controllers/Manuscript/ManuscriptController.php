<?php

namespace App\Http\Controllers\Manuscript;

use App\Http\Controllers\Controller;
use App\Models\Manuscript\Manuscript;
use Illuminate\Http\Request;

class ManuscriptController extends Controller {
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
  public function create(Request $request) {
    $currentStep = $request->step ?? 3;
    // error, success, 'undifined/null'
    $forms = [
      [
        'label' => 'File Upload',
        'status' => 'success'
      ],
      [
        'label' => 'Title, Abstract',
        'status' => 'success'
      ],
      [
        'label' => 'Keywords',
        'status' => 'error'
      ],
      [
        'label' => 'Authors & Institutions',
      ],
      [
        'label' => 'Details & Comments',
      ],
      [
        'label' => 'Review & Submit',
      ],
    ];
    return view('pages.manuscripts.form', [
      'forms' => collect($forms)
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    // return redirect('/manuscripts/create')->with
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
