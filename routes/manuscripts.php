<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->controller(\App\Http\Controllers\Manuscript\ManuscriptController::class)->group(function () {
  Route::get('manuscripts/create', 'create',)->middleware('role:author');
  Route::post('manuscripts/create', 'store',);
});
