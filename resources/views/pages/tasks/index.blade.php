<x-app-layout :title="$type . ' Tasks'" :subGate="$subGate">
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
        <h1 class="text-xl font-extrabold text-gray-900 dark:text-white sm:text-2xl">{{ $type }} Tasks</h1>
      </div>
      {{-- Button Control --}}
      <div class="flex w-full flex-col justify-between gap-2 dark:divide-gray-700 md:flex-row md:items-center">
        <div class="mb-4 hidden items-center sm:mb-0 sm:flex">
          <form class="w-full sm:pr-3" action="#" method="GET">
            <label for="tasks-search" class="sr-only">Search</label>
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
              <input type="search" name="search" id="tasks-search" value="{{ request('search') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                placeholder="Search task">
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
          ...$type == 'Invitation'
              ? [
                  [
                      'label' => '',
                      'name' => 'action',
                      'isSortable' => false,
                  ],
              ]
              : [],
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
              'label' => $type == 'Invitation' ? 'Abstract' : 'Status',
              'name' => $type == 'Invitation' ? 'abstract' : 'status',
              'isSortable' => false,
          ],
          [
              'label' => 'Authors',
              'name' => 'authors',
              'isSortable' => false,
          ],
          [
              'label' => 'Submitted at',
              'name' => 'submitted_at',
              'isSortable' => true,
          ],
      ]">
        @if ($tasks->total() > 10)
          @slot('pagination')
            {{ $tasks->links() }}
          @endslot
        @endif

        @foreach ($tasks as $task)
          @if ($type == 'Invitation')
            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            @else
            <tr href="{{ route('tasks.show', ['task' => $task, 'subGate' => $subGate->slug]) }}"
              class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
          @endif
          @if ($type == 'Invitation')
            <td class="w-[1%] px-6 py-2">
              <button title="More" id="more-btn-{{ $task->id }}" x-data x-on:click.stop=""
                data-dropdown-toggle="more-dropdown-{{ $task->id }}" class="button secondary !p-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M16 12a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2" />
                </svg>
              </button>

              <!-- Dropdown menu -->
              <div id="more-dropdown-{{ $task->id }}"
                class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="more-btn-{{ $task->id }}">
                  <li class="border border-gray-100 hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-400">
                    <form
                      action="{{ route('tasks.invitationDecision', ['subGate' => $subGate->slug, 'task' => $task]) }}"
                      method="POST" class="w-full">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="decision" value="accept">
                      <button type="submit" class="flex w-full cursor-pointer items-center gap-3 px-4 py-2">
                        <span>Accept this invitation</span>
                      </button>
                    </form>
                  </li>
                  <li class="border-t border-gray-100 hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-400">
                    <form
                      action="{{ route('tasks.invitationDecision', ['subGate' => $subGate->slug, 'task' => $task]) }}"
                      method="POST" class="w-full">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="decision" value="reject">
                      <button type="submit"
                        class="flex w-full cursor-pointer items-center gap-3 px-4 py-2 text-red-700 dark:text-red-500">
                        <span>Decline this invitation</span>
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </td>
          @endif
          <td class="font-xs min-w-44 w-[1%] px-6 py-2">{{ $task->manuscript->code ?? '-' }}</td>
          <th role="row" class="font-sm px-6 py-2 font-bold">
            {{ $task->manuscript->title }}
          </th>
          @if ($type == 'Invitation')
            <td>
              {{ $task->manuscript->abstract }}
            </td>
          @else
            <td class="w-[1%] truncate px-6 py-2">
              @if ($task->processed_at == null)
                <x-badge type="warning" class="italic">Needs Review</x-badge>
              @else
                @switch($task->status)
                  @case('done')
                    @if ($task->details->last()->decision == 'accept')
                      <x-badge type="success">Accepted</x-badge>
                    @else
                      <x-badge type="error">Rejected</x-badge>
                    @endif
                  @break

                  @case('in_progress')
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
                      Waiting your decision
                    </x-badge>
                  @break

                  @case('delegated')
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
                      Waiting Academic Editor
                    </x-badge>
                  @break
                @endswitch
              @endif
            </td>
          @endif
          <td class="min-w-48 w-[1%] px-6 py-2">
            <div class="-my-1 flex items-center truncate text-sm">
              <span class="sr-only">Open user menu</span>
              <div class="relative h-8 w-8 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
                <svg class="absolute -left-1 h-10 w-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                    clip-rule="evenodd">
                  </path>
                </svg>
              </div>
              <div class="mx-3 hidden w-fit text-left md:block" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                  {{ $task->manuscript->authors->where('pivot.is_corresponding_author', true)->first()->getFullName() }}
                </p>
                <p class="truncate text-left text-xs font-medium italic text-gray-900 dark:text-gray-300">
                  (Corresponding Author)
                </p>
                <button type="button" x-data
                  x-on:click.prevent.stop="$dispatch('open-modal', 'modal-author-info'); $dispatch('set-authors-info', @js($task->manuscript->authors->toArray()))"
                  class="mt-1 truncate text-left text-xs font-medium italic text-gray-900 underline-offset-2 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-300"
                  role="none">
                  Click this for more info
                </button>
              </div>
            </div>
          </td>
          <td class="w-[1%] px-6 py-2">{{ Carbon\Carbon::parse($task->manuscript->submitted_at)->format('d M Y') }}
          </td>
          @if (true)
            </tr>
          @endif
        @endforeach
      </x-table>

      <x-modal name="modal-author-info" focusable>
        <div class="card relative !p-0 sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg"
          x-data="{
              authors: []
          }" x-init="$watch('show', val => {
              if (!val) {
                  setTimeout(() => authors = [], 500);
              }
          })" x-on:set-authors-info.window="authors = $event.detail">
          <div class="flex items-center justify-between p-4">
            <h3 class="text-xl font-bold">Authors</h3>
            <button class="button error !p-2" type="button" x-on:click="$dispatch('close')">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z" />
              </svg>
            </button>
          </div>
          <div class="w-full">
            <x-table :columns="[
                ['label' => 'AUTHORS', 'name' => 'AUTHOR', 'isSortable' => false],
                ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
            ]">
              <template x-for="(author, index) in authors">
                <tr
                  class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                  <td valign="top" class="max-w-64px truncate px-6 py-2">
                    <div class="flex flex-col items-start">
                      <input type="hidden" name="authorsId[]" x-model="author.id">
                      <h3 class="text-base font-bold"
                        x-text="`${author.title ? `${author.title} `: ''}${author.first_name ? `${author.first_name} `: ''}${author.last_name ? `${author.last_name} `: ''}${author.degree ? `${author.degree} `: ''}`">
                      </h3>
                      <template x-if="author.pivot.is_corresponding_author">
                        <p class="text-sm italic">(Corresponding Author)</p>
                      </template>
                      <p class="mt-6 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline"
                        x-text="author.email">
                      </p>
                      <template x-if="author.orcid_id">
                        <div class="mt-2 flex items-center gap-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                            <path fill="currentColor"
                              d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                          </svg>
                          <p x-text="author.orcid_id"
                            class="text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">
                          </p>
                        </div>
                      </template>
                    </div>
                  </td>
                  <td valign="top" class="lg:min-w-96 min-w-min px-6 py-2">
                    <div class="flex flex-col items-start">
                      <p class="text-sm font-bold" x-text="`${author.institution ? `${author.institution}, ` : ''}`">
                      </p>
                      <p class="text-sm"
                        x-text="`${author.department ? `${author.department}, ` : ''}${author.position??''}`">
                      </p>
                      <p class="mt-3 text-sm font-normal" x-text="author.address"></p>
                      <p class="text-sm font-normal"
                        x-text="`${author.city ? `${author.city}, ` : ''}${author.province ? `${author.province}, ` : ''}${author.country?.name ? `${author.country?.name}, ` : ''}${author.postal_code ? `ID ${author.postal_code}` : ''}`">
                      </p>
                    </div>
                  </td>
                </tr>
              </template>
            </x-table>
          </div>
        </div>
      </x-modal>
    </div>
  </div>
</x-app-layout>
