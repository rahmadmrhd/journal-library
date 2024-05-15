<?php

namespace App\Http\Controllers\Manuscript;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UploadFileRequest;
use App\Models\Manuscript\File;
use App\Models\Manuscript\FileType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller {
  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    try {
      $validatedData = $request->validate([
        'file' => ['required', 'file', 'max:51200'],
      ]);
      $validatedData['name'] = $request->file('file')->getClientOriginalName();
      $validatedData['extension'] = $request->file('file')->getClientOriginalExtension();
      $validatedData['mime_type'] = $request->file('file')->getClientMimeType();
      $validatedData['path'] = $request->file('file')->store('files/temps');
      $validatedData['user_id'] = $request->user()->id;
      if ($request->has('Manuscript_id')) {
        $validatedData['manuscript_id'] = $request->Manuscript_id;
      }

      $file = File::create($validatedData);
      return response()->json([
        'success' => true,
        'file' => $file,
        'file_types' => FileType::orderBy('required', 'desc')->get(),
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ]);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, File $file) {
    $request->validate([
      'file_type_id' => ['required', 'exists:file_types,id'],
    ]);
    if ($request->has('Manuscript_id')) {
      $file->manuscript_id = $request->Manuscript_id;
    }
    $file->file_type_id = $request->file_type_id;
    $file->save();
    return response()->json([
      'success' => true,
      'file' => $file
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(File $file) {
    Storage::delete($file->path);
    $file->delete();
    return response()->json(['success' => true]);
  }
}
