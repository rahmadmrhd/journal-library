@php
  $forms = [
      [
          'label' => 'User info',
          'status' => 'success', // error, success, in_progress, 'undifined/null'
      ],
      [
          'label' => 'User info',
          'status' => 'error', // error, success, in_progress, 'undifined/null'
      ],
      [
          'label' => 'User info',
          'status' => 'in_progress', // error, success, in_progress, 'undifined/null'
      ],
      [
          'label' => 'User info',
      ],
  ];
@endphp
<x-app-layout sizeHideSidebar="2xl" title="Submit Manuscript">
  <div class="fixed bottom-4 top-20 hidden border-r border-gray-300 !pr-4 dark:border-gray-800 md:block">
    <div class="card flex h-full w-56 flex-col !p-4 transition-[width] duration-300 ease-in-out lg:w-72">
      <h3 class="mb-2 border-b border-gray-200 pb-2 text-xl font-bold dark:border-gray-700">Submission</h3>
      <ol class="h-full space-y-2 overflow-y-auto">
        @foreach ($forms as $form)
          <li>
            <div
              @switch($form['status']??null)
            @case('success')
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            @break
            @case('error')
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            @break
            @case('in_progress')
              class="w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-2 text-blue-700 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400"
            @break
            @default
              class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            @endswitch
              role="alert">
              <div class="flex w-full items-center justify-between gap-x-6">
                <span class="sr-only">{{ $form['label'] }}</span>
                <div class="flex w-full flex-grow gap-x-2">
                  <h3 class="font-medium">{{ $loop->iteration }}.</h3>
                  <h3 class="flex-grow text-left font-medium">{{ $form['label'] }}</h3>
                </div>
                @switch($form['status']??null)
                  @case('success')
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 16 12">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5.917 5.724 10.5 15 1.5" />
                    </svg>
                  @break

                  @case('error')
                    <svg class="-mr-1 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                      height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                  @break

                  @case('in_progress')
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  @break

                  @default
                @endswitch
              </div>
            </div>
          </li>
        @endforeach
      </ol>
    </div>
  </div>
  <div
    class="sticky top-16 mb-2 block w-full border-b border-gray-300 bg-gray-100 pb-2 pt-4 dark:border-gray-800 dark:bg-gray-900 md:hidden">
    @php
      $currentForm = collect($forms)->where('status', 'in_progress')->first();
      $currentFormIndex = collect($forms)->search($currentForm) + 1;
    @endphp
    <button id="dropdownStepSubmissionButton" data-dropdown-toggle="dropdownStepSubmission"
      data-dropdown-placement="bottom" data-dropdown-trigger="hover" type="button"
      @switch($currentForm['status']??null)
            @case('success')
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            @break
            @case('error')
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            @break
            @case('in_progress')
              class="w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-2 text-blue-700 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400"
            @break
            @default
              class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            @endswitch
      role="alert">
      <div class="flex w-full items-center justify-between gap-x-6">
        <span class="sr-only">{{ $currentForm['label'] }}</span>
        <div class="flex w-full flex-grow gap-x-2">
          <h3 class="flex-none font-medium">{{ $currentFormIndex }}.</h3>
          <h3 class="flex-grow text-left font-medium">{{ $currentForm['label'] }}</h3>
        </div>
        @switch($currentForm['status']??null)
          @case('success')
            <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 5.917 5.724 10.5 15 1.5" />
            </svg>
          @break

          @case('error')
            <svg class="-mr-1 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
          @break

          @case('in_progress')
            <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
          @break

          @default
        @endswitch

        <svg class="ms-3 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 4 4 4-4" />
        </svg>
      </div>
    </button>
    {{-- Dropdown menu --}}
    <div id="dropdownStepSubmission" class="z-10 hidden w-full rounded-lg">
      <ol class="card max-h-48 space-y-2 overflow-y-auto p-4" aria-labelledby="dropdownStepSubmissionButton">
        @foreach ($forms as $form)
          <li>
            <div
              @switch($form['status']??null)
            @case('success')
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            @break
            @case('error')
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            @break
            @case('in_progress')
              class="w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-2 text-blue-700 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400"
            @break
            @default
              class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            @endswitch
              role="alert">
              <div class="flex w-full items-center justify-between gap-x-6">
                <span class="sr-only">{{ $form['label'] }}</span>
                <div class="flex w-full flex-grow gap-x-2">
                  <h3 class="font-medium">{{ $loop->iteration }}.</h3>
                  <h3 class="flex-grow text-left font-medium">{{ $form['label'] }}</h3>
                </div>
                @switch($form['status']??null)
                  @case('success')
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 16 12">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5.917 5.724 10.5 15 1.5" />
                    </svg>
                  @break

                  @case('error')
                    <svg class="-mr-1 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                      height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                  @break

                  @case('in_progress')
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  @break

                  @default
                @endswitch
              </div>
            </div>
          </li>
        @endforeach
      </ol>
    </div>

  </div>
  <main class="min-h-screen md:ml-80">

    TEST
  </main>
</x-app-layout>
