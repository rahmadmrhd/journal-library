<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['steps', 'manuscript', 'alert', 'subGate']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['steps', 'manuscript', 'alert', 'subGate']); ?>
<?php foreach (array_filter((['steps', 'manuscript', 'alert', 'subGate']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php
  $currentStepIndex = $manuscript->current_step ?? 1;
  $currentStep = $steps[$currentStepIndex - 1];
?>

<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sizeHideSidebar' => '2xl','title' => 'Submit Manuscript','subGate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subGate),'class' => 'px-4 pt-4']); ?>
  <input id="manuscript-id" type="hidden" name="id" value="<?php echo e($manuscript->id ?? ''); ?>" form="manuscript-form">
  <div class="fixed bottom-4 top-20 hidden border-r border-gray-300 !pr-4 dark:border-gray-800 md:block">
    <div class="card flex max-h-full w-72 flex-col !p-4">
      <h3 class="mb-2 border-b border-gray-200 pb-2 text-xl font-bold dark:border-gray-700">Submission</h3>
      <ol class="h-full space-y-2 overflow-y-auto">
        <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <form x-data method="POST" <?php echo $currentStepIndex == $loop->iteration
              ? 'x-on:submit.prevent'
              : 'x-on:submit.prevent="changeStep(event, $dispatch)"'; ?>

            action=<?php echo e(route('manuscripts.change_step', ['subGate' => $manuscript->subGate->slug ?? $subGate->slug, 'manuscript' => $manuscript->id ?? ''])); ?>>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <input type="hidden" name="step" value="<?php echo e($loop->iteration); ?>">
            <button type="submit"
              <?php if($currentStepIndex == $loop->iteration): ?> class="w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-2 text-blue-700 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400" 
              <?php else: ?>
              <?php switch($step->status??null):
            case ('success'): ?>
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            <?php break; ?>
            <?php case ('error'): ?>
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            <?php break; ?>
            <?php default: ?>
              class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            <?php endswitch; ?> <?php endif; ?>
              role="alert">
              <div class="flex w-full items-center justify-between gap-x-6">
                <span class="sr-only"><?php echo e($step->name); ?></span>
                <div class="flex w-full flex-1 justify-start gap-x-1 text-sm font-normal">
                  <h3 class="truncate">Step <?php echo e($loop->iteration); ?>: </h3>
                  <h3 class="text-wrap flex-1 text-left"><?php echo e($step->name); ?></h3>
                </div>
                <?php if($currentStepIndex == $loop->iteration): ?>
                  <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                <?php else: ?>
                  <?php switch($step->status??null):
                    case ('success'): ?>
                      <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5.917 5.724 10.5 15 1.5" />
                      </svg>
                    <?php break; ?>

                    <?php case ('error'): ?>
                      <svg class="-mr-1 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18 17.94 6M18 18 6.06 6" />
                      </svg>
                    <?php break; ?>

                    <?php default: ?>
                  <?php endswitch; ?>
                <?php endif; ?>
              </div>
            </button>
          </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ol>
    </div>
  </div>
  <div
    class="sticky top-0 z-20 mb-2 block w-full border-b border-gray-300 bg-gray-100 pb-2 pt-4 dark:border-gray-800 dark:bg-gray-900 md:hidden">
    <button id="dropdownStepSubmissionButton" data-dropdown-toggle="dropdownStepSubmission"
      data-dropdown-placement="bottom" data-dropdown-trigger="click" type="button"
      <?php switch($currentStep->status??null):
            case ('success'): ?>
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            <?php break; ?>
            <?php case ('error'): ?>
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            <?php break; ?>
            <?php default: ?>
              class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            <?php endswitch; ?>
      role="alert">
      <div class="flex w-full items-center justify-between gap-x-6">
        <span class="sr-only"><?php echo e($currentStep->name); ?></span>
        <?php switch($currentStep->status??null):
          case ('success'): ?>
            <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 5.917 5.724 10.5 15 1.5" />
            </svg>
          <?php break; ?>

          <?php case ('error'): ?>
            <svg class="-mr-1 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
          <?php break; ?>
        <?php endswitch; ?>

        <div class="flex w-full flex-1 justify-start gap-x-1 text-sm font-normal">
          <h3 class="truncate">Step <?php echo e($currentStepIndex); ?>: </h3>
          <h3 class="text-wrap flex-1 text-left"><?php echo e($currentStep->name); ?></h3>
        </div>

        <svg class="ms-3 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 4 4 4-4" />
        </svg>
      </div>
    </button>
    
    <div id="dropdownStepSubmission" class="hidden w-full rounded-lg">
      <ol class="card space-y-2 overflow-y-auto p-4" aria-labelledby="dropdownStepSubmissionButton">
        <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <form x-data method="POST" <?php echo $currentStepIndex == $loop->iteration
              ? 'x-on:submit.prevent'
              : 'x-on:submit.prevent="changeStep(event, $dispatch)"'; ?>

            action=<?php echo e(route('manuscripts.change_step', ['subGate' => $manuscript->subGate->slug ?? $subGate->slug, 'manuscript' => $manuscript->id ?? ''])); ?>>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <input type="hidden" name="step" value="<?php echo e($loop->iteration); ?>">
            <button type="submit"
              <?php if($currentStepIndex == $loop->iteration): ?> class="w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-2 text-blue-700 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400"
            <?php else: ?>
              <?php switch($step->status??null):
            case ('success'): ?>
              class="w-full rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-green-700 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            <?php break; ?>
            <?php case ('error'): ?>
              class="w-full rounded-lg border border-red-300 bg-red-100 px-4 py-2 text-red-700 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            <?php break; ?>
            <?php default: ?>
              class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
            <?php endswitch; ?> <?php endif; ?>
              role="alert">
              <div class="flex w-full items-center justify-between gap-x-6">
                <span class="sr-only"><?php echo e($step->name); ?></span>
                <div class="flex w-full flex-1 justify-start gap-x-1 text-sm font-normal">
                  <h3 class="truncate">Step <?php echo e($loop->iteration); ?>: </h3>
                  <h3 class="text-wrap flex-1 text-left"><?php echo e($step->name); ?></h3>
                </div>
                <?php if($currentStepIndex == $loop->iteration): ?>
                  <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                <?php else: ?>
                  <?php switch($step->status??null):
                    case ('success'): ?>
                      <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5.917 5.724 10.5 15 1.5" />
                      </svg>
                    <?php break; ?>

                    <?php case ('error'): ?>
                      <svg class="-mr-1 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18 17.94 6M18 18 6.06 6" />
                      </svg>
                    <?php break; ?>

                    <?php default: ?>
                  <?php endswitch; ?>
                <?php endif; ?>
              </div>
            </button>
          </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ol>
    </div>

  </div>
  <main class="md:ml-80">
    <div id=alert-group></div>
    <?php if($alert): ?>
      <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['messages' => $alert['messages'],'type' => $alert['type'],'title' => $alert['title'],'closeable' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($alert['messages']),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($alert['type']),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($alert['title']),'closeable' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
    <?php elseif(session('alert')): ?>
      <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['messages' => session('alert')['messages'],'type' => session('alert')['type'],'title' => session('alert')['title'],'closeable' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('alert')['messages']),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('alert')['type']),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('alert')['title']),'closeable' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
    <?php endif; ?>
    <div>
      <?php echo e($slot); ?>

    </div>
    <form id="previous-step" method="POST" x-on:submit.prevent="changeStep(event, $dispatch)"
      action=<?php echo e(route('manuscripts.change_step', ['subGate' => $manuscript->subGate->slug ?? $subGate->slug, 'manuscript' => $manuscript->id ?? ''])); ?>>
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <input type="hidden" name="step" value="<?php echo e($currentStepIndex - 1); ?>">
    </form>
    <div
      class="mt-4 flex flex-col items-start justify-between gap-2 border-t border-gray-300 py-2 dark:border-gray-700 md:flex-row md:items-center">
      <div class="flex flex-col items-center gap-2 md:flex-row">
        <?php if($currentStepIndex > 1): ?>
          <button form="previous-step" type="submit" class="button secondary !gap-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-width="2" d="m15 6l-6 6l6 6" />
            </svg>
            Previous Step
          </button>
        <?php endif; ?>
      </div>
      <div class="flex flex-col items-center gap-2 md:flex-row">
        <?php if($currentStepIndex < count($steps)): ?>
          <button id="submit-modal-btn" class="button primary !gap-x-1" type="submit" form="manuscript-form">
            Save & Continue
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rotate-180" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-width="2" d="m15 6l-6 6l6 6" />
            </svg>
          </button>
        <?php else: ?>
          <button id="submit-modal-btn" class="button primary !gap-x-1" type="submit"
            form="manuscript-submit-form">
            Submit
          </button>
        <?php endif; ?>
      </div>
    </div>
  </main>
  <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'confirmation-change-step','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'confirmation-change-step','focusable' => true]); ?>
    <div class="max-w-2xl p-4 text-center md:p-5" x-data="{ form: null, targetStep: null }"
      x-on:confirm-change-step.window="form=$event.detail.form; targetStep=$event.detail.targetStep;"
      x-init="$watch('show', val => {
          if (!val) {
              form = null;
              targetStep = null;
          }
      })">
      <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>
      <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
        <?php echo e(__('Save changes first before leaving this page?')); ?>

      </h3>
      <div class="flex justify-center gap-3">
        <input type="hidden" name="step" form="manuscript-form" x-bind:value="targetStep">
        <button id="submit-modal-btn" type="submit" form="manuscript-form" class="button primary"
          x-on:click="$dispatch('close')">
          <?php echo e(__('Yes, Save changes')); ?>

        </button>
        <template x-if="form">
          <button id="delete-modal-btn" type="button" x-on:click="onSubmitChangeStep(form)" class="button error">
            <?php echo e(__('No, Discard changes')); ?>

          </button>
        </template>
        <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')" class="button secondary">
          <?php echo e(__('Cancel')); ?>

        </button>
      </div>
    </div>
   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

  <?php echo app('Illuminate\Foundation\Vite')(['resources/js/components/submission.js']); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/layouts/submission.blade.php ENDPATH**/ ?>