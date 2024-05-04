<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
  <form x-data x-init="$watch('show', value => {
      if (!value) {
          onCloseDeleteForm()
      }
  })" method="POST" class="max-w-screen-md p-6" id="confirm-user-deletion-form"
    action="users/{{ old('id') }}">
    @csrf
    @method('delete')

    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Are you sure you want to delete this user?') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Once this user is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete this user.') }}
    </p>
    <input id="id" type="hidden" name="id" value="{{ old('id') }}">
    <x-text-input class="mt-6" :label="__('Password')" id="password_for_delete" name="password" type="password" required
      autofocus autocomplete="current_password" :messages="$errors->userDeletion->get('password')" :status="$errors->userDeletion->has('password') ? 'error' : ''">
      <x-slot name="icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
        </svg>
      </x-slot>
    </x-text-input>

    <div class="mt-6 flex flex-row-reverse gap-3">
      <button type="submit"
        class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:hover:bg-red-500 dark:focus:ring-offset-gray-800">
        {{ __('Delete User') }}
      </button>
      <button x-on:click.prevent="$dispatch('close')" type="button"
        class="inline-flex items-center rounded-md border border-gray-200 border-transparent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-900 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-100 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
        {{ __('Cancel') }}
      </button>
    </div>
  </form>
</x-modal>
