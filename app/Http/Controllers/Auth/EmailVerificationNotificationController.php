<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SubGate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller {
  /**
   * Send a new email verification notification.
   */
  public function store(Request $request, SubGate $subGate): RedirectResponse {
    if ($request->user()->hasVerifiedEmail()) {
      return redirect()->intended(route('dashboard', $subGate->slug, absolute: false));
    }

    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
  }
}
