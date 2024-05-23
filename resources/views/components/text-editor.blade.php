@props([
    'id' => 'editorjs',
    'label',
    'description',
    'messages' => [],
    'disabled' => false,
    'variable' => 'editor',
    'initValue',
])
<div x-data="{ {!! $variable !!}: null }" {!! $attributes !!} x-init="$nextTick(async () => {
    {!! $variable !!} = await window.initEditor(@js($id), @js($disabled), @js($initValue ?? null));
})">
  @push('head')
    @vite(['resources/css/text-editor.css'])
    @vite(['resources/js/components/text-editor.js'])
    <script src="https://cdn.jsdelivr.net/npm/editorjs-text-color-plugin@2.0.3/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script>
  @endpush
  @isset($label)
    <label {{ isset($id) ? 'for=' . $id : '' }}
      class="@if (!isset($description)) mb-2 @endif block text-base font-extrabold text-gray-900 dark:text-white lg:text-lg">{{ $label }}
      {{-- @if ($required)
        <span class="ms-1 text-red-700 dark:text-red-500">*</span>
      @endif --}}
    </label>
  @endisset
  @if (isset($description))
    <p class="mb-2 text-sm font-normal italic text-gray-900 dark:font-thin dark:text-gray-200">{{ $description }}</p>
  @endif
  <div
    class="{!! isset($messages) && count($messages) > 0
        ? 'border-red-500 bg-red-50'
        : 'placeholder-red-700 focus:border-red-500 focus:ring-red-500' !!} rounded-md border border-gray-300 bg-gray-50 !p-0 dark:border-gray-600 dark:bg-gray-700">

    <script>
      window.idEditor = @js($id)
    </script>
    <articel class="prose relative block max-w-none" id="{!! $id !!}"></articel>
  </div>
  @if (isset($messages) && count($messages) > 0)
    <ul class="space-y-0 text-sm text-red-600 dark:text-red-400" role="alert">
      @foreach ((array) $messages as $message)
        <li class="text-red-700 dark:text-red-400">{{ $message }}</li>
      @endforeach
    </ul>
  @endif
</div>
