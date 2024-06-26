<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SubGate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller {
  /**
   * Update the user's password.
   */
  public function update(Request $request, SubGate $subGate): RedirectResponse {
    $validated = $request->validateWithBag('updatePassword', [
      'current_password' => ['required', 'current_password'],
      'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $request->user()->update([
      'password' => Hash::make($validated['password']),
    ]);

    return back()->with('status', 'password-updated')
      ->with('message', [
        'status' => 'success',
        'msg' => 'Your password has been updated!'
      ]);
  }
  public function store(Request $request, SubGate $subGate): RedirectResponse {
    $validated = $request->validateWithBag('updatePassword', [
      'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $request->user()->update([
      'password' => Hash::make($validated['password']),
    ]);

    return back()->with('status', 'password-updated')
      ->with('message', [
        'status' => 'success',
        'msg' => 'Your password has been updated!'
      ]);
  }
}
