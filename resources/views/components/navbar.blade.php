@props(['sizeHideSidebar' => 'lg'])
@php
  $sizeList = [
      'sm' => 'sm:hidden',
      'md' => 'md:hidden',
      'lg' => 'lg:hidden',
      'xl' => 'xl:hidden',
      '2xl' => '2xl:hidden',
  ][$sizeHideSidebar];
@endphp
<nav
  class="fixed top-0 z-40 h-16 w-full border-b border-gray-200 bg-white px-3 py-2 dark:border-gray-700 dark:bg-gray-800 lg:px-5 lg:pl-3">
  <div class="flex items-center justify-between">
    <div class="flex items-center justify-start rtl:justify-end">
      {{-- hambuger btn --}}
      <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
        type="button"
        class="{{ $sizeList }} inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
          </path>
        </svg>
      </button>
      {{-- End hamburger btn --}}
      {{-- Logo App --}}
      <div class="ms-2 hidden md:me-24 md:flex">
        <x-application-logo class="me-3 h-10" />
        {{-- <img src="{{ url('storage/logo_untag.png') }}" class="me-3 h-10 self-center" alt="Untag Logo" /> --}}
        <div class="flex flex-col self-center">
          <span class="text-md whitespace-nowrap font-semibold uppercase dark:text-white">Submission System</span>
          {{-- <span class="whitespace-nowrap text-sm font-normal uppercase dark:text-white">Universitas 17 Agustus
            1945</span> --}}
        </div>
      </div>
      {{-- End Logo App --}}
    </div>

    <div class="flex items-center">
      {{-- Toggle Theme --}}
      <div class="ms-3 flex items-center">
        <button id="theme-toggle" type="button" data-dropdown-toggle="dropdown-theme"
          class="rounded-lg p-2.5 text-sm text-gray-500 hover:bg-gray-100 hover:outline-none dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
          <svg id="theme-toggle-dark-icon" class="hidden h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon" class="hidden h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>
        <div
          class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded bg-white text-base shadow dark:divide-gray-600 dark:bg-gray-700"
          id="dropdown-theme">
          <div class="py-1" role="none">
            <input type="radio" name="theme" id="dark-theme" class="hidden" value="dark">
            <label for="dark-theme" class="dropdown-item" role="menuitem" name="dark">
              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M11.675 2.015a.998.998 0 0 0-.403.011C6.09 2.4 2 6.722 2 12c0 5.523 4.477 10 10 10 4.356 0 8.058-2.784 9.43-6.667a1 1 0 0 0-1.02-1.33c-.08.006-.105.005-.127.005h-.001l-.028-.002A5.227 5.227 0 0 0 20 14a8 8 0 0 1-8-8c0-.952.121-1.752.404-2.558a.996.996 0 0 0 .096-.428V3a1 1 0 0 0-.825-.985Z"
                  clip-rule="evenodd" />
              </svg>
              <span>Dark</span>
            </label>
            <input type="radio" name="theme" id="light-theme" class="hidden" value="light">
            <label for="light-theme" class="dropdown-item" role="menuitem" name="light">
              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M13 3a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0V3ZM6.343 4.929A1 1 0 0 0 4.93 6.343l1.414 1.414a1 1 0 0 0 1.414-1.414L6.343 4.929Zm12.728 1.414a1 1 0 0 0-1.414-1.414l-1.414 1.414a1 1 0 0 0 1.414 1.414l1.414-1.414ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm-9 4a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H3Zm16 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2ZM7.757 17.657a1 1 0 1 0-1.414-1.414l-1.414 1.414a1 1 0 1 0 1.414 1.414l1.414-1.414Zm9.9-1.414a1 1 0 0 0-1.414 1.414l1.414 1.414a1 1 0 0 0 1.414-1.414l-1.414-1.414ZM13 19a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Z"
                  clip-rule="evenodd" />
              </svg>
              <span>Light</span>
            </label>
            <input type="radio" name="theme" id="system-theme" class="hidden" value="system">
            <label for="system-theme" class="dropdown-item" role="menuitem" name="system">
              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M10.85 12.65h2.3L12 9zM20 8.69V4h-4.69L12 .69L8.69 4H4v4.69L.69 12L4 15.31V20h4.69L12 23.31L15.31 20H20v-4.69L23.31 12zM14.3 16l-.7-2h-3.2l-.7 2H7.8L11 7h2l3.2 9z" />
              </svg>
              <span>System</span>
            </label>
          </div>
        </div>
      </div>
      {{-- End Toggle Theme --}}
      {{-- Toggle User --}}
      @auth
        <div class="ms-3 flex items-center">
          <button type="button" class="-my-1 flex items-center rounded-lg text-sm" aria-expanded="false"
            data-dropdown-toggle="dropdown-user">
            <span class="sr-only">Open user menu</span>
            <div class="relative h-8 w-8 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
              <svg class="absolute -left-1 h-10 w-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                </path>
              </svg>
            </div>
            {{-- <img class="h-8 w-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
              alt="user photo"> --}}
            <div class="mx-3 hidden text-left md:block" role="none">
              <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ Auth::user()->preferred_name ?? Auth::user()->getFullName() }}
              </p>
              <p class="truncate text-left text-xs font-medium text-gray-900 dark:text-gray-300" role="none">
                {{ Auth::user()->username }}
              </p>
            </div>
          </button>
          <div
            class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded bg-white text-base shadow dark:divide-gray-600 dark:bg-gray-700"
            id="dropdown-user">
            <div class="px-4 py-3 md:hidden" role="none">
              <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ Auth::user()->preferred_name ?? Auth::user()->getFullName() }}
              </p>
              <p class="truncate text-sm font-medium text-gray-900 dark:text-gray-300" role="none">
                {{ Auth::user()->username }}
              </p>
            </div>
            <div class="divide-y divide-gray-100 px-4 py-3">
              <form action="{{ route('role.update', absolute: false) }}" method="POST">
                @csrf
                @method('PUT')
                <x-text-input label="Role" name="roleId" value="{{ Auth::user()->current_role_id }}"
                  onchange="this.form.submit()" type="select">
                  @foreach (Auth::user()->roles as $role)
                    <option {{ Auth::user()->current_role_id == $role->id ? 'selected' : '' }}
                      value="{{ $role->id }}">{{ $role->name }}</option>
                  @endforeach
                </x-text-input>
                {{-- <label for="role" class="block text-sm font-medium text-gray-900 dark:text-white">
                  Role
                </label>
                <select id="role" name="roleId" onchange="this.form.submit()"
                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-2 py-1 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                  @foreach (Auth::user()->roles as $role)
                    <option {{ Auth::user()->current_role_id == $role->id ? 'selected' : '' }}
                      value="{{ $role->id }}">{{ $role->name }}</option>
                  @endforeach
                </select> --}}
              </form>
            </div>
            <ul class="py-1" role="none">

              {{-- @dd(Auth::user()->current_role_id) --}}
              <li>
                <a href="{{ route('settings', absolute: false) }}" class="dropdown-item" role="menuitem">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                      d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z"
                      clip-rule="evenodd" />
                  </svg>
                  <span>Settings</span>
                </a>
              </li>
              <li>
                <form action="{{ route('logout', absolute: false) }}" method="POST" role="menuitem">
                  @csrf
                  <button class="dropdown-item w-full" role="menuitem" type="submit">
                    <x-gmdi-logout class="!text-red-500" />
                    <span class="text-red-500">Log Out</span>
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      @endauth
      {{-- Toggle User --}}
    </div>
  </div>
</nav>
