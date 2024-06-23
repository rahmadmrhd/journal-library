<x-app-layout title="Invitation Tasks" :subGate="$subGate">
  {{-- Alert --}}
  @if (session('alert'))
    @php
      $msg = session('alert');
    @endphp
    <x-alert class="sm:mx-4" :type="$msg['type']" :title="$msg['title'] ?? null" :messages="$msg['messages'] ?? null" :id="'msg-box'" :timeout="3000" />
  @endif
  <div class="absolute h-full w-full border-b border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800">
    <div class="relative flex h-full w-full flex-col items-start justify-between p-4">
      <div class="mb-3">
        <h1 class="text-xl font-extrabold text-gray-900 dark:text-white sm:text-2xl">Invitation Tasks</h1>
      </div>
      {{-- Button Control --}}
      <div class="flex w-full flex-col justify-between gap-2 dark:divide-gray-700 md:flex-row md:items-center">
        <div class="mb-4 hidden items-center sm:mb-0 sm:flex">
          <form class="w-full sm:pr-3" action="#" method="GET">
            <label for="invitations-search" class="sr-only">Search</label>
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
              <input type="search" name="search" id="invitations-search" value="{{ request('search') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                placeholder="Search invitation">
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
      </div>

      <x-table class="mt-6 h-full" :columns="[
          [
              'label' => '',
              'name' => 'action',
              'isSortable' => false,
          ],
          [
              'label' => 'Manuscript ID',
              'name' => 'manuscript_id',
              'isSortable' => true,
          ],
          [
              'label' => 'Manuscript Title',
              'name' => 'manuscript_title',
              'isSortable' => true,
          ],
          [
              'label' => 'Abstract',
              'name' => 'abstract',
              'isSortable' => false,
          ],
          [
            'label' => 'Author',
            'name' => 'author',
            'isSortable' => true,
    ],
          [
              'label' => 'Submitted at',
              'name' => 'submitted_at',
              'isSortable' => true,
          ],
      ]">
        @if ($invitations->total() > 10)
          @slot('pagination')
            {{ $invitations->links() }}
          @endslot
        @endif

        @foreach ($invitations as $invitation)
          <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            <td class="w-[1%] px-6 py-2">
              <button title="More" id="more-btn-{{ $invitation->id }}" x-data x-on:click.stop=""
                data-dropdown-toggle="more-dropdown-{{ $invitation->id }}" class="button secondary !p-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M16 12a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2" />
                </svg>
              </button>

              <!-- Dropdown menu -->
              <div id="more-dropdown-{{ $invitation->id }}"
                class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="more-btn-{{ $invitation->id }}">
                  <li>

                  </li>
                  <li class="border-t border-gray-100 dark:border-gray-600">
                    <button type="button" x-data
                      x-on:click.prevent.stop="$dispatch('open-modal', 'modal-delete-submission')"
                      class="flex w-full items-center gap-3 px-4 py-2 text-red-700 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-400">
                      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                      </svg>
                      <span>Delete</span>
                    </button>
                  </li>
                </ul>
              </div>
            </td>
            <td class="font-xs min-w-44 w-[1%] px-6 py-2">{{ $invitation->manuscript->code ?? '-' }}</td>
            <th role="row" class="font-sm px-6 py-2 font-bold">
              {{ $invitation->manuscript->title ?? '(No Title Entered)' }}
            </th>
            <td>
              {{ $invitation->manuscript->abstract }}
            </td>
            <td class="px-6 py-2">

            </td>
            <td class="w-[1%] px-6 py-2">
              {{ Carbon\Carbon::parse($invitation->manuscript->submitted_at)->format('d M Y') }}
            </td>
          </tr>
        @endforeach
      </x-table>
    </div>
  </div>
</x-app-layout>
