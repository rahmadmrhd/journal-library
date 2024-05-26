@props(['id', 'colorToogle' => 'bg-red-700 peer-checked:bg-green-500', 'checked' => false, 'disabled' => false])


<label
  {{ $attributes->filter(fn($value, $key) => in_array($key, ['x-show', 'x-data', 'class']))->merge(['class' => $disabled ? '' : 'cursor-pointer']) }}
  {{ isset($id) ? 'id=' . $id : '' }} {{ $disabled ? 'disabled' : '' }}>
  <input type="checkbox" class="peer sr-only" {{ $checked ? 'checked' : '' }} {{ $disabled ? 'disabled' : '' }}
    {{ $attributes }}>
  <div
    class="{!! $colorToogle !!} relative h-5 w-9 rounded-full after:absolute after:start-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:border after:bg-white after:transition-all after:content-[''] peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none rtl:peer-checked:after:-translate-x-full dark:border-gray-600 dark:bg-red-700">
  </div>
</label>
