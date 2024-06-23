<x-app-layout :subGate="$subGate" class="">
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Profile') }}
    </h2>
  </x-slot>

  {{-- Tab --}}
  <x-tabs-panel class="w-full px-4" :withFragment="true" :tabs="[
      [
          'label' => 'Profile',
          'name' => 'profile',
      ],
      [
          'label' => 'Account',
          'name' => 'account',
      ],
  ]">
    @if (session('alert'))
      @php
        $msg = session('alert');
      @endphp
      <x-alert class="sm:mx-6" :type="$msg['type']" :messages="$msg['msg']" :id="'msg-box'" :timeout="3000" />
    @endif

    <x-slot name="profile" class="space-y-6 px-4">
      @include('pages.settings.partials.profile')
    </x-slot>
    <x-slot name="account" class="space-y-6 px-4">
      @include('pages.settings.partials.account')
    </x-slot>

  </x-tabs-panel>
</x-app-layout>
