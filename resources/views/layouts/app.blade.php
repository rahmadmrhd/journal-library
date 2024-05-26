@props(['sizeHideSidebar' => 'lg', 'title', 'class' => ''])

@php
  $sizeList = [
      'sm' => 'sm:ml-60',
      'md' => 'md:ml-60',
      'lg' => 'lg:ml-60',
      'xl' => 'xl:ml-60',
      '2xl' => '2xl:ml-60',
  ][$sizeHideSidebar];
@endphp

@extends('layouts.master')

@section('body')

  <body class="bg-gray-100 font-sans antialiased dark:bg-gray-900 dark:text-white">
    <!-- Page Heading -->
    <x-navbar :sizeHideSidebar="$sizeHideSidebar" />
    <x-sidebar :sizeHideSidebar="$sizeHideSidebar" />

    <!-- Page Content -->
    <main class="{{ $sizeList }} {{ $class }} mt-16 p-4">
      @if (request()->request->has('role_error'))
        @include('auth.role-error')
      @else
        {{ $slot }}
      @endif
    </main>
    <div id="loading-box"
      class="fixed bottom-0 left-0 right-0 top-0 z-[100] hidden items-center justify-center overflow-y-auto bg-gray-900/50 p-4 dark:bg-gray-900/80">
      <div class="min-h-6 flex max-h-full max-w-[60%] items-center gap-6 rounded-xl bg-white p-4 shadow dark:bg-gray-800">
        <div role="status">
          <svg aria-hidden="true" class="h-10 w-10 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600"
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
        <div>
          <h3 id="loading-title" class="mb-1 text-lg font-medium empty:hidden">Loading...</h3>
          <p id="loading-description" class="empty:hidden"></p>
        </div>
      </div>
    </div>
    @stack('body')

    <x-modal name="file-preview" focusable x-on:load.window="window.$dispatch= $dispatch">
      <div
        class="card relative h-screen w-full !p-0 sm:w-[80vw] lg:h-[85vh] lg:w-[1000px] xl:h-[75vh] xl:w-[1200px] 2xl:w-[1500px]">
        <div class="relative flex items-center justify-between p-2 !px-4">
          <h3 class="text-lg font-bold">File Preview</h3>
          <button class="button secondary !p-2" type="button" x-on:click="$dispatch('close')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z" />
            </svg>
          </button>
        </div>
        <div id="container-file" class="relative h-[90%] w-full">
          {{-- <iframe
      src="https://view.officeapps.live.com/op/embed.aspx?src=https://13vtlvqnkb.sharedwithexpose.com/files/manuscripts/9c1306ca-e277-4810-acfd-18ced2d8ffae/9c130608-323b-43e6-b80c-3914c268179e.xlsx"
      class="min-h-screen w-full" frameborder="0"></iframe> --}}
          {{-- <object name="test.pdf" type="application/pdf" data="/files/temps/uazZmSEBvUW6d1plESP19yywhgmDRy6HgAVjzzlp.pdf"
            class="relative h-full w-full">
          </object> --}}
        </div>
      </div>
    </x-modal>
    @vite(['resources/js/components/loading-handler.js', 'resources/js/components/file-preview.js'])
  </body>
@endsection
