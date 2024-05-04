@php
  $title = 'Users';
@endphp
<x-app-layout>
  {{-- Alert --}}
  @if (session('message'))
    @php
      $msg = session('message');
    @endphp
    <x-alert class="sm:mx-4" :status="$msg['status']" :messages="$msg['msg']" :id="'msg-box'" :timeout="3000" />
  @endif
  <div class="border-b border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800 sm:rounded-lg">
    <div class="flex w-full flex-col items-start justify-between p-4">
      <div class="mb-3">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Users Management</h1>
      </div>
      {{-- Button Control --}}
      <div class="flex w-full flex-col justify-between gap-2 dark:divide-gray-700 md:flex-row md:items-center">
        <div class="mb-4 hidden items-center sm:mb-0 sm:flex">
          <form class="w-full sm:pr-3" action="#" method="GET">
            <label for="users-search" class="sr-only">Search</label>
            <div class="relative sm:w-full md:w-72 xl:w-96">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
                </svg>
              </div>
              @if (request('show'))
                <input type="hidden" name="show" value="{{ request('show') }}">
              @endif
              <input type="search" name="search" id="users-search" value="{{ request('search') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                placeholder="Search User">
            </div>
          </form>
          <div class="flex items-center sm:justify-end">
            <div class="flex space-x-1 pl-2">
              <button type="button" title="Filter"
                class="inline-flex cursor-pointer justify-center rounded p-1 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M14 12v7.88c.04.3-.06.62-.29.83a.996.996 0 0 1-1.41 0l-2.01-2.01a.99.99 0 0 1-.29-.83V12h-.03L4.21 4.62a1 1 0 0 1 .17-1.4c.19-.14.4-.22.62-.22h14c.22 0 .43.08.62.22a1 1 0 0 1 .17 1.4L14.03 12z" />
                </svg>
              </button>
            </div>
          </div>
        </div>
        <div class="flex w-full items-end gap-2 sm:w-auto">
          <button id="add-user-btn" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'add-user-modal')" class="button primary">
            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"></path>
            </svg>
            Add New User
          </button>
          {{-- <a href="{{ route('admin.mahasiswa.print') }}"
            class="inline-flex h-9 w-1/2 items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">
            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                clip-rule="evenodd"></path>
            </svg>
            Export
          </a> --}}
        </div>
      </div>

      @include('pages.users.form')

      @include('pages.users.delete')

      <x-table minHeight="500px" :columns="[
          [
              'label' => 'Name',
              'name' => 'name',
              'isSortable' => true,
          ],
          [
              'label' => 'Email',
              'name' => 'email',
              'isSortable' => true,
          ],
          [
              'label' => 'Institution',
              'name' => 'institution',
              'isSortable' => true,
          ],
          [
              'label' => 'Role',
              'name' => 'role',
              'isSortable' => false,
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
            <td class="w-[1%] px-6 py-2 text-center">{{ $user->email }}</td>
            <td class="w-[1%] px-6 py-2 text-center">{{ $user->institution }}</td>
            <td class="w-[1%] px-6 py-2 text-center">
              <ul>
                @foreach ($user->roles()->get() as $role)
                  <li class="list-disc text-left">{{ $role->name }}</li>
                @endforeach
              </ul>
            </td>
            @if (!$user->readonly)
              <td class="w-[100px] space-x-1 whitespace-nowrap p-4">
                <button title="More" id="more-btn-{{ $user->id }}" {{ $user->readonly ? 'disabled' : '' }}
                  data-dropdown-toggle="more-dropdown-{{ $user->id }}" class="button secondary !p-2"
                  type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M16 12a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2" />
                  </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="more-dropdown-{{ $user->id }}"
                  class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="more-btn-{{ $user->id }}">
                    <li>
                      <button type="button" x-data x-on:click="showUpdateUser({{ $user->id }}, event, $dispatch)"
                        class="flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Edit
                      </button>
                    </li>
                    <li>
                      <button id="reset-password-btn-{{ $user->id }}"
                        data-dropdown-toggle="reset-password-dropdown-{{ $user->id }}"
                        data-dropdown-placement="right-start" data-dropdown-offset-distance="2" type="button"
                        data-dropdown-trigger="hover"
                        class="flex w-full items-center justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Reset Password
                        <svg class="ms-3 h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
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
                                class="block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Send to email
                              </a>
                            </li>
                          @endif
                          <li>
                            <button type="button" x-data=""
                              x-on:click.prevent="showConfirmDeleteModal({{ $user->id }}, event, $dispatch)"
                              class="block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
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
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg">
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

    </div>
  </div>
  @vite(['resources/js/user.js'])
</x-app-layout>
