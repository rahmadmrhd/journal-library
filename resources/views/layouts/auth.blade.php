@props(['title'])
@extends('layouts.master')

@section('body')

  <body class="font-sans antialiased">
    <div
      class="absolute bottom-0 left-0 right-0 top-0 flex justify-center overflow-auto bg-gray-200 text-gray-900 dark:bg-gray-900 dark:text-gray-100 sm:items-center">
      <div class="relative max-h-full w-full bg-white sm:w-auto sm:rounded-xl sm:bg-none">
        <div
          class="relative flex min-h-full w-full self-center bg-white px-6 py-4 dark:bg-gray-800 sm:w-auto sm:rounded-xl sm:shadow-xl">
          {{ $slot }}
        </div>
      </div>
    </div>
    @stack('body')
  </body>
@endsection
