<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'id',
    'type',
    'placeholder',
    'name',
    'value' => '',
    'autofocus' => false,
    'required' => false,
    'autocomplete' => '',
    'status' => '',
    'messages' => [],
    'label',
    'class' => '',
    'rows' => 3,
    'options' => [
        [
            'label' => 'Admin',
            'value' => 'admin',
        ],
    ],
    'direction' => 'row', //row or col,
    'description',
    'disabled' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'id',
    'type',
    'placeholder',
    'name',
    'value' => '',
    'autofocus' => false,
    'required' => false,
    'autocomplete' => '',
    'status' => '',
    'messages' => [],
    'label',
    'class' => '',
    'rows' => 3,
    'options' => [
        [
            'label' => 'Admin',
            'value' => 'admin',
        ],
    ],
    'direction' => 'row', //row or col,
    'description',
    'disabled' => false,
]); ?>
<?php foreach (array_filter(([
    'id',
    'type',
    'placeholder',
    'name',
    'value' => '',
    'autofocus' => false,
    'required' => false,
    'autocomplete' => '',
    'status' => '',
    'messages' => [],
    'label',
    'class' => '',
    'rows' => 3,
    'options' => [
        [
            'label' => 'Admin',
            'value' => 'admin',
        ],
    ],
    'direction' => 'row', //row or col,
    'description',
    'disabled' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>




<div <?php echo $attributes->filter(fn($value, $key) => in_array($key, ['x-show', 'x-data'])); ?>

  <?php if($type == 'password'): ?> x-data="{ showPassword: false, typeInput:'password', show_error: true }" <?php endif; ?>
  class="text-input <?php echo e($class); ?> <?php echo e($status); ?>">
  <?php if(isset($label)): ?>
    <label <?php echo e(isset($id) ? 'for=' . $id : ''); ?>

      class="label <?php if(!isset($description)): ?> mb-2 <?php endif; ?>"><?php echo e($label); ?>

      <?php if($required): ?>
        <span class="ms-1 text-red-700 dark:text-red-500">*</span>
      <?php endif; ?>
    </label>
  <?php endif; ?>
  <?php if(isset($description)): ?>
    <p class="description"><?php echo e($description); ?></p>
  <?php endif; ?>
  <?php if($type == 'checkbox' || $type == 'radio'): ?>
    <ul
      class="sm:flex-<?php echo e($direction); ?> <?php echo e($direction == 'row' ? 'sm:divide-y-0 sm:divide-x' : 'sm:divide-y'); ?> checkbox-input flex w-full flex-col items-center divide-y divide-gray-200 rounded-lg border border-gray-200 bg-gray-50 text-sm font-medium text-gray-900 dark:divide-gray-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
      <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="w-full">
          <div class="flex items-center px-3">
            <input <?php echo $option['attributes'] ?? $attributes; ?> <?php echo $disabled ? 'disabled' : ''; ?> <?php echo e($option['checked'] ?? false ? 'checked' : ''); ?>

              <?php echo e($option['required'] ?? $required ? 'required' : ''); ?> <?php echo $option['name'] ?? null ? 'name="' . $option['name'] . '"' : ''; ?>

              id="<?php echo e($type); ?>-<?php echo e($name); ?>-<?php echo e($loop->iteration); ?>" type="<?php echo e($type); ?>"
              <?php echo e(is_array($value) ? (collect($value)->contains($option['value']) ? 'checked' : '') : ($value == $option['value'] ? 'checked' : '')); ?>

              name="<?php echo e($name); ?>" value="<?php echo e($option['value']); ?>"
              class="input <?php echo e($type == 'checkbox' ? 'rounded' : 'rounded-full'); ?> <?php echo $disabled ? '' : 'cursor-pointer'; ?> h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">

            <label for="<?php echo e($type); ?>-<?php echo e($name); ?>-<?php echo e($loop->iteration); ?>"
              class="<?php echo $disabled ? '' : 'cursor-pointer'; ?> ms-2 w-full py-3 text-left text-sm font-medium text-gray-900 dark:text-gray-300">
              <?php if($option['required'] ?? false): ?>
                <span class="ms-1 text-base font-bold text-red-700 dark:text-red-500">*</span>
              <?php endif; ?><?php echo e($option['label']); ?>

            </label>
          </div>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  <?php else: ?>
    <div class="inline-flex w-full gap-3">
      <div class="relative flex-1">
        <?php if(isset($icon)): ?>
          <div class="icon">
            <?php echo e($icon); ?>

          </div>
        <?php endif; ?>
        <?php if($type == 'select'): ?>
          <select class="input" <?php echo $attributes; ?> <?php echo $disabled ? 'disabled' : ''; ?> <?php echo e(isset($id) ? 'id=' . $id : ''); ?>

            name="<?php echo e($name ?? ''); ?>" <?php echo e($autofocus ? 'autofocus' : ''); ?> <?php echo e($required ? 'required' : ''); ?>>
            <?php echo e($slot); ?>

          </select>
        <?php elseif($type == 'textarea'): ?>
          <textarea class="input" <?php echo $attributes; ?> <?php echo $disabled ? 'disabled' : ''; ?> <?php echo e(isset($id) ? 'id=' . $id : ''); ?>

            <?php echo e($autocomplete ? 'autocomplete=' . $autocomplete : ''); ?> name="<?php echo e($name ?? ''); ?>"
            <?php echo e($autofocus ? 'autofocus' : ''); ?> <?php echo e($required ? 'required' : ''); ?> placeholder="<?php echo e($placeholder ?? ''); ?>"
            rows="<?php echo e($rows); ?>"><?php echo e($value); ?></textarea>
        <?php elseif($type == 'custom'): ?>
          <?php echo e($slot); ?>

        <?php else: ?>
          <input <?php echo $attributes; ?> <?php echo $disabled ? 'disabled' : ''; ?>

            <?php if($type == 'password'): ?> x-bind:type="showPassword ? 'text' : 'password'" 
    <?php else: ?>
    type="<?php echo e($type); ?>" <?php endif; ?>
            <?php echo e(isset($id) ? 'id=' . $id : ''); ?> <?php echo e($autocomplete ? 'autocomplete=' . $autocomplete : ''); ?>

            name="<?php echo e($name ?? ''); ?>" value="<?php echo e($value); ?>" <?php echo e($autofocus ? 'autofocus' : ''); ?>

            <?php echo e($required ? 'required' : ''); ?> placeholder="<?php echo e($placeholder ?? ''); ?>"
            class="<?php echo e(isset($icon) ? 'pl-8' : ''); ?> <?php echo e($type == 'password' ? 'pr-8' : ''); ?> input input-text">
          <?php if($type == 'password'): ?>
            <div class="icon-eye" x-on:click="showPassword = !showPassword">
              <svg xmlns="http://www.w3.org/2000/svg" :class="showPassword ? 'hidden' : ''" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
              </svg><svg xmlns="http://www.w3.org/2000/svg" :class="showPassword ? '' : 'hidden'" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3zm-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7" />
              </svg>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <?php echo e($ext ?? ''); ?>

    </div>
  <?php endif; ?>
  <?php if(isset($status) && isset($messages) && count($messages) > 0): ?>
    <ul class="mt-1 space-y-0 text-sm text-red-600 dark:text-red-400" role="alert">
      <?php $__currentLoopData = (array) $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="msg"><?php echo e($message); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  <?php endif; ?>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/js/components/text-input.js']); ?>
</div>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/text-input.blade.php ENDPATH**/ ?>