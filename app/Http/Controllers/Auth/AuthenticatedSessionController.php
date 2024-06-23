<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\SubGate;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller {
  /**
   * Display the login view.
   */
  public function create(SubGate $subGate): View {
    return view('auth.login', [
      'subGate' => $subGate,
    ]);
  }

  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request, SubGate $subGate): RedirectResponse {
    $request->authenticate();

    $request->session()->regenerate();

    $user =  $request->user();

    if ($user->roles()->wherePivot('sub_gate_id', $subGate->id)->where('id', $user->current_role_id)->count() <= 0) {
      $user->update(['current_role_id' => $user->roles()->wherePivot('sub_gate_id', $subGate->id)->first()->id,]);
    }

    return redirect()->intended(route('dashboard', $subGate->slug, absolute: false));
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request, SubGate $subGate): RedirectResponse {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login', $subGate->slug);
  }

  public function changeRole(Request $request, SubGate $subGate) {
    $role = $request->user()->roles()->where('id', $request->roleId)->first();

    if (!$role) {
      return redirect()->back();
    }

    $request->user()->current_role_id = $request->roleId;
    $request->user()->save();
    return redirect()->back();
  }
}
