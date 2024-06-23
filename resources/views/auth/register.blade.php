<x-auth-layout>
  <div class="sm:min-w-80 w-full">
    <div class="mb-6 mt-4">
      <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold">Sign Up</h1>
        <x-toggle-theme />
      </div>
      <x-alert type="error" :messages="session('status')" />

      <form method="POST" action="{{ route('register', $subGate->slug, absolute: false) }}">
        @csrf
        {{-- <input type="hidden" name="accessToken" value="{{ $accessToken ?? '' }}">
        <input type="hidden" name="orcid" value="{{ $orcid ?? '' }}"> --}}
        <x-text-input :label="__('First Name')" id="first_name" name="first_name" type="text" :value="old('first_name')" required
          autofocus autocomplete="first_name" :messages="$errors->get('first_name')" :status="$errors->has('first_name') ? 'error' : ''" placeholder="John Doe">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
            </svg>
          </x-slot>
        </x-text-input>
        <x-text-input class="mt-3" :label="__('Last Name')" id="last_name" name="last_name" type="text" :value="old('last_name')"
          required autofocus autocomplete="last_name" :messages="$errors->get('last_name')" :status="$errors->has('last_name') ? 'error' : ''" placeholder="John Doe">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
            </svg>
          </x-slot>
        </x-text-input>
        <x-text-input class="mt-3" :label="__('Username')" id="username" name="username" type="text" :value="old('username')"
          required autofocus autocomplete="username" :messages="$errors->get('username')" :status="$errors->has('username') ? 'error' : ''" placeholder="jhon_doe">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M5.5 7A1.5 1.5 0 0 1 4 5.5A1.5 1.5 0 0 1 5.5 4A1.5 1.5 0 0 1 7 5.5A1.5 1.5 0 0 1 5.5 7m15.91 4.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.11 0-2 .89-2 2v7c0 .55.22 1.05.59 1.41l8.99 9c.37.36.87.59 1.42.59c.55 0 1.05-.23 1.41-.59l7-7c.37-.36.59-.86.59-1.41c0-.56-.23-1.06-.59-1.42" />
            </svg>
          </x-slot>
        </x-text-input>
        <x-text-input class="mt-3" :label="__('Email')" id="email" name="email" type="email" :value="old('email')"
          required autofocus autocomplete="email" :messages="$errors->get('email')" :status="$errors->has('email') ? 'error' : ''"
          placeholder="yourname@example.com">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10h5v-2h-5c-4.34 0-8-3.66-8-8s3.66-8 8-8s8 3.66 8 8v1.43c0 .79-.71 1.57-1.5 1.57s-1.5-.78-1.5-1.57V12c0-2.76-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5c1.38 0 2.64-.56 3.54-1.47c.65.89 1.77 1.47 2.96 1.47c1.97 0 3.5-1.6 3.5-3.57V12c0-5.52-4.48-10-10-10m0 13c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3" />
            </svg>
          </x-slot>
        </x-text-input>
        <x-text-input class="mt-3" :label="__('Password')" id="password" name="password" type="password"
          :value="old('password')" required autofocus autocomplete="new-password" :messages="$errors->get('password')" :status="$errors->has('password') ? 'error' : ''"
          placeholder="********">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
            </svg>
          </x-slot>
        </x-text-input>
        <x-text-input class="mt-3" :label="__('Confirm Password')" id="password_confirmation" name="password_confirmation"
          type="password" :value="old('password_confirmation')" required autofocus autocomplete="new-password" :messages="$errors->get('password_confirmation')"
          :status="$errors->has('password_confirmation') ? 'error' : ''" placeholder="********">
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
            Register
          </button>
          <small class="text-gray-600 dark:text-gray-400">OR</small>
          <a href="{{ Illuminate\Support\Facades\Config::get('orcid.auth_link') . '/auth' }}"
            title="Register with ORCID"
            class="inline-block h-8 w-8 rounded-full bg-white shadow-md focus:outline-none focus:ring-2 focus:ring-lime-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8 text-[#a6ce39] focus:text-lime-300 dark:hover:text-lime-300" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
            </svg>
          </a>
        </div>
        <div class="mt-6 gap-4 text-sm text-gray-600 dark:text-gray-400">
          Already a Member?
          <a class="text-blue-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-blue-500 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
            href="{{ route('login', $subGate->slug, absolute: false) }}">
            Log In
          </a>
        </div>
      </form>
    </div>
  </div>
</x-auth-layout>
