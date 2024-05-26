<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['type', 'useIcon' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['type', 'useIcon' => false]); ?>
<?php foreach (array_filter((['type', 'useIcon' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<span <?php echo e($attributes->merge(['class' => 'badge ' . ($type ?? '')])); ?>>
  <?php if($useIcon): ?>
    <?php echo $icon ?? '<span class="badge-point"></span>'; ?>

  <?php endif; ?>
  <?php echo e($slot); ?>

</span>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/badge.blade.php ENDPATH**/ ?>