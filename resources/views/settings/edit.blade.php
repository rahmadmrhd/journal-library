<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Profile') }}
    </h2>
  </x-slot>

  {{-- Tab --}}
  <div
    class="sticky top-16 z-10 -mx-4 mb-4 border-b-2 border-gray-200 bg-gray-100 px-4 dark:border-gray-700 dark:bg-gray-900 sm:px-10 lg:px-12">
    <ul class="-mb-px flex flex-wrap text-center text-sm font-medium" id="tab">
      <li class="me-2">
        <a href="#profile" class="inline-block rounded-t-lg p-4" id="profile-tab">Profile</a>
      </li>
      <li>
        <a href="#account" class="inline-block rounded-t-lg p-4" id="account-tab">Account</a>
      </li>
    </ul>
  </div>

  {{-- Alert --}}
  @if (session('message'))
    @php
      $msg = session('message');
    @endphp
    <x-alert class="sm:mx-6" :status="$msg['status']" :messages="$msg['msg']" :id="'msg-box'" :timeout="3000" />
  @endif
  @if (!isset($user->email) || !isset($user->username) || !isset($user->password))
    <x-alert class="sm:mx-6" :status="'warning'" :id="'warning-box'" :closeable="false">
      <span class="font-medium">Please update your account and password information first! </span>
      <a x-data="{ show: window.location.hash != '#account' }" x-on:hashchange.window="show = window.location.hash != '#account' " x-show="show"
        class="underline underline-offset-1 hover:text-blue-500" href="#account">Click Here</a>
    </x-alert>
  @endif

  {{-- Tab Content --}}
  <div id="tab-content" class="py-4 sm:px-6">
    <div class="hidden space-y-6" id="profile-content">
      @include('settings.partials.profile')
    </div>
    <div class="hidden space-y-6" id="account-content">
      @include('settings.partials.account')
    </div>
  </div>
  @vite(['resources/js/settings.js'])
</x-app-layout>
