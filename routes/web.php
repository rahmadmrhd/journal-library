<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile');
  Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(\App\Http\Controllers\OrcidController::class)->group(function () {
  Route::get('orcid/auth', 'auth')->middleware('guest');
  Route::get('orcid/connect', 'connect')->middleware('auth');
  Route::delete('orcid', 'destroy')->middleware('auth')->name('orcid.destroy');
});

require __DIR__ . '/auth.php';
