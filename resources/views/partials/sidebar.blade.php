@php
  $sidebarItems = [
      'Dashboard' => [
          'route' => '/dashboard',
          'icon' => 'gmdi-dashboard',
      ],
      'Mahasiswa' => [
          'route' => '/admin/mahasiswa',
          'icon' => 'fas-users',
      ],
  ];
  // $sidebarItems = [
  //     'Home' => [
  //         'route' => '/',
  //         'icon' => 'fas-home',
  //     ],
  //     'Kanban' => [
  //         'route' => '/',
  //         'icon' => 'gmdi-dashboard',
  //         'items' => [
  //             'Dashboard' => '/',
  //         ],
  //     ],
  // ];
@endphp

<aside id="logo-sidebar"
  class="fixed left-0 top-0 z-[39] h-screen w-60 -translate-x-full border-r border-gray-200 bg-white pt-20 transition-transform dark:border-gray-700 dark:bg-gray-800 lg:translate-x-0"
  aria-label="Sidebar">
  <div class="h-full overflow-y-auto bg-white pb-4 dark:bg-gray-800">
    <ul class="font-medium" id="sidebar-menu">
      @foreach ($sidebarItems as $key => $item)
        <li>
          @if (isset($item['items']))
            <button type="button" class="sidebar-item-dropdown group" aria-controls="dropdown-{{ $key }}"
              data-collapse-toggle="dropdown-{{ $key }}">
              @svg($item['icon'])
              <span class="ms-3 flex-1 whitespace-nowrap text-left">{{ $key }}</span>
              <svg class="svg-dropdown" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 4 4 4-4" />
              </svg>
            </button>
            <ul id="dropdown-{{ $key }}" class="hidden space-y-2 py-2">
              @foreach ($item['items'] as $dropdownItem => $dropdownItemRoute)
                <li>
                  <a href="{{ $dropdownItemRoute }}" class="group">{{ $dropdownItem }}</a>
                </li>
              @endforeach
            </ul>
          @else
            <a href="{{ $item['route'] }}"
              class="sidebar-item {{ strtolower($key) == strtolower($title ?? '') ? 'active' : '' }} group">
              @svg($item['icon'])
              <span class="ms-3 flex-1 whitespace-nowrap">{{ $key }}</span>
            </a>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
</aside>
