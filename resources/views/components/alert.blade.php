@props(['status', 'messages', 'id' => 'alert-box', 'timeout' => 2000, 'closeable' => true])

@if (isset($messages) || $slot->isNotEmpty())
  <div id="{{ $id }}" {{ $attributes->merge(['class' => 'alert ' . ($status ?? '')]) }} role="alert"
    x-data="{ show: true }" x-show="show" x-transition.duration.500ms x-init="setTimeout(() => show = false, {{ $timeout }})">
    <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
      viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">Info</span>
    <div class="ms-3 text-sm font-medium">
      @isset($messages)
        @if (is_array($messages))
          @if (count($messages) > 1)
            <ul class="mt-1.5 list-inside list-disc">
              @foreach ($messages as $message)
                <li>{{ $message }}</li>
              @endforeach
            </ul>
          @else
            {{ $messages[0] }}
          @endif
        @else
          {{ $messages }}
        @endif
      @else
        {{ $slot }}
      @endisset
    </div>
    @if ($closeable)
      <button type="button"
        class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg p-1.5 focus:ring-2"
        data-dismiss-target="#{{ $id }}" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
      </button>
    @endif
  </div>
@endif
