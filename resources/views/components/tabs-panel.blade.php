@props([
    'tabs' => [],
    'withFragment' => false,
])
<div {{ $attributes->merge(['class' => 'bg-inherit']) }}>
  <div class="sticky top-0 z-10 mb-4 border-b-2 border-gray-200 bg-inherit dark:border-gray-700">
    <ul class="-mb-px flex overflow-x-auto bg-inherit text-center text-sm font-medium" x-data x-ref="tab"
      x-on:load.window="registerTabsPanel(@js($tabs), $refs.tab, @js($withFragment))">
      @foreach ($tabs as $tab)
        <li class="me-2 min-w-fit">
          <a href="#{{ $tab['name'] }}" class="inline-block rounded-t-lg p-4"
            id="{{ $tab['name'] }}-tab">{{ $tab['label'] }}</a>
        </li>
      @endforeach
    </ul>
  </div>
  {{-- Tab Content --}}
  <div id="tab-content">
    @foreach ($tabs as $tab)
      <div {{ ${$tab['name']}->attributes->merge(['class' => 'hidden']) }} id="{{ $tab['name'] . '-content' }}"
        role="tabpanel">
        {{ ${$tab['name']} }}
      </div>
    @endforeach
  </div>
</div>

@vite(['resources/js/components/tabs-panel.js'])
