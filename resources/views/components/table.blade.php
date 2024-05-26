@props(['columns', 'tableId', 'positionPage' => 'both'])

<div {{ $attributes->merge(['class' => 'relative block overflow-x-auto w-full']) }}>
  @isset($pagination)
    <div class="{{ $positionPage == 'top' || $positionPage == 'both' ? '' : 'hidden' }} w-full p-4">
      {{ $pagination }}
    </div>
  @endisset
  <div class="w-full">
    <table class="w-full text-left text-sm text-gray-900 rtl:text-right dark:text-gray-100"
      @isset($tableId)
    id="{{ $tableId }}"
  @endisset>
      <thead class="bg-gray-100 text-xs uppercase text-gray-900 dark:bg-gray-700 dark:text-gray-100">
        <tr>
          @foreach ($columns as $column)
            @if ($column['isSortable'])
              <th scope="col" class="{{ $column['class'] ?? '' }} truncate px-6 py-3">
                <a class="@if (request('sortBy') == $column['name']) text-blue-400 @endif flex items-center font-bold"
                  href="{{ request()->fullUrlWithQuery(['sortBy' => $column['name'], 'sort' => request('sort') == 'asc' ? 'desc' : 'asc']) }}
            ">
                  {{ $column['label'] }}
                  @if ($column['required'] ?? false)
                    <span class="ms-1 text-red-700 dark:text-red-500">*</span>
                  @endif
                  @if (request('sortBy') == $column['name'])
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                      class="@if (request('sort') == 'asc') rotate-180 @endif ml-1">
                      <path fill="currentColor"
                        d="M18.2 13.3L12 7l-6.2 6.3c-.2.2-.3.5-.3.7s.1.5.3.7c.2.2.4.3.7.3h11c.3 0 .5-.1.7-.3c.2-.2.3-.5.3-.7s-.1-.5-.3-.7" />
                    </svg>
                  @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48"
                      class="ml-1">
                      <path fill="currentColor" stroke="currentColor" stroke-linejoin="round" stroke-width="4"
                        d="m24 42l-9-13h18zm0-36l-9 13h18z" />
                    </svg>
                  @endif
                </a>
              </th>
            @else
              <th scope="col" class="{{ $column['class'] ?? '' }} px-6 py-3">
                <span>{{ $column['label'] }}</span>
                @if ($column['required'] ?? false)
                  <span class="ms-1 text-red-700 dark:text-red-500">*</span>
                @endif
              </th>
            @endif
          @endforeach
        </tr>
      </thead>
      <tbody>
        {{ $slot }}
      </tbody>
    </table>
  </div>

  @isset($pagination)
    <div class="{{ $positionPage == 'top' || $positionPage == 'both' ? '' : 'hidden' }} mt-4 w-full p-4">
      {{ $pagination }}
    </div>
  @endisset
  @vite(['resources/js/components/table.js'])
</div>
