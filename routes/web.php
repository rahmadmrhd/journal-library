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

Route::middleware(['auth', 'verified'])->group(function () {
  Route::resource('users', \App\Http\Controllers\UsersController::class)->middleware('role:admin');
  Route::get('users/search/{role}/{find}', [\App\Http\Controllers\UsersController::class, 'find']);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/manuscripts.php';
require __DIR__ . '/tasks.php';
