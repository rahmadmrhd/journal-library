<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['title']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['title']); ?>
<?php foreach (array_filter((['title']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<?php $__env->startSection('body'); ?>

  <body class="font-sans antialiased">
    <div
      class="absolute bottom-0 left-0 right-0 top-0 flex justify-center overflow-auto bg-gray-200 text-gray-900 dark:bg-gray-900 dark:text-gray-100 sm:items-center">
      <div class="relative max-h-full">
        <div
          class="relative min-h-full w-full self-center bg-white px-6 py-4 dark:bg-gray-800 sm:w-auto sm:rounded-xl sm:shadow-xl">
          <?php echo e($slot); ?>

        </div>
      </div>
    </div>
    <?php echo $__env->yieldPushContent('body'); ?>
  </body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/layouts/auth.blade.php ENDPATH**/ ?>