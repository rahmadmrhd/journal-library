@props([
    'tabs' => [],
])
<script>
  window.tabs = @json($tabs)
</script>
<div
  class="sticky top-16 z-10 -mx-4 mb-4 border-b-2 border-gray-200 bg-gray-100 px-4 dark:border-gray-700 dark:bg-gray-900 sm:px-10 lg:px-12">
  <ul class="-mb-px flex flex-wrap text-center text-sm font-medium" id="tab">
    @foreach ($tabs as $tab)
      <li class="me-2">
        <a href="#{{ $tab['name'] }}" class="inline-block rounded-t-lg p-4"
          id="{{ $tab['name'] }}-tab">{{ $tab['title'] }}</a>
      </li>
    @endforeach
  </ul>
</div>
{{-- Tab Content --}}
<div id="tab-content" class="py-4 sm:px-6">
  {{ $slot }}
</div>

@vite(['resources/js/components/tabs-panel.js'])
