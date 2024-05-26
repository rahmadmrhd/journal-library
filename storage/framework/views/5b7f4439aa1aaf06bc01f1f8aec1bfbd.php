<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'id' => 'editorjs',
    'label',
    'description',
    'messages' => [],
    'disabled' => false,
    'variable' => 'editor',
    'name',
    'initValue',
    'required' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'id' => 'editorjs',
    'label',
    'description',
    'messages' => [],
    'disabled' => false,
    'variable' => 'editor',
    'name',
    'initValue',
    'required' => false,
]); ?>
<?php foreach (array_filter(([
    'id' => 'editorjs',
    'label',
    'description',
    'messages' => [],
    'disabled' => false,
    'variable' => 'editor',
    'name',
    'initValue',
    'required' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div <?php echo $attributes; ?> x-init="$nextTick(async () => {
    <?php echo $variable; ?> = await window.initEditor(<?php echo \Illuminate\Support\Js::from($id)->toHtml() ?>, <?php echo \Illuminate\Support\Js::from($disabled)->toHtml() ?>, <?php echo \Illuminate\Support\Js::from($initValue ?? null)->toHtml() ?>);
})">
  <?php $__env->startPush('head'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/text-editor.css']); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/components/text-editor.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-text-color-plugin@2.0.3/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script>
  <?php $__env->stopPush(); ?>
  <?php if(isset($label)): ?>
    <label <?php echo e(isset($id) ? 'for=' . $id : ''); ?>

      class="<?php if(!isset($description)): ?> mb-2 <?php endif; ?> block text-base font-extrabold text-gray-900 dark:text-white lg:text-lg"><?php echo e($label); ?>

      <?php if($required): ?>
        <span class="ms-1 text-red-700 dark:text-red-500">*</span>
      <?php endif; ?>
    </label>
  <?php endif; ?>
  <?php if(isset($description)): ?>
    <p class="mb-2 text-sm font-normal italic text-gray-900 dark:font-thin dark:text-gray-200"><?php echo e($description); ?></p>
  <?php endif; ?>
  <div
    class="<?php echo isset($messages) && count($messages) > 0
        ? 'border-red-500 bg-red-50'
        : 'placeholder-red-700 focus:border-red-500 focus:ring-red-500'; ?> rounded-md border border-gray-300 bg-gray-50 !p-0 dark:border-gray-600 dark:bg-gray-700">
    <?php if(isset($name)): ?>
      <input id="<?php echo $id; ?>-input" type="text" class="hidden" <?php echo $required ? 'required' : ''; ?>

        name="<?php echo $name; ?>">
    <?php endif; ?>
    <articel class="prose relative block max-w-none" id="<?php echo $id; ?>"></articel>
  </div>
  <?php if(isset($messages) && count($messages) > 0): ?>
    <ul class="space-y-0 text-sm text-red-600 dark:text-red-400" role="alert">
      <?php $__currentLoopData = (array) $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="text-red-700 dark:text-red-400"><?php echo e($message); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  <?php endif; ?>
</div>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/text-editor.blade.php ENDPATH**/ ?>