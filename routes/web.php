<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
  Route::put('/profile', [App\Http\Controllers\SettingsController::class, 'profileUpdate'])->name('profile.update');
  Route::put('/account', [App\Http\Controllers\SettingsController::class, 'accountUpdate'])->name('account.update');
  Route::delete('/account', [App\Http\Controllers\SettingsController::class, 'accountDestroy'])->name('account.destroy');
});

Route::controller(\App\Http\Controllers\OrcidController::class)->group(function () {
  Route::get('orcid/auth', 'auth')->middleware('guest');
  Route::get('orcid/connect', 'connect')->middleware('auth');
  Route::delete('orcid', 'destroy')->middleware('auth')->name('orcid.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
  Route::resource('users', \App\Http\Controllers\UsersController::class);
});

Route::middleware(['auth', 'verified', 'role:author'])->group(function () {
  Route::resource('papers', \App\Http\Controllers\ManuscriptController::class);
});

require __DIR__ . '/auth.php';
