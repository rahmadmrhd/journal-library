<?php

use Illuminate\Support\Facades\Route;

Route::resource('files', App\Http\Controllers\Manuscript\FileController::class)->middleware(['auth', 'verified']);
Route::get('keywords/{keyword}', [App\Http\Controllers\Manuscript\KeywordController::class, 'search'])->name('keywords.search');

Route::middleware(['auth', 'verified', 'role:author'])->controller(\App\Http\Controllers\Manuscript\ManuscriptController::class)->group(function () {
  Route::get('manuscripts/create/{manuscript?}', 'create',)->name('manuscripts.create')->middleware('remove_params');
  Route::put('manuscripts/create/{manuscript?}', 'storeFile',)->name('manuscripts.storeFile');
  Route::put('manuscripts/create/{manuscript?}/basic-information', 'storeBasicInformation',)->name('manuscripts.storeBasicInformation');
  Route::patch('manuscripts/create/change_step/{manuscript?}', 'changeStep',)->name('manuscripts.change_step');
});
