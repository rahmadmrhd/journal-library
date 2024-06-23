<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('/{subGate}/register', [RegisteredUserController::class, 'create'])
    ->name('register');

  Route::post('/{subGate}/register', [RegisteredUserController::class, 'store'])->name('register.store');

  Route::get('/{subGate}/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

  Route::post('/{subGate}/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

  Route::get('/{subGate}/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

  Route::post('/{subGate}/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

  Route::get('/{subGate}/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

  Route::post('/{subGate}/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');
});

Route::middleware('auth')->group(function () {
  Route::get('/{subGate}/verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

  Route::get('/{subGate}/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

  Route::post('/{subGate}/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

  Route::get('/{subGate}/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

  Route::post('/{subGate}/confirm-password', [ConfirmablePasswordController::class, 'store']);

  Route::post('/{subGate}/password', [PasswordController::class, 'store'])->name('password.store');
  Route::put('/{subGate}/password', [PasswordController::class, 'update'])->name('password.update');

  Route::post('/{subGate}/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

  Route::put('/{subGate}/role', [AuthenticatedSessionController::class, 'changeRole'])->name('role.update');

  Route::get('/{subGate}/auth/error', function () {
    return view('auth.role-error');
  })->name('role.error');
});

Route::controller(\App\Http\Controllers\OrcidController::class)->group(function () {
  Route::get('/{subGate}/orcid/auth', 'auth')->middleware('guest');
  Route::get('/{subGate}/orcid/connect', 'connect')->middleware('auth');
  Route::delete('/{subGate}/orcid', 'destroy')->middleware('auth')->name('orcid.destroy');
});
