@props(['steps', 'manuscript'])
@php
  $currentStepIndex = $manuscript->current_step ?? 1;
  $currentStep = $steps[$currentStepIndex - 1];
@endphp

<x-app-layout sizeHideSidebar="2xl" title="Submit Manuscript">
  <input id="manuscript-id" type="hidden" name="id" value="{{ $manuscript->id ?? '' }}" form="manuscript-form">
  <div class="fixed bottom-4 top-20 hidden border-r border-gray-300 !pr-4 dark:border-gray-800 md:block">
    <div class="card flex max-h-full w-72 flex-col !p-4">
      <h3 class="mb-2 border-b border-gray-200 pb-2 text-xl font-bold dark:border-gray-700">Submission</h3>
      <ol class="h-full space-y-2 overflow-y-auto">
        @foreach ($steps as $step)
          <form x-data x-on:submit.prevent="changeStep(event, $dispatch)" method="POST"
            action={{ route('manuscripts.change_step', $manuscript->id ?? '') }}>
            @csrf
            @method('PATCH')
            <input type="hidden" name="step" value="{{ $loop->iteration }}">
            <button type="submit"
              @if ($currentStepIndex == $loop->iteration) class="w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-2 text-blue-700 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400" 
              @else
              @switch($step->status??null)
            @case('success')
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            @break
            @case('error')
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            @break
            @default
              class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            @endswitch @endif
              role="alert">
              <div class="flex w-full items-center justify-between gap-x-6">
                <span class="sr-only">{{ $step->name }}</span>
                <div class="flex w-full flex-1 justify-start gap-x-1 text-sm font-normal">
                  <h3 class="truncate">Step {{ $loop->iteration }}: </h3>
                  <h3 class="text-wrap flex-1 text-left">{{ $step->name }}</h3>
                </div>
                @if ($currentStepIndex == $loop->iteration)
                  <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                @else
                  @switch($step->status??null)
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

                    @default
                  @endswitch
                @endif
              </div>
            </button>
          </form>
        @endforeach
      </ol>
    </div>
  </div>
  <div
    class="sticky top-16 z-20 mb-2 block w-full border-b border-gray-300 bg-gray-100 pb-2 pt-4 dark:border-gray-800 dark:bg-gray-900 md:hidden">
    <button id="dropdownStepSubmissionButton" data-dropdown-toggle="dropdownStepSubmission"
      data-dropdown-placement="bottom" data-dropdown-trigger="click" type="button"
      @switch($currentStep->status??null)
            @case('success')
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            @break
            @case('error')
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            @break
            @default
              class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            @endswitch
      role="alert">
      <div class="flex w-full items-center justify-between gap-x-6">
        <span class="sr-only">{{ $currentStep->name }}</span>
        <div class="flex w-full flex-1 justify-start gap-x-1 text-sm font-normal">
          <h3 class="truncate">Step {{ $currentStepIndex }}: </h3>
          <h3 class="text-wrap flex-1 text-left">{{ $currentStep->name }}</h3>
        </div>
        @switch($currentStep->status??null)
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

          @default
        @endswitch

        {{-- <svg class="ms-3 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 4 4 4-4" />
        </svg> --}}
      </div>
    </button>
    {{-- Dropdown menu --}}
    <div id="dropdownStepSubmission" class="hidden w-full rounded-lg">
      <ol class="card max-h-48 space-y-2 overflow-y-auto p-4" aria-labelledby="dropdownStepSubmissionButton">
        @foreach ($steps as $step)
          <form x-data x-on:submit.prevent="changeStep(event, $dispatch)" method="POST"
            action={{ route('manuscripts.change_step', $manuscript->id ?? '') }}>
            @csrf
            @method('PATCH')
            <input type="hidden" name="step" value="{{ $loop->iteration }}">
            <button type="submit"
              @if ($currentStepIndex == $loop->iteration) class="w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-2 text-blue-700 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400"
            @else
              @switch($step->status??null)
            @case('success')
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            @break
            @case('error')
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            @break
            @default
              class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            @endswitch @endif
              role="alert">
              <div class="flex w-full items-center justify-between gap-x-6">
                <span class="sr-only">{{ $step->name }}</span>
                <div class="flex w-full flex-1 justify-start gap-x-1 text-sm font-normal">
                  <h3 class="truncate">Step {{ $loop->iteration }}: </h3>
                  <h3 class="text-wrap flex-1 text-left">{{ $step->name }}</h3>
                </div>
                @if ($currentStepIndex == $loop->iteration)
                  <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                @else
                  @switch($step->status??null)
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

                    @default
                  @endswitch
                @endif
              </div>
            </button>
          </form>
        @endforeach
      </ol>
    </div>

  </div>
  <main class="md:ml-80">
    @if (session('alert'))
      <x-alert :messages="session('alert')['message']" :type="session('alert')['type']" timeout="5000" />
    @endif
    <div id=alert-group></div>
    <div>
      {{ ${'step' . $currentStepIndex} ?? '' }}
    </div>

    <div
      class="mt-4 flex flex-col items-center justify-between gap-2 border-t border-gray-300 py-2 dark:border-gray-700 md:flex-row">
      <div class="flex flex-col items-center gap-2 md:flex-row">
        @if ($currentStepIndex > 1)
          <button type="button" class="button secondary !gap-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-width="2" d="m15 6l-6 6l6 6" />
            </svg>
            Previous Step
          </button>
        @endif
      </div>
      <div class="flex flex-col items-center gap-2 md:flex-row">
        @if ($currentStepIndex < count($steps))
          <button id="submit-modal-btn" class="button primary !gap-x-1" type="submit" form="manuscript-form">
            Save & Continue
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rotate-180" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-width="2" d="m15 6l-6 6l6 6" />
            </svg>
          </button>
        @else
          <button id="submit-modal-btn" class="button primary !gap-x-1" type="submit" form="manuscript-form">
            Submit
          </button>
        @endif
      </div>
    </div>
  </main>
  <x-modal name="confirmation-change-step">
    <div class="max-w-2xl p-4 text-center md:p-5" x-data="{ form: null }"
      x-on:confirm-change-step.window="$dispatch('close-modal'); form=$event.detail.form">
      <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>
      <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
        {{ __('Are you sure to leave this page and ignore the changes that have been made?') }}
      </h3>
      <div class="flex justify-center gap-3">
        <button id="delete-modal-btn" type="button" x-on:click="form.submit()" class="button error">
          Yes, I am sure
        </button>
        <button id="submit-modal-btn" type="submit" form="manuscript-form" class="button primary">
          No, Save changes
        </button>
        <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')" class="button secondary">
          Cancel
        </button>
      </div>
    </div>
  </x-modal>

  @vite(['resources/js/components/submission.js'])
</x-app-layout>
