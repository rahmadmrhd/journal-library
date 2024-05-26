<x-app-layout title="Manuscripts">
  {{-- Alert --}}
  @if (session('alert'))
    @php
      $msg = session('alert');
    @endphp
    <x-alert class="sm:mx-4" :type="$msg['type']" :messages="$msg['messages']" :id="'msg-box'" :timeout="3000" />
  @endif
  <div class="border-b border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800 sm:rounded-lg">
    <div class="flex w-full flex-col items-start justify-between p-4">
      <div class="mb-3">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Manuscripts Management</h1>
      </div>
      {{-- Button Control --}}
      <div class="flex w-full flex-col justify-between gap-2 dark:divide-gray-700 md:flex-row md:items-center">
        <div class="mb-4 hidden items-center sm:mb-0 sm:flex">
          <form class="w-full sm:pr-3" action="#" method="GET">
            <label for="manuscripts-search" class="sr-only">Search</label>
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
              <input type="search" name="search" id="manuscripts-search" value="{{ request('search') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                placeholder="Search manuscript">
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
          <a href="{{ route('manuscripts.create') }}" id="add-manuscript-btn" class="button primary">
            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"></path>
            </svg>
            Submit New Manuscript
          </a>
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

      {{-- @include('pages.manuscripts.form') --}}

      {{-- @include('pages.manuscripts.delete') --}}

      <x-table class="mt-6" :columns="[
          [
              'label' => 'Action',
              'name' => 'action',
              'isSortable' => false,
          ],
          [
              'label' => 'ID',
              'name' => 'id',
              'isSortable' => true,
          ],
          [
              'label' => 'Title',
              'name' => 'title',
              'isSortable' => true,
          ],
          [
              'label' => 'Status',
              'name' => 'status',
              'isSortable' => true,
          ],
          [
              'label' => 'Created at',
              'name' => 'created_at',
              'isSortable' => true,
          ],
      ]">
        @slot('pagination')
          {{ $manuscripts->links() }}
        @endslot

        @foreach ($manuscripts as $manuscript)
          <tr
            href="{{ $manuscript->submitted_at ? route('manuscripts.show', $manuscript->id) : route('manuscripts.create', $manuscript->id) }}"
            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            <td class="w-[1%] space-x-1 whitespace-nowrap p-4">
              <button title="More" id="more-btn-{{ $manuscript->id }}" x-data x-on:click.stop=""
                data-dropdown-toggle="more-dropdown-{{ $manuscript->id }}" class="button secondary !p-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M16 12a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2" />
                </svg>
              </button>

              <!-- Dropdown menu -->
              <div id="more-dropdown-{{ $manuscript->id }}"
                class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="more-btn-{{ $manuscript->id }}">
                  <li>
                    @if ($manuscript->submitted_at)
                      <a href="{{ route('manuscripts.show', $manuscript->id) }}"
                        class="flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Show
                      </a>
                    @else
                      <a href="{{ route('manuscripts.create', $manuscript->id) }}"
                        class="flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Continue
                      </a>
                    @endif
                  </li>
                  <li class="border-t border-gray-100 dark:border-gray-600">
                    @if ($manuscript->submitted_at)
                      <button type="button" x-data
                        x-on:click.prevent.stop="console.log($event);$dispatch('open-modal', 'modal-cancel-submission')"
                        class="flex w-full items-center gap-3 px-4 py-2 text-red-700 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                          <path fill="currentColor" fill-rule="evenodd"
                            d="M12.035 13.096a6.5 6.5 0 0 1-9.131-9.131zm1.061-1.06L3.965 2.903a6.5 6.5 0 0 1 9.131 9.131ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"
                            clip-rule="evenodd" />
                        </svg>
                        <span>Cancel Submission</span>
                      </button>
                    @else
                      <button type="button" x-data
                        x-on:click.prevent.stop="$dispatch('open-modal', 'modal-delete-submission')"
                        class="flex w-full items-center gap-3 px-4 py-2 text-red-700 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                        </svg>
                        <span>Delete</span>
                      </button>
                    @endif
                  </li>
                </ul>
              </div>
            </td>
            <td class="font-xs min-w-44 w-[1%] px-6 py-2">{{ $manuscript->code ?? '-' }}</td>
            <th role="row" class="font-sm {{ $manuscript->title ? 'font-bold' : 'italic font-normal' }} px-6 py-2">
              {{ $manuscript->title ?? '(No Title Entered)' }}
            </th>
            <td class="w-[1%] truncate px-6 py-2">
              @if (!$manuscript->submitted_at)
                <x-badge type="secondary" :useIcon="false" class="italic">Draf</x-badge>
              @else
                <x-badge type="primary" :useIcon="true">
                  @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <circle cx="18" cy="12" r="0" fill="currentColor">
                        <animate attributeName="r" begin=".67" calcMode="spline" dur="1.5s"
                          keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                          values="0;2;0;0" />
                      </circle>
                      <circle cx="12" cy="12" r="0" fill="currentColor">
                        <animate attributeName="r" begin=".33" calcMode="spline" dur="1.5s"
                          keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                          values="0;2;0;0" />
                      </circle>
                      <circle cx="6" cy="12" r="0" fill="currentColor">
                        <animate attributeName="r" begin="0" calcMode="spline" dur="1.5s"
                          keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                          values="0;2;0;0" />
                      </circle>
                    </svg>
                  @endslot
                  Waiting for a decision </x-badge>
              @endif
            </td>
            <td class="w-[1%] px-6 py-2">{{ Carbon\Carbon::parse($manuscript->created_at)->format('d M Y') }}</td>
          </tr>
        @endforeach
      </x-table>

      @if (session('already-submission'))
        <x-modal name="modal-already-submission" :show="true" focusable>
          <div id="confirm-continue-submission" class="max-w-2xl p-4 text-center md:p-5">
            <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
              {{ __('You have already drafted a submission. Please continue the previous submission before starting a new one.') }}
            </h3>
            <a href="{{ route('manuscripts.create', session('already-submission')) }}" id="delete-modal-btn"
              class="button primary">
              Yes, I will continue
            </a>
            <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')" class="button secondary">
              Cancel
            </button>
          </div>
        </x-modal>
      @endif

      <x-modal name="modal-delete-submission" focusable>
        <form method="POST" x-data="{ id: '' }" x-bind:action="`manuscripts/${id}`"
          x-on:set="id = $event.detail.id" class="max-w-2xl p-4 text-center md:p-5">
          @csrf
          @method('DELETE')
          <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
            {{ __('Are you sure you want to delete this submissions?') }}
          </h3>
          <button type="submit" id="delete-modal-btn" class="button error">
            Yes, Delete Submissions
          </button>
          <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')" class="button secondary">
            Cancel
          </button>
        </form>
      </x-modal>

      <x-modal name="modal-cancel-submission" focusable>
        <form method="POST" x-data="{ id: '', reason: '' }" x-bind:action="`manuscripts/${id}/cancel`"
          x-on:set="id = $event.detail.id" class="max-w-2xl p-4 text-center md:p-5">
          @csrf
          @method('DELETE')
          <x-text-input type="radio" direction="col" name="reason" x-model="reason"
            label="Please select a reason for canceling the submission" required :options="[
                ['label' => 'I have changed my mind', 'value' => 'I have changed my mind'],
                ['label' => 'I have lost my work', 'value' => 'I have lost my work'],
                ['label' => 'I have not finished my work', 'value' => 'I have not finished my work'],
                ['label' => 'Other', 'value' => 'other'],
            ]">
          </x-text-input>

          <div class="mt-6 flex flex-row-reverse gap-3">
            <button type="submit" class="button error">
              {{ __('Cancel Submission') }}
            </button>
            <button x-on:click.prevent="$dispatch('close')" type="button" class="button secondary">
              {{ __('Close') }}
            </button>
          </div>
        </form>
      </x-modal>
    </div>
  </div>
  @vite(['resources/js/manuscript.js'])
</x-app-layout>
