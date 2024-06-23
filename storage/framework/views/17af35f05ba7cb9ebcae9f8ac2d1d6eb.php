<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['sizeHideSidebar' => 'lg', 'subGate']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['sizeHideSidebar' => 'lg', 'subGate']); ?>
<?php foreach (array_filter((['sizeHideSidebar' => 'lg', 'subGate']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php
  $sidebarItems = [
      'Dashboard' => [
          'route' => '/dashboard',
          'route_pattern' => '/dashboard/*',
          'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
                    </svg>',
      ],
      'Manuscript' => [
          'route' => '/manuscripts',
          'route_pattern' => '/manuscripts/*',
          'role' => 'author',
          'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M20 5v14H4V5zm0-2H4c-1.11 0-2 .89-2 2v14c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V5c0-1.11-.89-2-2-2m-2 12H6v2h12zm-8-8H6v6h4zm2 2h6V7h-6zm6 2h-6v2h6z" />
                    </svg>',
      ],
      'Task' => [
          'route_pattern' => '/tasks/*',
          'icon' => '<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24">
                      <path fill="currentColor" d="m10.95 18l5.65-5.65l-1.45-1.45l-4.225 4.225l-2.1-2.1L7.4 14.45zM6 22q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h8l6 6v12q0 .825-.587 1.413T18 22zm7-13h5l-5-5z" />
                    </svg>',
          'items' => [
              'Invitation' => [
                  'route' => '/tasks/invitation',
                  'route_pattern' => '/tasks/invitation/*',
                  'role' => ['academic-editor', 'reviewer'],
                  'indicator' => Auth::user()
                      ->invitations()
                      ->where(function ($query) {
                          $query->where('task_invitations.status', 'invited');
                          $query->orWhereRaw(
                              'DATEDIFF(`task_invitations`.`invited_at`, NOW()) > `task_invitations`.`deadline`',
                          );
                      })
                      ->where('task_invitations.role_id', auth()->user()->currentRole->id)
                      ->count(),
              ],
              'Assignment' => [
                  'route' => '/tasks/assignment',
                  'route_pattern' => '/tasks/assignment/*',
                  'indicator' => \App\Models\Manuscript\Task::where(function ($query) {
                      $query->where('status', 'in_progress');
                      $query->orWhere('status', 'pending');
                  })
                      ->where('user_id', auth()->user()->id)
                      ->where('processed_at', null)
                      ->where('sub_gate_id', $subGate->id)
                      ->where('role_id', auth()->user()->currentRole->id)
                      ->count(),
              ],
              'In Progress' => [
                  'route' => '/tasks/in-progress',
                  'route_pattern' => '/tasks/in-progress/*',
                  'role' => ['academic-editor', 'editor-in-chief'],
              ],
              'Finalization' => [
                  'route' => '/tasks/finalization',
                  'route_pattern' => '/tasks/finalization/*',
                  'role' => ['editor-in-chief'],
              ],
              'History' => [
                  'route' => '/tasks/history',
                  'route_pattern' => '/tasks/history/*',
              ],
          ],
          'role' => ['editor-assistant', 'editor-in-chief', 'academic-editor', 'reviewer'],
      ],
      'Forms' => [
          'route' => '/forms',
          'route_pattern' => '/forms/*',
          'role' => 'admin',
          'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2M7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7zm10 2h-6v-2h6zm0-4h-6v-2h6zm0-4h-6V7h6z" />
                    </svg>',
      ],
      'Users' => [
          'route' => '/users',
          'route_pattern' => '/users/*',
          'role' => 'admin',
          'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M12 5.5A3.5 3.5 0 0 1 15.5 9a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8.5 9A3.5 3.5 0 0 1 12 5.5M5 8c.56 0 1.08.15 1.53.42c-.15 1.43.27 2.85 1.13 3.96C7.16 13.34 6.16 14 5 14a3 3 0 0 1-3-3a3 3 0 0 1 3-3m14 0a3 3 0 0 1 3 3a3 3 0 0 1-3 3c-1.16 0-2.16-.66-2.66-1.62a5.54 5.54 0 0 0 1.13-3.96c.45-.27.97-.42 1.53-.42M5.5 18.25c0-2.07 2.91-3.75 6.5-3.75s6.5 1.68 6.5 3.75V20h-13zM0 20v-1.5c0-1.39 1.89-2.56 4.45-2.9c-.59.68-.95 1.62-.95 2.65V20zm24 0h-3.5v-1.75c0-1.03-.36-1.97-.95-2.65c2.56.34 4.45 1.51 4.45 2.9z" />
                    </svg>',
      ],
  ];

  $currentRole = Auth::user()->currentRole->slug;
  $sizeList = [
      'sm' => 'sm:translate-x-0',
      'md' => 'md:translate-x-0',
      'lg' => 'lg:translate-x-0',
      'xl' => 'xl:translate-x-0',
      '2xl' => '2xl:translate-x-0',
  ][$sizeHideSidebar];
?>

<aside id="logo-sidebar"
  class="<?php echo e($sizeList); ?> fixed left-0 top-0 z-[39] h-screen w-60 -translate-x-full border-r border-gray-200 bg-white pt-20 transition-transform dark:border-gray-700 dark:bg-gray-800"
  aria-label="Sidebar">
  <div class="h-full overflow-y-auto bg-white pb-4 dark:bg-gray-800">
    <ul class="space-y-2 font-medium" id="sidebar-menu">
      <?php $__currentLoopData = $sidebarItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(
            !isset($item['role']) ||
                (is_array($item['role']) ? in_array($currentRole, $item['role']) : $currentRole == $item['role'])): ?>
          <li x-data="{
              open: checkUrlPath('<?php echo '/' . $subGate->slug . $item['route_pattern']; ?>')
          }">
            <?php if(isset($item['items'])): ?>
              <button type="button" x-data="{ active: false }" x-init="active = checkUrlPath('<?php echo '/' . $subGate->slug . $item['route_pattern']; ?>')" x-bind:class="active && 'active'"
                class="sidebar-item-dropdown group relative" x-on:click="open = !open"
                x-bind:class="open && 'shadow-md'">
                <?php echo $item['icon']; ?>

                <span class="ms-3 flex-1 whitespace-nowrap text-left"><?php echo e($key); ?></span>
                <svg class="svg-dropdown" x-bind:class="!open && 'rotate-90'" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
                </svg>
                <?php if(collect($item['items'])->some(function ($item) {
                        if (!isset($item['indicator'])) {
                            return false;
                        }
                        if ($item['indicator'] instanceof \Illuminate\Database\Eloquent\Builder) {
                            return ($item['indicator']?->count() ?? 0) > 0;
                        }
                        return $item['indicator'] > 0;
                    })): ?>
                  <div
                    class="absolute start-3 top-1 inline-flex h-3 w-3 items-center justify-center rounded-full border-2 border-white bg-red-500 text-[10px] font-thin text-white dark:border-gray-800 dark:bg-rose-600"
                    x-bind:class="active && 'dark:!border-gray-700'">
                  </div>
                <?php endif; ?>
              </button>
              <ul x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="mb-2 divide-y divide-gray-200 border-b border-t-2 border-gray-200 bg-gray-50 dark:divide-gray-700 dark:border-gray-700 dark:bg-slate-900">
                <?php $__currentLoopData = $item['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dropdownItem => $dropdownItemDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(
                      !isset($dropdownItemDetails['role']) ||
                          (is_array($dropdownItemDetails['role'])
                              ? in_array($currentRole, $dropdownItemDetails['role'])
                              : $currentRole == $dropdownItemDetails['role'])): ?>
                    <li>
                      <a href="<?php echo e('/' . $subGate->slug . $dropdownItemDetails['route']); ?>" class="group relative"
                        x-data="{ active: false }" x-init="active = checkUrlPath('<?php echo '/' . $subGate->slug . $dropdownItemDetails['route_pattern']; ?>')"
                        x-bind:class="active && 'active'"><?php echo e($dropdownItem); ?>

                        <?php
                          $indicator = 0;
                          if (!isset($dropdownItemDetails['indicator'])) {
                              $indicator = 0;
                          } elseif (
                              $dropdownItemDetails['indicator'] instanceof \Illuminate\Database\Eloquent\Builder
                          ) {
                              // $indicator = $dropdownItemDetails['indicator']?->count() ?? 0;
                          } else {
                              $indicator = $dropdownItemDetails['indicator'];
                          }
                        ?>

                        <?php if($indicator > 0): ?>
                          <div
                            class="inline-flex h-4 w-4 items-center justify-center rounded-full border-none bg-red-500 text-xs font-bold text-white dark:bg-rose-600">
                            <?php echo e($indicator); ?>

                          </div>
                        <?php endif; ?>
                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            <?php else: ?>
              <div class="relative" x-data="{ active: false }">
                <a href="<?php echo e('/' . $subGate->slug . $item['route']); ?>" x-init="active = checkUrlPath('<?php echo '/' . $subGate->slug . $item['route_pattern']; ?>')"
                  class="sidebar-item group relative" x-bind:class="active && 'active'">
                  <?php echo $item['icon']; ?>

                  <span class="ms-3 flex-1 whitespace-nowrap"><?php echo e($key); ?></span>
                </a>
                <?php
                  $indicator = 0;
                  if (!isset($item['indicator'])) {
                      $indicator = 0;
                  } elseif ($item['indicator'] instanceof \Illuminate\Database\Eloquent\Builder) {
                      // $indicator = $item['indicator']?->count() ?? 0;
                  } else {
                      $indicator = $item['indicator'];
                  }
                ?>
                <?php if($indicator > 0): ?>
                  <div
                    class="dark:border-gray-$ite00 absolute start-2.5 top-1 inline-flex h-4 w-4 items-center justify-center rounded-full border-2 border-white bg-red-500 text-[10px] font-thin text-white dark:bg-rose-600"
                    x-bind:class="active && 'dark:!border-gray-700'">
                    <?php echo e($indicator); ?>

                  </div>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </li>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
</aside>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/sidebar.blade.php ENDPATH**/ ?>