@php
  $currentRole = App\Models\Role::find(Auth::user()->current_role_id)->slug;
  $sidebarItems = [
      'Dashboard' => [
          'route' => 'dashboard',
          'route_pattern' => '/dashboard/*',
          'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
                    </svg>',
      ],
      'Papers' => [
          'route' => 'papers',
          'route_pattern' => '/papers/*',
          'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M20 5v14H4V5zm0-2H4c-1.11 0-2 .89-2 2v14c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V5c0-1.11-.89-2-2-2m-2 12H6v2h12zm-8-8H6v6h4zm2 2h6V7h-6zm6 2h-6v2h6z" />
                    </svg>',
      ],
      'Users' => [
          'route' => 'users',
          'route_pattern' => '/users/*',
          'role' => 'admin',
          'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M12 5.5A3.5 3.5 0 0 1 15.5 9a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8.5 9A3.5 3.5 0 0 1 12 5.5M5 8c.56 0 1.08.15 1.53.42c-.15 1.43.27 2.85 1.13 3.96C7.16 13.34 6.16 14 5 14a3 3 0 0 1-3-3a3 3 0 0 1 3-3m14 0a3 3 0 0 1 3 3a3 3 0 0 1-3 3c-1.16 0-2.16-.66-2.66-1.62a5.54 5.54 0 0 0 1.13-3.96c.45-.27.97-.42 1.53-.42M5.5 18.25c0-2.07 2.91-3.75 6.5-3.75s6.5 1.68 6.5 3.75V20h-13zM0 20v-1.5c0-1.39 1.89-2.56 4.45-2.9c-.59.68-.95 1.62-.95 2.65V20zm24 0h-3.5v-1.75c0-1.03-.36-1.97-.95-2.65c2.56.34 4.45 1.51 4.45 2.9z" />
                    </svg>',
      ],
  ];
@endphp

<aside id="logo-sidebar"
  class="fixed left-0 top-0 z-[39] h-screen w-60 -translate-x-full border-r border-gray-200 bg-white pt-20 transition-transform dark:border-gray-700 dark:bg-gray-800 lg:translate-x-0"
  aria-label="Sidebar">
  <div class="h-full overflow-y-auto bg-white pb-4 dark:bg-gray-800">
    <ul class="font-medium" id="sidebar-menu">
      @foreach ($sidebarItems as $key => $item)
        @if (!isset($item['role']) || $currentRole == $item['role'])
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
              <a href="{{ $item['route'] }}" x-data="{ active: false }" x-init="active = checkUrlPath('{!! $item['route_pattern'] !!}')" class="sidebar-item group"
                x-bind:class="active && 'active'">
                {!! $item['icon'] !!}
                <span class="ms-3 flex-1 whitespace-nowrap">{{ $key }}</span>
              </a>
            @endif
          </li>
        @endif
      @endforeach
    </ul>
  </div>
</aside>
