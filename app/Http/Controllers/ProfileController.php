<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProfileController extends Controller {
  /**
   * Display the user's profile form.
   */
  public function edit(Request $request): View {
    $user = $request->user();

    // if (!isset($user->email) || !isset($user->username) || !isset($user->password)) {
    //   Session::flash('message', [
    //     'status' => 'warning',
    //     'msg' => 'Please update your account and password information first!'
    //   ]);
    // }
    return view('profile.edit', [
      'user' => $user,
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile')->withFragment('#account')->with('message', [
      'status' => 'success',
      'msg' => 'Your profile has been updated!',
    ])->with('status', 'profile-updated');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }
}
