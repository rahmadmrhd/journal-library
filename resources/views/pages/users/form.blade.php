@push('head')
  <meta name="base-url" content="{{ url('/') }}">
@endpush

<x-modal name="add-user-modal" :show="$errors->form->isNotEmpty()" focusable>
  <div class="lg:min-w-96 relative w-full self-start sm:max-h-full sm:self-center">
    <div class="relative h-full bg-white shadow dark:bg-gray-800 sm:max-h-full sm:rounded-lg">
      <form id="user-form" action="{{ route('users.store') }}" method="POST"
        is-update="{{ old('_method', '') == 'PUT' ? 'true' : 'false' }}" enctype="multipart/form-data">
        {{-- Modal header  --}}
        <div
          class="flex w-full items-start justify-between rounded-t border-b p-5 dark:border-gray-700 dark:bg-gray-800">
          <h3 id="modal-title" class="text-xl font-semibold dark:text-white">
            Add New User
          </h3>

        </div>
        {{-- Modal body  --}}
        <div class="mt-0 space-y-6 p-6">
          <div x-data="{
              title: @js(old('title', $user->title ?? '')),
              first_name: @js(old('first_name', $user->first_name ?? '')),
              last_name: @js(old('last_name', $user->last_name ?? '')),
              degree: @js(old('degree', $user->degree ?? '')),
              preferred_name: @js(old('preferred_name', $user->preferred_name ?? '')),
              email: @js(old('email', $user->email ?? '')),
              roles: @js(old('roles')) ?? [],
              showError: @js($errors->form->isNotEmpty()),
          }" x-init="$watch('show', value => {
              if (!value) {
                  onCloseForm();
              }
          })" class="grid grid-cols-12 gap-x-6">
            @csrf
            <input type="hidden" name="id" value="{{ old('id', '') }}">
            <input type="hidden" name="_method" value="{{ old('id') ? 'PUT' : 'POST' }}">
            <x-text-input class="col-span-12 sm:col-span-4 xl:col-span-2" :label="__('Title')" id="title"
              name="title" type="text" x-model="title" placeholder="(Dr., Mr., Mrs., etc.)" autocomplete="title"
              :status="$errors->form->has('title') ? 'error' : ''" :messages="$errors->form->get('title')"></x-text-input>

            <x-text-input class="col-span-12 sm:col-span-8 xl:col-span-4" :label="__('First Name')" id="first_name"
              name="first_name" type="text" x-model="first_name" required autocomplete="first_name" :status="$errors->form->has('first_name') ? 'error' : ''"
              :messages="$errors->form->get('first_name')"></x-text-input>

            <x-text-input class="col-span-12 sm:col-span-8 xl:col-span-4" :label="__('Last Name')" id="last_name"
              name="last_name" type="text" x-model="last_name" autocomplete="last_name" required :status="$errors->form->has('last_name') ? 'error' : ''"
              :messages="$errors->form->get('last_name')"></x-text-input>

            <x-text-input class="col-span-12 sm:col-span-4 xl:col-span-2" :label="__('Degree')" id="degree"
              name="degree" type="text" x-model="degree" autocomplete="degree" :messages="$errors->form->get('degree')" :status="$errors->form->has('degree') ? 'error' : ''"
              placeholder="(Ph.D., M.D., etc.)"></x-text-input>

            <x-text-input class="col-span-12 sm:col-span-9 xl:col-span-7" :label="__('Preferred Name (nickname)')" id="preferred_name"
              name="preferred_name" type="text" x-model="preferred_name" autocomplete="preferred_name"
              :status="$errors->form->has('preferred_name') ? 'error' : ''" :messages="$errors->form->get('preferred_name')"></x-text-input>

            <x-text-input class="col-span-12" :label="__('Email')" id="email" name="email" type="email"
              x-model="email" :value="old('email')" required autofocus autocomplete="email" :status="$errors->form->has('email') ? 'error' : ''"
              :messages="$errors->form->get('email')" placeholder="example@example.com">
              <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10h5v-2h-5c-4.34 0-8-3.66-8-8s3.66-8 8-8s8 3.66 8 8v1.43c0 .79-.71 1.57-1.5 1.57s-1.5-.78-1.5-1.57V12c0-2.76-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5c1.38 0 2.64-.56 3.54-1.47c.65.89 1.77 1.47 2.96 1.47c1.97 0 3.5-1.6 3.5-3.57V12c0-5.52-4.48-10-10-10m0 13c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3" />
                </svg>
              </x-slot>
            </x-text-input>

            <x-text-input class="col-span-12" type="checkbox" label="Select Roles" required :messages="$errors->form->get('roles')"
              :status="$errors->form->has('roles') ? 'error' : ''" name="roles[]" :options="$roles" x-model="roles" direction="row" />


          </div>
          <div id="user-credentials" x-data="{
              generate: @js(old('generate', null)) ?? (@js(old('username', null)) != null ? [] : ['generate']),
              username: @js(old('username', $user->username ?? '')),
              password: '',
              password_confirmation: '',
              showError: @js($errors->form->isNotEmpty()),
          }" x-init="$watch('show', value => {
              if (!value) {
                  generate = ['generate'];
                  username = '';
                  password = '';
                  password_confirmation = '';
                  showError = false;
              }
          });
          window.onload = function() {
              if (generate[0] == 'generate') {
                  username = generateRandom(12);
                  password = generateRandom(12);
                  password_confirmation = password;
              }
          }
          $watch('generate', value => {
              if (value[0] == 'generate') {
                  username = generateRandom(12);
                  password = generateRandom(12);
                  password_confirmation = password;
              } else {
                  username = '';
                  password = '';
                  password_confirmation = '';
              }
          });" class="grid grid-cols-12">
            <header class="col-span-12 mb-5 border-b border-gray-200 pb-1 dark:border-gray-600">
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Login Information') }}
              </h2>
              <div class="mt-2 flex items-center">
                <x-toggle value="generate" name="generate[]" x-model="generate"> </x-toggle>
                <span id="status-text" class="ms-3 block text-sm font-medium text-gray-900 dark:text-white">
                  Generate Random
                </span>
              </div>
            </header>
            <x-text-input x-bind:readonly="!(!generate[0])" class="col-span-12 sm:col-span-7" :label="__('Username')"
              id="username" name="username" type="text" x-model="username" required autofocus
              autocomplete="username" :messages="$errors->form->get('username')" :status="$errors->form->has('username') ? 'error' : ''" placeholder="jhon_doe">
              <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                </svg>
              </x-slot>
            </x-text-input>

            <x-text-input x-bind:readonly="!(!generate[0])" class="col-span-12 sm:col-span-7" :label="__('Password')"
              id="password" name="password" type="password" x-model="password" required autofocus
              autocomplete="new-password" :messages="$errors->form->get('password')" :status="$errors->form->has('password') ? 'error' : ''" placeholder="********">
              <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
                </svg>
              </x-slot>
            </x-text-input>

            <x-text-input x-show="!generate[0]" class="col-span-12 sm:col-span-7" :label="__('Confirm Password')"
              id="password_confirmation" name="password_confirmation" type="password"
              x-model="password_confirmation" required autofocus autocomplete="new-password" :messages="$errors->form->get('password_confirmation')"
              :status="$errors->form->has('password_confirmation') ? 'error' : ''" placeholder="********">
              <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
                </svg>
              </x-slot>
            </x-text-input>
          </div>

        </div>

        {{-- Modal footer  --}}
        <div class="flex items-center gap-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-700">
          <button id="submit-modal-btn" class="button primary" type="submit">
            Save
          </button>
          <button type="button" x-on:click.prevent="$dispatch('close')" class="button secondary">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</x-modal>
