<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['type', 'title', 'messages', 'id' => 'alert-box', 'timeout' => 2000, 'closeable' => true]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['type', 'title', 'messages', 'id' => 'alert-box', 'timeout' => 2000, 'closeable' => true]); ?>
<?php foreach (array_filter((['type', 'title', 'messages', 'id' => 'alert-box', 'timeout' => 2000, 'closeable' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if(isset($messages) || $slot->isNotEmpty()): ?>
  <div id="<?php echo e($id); ?>" <?php echo e($attributes->merge(['class' => 'alert ' . ($type ?? '')])); ?> role="alert"
    x-data="{ show: true }" x-show="show" x-transition.duration.500ms>
    <svg class="mt-[2px] h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
      viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only"><?php echo e($type ?? ''); ?></span>
    <div class="ms-3">
      <?php if(isset($title)): ?>
        <span class="block font-medium"><?php echo e($title); ?></span>
      <?php endif; ?>
      <?php if(isset($messages)): ?>
        <?php if(is_array($messages)): ?>
          <ul class="<?php if(isset($title)): ?> mt-1.5 <?php endif; ?> list-inside list-disc">
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="text-sm font-normal"><?php echo e($message); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        <?php else: ?>
          <span class="<?php if(isset($title)): ?> text-sm font-normal <?php else: ?> font-medium <?php endif; ?>">
            <?php echo e($messages); ?>

          </span>
        <?php endif; ?>
      <?php else: ?>
        <?php echo e($slot); ?>

      <?php endif; ?>
    </div>
    <?php if($closeable): ?>
      <button type="button" x-init="setTimeout(() => show = false, <?php echo e($timeout); ?>)"
        class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg p-1.5 focus:ring-2"
        data-dismiss-target="#<?php echo e($id); ?>" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
      </button>
    <?php endif; ?>
  </div>
<?php endif; ?>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/alert.blade.php ENDPATH**/ ?>