<x-auth-layout>
  <div class="sm:min-w-80">
    <div class="mb-6 mt-4">
      <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold">Reset Password</h1>
        <x-toggle-theme />
      </div>
      <form method="POST" action="{{ route('password.store', $subGate->slug, absolute: false) }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token', absolute: false) }}">

        <x-text-input :label="__('Password')" id="password" name="password" type="password" :value="old('password')" required
          autofocus autocomplete="new-password" :messages="$errors->get('password')" :status="$errors->has('password') ? 'error' : ''" placeholder="********">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
            </svg>
          </x-slot>
        </x-text-input>
        <x-text-input :label="__('Confirm Password')" id="password_confirmation" name="password_confirmation" type="password"
          :value="old('password_confirmation')" required autofocus autocomplete="new-password" :messages="$errors->get('password_confirmation')" :status="$errors->has('password_confirmation') ? 'error' : ''"
          placeholder="********">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
            </svg>
          </x-slot>
        </x-text-input>

        <div class="mt-6 flex items-center justify-start gap-4">
          <button
            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
            Reset Password
          </button>
        </div>
      </form>
    </div>
  </div>
</x-auth-layout>
