<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'tabs' => [],
    'withFragment' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'tabs' => [],
    'withFragment' => false,
]); ?>
<?php foreach (array_filter(([
    'tabs' => [],
    'withFragment' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div <?php echo e($attributes->merge(['class' => 'bg-inherit'])); ?>>
  <div class="sticky top-0 z-10 mb-4 border-b-2 border-gray-200 bg-inherit dark:border-gray-700">
    <ul class="-mb-px flex overflow-x-auto bg-inherit text-center text-sm font-medium" x-data x-ref="tab"
      x-on:load.window="registerTabsPanel(<?php echo \Illuminate\Support\Js::from($tabs)->toHtml() ?>, $refs.tab, <?php echo \Illuminate\Support\Js::from($withFragment)->toHtml() ?>)">
      <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="me-2 min-w-fit">
          <a href="#<?php echo e($tab['name']); ?>" class="inline-block rounded-t-lg p-4"
            id="<?php echo e($tab['name']); ?>-tab"><?php echo e($tab['label']); ?></a>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
  
  <div id="tab-content">
    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div <?php echo e(${$tab['name']}->attributes->merge(['class' => 'hidden'])); ?> id="<?php echo e($tab['name'] . '-content'); ?>"
        role="tabpanel">
        <?php echo e(${$tab['name']}); ?>

      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>

<?php echo app('Illuminate\Foundation\Vite')(['resources/js/components/tabs-panel.js']); ?>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/tabs-panel.blade.php ENDPATH**/ ?>