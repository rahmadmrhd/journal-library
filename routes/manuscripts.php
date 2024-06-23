<?php

use Illuminate\Support\Facades\Route;

// Route::get('{subGate}/files/{file}', [\App\Http\Controllers\Manuscript\FileController::class, 'show'])->middleware(['auth', 'verified']);
Route::resource('files', App\Http\Controllers\Manuscript\FileController::class)->middleware(['auth', 'verified'])->except(['show']);
Route::get('keywords/{keyword}', [App\Http\Controllers\Manuscript\KeywordController::class, 'search'])->name('keywords.search');

Route::prefix('/{subGate}')->middleware(['sub_gate', 'auth', 'verified', 'role:author'])->controller(\App\Http\Controllers\Manuscript\ManuscriptController::class)->group(function () {
  Route::get('/manuscripts', 'index',)->name('manuscripts.index');
  Route::get('/manuscripts/create/{manuscript?}', 'create',)->name('manuscripts.create')->middleware('remove_params');
  Route::put('/manuscripts/create/{manuscript?}', 'storeFile',)->name('manuscripts.storeFile');
  Route::put('/manuscripts/create/{manuscript}/basic-information', 'storeBasicInformation',)->name('manuscripts.storeBasicInformation');
  Route::put('/manuscripts/create/{manuscript}/authors', 'storeAuthors')->name('manuscripts.storeAuthors');
  Route::put('/manuscripts/create/{manuscript}/details', 'storeDetails')->name('manuscripts.storeDetails');
  Route::put('/manuscripts/create/{manuscript}/submit', 'submit')->name('manuscripts.submit');
  Route::patch('/manuscripts/create/change_step/{manuscript?}', 'changeStep',)->name('manuscripts.change_step');
  Route::delete('/manuscripts/{manuscript}/cancel', 'cancel')->name('manuscripts.cancel');
  Route::delete('/manuscripts/{manuscript}', 'destroy')->name('manuscripts.destroy');

  Route::get('/manuscripts/{manuscript}', 'show',)->name('manuscripts.show');
});
