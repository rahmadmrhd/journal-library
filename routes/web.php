<?php

use App\Models\SubGate;
use Illuminate\Support\Facades\Route;

Route::get('{subGate}', function (SubGate $subGate) {
  return redirect()->route('dashboard', ['subGate' => $subGate->slug]);
});

Route::get('/{subGate}/dashboard', function (SubGate $subGate) {
  return view('dashboard', [
    'subGate' => $subGate,
  ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/{subGate}')->middleware(['sub_gate', 'auth'])->group(function () {
  Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
  Route::put('/profile', [App\Http\Controllers\SettingsController::class, 'profileUpdate'])->name('profile.update');
  Route::put('/account', [App\Http\Controllers\SettingsController::class, 'accountUpdate'])->name('account.update');
  Route::delete('/account', [App\Http\Controllers\SettingsController::class, 'accountDestroy'])->name('account.destroy');
});

Route::prefix('/{subGate}')->middleware(['sub_gate', 'auth', 'verified'])->group(function () {
  Route::resource('/users', \App\Http\Controllers\UsersController::class)->middleware('role:admin');
  Route::post('/users/search/{role}/{find}', [\App\Http\Controllers\UsersController::class, 'find']);

  Route::resource('/forms', \App\Http\Controllers\FormsController::class)->middleware('role:admin');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/manuscripts.php';
require __DIR__ . '/tasks.php';
