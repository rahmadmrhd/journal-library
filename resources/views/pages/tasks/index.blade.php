<x-app-layout :title="strtoupper($type) . ' TASKS'">
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
        <h1 class="text-xl font-extrabold text-gray-900 dark:text-white sm:text-2xl">{{ strtoupper($type) }} TASKS</h1>
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

      <x-table class="mt-6" :columns="[
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
              'label' => 'Status',
              'name' => 'status',
              'isSortable' => false,
          ],
          [
              'label' => 'Created at',
              'name' => 'created_at',
              'isSortable' => true,
          ],
      ]">
        @if ($tasks->total() > 10)
          @slot('pagination')
            {{ $tasks->links() }}
          @endslot
        @endif

        @foreach ($tasks as $task)
          <tr href="{{ route('tasks.show', $task) }}"
            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            <td class="font-xs min-w-44 w-[1%] px-6 py-2">{{ $task->manuscript->code ?? '-' }}</td>
            <th role="row" class="font-sm {{ $task->title ? 'font-bold' : 'italic font-normal' }} px-6 py-2">
              {{ $task->manuscript->title ?? '(No Title Entered)' }}
            </th>
            <td class="w-[1%] truncate px-6 py-2">
              @if ($task->processed_at == null)
                <x-badge type="warning" class="italic">Needs Review</x-badge>
              @else
                @switch($task->status)
                  @case('completed')
                    @if ($task->decision == 'accepted')
                      <x-badge type="success">Accepted</x-badge>
                    @else
                      <x-badge type="error">Rejected</x-badge>
                    @endif
                  @break

                  @case('in_progress')
                    <x-badge type="primary">In Progress</x-badge>
                  @break
                @endswitch
              @endif
            </td>
            <td class="w-[1%] px-6 py-2">{{ Carbon\Carbon::parse($task->created_at)->format('d M Y') }}</td>
          </tr>
        @endforeach
      </x-table>
    </div>
  </div>
</x-app-layout>
