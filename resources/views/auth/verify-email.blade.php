<x-auth-layout>
  <div class="sm:max-w-xl">
    <div class="mb-6 mt-4">
      <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold">Verify Email</h1>
        <x-toggle-theme />
      </div>
      <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
      </div>

      @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
          {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
      @endif

      <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send', absolute: false) }}">
          @csrf

          <div class="flex flex-col gap-2 sm:flex-row">
            <button type="submit"
              class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
              Resend Verification Email
            </button>

            <a href="{{ route('profile', absolute: false) }}"
              class="inline-flex items-center rounded-md border border-gray-400 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-900 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
              Continue to Profile
            </a>
          </div>
        </form>

        <form method="POST" action="{{ route('logout', absolute: false) }}">
          @csrf

          <button type="submit"
            class="rounded-md text-sm text-gray-600 hover:text-gray-900 hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
            {{ __('Log Out') }}
          </button>

        </form>
      </div>
    </div>
</x-auth-layout>
