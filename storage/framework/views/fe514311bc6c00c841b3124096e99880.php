<?php
  $error = request()->get('role_error');
?>
<div class="card">
  <div class="mb-6 mt-4">
    <div class="mb-3 flex items-center justify-between">
      <h1 class="text-3xl font-bold">Can't access this page</h1>
    </div>
    <div class="text-sm text-gray-600 dark:text-gray-400">
      <?php echo e($error['message']); ?>

    </div>

    <div class="mt-6 flex items-center justify-between">
      <form class="w-full" action="<?php echo e(route('role.update', $subGate->slug, absolute: false)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'select','name' => 'roleId','onchange' => 'this.form.submit()','label' => 'Recommended Role','class' => 'max-w-96 w-full','description' => 'Please select a role to continue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'select','name' => 'roleId','onchange' => 'this.form.submit()','label' => 'Recommended Role','class' => 'max-w-96 w-full','description' => 'Please select a role to continue']); ?>
          <option value="" disabled selected>-- Select Role --</option>
          <?php $__currentLoopData = $error['role_recomended']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

        <div class="mt-3 flex flex-col gap-x-6 gap-y-2 sm:flex-row">

          <?php if($error['url_back'] != url()->current()): ?>
            <a href="<?php echo e($error['url_back']); ?>"
              class="inline-flex items-center rounded-md border border-gray-400 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-900 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
              Back
            </a>
          <?php endif; ?>
        </div>
      </form>

    </div>
  </div>
</div>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/auth/role-error.blade.php ENDPATH**/ ?>