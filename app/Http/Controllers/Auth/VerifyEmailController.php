<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SubGate;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller {
  /**
   * Mark the authenticated user's email address as verified.
   */
  public function __invoke(EmailVerificationRequest $request, SubGate $subGate): RedirectResponse {
    if ($request->user()->hasVerifiedEmail()) {
      return redirect()->intended(route('dashboard', $subGate->slug, absolute: false) . '?verified=1');
    }

    if ($request->user()->markEmailAsVerified()) {
      event(new Verified($request->user()));
    }

    return redirect()->intended(route('dashboard', $subGate->slug, absolute: false) . '?verified=1');
  }
}
