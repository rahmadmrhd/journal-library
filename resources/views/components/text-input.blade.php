@props([
    'disabled' => false,
    'id',
    'type',
    'placeholder',
    'name',
    'value' => '',
    'autofocus' => false,
    'required' => false,
    'status' => '',
    'messages',
    'label',
    'class' => '',
    'rows' => 3,
])

{{-- <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}> --}}

<div @if ($type == 'password') x-data="{ showPassword: false, typeInput:'password' }" @endif
  class="text-input {{ $status }} {{ $class }} mb-2">
  <label for="{{ $id }}">{{ $label }}
    @if ($required)
      <span class="ms-1 text-red-700 dark:text-red-500">*</span>
    @endif
  </label>
  <div class="inline-flex w-full gap-3">
    <div class="relative flex-1">
      @if (isset($icon))
        <div class="icon">
          {{ $icon }}
        </div>
      @endif
      @if ($type != 'textarea' && $type != 'select')
        <input {{ $attributes }}
          @if ($type == 'password') x-bind:type="showPassword ? 'text' : 'password'" 
    @else
    type="{{ $type }}" @endif
          id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} name="{{ $name ?? '' }}"
          value="{{ $value }}" {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }}
          placeholder="{{ $placeholder ?? '' }}"
          class="{{ isset($icon) ? 'pl-8' : '' }} {{ $type == 'password' ? 'pr-8' : '' }}">
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
      @elseif ($type == 'textarea')
        <textarea {{ $attributes }} id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} name="{{ $name ?? '' }}"
          {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }} placeholder="{{ $placeholder ?? '' }}"
          rows="{{ $rows }}">{{ $value }}</textarea>
      @else
        <select {{ $attributes }} id="{{ $id }}" {{ $disabled ? 'disabled' : '' }}
          name="{{ $name ?? '' }}" {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }}>
          {{ $options }}
        </select>
      @endif
    </div>
    {{ $ext ?? '' }}
  </div>
  @if (isset($status))
    <ul class="mt-2 space-y-0 text-sm text-red-600 dark:text-red-400">
      @foreach ((array) $messages as $message)
        <li>{{ $message }}</li>
      @endforeach
    </ul>
  @endif
</div>

