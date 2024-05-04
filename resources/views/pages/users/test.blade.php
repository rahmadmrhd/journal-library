<x-modal name="modal-confirm-reset-password">
  <div id="confirm-reset-password" class="max-w-2xl p-4 text-center md:p-5" x-data x-init="$watch('show', value => {
      if (!value) {
          onCloseConfirm()
      }
  })">
    <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
      {{ __("Are you sure to reset this user's password?") }}
    </h3>
    <button id="delete-modal-btn" type="button"
      class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
      Yes, I am sure
    </button>
    <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')"
      class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
      Cancel
    </button>
  </div>
</x-modal>

<x-table minHeight="500px" :columns="[
    [
        'label' => 'Name',
        'name' => 'name',
        'isSortable' => true,
    ],
    [
        'label' => 'Role',
        'name' => 'role',
        'isSortable' => false,
    ],
    [
        'label' => 'Status',
        'name' => 'status',
        'isSortable' => true,
    ],
    [
        'label' => '',
        'isSortable' => false,
    ],
]">
  @slot('pagination')
    {{ $users->links() }}
  @endslot

  @foreach ($users as $user)
    @php
      $user->readonly = $user->roles()->pluck('slug')->contains('admin');
    @endphp
    <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">

      <th scope="row">
        <div class="flex items-center truncate px-6 py-2 text-gray-900 dark:text-white">
          <div class="w-10">
            @isset($user->image)
              <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $user->image) }}"
                alt="Profile-{{ $user->nama }}">
            @else
              <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 h-12 w-12 text-gray-300 dark:text-gray-700"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 19.2c-2.5 0-4.71-1.28-6-3.2c.03-2 4-3.1 6-3.1s5.97 1.1 6 3.1a7.232 7.232 0 0 1-6 3.2M12 5a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-3A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10c0-5.53-4.5-10-10-10" />
              </svg>
            @endisset
          </div>
          <div class="ps-3">
            <div class="w-24 truncate text-base font-semibold lg:w-auto">
              {{ $user->getFullName() . ($user->preferred_name ? ' (' . $user->preferred_name . ')' : '') }}
            </div>
            <div class="font-normal text-gray-500">{{ $user->username }}</div>
          </div>
        </div>
      </th>
      <td class="w-[1%] px-6 py-2 text-center">
        <ul>
          @foreach ($user->roles()->get() as $role)
            <li class="list-disc text-left">{{ $role->name }}</li>
          @endforeach
        </ul>
      </td>
      <td class="w-[1%] px-6 py-2">
        <div role="status" id="status-loading" class="mx-auto hidden">
          <svg aria-hidden="true" class="h-8 w-8 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600"
            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
              fill="currentColor" />
            <path
              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
              fill="currentFill" />
          </svg>
          <span class="sr-only">Loading...</span>
        </div>
        <div class="flex items-center">
          <x-toggle :checked="$user->status" id="status-toggle" :disabled="$user->readonly"
            onclick="updateStatus({{ $user->id }}, event, this.parentNode.parentNode)">
          </x-toggle>
          <span id="status-text"
            class="ms-3 block text-xs font-medium text-gray-900 dark:text-white">{{ $user->status ? 'Active' : 'Inactive' }}</span>
        </div>
      </td>
      @if (!$user->readonly)
        <td class="w-[100px] space-x-1 whitespace-nowrap p-4">
          <button title="More" id="more-btn-{{ $user->id }}" {{ $user->readonly ? 'disabled' : '' }}
            data-dropdown-toggle="more-dropdown-{{ $user->id }}" class="button secondary !p-2" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M16 12a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2" />
            </svg>
          </button>

          <!-- Dropdown menu -->
          <div id="more-dropdown-{{ $user->id }}"
            class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="more-btn-{{ $user->id }}">
              <li>
                <button id="reset-password-btn-{{ $user->id }}"
                  data-dropdown-toggle="reset-password-dropdown-{{ $user->id }}"
                  data-dropdown-placement="right-start" data-dropdown-offset-distance="2" type="button"
                  data-dropdown-trigger="hover"
                  class="flex w-full items-center justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Reset Password
                  <svg class="ms-3 h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 9 4-4-4-4" />
                  </svg></button>
                <div id="reset-password-dropdown-{{ $user->id }}"
                  class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="reset-password-btn-{{ $user->id }}">
                    @if ($user->email_verifies_at)
                      <li>
                        <a href="#"
                          class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                          Send to email
                        </a>
                      </li>
                    @endif
                    <li>
                      <button type="button" x-data=""
                        x-on:click.prevent="showConfirmDeleteModal({{ $user->id }}, event, $dispatch)"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Generate new password
                      </button>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="border-t border-gray-100 dark:border-gray-600">
                <button type="button" x-data x-on:click="deleteUser({{ $user->id }}, event, $dispatch)"
                  {{ $user->readonly ? 'disabled' : '' }}
                  class="flex w-full items-center gap-3 px-4 py-2 text-red-700 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-400">
                  <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <span>Delete Account</span>
                </button>
              </li>
            </ul>
          </div>
        </td>
      @endif
    </tr>
  @endforeach
</x-table>
