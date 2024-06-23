<?php if (isset($component)) { $__componentOriginal5aa59089e7535ae5a2a66db263215a8c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5aa59089e7535ae5a2a66db263215a8c = $attributes; } ?>
<?php $component = App\View\Components\SubmissionLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('submission-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SubmissionLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['manuscript' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($manuscript ?? null),'steps' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($steps),'alert' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($alert ?? null),'subGate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subGate)]); ?>
  <?php if(($manuscript->current_step ?? 1) == 5): ?>
    <?php echo $__env->make('pages.manuscripts.form.review-submit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php else: ?>
    <?php
      $currentStep = $steps[($manuscript->current_step ?? 1) - 1];
    ?>
    <div class="card">
      <div class="border-b border-gray-300 pb-2 dark:border-gray-700">
        <h3 class="text-left text-xl font-extrabold lg:text-3xl">
          Step <?php echo e($manuscript->current_step ?? 1); ?>: <?php echo e($currentStep->name); ?>

        </h3>
        <?php if(isset($currentStep->description)): ?>
          <p class="mt-2 text-sm font-thin italic"><?php echo e($currentStep->description); ?></p>
        <?php endif; ?>
      </div>
      <div class="mt-3">
        <?php switch($manuscript->current_step ?? 1):
          case (1): ?>
            <?php echo $__env->make('pages.manuscripts.form.upload-file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php break; ?>

          <?php case (2): ?>
            <?php echo $__env->make('pages.manuscripts.form.basic-information', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php break; ?>

          <?php case (3): ?>
            <?php echo $__env->make('pages.manuscripts.form.authors-institutions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php break; ?>

          <?php case (4): ?>
            <?php echo $__env->make('pages.manuscripts.form.details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php break; ?>

          <?php default: ?>
            <h3>Out Of Range</h3>
        <?php endswitch; ?>
      </div>
    </div>
  <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5aa59089e7535ae5a2a66db263215a8c)): ?>
<?php $attributes = $__attributesOriginal5aa59089e7535ae5a2a66db263215a8c; ?>
<?php unset($__attributesOriginal5aa59089e7535ae5a2a66db263215a8c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5aa59089e7535ae5a2a66db263215a8c)): ?>
<?php $component = $__componentOriginal5aa59089e7535ae5a2a66db263215a8c; ?>
<?php unset($__componentOriginal5aa59089e7535ae5a2a66db263215a8c); ?>
<?php endif; ?>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/pages/manuscripts/form.blade.php ENDPATH**/ ?>