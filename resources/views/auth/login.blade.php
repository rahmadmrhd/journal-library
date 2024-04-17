<x-auth-layout>
  <div class="relative w-full flex-row items-center dark:divide-gray-700 sm:flex">
    <div class="">
      <x-auth-image class="mx-auto h-60 w-60 fill-current text-blue-700 dark:text-sky-900 sm:h-96 sm:w-96" />
    </div>

    <div class="sm:min-w-80 pl-6">
      <div class="mb-6 mt-4">
        <div class="mb-6">
          <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold">{{ 'Welcome' }}</h1>
            <x-toggle-theme />
          </div>
          <h3 class="text-sm text-gray-800 dark:text-gray-300">Login to continue</h3>
        </div>

        <x-alert status="error" :timeout="5000" :messages="count($errors->get('status')) > 0 ? $errors->get('status') : session('status')" />
        <form method="POST" action="{{ route('login', absolute: false) }}">
          @csrf
          <x-text-input :label="__('Email or Username')" id="emailOrUsername" name="emailOrUsername" type="text" :value="old('emailOrUsername')"
            required autofocus autocomplete="username" :messages="$errors->get('emailOrUsername')" :status="$errors->has('emailOrUsername') ? 'error' : ''">
            <x-slot name="icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
              </svg>
            </x-slot>
          </x-text-input>
          <x-text-input :label="__('Password')" id="password" name="password" type="password" :value="old('password')" required
            autofocus autocomplete="current_password" :messages="$errors->get('password')" :status="$errors->has('password') ? 'error' : ''">
            <x-slot name="icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
              </svg>
            </x-slot>
          </x-text-input>

          <!-- Remember Me -->
          <div class="mt-4 flex items-center justify-between gap-2">
            <label for="remember_me" class="inline-flex items-center">
              <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
                name="remember">
              <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
              <a class="rounded-md text-sm text-gray-600 hover:text-gray-900 hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                href="{{ route('password.request', absolute: false) }}">
                {{ __('Forgot your password?') }}
              </a>
            @endif
          </div>

          <div class="mt-6 flex items-center justify-start gap-4">
            <button
              class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
              Log In
            </button>
            <small class="text-gray-600 dark:text-gray-400">OR</small>
            <a href="{{ Illuminate\Support\Facades\Config::get('orcid.auth_link') . '/auth' }}" title="Login with ORCID"
              class="inline-block h-8 w-8 rounded-full bg-white shadow-md focus:outline-none focus:ring-2 focus:ring-lime-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
              <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-[#a6ce39] focus:text-lime-300 dark:hover:text-lime-300" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
              </svg>
            </a>
          </div>
          <div class="mt-6 gap-4 text-sm text-gray-600 dark:text-gray-400">
            Not a Member?
            <a class="text-blue-600 hover:text-gray-900 focus:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-blue-500 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
              href="{{ route('register', absolute: false) }}">
              Sign Up
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-auth-layout>
