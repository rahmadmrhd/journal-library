<x-auth-layout>
  <div class="sm:max-w-2xl">
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-3xl font-bold">Forgot Password</h1>
      <x-toggle-theme />
    </div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-alert type="error" :messages="session('status')" />

    <form method="POST" action="{{ route('password.email', $subGate->slug, absolute: false) }}">
      @csrf

      <!-- Email Address -->
      <x-text-input :label="__('Email')" id="email" name="email" type="email" :value="old('email')" required autofocus
        autocomplete="email" :messages="$errors->get('email')" :status="$errors->has('email') ? 'error' : ''" placeholder="yourname@example.com">
        <x-slot name="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10h5v-2h-5c-4.34 0-8-3.66-8-8s3.66-8 8-8s8 3.66 8 8v1.43c0 .79-.71 1.57-1.5 1.57s-1.5-.78-1.5-1.57V12c0-2.76-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5c1.38 0 2.64-.56 3.54-1.47c.65.89 1.77 1.47 2.96 1.47c1.97 0 3.5-1.6 3.5-3.57V12c0-5.52-4.48-10-10-10m0 13c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3" />
          </svg>
        </x-slot>
      </x-text-input>

      <div class="mt-6 flex items-center justify-start gap-4">
        <button
          class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
          Email Password Reset Link
        </button>
      </div>
    </form>
  </div>
</x-auth-layout>
