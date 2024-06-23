<form x-data="{ step: null }" x-ref="formChangeStep"
  x-on:change-step.window="step = $event.detail; setTimeout(() => $refs.formChangeStep.submit(), 100); " class="hidden"
  action=<?php echo e(route('manuscripts.change_step', ['subGate' => $manuscript->subGate->slug ?? $subGate->slug, 'manuscript' => $manuscript->id])); ?>"
  method="POST">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PATCH'); ?>
  <input type="hidden" name="step" x-bind:value="step">
</form>

<form id="manuscript-submit-form"
  action="<?php echo e(route('manuscripts.submit', ['subGate' => $manuscript->subGate->slug ?? $subGate->slug, 'manuscript' => $manuscript->id])); ?>"
  method="POST">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>
  <div class="space-y-4">
    <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($loop->iteration != 5): ?>
        <div
          class="card <?php echo e($step->status != 'success' ? '!border !border-red-300 !bg-red-50 !bg-opacity-30 !text-red-700 dark:!border-red-800 dark:!bg-gray-800 dark:!text-red-400' : ''); ?>">
          <div
            class="<?php echo e($step->status != 'success' ? 'border-red-300 dark:border-red-800' : 'border-gray-300  dark:border-gray-700'); ?> border-b pb-2">
            <button type="button" x-data x-on:click="$dispatch('change-step', <?php echo e($loop->iteration); ?>)"
              class="<?php echo e($step->status != 'success' ? 'hover:!text-red-500 dark:hover:!text-red-500' : 'hover:!text-blue-500 '); ?> text-left text-xl font-extrabold underline-offset-1 hover:underline lg:text-3xl">
              Step <?php echo e($loop->iteration); ?>: <?php echo e($step->name); ?>

            </button>
            <?php if(isset($step->description)): ?>
              <p class="mt-2 text-sm font-thin italic"><?php echo e($step->description); ?></p>
            <?php endif; ?>
          </div>
          <div class="mt-3">
            <?php switch($loop->iteration):
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</form>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/pages/manuscripts/form/review-submit.blade.php ENDPATH**/ ?>