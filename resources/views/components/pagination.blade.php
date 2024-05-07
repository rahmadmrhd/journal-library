<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
    <div class="flex min-w-0 flex-1 items-center gap-8">
      <form class="flex items-center gap-1" method="GET">
        <label for="show" class="block text-sm font-medium text-gray-900 dark:text-white">Show</label>
        <select name="show" value="{{ $paginator->perPage() }}" onchange="showOnChanged(event)"
          class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-2 py-1 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
          <option value="10" {{ request('show') == 10 ? 'selected' : '' }}>10</option>
          <option value="20" {{ request('show') == 20 ? 'selected' : '' }}>20</option>
          <option value="50" {{ request('show') == 50 ? 'selected' : '' }}>50</option>
          <option value="100" {{ request('show') == 100 ? 'selected' : '' }}>100</option>
          <option value="all" {{ request('show') == 'all' ? 'selected' : '' }}>All</option>
          @if (request('show') != 'all' &&
                  request('show') != '' &&
                  request('show') != '10' &&
                  request('show') != '20' &&
                  request('show') != '50' &&
                  request('show') != '100')
            <option value="{{ $paginator->perPage() }}" selected disabled>{{ $paginator->perPage() }}</option>
          @endif
        </select>
      </form>
      <p class="text-sm leading-5 text-gray-700 dark:text-gray-400">
        {!! __('Showing') !!}
        @if ($paginator->firstItem())
          <span class="font-medium">{{ $paginator->firstItem() }}</span>
          {!! __('to') !!}
          <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
          {{ $paginator->count() }}
        @endif
        {!! __('of') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('results') !!}
      </p>
    </div>

    @if ($paginator->hasPages())
      <ul class="flex h-8 items-center -space-x-px text-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <span href="#" aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
            class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 dark:border-gray-600 dark:bg-gray-800">
            <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 1 1 5l4 4" />
            </svg>
          </span>
        @else
          <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}"
            class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:!text-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
            <span class="sr-only">Previous</span>
            <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 1 1 5l4 4" />
            </svg>
          </a>
        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
            <span aria-disabled="true">
              <span
                class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 dark:border-gray-600 dark:bg-gray-800">{{ $element }}</span>
            </span>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
                <span aria-current="page">
                  <span
                    class="relative z-10 -ml-px inline-flex h-8 cursor-default items-center border border-gray-300 bg-blue-700 px-3 text-sm font-medium leading-tight text-white dark:border-gray-600">{{ $page }}</span>
                </span>
              @else
                <a class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:!text-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
                  href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                  {{ $page }}
                </a>
              @endif
            @endforeach
          @endif
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}"
            class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:!text-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
            <span class="sr-only">Next</span>
            <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 9 4-4-4-4" />
            </svg>
          </a>
        @else
          <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
            class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 dark:border-gray-600 dark:bg-gray-800">
            <span class="sr-only">Next</span>
            <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 9 4-4-4-4" />
            </svg>
          </span>
        @endif
      </ul>
    @endif
  </div>
  @vite(['resources/js/pagination.js'])
</nav>
