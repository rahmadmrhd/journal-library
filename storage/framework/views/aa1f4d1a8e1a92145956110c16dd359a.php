<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'show' => false, 'maxWidth']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'show' => false, 'maxWidth']); ?>
<?php foreach (array_filter((['name', 'show' => false, 'maxWidth']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
  if (isset($maxWidth)) {
      $maxWidth = [
          'sm' => 'sm:max-w-sm',
          'md' => 'sm:max-w-md',
          'lg' => 'sm:max-w-lg',
          'xl' => 'sm:max-w-xl',
          '2xl' => 'sm:max-w-2xl',
          'full' => 'sm:max-w-full',
      ][$maxWidth];
  }
?>

<div x-data="{
    show: <?php echo \Illuminate\Support\Js::from($show)->toHtml() ?>,
    focusables() {
        // All focusable element types...
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)]
            // All non-disabled elements...
            .filter(el => !el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
}" x-init="$watch('show', value => {
    if (value) {
        document.body.classList.add('overflow-y-hidden');
        <?php echo e($attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : ''); ?>

    } else {
        document.body.classList.remove('overflow-y-hidden');
    }
})"
  x-on:open-modal.window="$event.detail == '<?php echo e($name); ?>' ? show = true : null"
  x-on:close-modal.window="$event.detail == '<?php echo e($name); ?>' ? show = false : null" x-on:close.stop="show = false"
  x-on:keydown.escape.window="show = false" x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
  x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="show"
  class="fixed inset-0 bottom-0 left-0 right-0 top-0 z-50 flex h-full max-h-full items-center overflow-y-auto px-0 py-0 sm:justify-center sm:px-4"
  style="display: <?php echo e($show ? 'block' : 'none'); ?>;">
  <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900"></div>
  </div>

  <div x-show="show"
    <?php echo e($attributes->merge(['class' => 'relative max-h-full w-full max-w-full overflow-y-auto bg-white shadow dark:bg-gray-800 sm:w-auto sm:rounded-lg ' . (isset($maxWidth) ? $maxWidth : ' sm:max-w-[90%] lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl')])); ?>

    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
    <?php echo e($slot); ?>

  </div>
</div>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/modal.blade.php ENDPATH**/ ?>