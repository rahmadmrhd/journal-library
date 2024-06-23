<div class="card">
  <div class="max-w-xl divide-y-2 divide-gray-200 dark:divide-gray-700">
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Login Information') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __("Update your account's profile information and email address.") }}
      </p>
    </header>

    <form id="send-verification" class="hidden" method="post"
      action="{{ route('verification.send', $subGate->slug, absolute: false) }}">
      @csrf
    </form>

    <form id="remove-orcid" class="hidden" method="post"
      action="{{ route('orcid.destroy', $subGate->slug, absolute: false) }}">
      @csrf
      @method('delete')
    </form>

    <form x-data="{ formChanged: false }" method="post" action="{{ route('account.update', $subGate->slug, absolute: false) }}"
      class="space-y-6">
      @csrf
      @method('PUT')

      <x-text-input x-on:change="formChanged = true" :label="__('Username')" id="username" name="username" type="text"
        :value="old('username', $user->username)" required autofocus autocomplete="username" :messages="$errors->get('username')" :status="$errors->has('username') ? 'error' : ''"
        placeholder="john_doe">
        <x-slot name="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
          </svg>
        </x-slot>
      </x-text-input>
      <div>
        <x-text-input x-on:change="formChanged = true" :label="__('Email')" id="email" name="email" type="email"
          :value="old('email', $user->email)" required autofocus autocomplete="email" :messages="$errors->get('email')" :status="$errors->has('email') || (!$user->hasVerifiedEmail() && isset($user->email)) ? 'error' : ''"
          placeholder="yourname@example.com">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10h5v-2h-5c-4.34 0-8-3.66-8-8s3.66-8 8-8s8 3.66 8 8v1.43c0 .79-.71 1.57-1.5 1.57s-1.5-.78-1.5-1.57V12c0-2.76-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5c1.38 0 2.64-.56 3.54-1.47c.65.89 1.77 1.47 2.96 1.47c1.97 0 3.5-1.6 3.5-3.57V12c0-5.52-4.48-10-10-10m0 13c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3" />
            </svg>
          </x-slot>
          @if (!$user->hasVerifiedEmail() && isset($user->email))
            <x-slot name="ext">
              <button form="send-verification"
                class="rounded-lg bg-blue-700 px-4 py-2 text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <span class="hidden sm:block">RESEND VERIFICATION EMAIL</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:hidden" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M3 4c-1.11 0-2 .89-2 2v12a2 2 0 0 0 2 2h10.5a6.5 6.5 0 0 1-.5-2.5a6.5 6.5 0 0 1 6.5-6.5a6.5 6.5 0 0 1 1.5.18V6a2 2 0 0 0-2-2zm0 2l8 5l8-5v2l-8 5l-8-5zm16 6l-2.25 2.25L19 16.5V15a2.5 2.5 0 0 1 2.5 2.5c0 .4-.09.78-.26 1.12l1.09 1.09c.42-.63.67-1.39.67-2.21c0-2.21-1.79-4-4-4zm-3.33 3.29c-.42.63-.67 1.39-.67 2.21c0 2.21 1.79 4 4 4V23l2.25-2.25L19 18.5V20a2.5 2.5 0 0 1-2.5-2.5c0-.4.09-.78.26-1.12z" />
                </svg>
              </button>
            </x-slot>
          @endif
        </x-text-input>
        @if (!$user->hasVerifiedEmail() && isset($user->email))
          <div>
            <p class="mt-2 text-sm text-red-700 dark:text-red-500">
              {{ __('Your email address is unverified.') }}
            </p>

            @if (session('status') === 'verification-link-sent')
              <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to your email address.') }}
              </p>
            @endif
          </div>
        @endif
      </div>
      <div>
        <div class="mb-2 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#a6ce39]" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
          </svg>
          ORCID
          @if (!$user->orcid_id)
            <a href="{{ Illuminate\Support\Facades\Config::get('orcid.auth_link') . '/connect' }}"
              class="ms-4 rounded-lg bg-[#a6ce39] px-2 py-2 text-xs font-bold uppercase text-white hover:bg-lime-300 focus:outline-none focus:ring-4 focus:ring-lime-300 dark:text-gray-800">
              Connect
            </a>
          @endif
        </div>
        @if ($user->orcid_id)
          <div class="flex items-center gap-4">
            <a href="https://orcid.org/{{ $user->orcid_id }}"
              class="text-sm font-normal underline underline-offset-1 hover:text-blue-500">
              {{ $user->orcid_id }}
            </a>
            @if (isset($user->email) && isset($user->username) && isset($user->password))
              <button form="remove-orcid" type="submit"
                class="rounded-lg bg-red-700 px-2 py-2 text-xs font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3zm0 5h2v9H9zm4 0h2v9h-2z" />
                </svg>
              </button>
            @endif
          </div>
        @endif

      </div>
      <div class="flex items-center gap-4" x-show="formChanged">
        <button x-bind:disabled="!formChanged" type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:bg-blue-400 dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
          Save
        </button>

        @if (session('status') === 'profile-updated')
          <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-green-600 dark:text-green-400">{{ __('Saved') }}</p>
        @endif
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="max-w-xl divide-y-2 divide-gray-200 dark:divide-gray-700">
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Update Password') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
      </p>
    </header>

    <form method="post" x-data="{ formChanged: false }"
      action="{{ route(isset($user->password) ? 'password.update' : 'password.store', $subGate->slug, absolute: false) }}"
      class="space-y-6">
      @csrf
      @isset($user->password)
        @method('put')
        <x-text-input x-on:change="formChanged = true" :label="__('Current Password')" id="current_password" name="current_password"
          type="password" :value="old('current_password')" required autofocus autocomplete="current_password" :messages="$errors->updatePassword->get('current_password')"
          :status="$errors->updatePassword->has('current_password') ? 'error' : ''" placeholder="********">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
            </svg>
          </x-slot>
        </x-text-input>
      @endisset
      <x-text-input x-on:change="formChanged = true" :label="__('New Password')" id="password" name="password" type="password"
        :value="old('password')" required autofocus autocomplete="new-password" :messages="$errors->updatePassword->get('password')" :status="$errors->updatePassword->has('password') ? 'error' : ''"
        placeholder="********">
        <x-slot name="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
          </svg>
        </x-slot>
      </x-text-input>
      <x-text-input x-on:change="formChanged = true" :label="__('Confirm Password')" id="password_confirmation"
        name="password_confirmation" type="password" :value="old('password_confirmation')" required autofocus
        autocomplete="new-password" :messages="$errors->updatePassword->get('password_confirmation')" :status="$errors->updatePassword->has('password_confirmation') ? 'error' : ''" placeholder="********">
        <x-slot name="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
          </svg>
        </x-slot>
      </x-text-input>

      <div class="flex items-center gap-4"x-show="formChanged">
        <button x-bind:disabled="!formChanged" type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
          Save
        </button>

        @if (session('status') === 'password-updated')
          <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-green-600 dark:text-green-400">{{ __('Saved') }}</p>
        @endif
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="max-w-xl divide-y-2 divide-gray-200 dark:divide-gray-700">
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Delete Account') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
      </p>
    </header>
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
      class="mt-6 inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:hover:bg-red-500 dark:focus:ring-offset-gray-800">
      {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
      <form method="post" action="{{ route('account.destroy', $subGate->slug, absolute: false) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          {{ __('Are you sure you want to delete your account?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </p>

        <x-text-input class="mt-6" :label="__('Password')" id="password_for_delete" name="password" type="password"
          :value="old('password')" required autofocus autocomplete="current_password" :messages="$errors->get('password')" :status="$errors->has('password') ? 'error' : ''">
          <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
            </svg>
          </x-slot>
        </x-text-input>

        <div class="mt-6 flex justify-end gap-3">
          <button x-on:click.prevent="$dispatch('close')"
            class="inline-flex items-center rounded-md border border-gray-200 border-transparent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-900 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-100 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
            {{ __('Cancel') }}
          </button>
          <button
            class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:hover:bg-red-500 dark:focus:ring-offset-gray-800">
            {{ __('Delete Account') }}
          </button>
        </div>
      </form>
    </x-modal>
  </div>
</div>
