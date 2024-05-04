<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\CountryApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class SettingsController extends Controller {
  private CountryApiService $countryApiService;
  public function __construct(CountryApiService $countryApiService) {
    $this->countryApiService = $countryApiService;
  }
  /**
   * Display the user's settings.
   */
  public function index(Request $request): View {
    $user = $request->user();
    // $countries = $this->countryApiService->getCountries();
    return view('pages.settings.edit', [
      'user' => $user,
      // 'countries' => $countries
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function profileUpdate(ProfileUpdateRequest $request): RedirectResponse {
    $validatedData = $request->validated();
    // dd($validatedData);
    $request->user()->fill($validatedData);

    $request->user()->save();

    return Redirect::route('settings')->withFragment('#profile')->with('message', [
      'status' => 'success',
      'msg' => 'Your profile information has been updated!',
    ])->with('status', 'profile-updated');
  }


  /**
   * Update the user's account information.
   */
  public function accountUpdate(AccountUpdateRequest $request): RedirectResponse {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('settings')->withFragment('#account')->with('message', [
      'status' => 'success',
      'msg' => 'Your account information has been updated!',
    ])->with('status', 'profile-updated');
  }

  /**
   * Delete the user's account.
   */
  public function accountDestroy(Request $request): RedirectResponse {
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
