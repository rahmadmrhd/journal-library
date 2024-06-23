<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['columns', 'tableId', 'positionPage' => 'both', 'sortable' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['columns', 'tableId', 'positionPage' => 'both', 'sortable' => false]); ?>
<?php foreach (array_filter((['columns', 'tableId', 'positionPage' => 'both', 'sortable' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div <?php echo e($attributes->merge(['class' => 'relative block overflow-x-auto w-full h-full'])); ?>>
  <?php if(isset($pagination)): ?>
    <div class="<?php echo e($positionPage == 'top' || $positionPage == 'both' ? '' : 'hidden'); ?> w-full p-4">
      <?php echo e($pagination); ?>

    </div>
  <?php endif; ?>
  <div class="relative w-full">
    <table class="w-full text-left text-sm text-gray-900 rtl:text-right dark:text-gray-100"
      <?php if(isset($tableId)): ?>
    id="<?php echo e($tableId); ?>"
  <?php endif; ?>>
      <thead class="bg-gray-100 text-xs uppercase text-gray-900 dark:bg-gray-700 dark:text-gray-100">
        <tr>
          <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($column['isSortable']): ?>
              <th scope="col" class="<?php echo e($column['class'] ?? ''); ?> truncate px-6 py-3">
                <a class="<?php if(request('sortBy') == $column['name']): ?> text-blue-600 dark:text-blue-400 <?php endif; ?> flex items-center font-bold"
                  href="<?php echo e(request()->fullUrlWithQuery(['sortBy' => $column['name'], 'sort' => request('sort') == 'asc' ? 'desc' : 'asc'])); ?>

            ">
                  <?php echo e($column['label']); ?>

                  <?php if($column['required'] ?? false): ?>
                    <span class="ms-1 text-red-700 dark:text-red-500">*</span>
                  <?php endif; ?>
                  <?php if(request('sortBy') == $column['name']): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                      class="<?php if(request('sort') == 'asc'): ?> rotate-180 <?php endif; ?> ml-1">
                      <path fill="currentColor"
                        d="M18.2 13.3L12 7l-6.2 6.3c-.2.2-.3.5-.3.7s.1.5.3.7c.2.2.4.3.7.3h11c.3 0 .5-.1.7-.3c.2-.2.3-.5.3-.7s-.1-.5-.3-.7" />
                    </svg>
                  <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48"
                      class="ml-1">
                      <path fill="currentColor" stroke="currentColor" stroke-linejoin="round" stroke-width="4"
                        d="m24 42l-9-13h18zm0-36l-9 13h18z" />
                    </svg>
                  <?php endif; ?>
                </a>
              </th>
            <?php else: ?>
              <th scope="col" class="<?php echo e($column['class'] ?? ''); ?> px-6 py-3">
                <span><?php echo e($column['label']); ?></span>
                <?php if($column['required'] ?? false): ?>
                  <span class="ms-1 text-red-700 dark:text-red-500">*</span>
                <?php endif; ?>
              </th>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
      </thead>
      <?php if(isset($tbody)): ?>
        <tbody <?php echo e($tbody->attributes); ?>>
          <?php echo e($tbody); ?>

        </tbody>
      <?php else: ?>
        <tbody <?php echo $sortable ? 'x-sort' : ''; ?>>
          <?php echo e($slot); ?>

        </tbody>
      <?php endif; ?>
    </table>
  </div>

  <?php if(isset($pagination)): ?>
    <div class="<?php echo e($positionPage == 'top' || $positionPage == 'both' ? '' : 'hidden'); ?> mt-4 w-full p-4">
      <?php echo e($pagination); ?>

    </div>
  <?php endif; ?>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/js/components/table.js']); ?>
</div>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/table.blade.php ENDPATH**/ ?>