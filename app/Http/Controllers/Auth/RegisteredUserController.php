<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SubGate;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller {
  /**
   * Display the registration view.
   */
  public function create(SubGate $subGate): View {
    return view('auth.register', [
      'subGate' => $subGate
    ]);
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request, SubGate $subGate): RedirectResponse {
    $validatedData = $request->validate([
      'first_name' => ['required', 'string', 'max:255'],
      'last_name' => ['required', 'string', 'max:255'],
      'username' => ['required', 'string', 'min:3'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);
    $validatedData['password'] = Hash::make($request->password);

    $user = User::create($validatedData);

    $user->roles()->syncWithPivotValues([1, 2], ['sub_gate_id' => $subGate->id]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('verification.notice', $subGate->slug, absolute: false));
  }
}
