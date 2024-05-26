<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Manuscripts']); ?>
  
  <?php if(session('alert')): ?>
    <?php
      $msg = session('alert');
    ?>
    <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['class' => 'sm:mx-4','type' => $msg['type'],'messages' => $msg['messages'],'id' => 'msg-box','timeout' => 3000]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'sm:mx-4','type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($msg['type']),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($msg['messages']),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('msg-box'),'timeout' => 3000]); ?>
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
  <div class="border-b border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800 sm:rounded-lg">
    <div class="flex w-full flex-col items-start justify-between p-4">
      <div class="mb-3">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Manuscripts Management</h1>
      </div>
      
      <div class="flex w-full flex-col justify-between gap-2 dark:divide-gray-700 md:flex-row md:items-center">
        <div class="mb-4 hidden items-center sm:mb-0 sm:flex">
          <form class="w-full sm:pr-3" action="#" method="GET">
            <label for="manuscripts-search" class="sr-only">Search</label>
            <div class="relative sm:w-full md:w-72 xl:w-96">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
                </svg>
              </div>
              <?php if(request('show')): ?>
                <input type="hidden" name="show" value="<?php echo e(request('show')); ?>">
              <?php endif; ?>
              <input type="search" name="search" id="manuscripts-search" value="<?php echo e(request('search')); ?>"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                placeholder="Search manuscript">
            </div>
          </form>
          <div class="flex items-center sm:justify-end">
            <div class="flex space-x-1 pl-2">
              <button type="button" title="Filter"
                class="inline-flex cursor-pointer justify-center rounded p-1 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M14 12v7.88c.04.3-.06.62-.29.83a.996.996 0 0 1-1.41 0l-2.01-2.01a.99.99 0 0 1-.29-.83V12h-.03L4.21 4.62a1 1 0 0 1 .17-1.4c.19-.14.4-.22.62-.22h14c.22 0 .43.08.62.22a1 1 0 0 1 .17 1.4L14.03 12z" />
                </svg>
              </button>
            </div>
          </div>
        </div>
        <div class="flex w-full items-end gap-2 sm:w-auto">
          <a href="<?php echo e(route('manuscripts.create')); ?>" id="add-manuscript-btn" class="button primary">
            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"></path>
            </svg>
            Submit New Manuscript
          </a>
          
        </div>
      </div>

      

      

      <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['class' => 'mt-6','columns' => [
          [
              'label' => 'Action',
              'name' => 'action',
              'isSortable' => false,
          ],
          [
              'label' => 'ID',
              'name' => 'id',
              'isSortable' => true,
          ],
          [
              'label' => 'Title',
              'name' => 'title',
              'isSortable' => true,
          ],
          [
              'label' => 'Status',
              'name' => 'status',
              'isSortable' => true,
          ],
          [
              'label' => 'Created at',
              'name' => 'created_at',
              'isSortable' => true,
          ],
      ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-6','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
          [
              'label' => 'Action',
              'name' => 'action',
              'isSortable' => false,
          ],
          [
              'label' => 'ID',
              'name' => 'id',
              'isSortable' => true,
          ],
          [
              'label' => 'Title',
              'name' => 'title',
              'isSortable' => true,
          ],
          [
              'label' => 'Status',
              'name' => 'status',
              'isSortable' => true,
          ],
          [
              'label' => 'Created at',
              'name' => 'created_at',
              'isSortable' => true,
          ],
      ])]); ?>
        <?php $__env->slot('pagination'); ?>
          <?php echo e($manuscripts->links()); ?>

        <?php $__env->endSlot(); ?>

        <?php $__currentLoopData = $manuscripts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manuscript): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr
            href="<?php echo e($manuscript->submitted_at ? route('manuscripts.show', $manuscript->id) : route('manuscripts.create', $manuscript->id)); ?>"
            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            <td class="w-[1%] space-x-1 whitespace-nowrap p-4">
              <button title="More" id="more-btn-<?php echo e($manuscript->id); ?>" x-data x-on:click.stop=""
                data-dropdown-toggle="more-dropdown-<?php echo e($manuscript->id); ?>" class="button secondary !p-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M16 12a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2" />
                </svg>
              </button>

              <!-- Dropdown menu -->
              <div id="more-dropdown-<?php echo e($manuscript->id); ?>"
                class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="more-btn-<?php echo e($manuscript->id); ?>">
                  <li>
                    <?php if($manuscript->submitted_at): ?>
                      <a href="<?php echo e(route('manuscripts.show', $manuscript->id)); ?>"
                        class="flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Show
                      </a>
                    <?php else: ?>
                      <a href="<?php echo e(route('manuscripts.create', $manuscript->id)); ?>"
                        class="flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Continue
                      </a>
                    <?php endif; ?>
                  </li>
                  <li class="border-t border-gray-100 dark:border-gray-600">
                    <?php if($manuscript->submitted_at): ?>
                      <button type="button" x-data
                        x-on:click.prevent.stop="console.log($event);$dispatch('open-modal', 'modal-cancel-submission')"
                        class="flex w-full items-center gap-3 px-4 py-2 text-red-700 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                          <path fill="currentColor" fill-rule="evenodd"
                            d="M12.035 13.096a6.5 6.5 0 0 1-9.131-9.131zm1.061-1.06L3.965 2.903a6.5 6.5 0 0 1 9.131 9.131ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"
                            clip-rule="evenodd" />
                        </svg>
                        <span>Cancel Submission</span>
                      </button>
                    <?php else: ?>
                      <button type="button" x-data
                        x-on:click.prevent.stop="$dispatch('open-modal', 'modal-delete-submission')"
                        class="flex w-full items-center gap-3 px-4 py-2 text-red-700 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                        </svg>
                        <span>Delete</span>
                      </button>
                    <?php endif; ?>
                  </li>
                </ul>
              </div>
            </td>
            <td class="font-xs min-w-44 w-[1%] px-6 py-2"><?php echo e($manuscript->code ?? '-'); ?></td>
            <th role="row" class="font-sm <?php echo e($manuscript->title ? 'font-bold' : 'italic font-normal'); ?> px-6 py-2">
              <?php echo e($manuscript->title ?? '(No Title Entered)'); ?>

            </th>
            <td class="w-[1%] truncate px-6 py-2">
              <?php if(!$manuscript->submitted_at): ?>
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['type' => 'secondary','useIcon' => false,'class' => 'italic']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'secondary','useIcon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'class' => 'italic']); ?>Draf <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
              <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['type' => 'primary','useIcon' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'primary','useIcon' => true]); ?>
                  <?php $__env->slot('icon'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <circle cx="18" cy="12" r="0" fill="currentColor">
                        <animate attributeName="r" begin=".67" calcMode="spline" dur="1.5s"
                          keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                          values="0;2;0;0" />
                      </circle>
                      <circle cx="12" cy="12" r="0" fill="currentColor">
                        <animate attributeName="r" begin=".33" calcMode="spline" dur="1.5s"
                          keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                          values="0;2;0;0" />
                      </circle>
                      <circle cx="6" cy="12" r="0" fill="currentColor">
                        <animate attributeName="r" begin="0" calcMode="spline" dur="1.5s"
                          keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite"
                          values="0;2;0;0" />
                      </circle>
                    </svg>
                  <?php $__env->endSlot(); ?>
                  Waiting for a decision  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
              <?php endif; ?>
            </td>
            <td class="w-[1%] px-6 py-2"><?php echo e(Carbon\Carbon::parse($manuscript->created_at)->format('d M Y')); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>

      <?php if(session('already-submission')): ?>
        <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'modal-already-submission','show' => true,'focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'modal-already-submission','show' => true,'focusable' => true]); ?>
          <div id="confirm-continue-submission" class="max-w-2xl p-4 text-center md:p-5">
            <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
              <?php echo e(__('You have already drafted a submission. Please continue the previous submission before starting a new one.')); ?>

            </h3>
            <a href="<?php echo e(route('manuscripts.create', session('already-submission'))); ?>" id="delete-modal-btn"
              class="button primary">
              Yes, I will continue
            </a>
            <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')" class="button secondary">
              Cancel
            </button>
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
      <?php endif; ?>

      <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'modal-delete-submission','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'modal-delete-submission','focusable' => true]); ?>
        <form method="POST" x-data="{ id: '' }" x-bind:action="`manuscripts/${id}`"
          x-on:set="id = $event.detail.id" class="max-w-2xl p-4 text-center md:p-5">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
          <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
            <?php echo e(__('Are you sure you want to delete this submissions?')); ?>

          </h3>
          <button type="submit" id="delete-modal-btn" class="button error">
            Yes, Delete Submissions
          </button>
          <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')" class="button secondary">
            Cancel
          </button>
        </form>
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

      <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'modal-cancel-submission','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'modal-cancel-submission','focusable' => true]); ?>
        <form method="POST" x-data="{ id: '', reason: '' }" x-bind:action="`manuscripts/${id}/cancel`"
          x-on:set="id = $event.detail.id" class="max-w-2xl p-4 text-center md:p-5">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
          <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'radio','direction' => 'col','name' => 'reason','xModel' => 'reason','label' => 'Please select a reason for canceling the submission','required' => true,'options' => [
                ['label' => 'I have changed my mind', 'value' => 'I have changed my mind'],
                ['label' => 'I have lost my work', 'value' => 'I have lost my work'],
                ['label' => 'I have not finished my work', 'value' => 'I have not finished my work'],
                ['label' => 'Other', 'value' => 'other'],
            ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'radio','direction' => 'col','name' => 'reason','x-model' => 'reason','label' => 'Please select a reason for canceling the submission','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                ['label' => 'I have changed my mind', 'value' => 'I have changed my mind'],
                ['label' => 'I have lost my work', 'value' => 'I have lost my work'],
                ['label' => 'I have not finished my work', 'value' => 'I have not finished my work'],
                ['label' => 'Other', 'value' => 'other'],
            ])]); ?>
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

          <div class="mt-6 flex flex-row-reverse gap-3">
            <button type="submit" class="button error">
              <?php echo e(__('Cancel Submission')); ?>

            </button>
            <button x-on:click.prevent="$dispatch('close')" type="button" class="button secondary">
              <?php echo e(__('Close')); ?>

            </button>
          </div>
        </form>
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
    </div>
  </div>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/js/manuscript.js']); ?>
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
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/pages/manuscripts/index.blade.php ENDPATH**/ ?>