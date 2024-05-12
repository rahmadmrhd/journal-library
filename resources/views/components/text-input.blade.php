@props([
    'id',
    'type',
    'placeholder',
    'name',
    'value' => '',
    'autofocus' => false,
    'required' => false,
    'autocomplete' => '',
    'status' => '',
    'messages' => '',
    'label',
    'class' => '',
    'rows' => 3,
    'options' => [
        [
            'label' => 'Admin',
            'value' => 'admin',
        ],
    ],
    'direction' => 'row', //row or col,
])

{{-- <input  {!!! $attributes-!!merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}> --}}


<div {!! $attributes->filter(fn($value, $key) => in_array($key, ['x-show', 'x-data'])) !!}
  @if ($type == 'password') x-data="{ showPassword: false, typeInput:'password', show_error: true }" @endif
  class="text-input {{ $class }} {{ $status }} mb-2">
  @isset($label)
    <label {{ isset($id) ? 'for=' . $id : '' }} class="label">{{ $label }}
      @if ($required)
        <span class="ms-1 text-red-700 dark:text-red-500">*</span>
      @endif
    </label>
  @endisset
  @if ($type == 'checkbox' || $type == 'radio')
    <ul
      class="sm:flex-{{ $direction }} {{ $direction == 'row' ? 'sm:divide-y-0 sm:divide-x' : 'sm:divide-y' }} flex w-full flex-col items-center divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white text-sm font-medium text-gray-900 dark:divide-gray-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
      @foreach ($options as $option)
        <li class="w-full">
          <div class="flex items-center px-3">
            <input {!! $attributes !!} {{ $option['required'] ?? false == 'required' ? 'required' : '' }}
              {!! $option['name'] ?? null ? 'name="' . $option['name'] . '"' : '' !!} id="{{ $type }}-{{ $name }}-{{ $option['value'] }}"
              type="{{ $type }}"
              {{ is_array($value) ? (collect($value)->contains($option['value']) ? 'checked' : '') : ($value == $option['value'] ? 'checked' : '') }}
              name="{{ $name }}" value="{{ $option['value'] }}"
              class="input {{ $type == 'checkbox' ? 'rounded' : 'rounded-full' }} h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">
            @if ($option['required'] ?? false)
              <span class="ms-1 text-red-700 dark:text-red-500">*</span>
            @endif
            <label for="{{ $type }}-{{ $name }}-{{ $option['value'] }}"
              class="ms-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $option['label'] }}</label>
          </div>
        </li>
      @endforeach
    </ul>
  @else
    <div class="inline-flex w-full gap-3">
      <div class="relative flex-1">
        @if (isset($icon))
          <div class="icon">
            {{ $icon }}
          </div>
        @endif
        @if ($type == 'select')
          <select class="input" {!! $attributes !!} {{ isset($id) ? 'id=' . $id : '' }}
            name="{{ $name ?? '' }}" {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }}>
            {{ $slot }}
          </select>
        @elseif ($type == 'textarea')
          <textarea class="input" {!! $attributes !!} {{ isset($id) ? 'id=' . $id : '' }}
            {{ $autocomplete ? 'autocomplete=' . $autocomplete : '' }} name="{{ $name ?? '' }}"
            {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }} placeholder="{{ $placeholder ?? '' }}"
            rows="{{ $rows }}">{{ $value }}</textarea>
        @elseif($type == 'custom')
          {{ $slot }}
        @else
          <input {!! $attributes !!}
            @if ($type == 'password') x-bind:type="showPassword ? 'text' : 'password'" 
    @else
    type="{{ $type }}" @endif
            {{ isset($id) ? 'id=' . $id : '' }} {{ $autocomplete ? 'autocomplete=' . $autocomplete : '' }}
            name="{{ $name ?? '' }}" value="{{ $value }}" {{ $autofocus ? 'autofocus' : '' }}
            {{ $required ? 'required' : '' }} placeholder="{{ $placeholder ?? '' }}"
            class="{{ isset($icon) ? 'pl-8' : '' }} {{ $type == 'password' ? 'pr-8' : '' }} input input-text">
          @if ($type == 'password')
            <div class="icon-eye" x-on:click="showPassword = !showPassword">
              <svg xmlns="http://www.w3.org/2000/svg" :class="showPassword ? 'hidden' : ''" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
              </svg><svg xmlns="http://www.w3.org/2000/svg" :class="showPassword ? '' : 'hidden'" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3zm-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7" />
              </svg>
            </div>
          @endif
        @endif
      </div>
      {{ $ext ?? '' }}
    </div>
  @endif
  @if (isset($status))
    <ul class="mt-2 space-y-0 text-sm text-red-600 dark:text-red-400" role="alert">
      @foreach ((array) $messages as $message)
        <li class="msg">{{ $message }}</li>
      @endforeach
    </ul>
  @endif
  {{-- @vite(['resources/js/text-input.js']) --}}
</div>
