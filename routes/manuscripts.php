<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->controller(\App\Http\Controllers\Manuscript\ManuscriptController::class)->group(function () {
  Route::get('manuscripts/create/{manuscript?}', 'create',)->name('manuscripts.create')->middleware('role:author', 'remove_params');
  Route::put('manuscripts/create/{manuscript?}', 'storeFile',)->name('manuscripts.store')->middleware('role:author');
  Route::patch('manuscripts/create/change_step/{manuscript?}', 'changeStep',)->name('manuscripts.change_step')->middleware('role:author');
});
