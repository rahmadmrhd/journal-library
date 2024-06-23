<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type . ' Tasks'),'subGate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subGate)]); ?>
  
  <?php if(session('alert')): ?>
    <?php
      $msg = session('alert');
    ?>
    <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['class' => 'sm:mx-4','type' => $msg['type'],'title' => $msg['title'] ?? null,'messages' => $msg['messages'] ?? null,'id' => 'msg-box','timeout' => 3000]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'sm:mx-4','type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($msg['type']),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($msg['title'] ?? null),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($msg['messages'] ?? null),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('msg-box'),'timeout' => 3000]); ?>
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
  <div class="absolute h-full w-full border-b border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800">
    <div class="relative flex h-full w-full flex-col items-start justify-between p-4">
      <div class="mb-3">
        <h1 class="text-xl font-extrabold text-gray-900 dark:text-white sm:text-2xl"><?php echo e($type); ?> Tasks</h1>
      </div>
      
      <div class="flex w-full flex-col justify-between gap-2 dark:divide-gray-700 md:flex-row md:items-center">
        <div class="mb-4 hidden items-center sm:mb-0 sm:flex">
          <form class="w-full sm:pr-3" action="#" method="GET">
            <label for="tasks-search" class="sr-only">Search</label>
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
              <input type="search" name="search" id="tasks-search" value="<?php echo e(request('search')); ?>"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                placeholder="Search task">
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
      </div>

      <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['class' => 'mt-6 h-full','columns' => [
          ...$type == 'Invitation'
              ? [
                  [
                      'label' => '',
                      'name' => 'action',
                      'isSortable' => false,
                  ],
              ]
              : [],
          [
              'label' => 'Manuscript ID',
              'name' => 'manuscript_id',
              'isSortable' => true,
          ],
          [
              'label' => 'Manuscript Title',
              'name' => 'manuscript_title',
              'isSortable' => true,
          ],
          [
              'label' => $type == 'Invitation' ? 'Abstract' : 'Status',
              'name' => $type == 'Invitation' ? 'abstract' : 'status',
              'isSortable' => false,
          ],
          [
              'label' => 'Authors',
              'name' => 'authors',
              'isSortable' => false,
          ],
          [
              'label' => 'Submitted at',
              'name' => 'submitted_at',
              'isSortable' => true,
          ],
      ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-6 h-full','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
          ...$type == 'Invitation'
              ? [
                  [
                      'label' => '',
                      'name' => 'action',
                      'isSortable' => false,
                  ],
              ]
              : [],
          [
              'label' => 'Manuscript ID',
              'name' => 'manuscript_id',
              'isSortable' => true,
          ],
          [
              'label' => 'Manuscript Title',
              'name' => 'manuscript_title',
              'isSortable' => true,
          ],
          [
              'label' => $type == 'Invitation' ? 'Abstract' : 'Status',
              'name' => $type == 'Invitation' ? 'abstract' : 'status',
              'isSortable' => false,
          ],
          [
              'label' => 'Authors',
              'name' => 'authors',
              'isSortable' => false,
          ],
          [
              'label' => 'Submitted at',
              'name' => 'submitted_at',
              'isSortable' => true,
          ],
      ])]); ?>
        <?php if($tasks->total() > 10): ?>
          <?php $__env->slot('pagination'); ?>
            <?php echo e($tasks->links()); ?>

          <?php $__env->endSlot(); ?>
        <?php endif; ?>

        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($type == 'Invitation'): ?>
            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            <?php else: ?>
            <tr href="<?php echo e(route('tasks.show', ['task' => $task, 'subGate' => $subGate->slug])); ?>"
              class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
          <?php endif; ?>
          <?php if($type == 'Invitation'): ?>
            <td class="w-[1%] px-6 py-2">
              <button title="More" id="more-btn-<?php echo e($task->id); ?>" x-data x-on:click.stop=""
                data-dropdown-toggle="more-dropdown-<?php echo e($task->id); ?>" class="button secondary !p-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M16 12a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2" />
                </svg>
              </button>

              <!-- Dropdown menu -->
              <div id="more-dropdown-<?php echo e($task->id); ?>"
                class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="more-btn-<?php echo e($task->id); ?>">
                  <li class="border border-gray-100 hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-400">
                    <form
                      action="<?php echo e(route('tasks.invitationDecision', ['subGate' => $subGate->slug, 'task' => $task])); ?>"
                      method="POST" class="w-full">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PUT'); ?>
                      <input type="hidden" name="decision" value="accept">
                      <button type="submit" class="flex w-full cursor-pointer items-center gap-3 px-4 py-2">
                        <span>Accept this invitation</span>
                      </button>
                    </form>
                  </li>
                  <li class="border-t border-gray-100 hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-400">
                    <form
                      action="<?php echo e(route('tasks.invitationDecision', ['subGate' => $subGate->slug, 'task' => $task])); ?>"
                      method="POST" class="w-full">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PUT'); ?>
                      <input type="hidden" name="decision" value="reject">
                      <button type="submit"
                        class="flex w-full cursor-pointer items-center gap-3 px-4 py-2 text-red-700 dark:text-red-500">
                        <span>Decline this invitation</span>
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </td>
          <?php endif; ?>
          <td class="font-xs min-w-44 w-[1%] px-6 py-2"><?php echo e($task->manuscript->code ?? '-'); ?></td>
          <th role="row" class="font-sm px-6 py-2 font-bold">
            <?php echo e($task->manuscript->title); ?>

          </th>
          <?php if($type == 'Invitation'): ?>
            <td>
              <?php echo e($task->manuscript->abstract); ?>

            </td>
          <?php else: ?>
            <td class="w-[1%] truncate px-6 py-2">
              <?php if($task->processed_at == null): ?>
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['type' => 'warning','class' => 'italic']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'warning','class' => 'italic']); ?>Needs Review <?php echo $__env->renderComponent(); ?>
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
                <?php switch($task->status):
                  case ('done'): ?>
                    <?php if($task->details->last()->decision == 'accept'): ?>
                      <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['type' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success']); ?>Accepted <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['type' => 'error']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error']); ?>Rejected <?php echo $__env->renderComponent(); ?>
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
                  <?php break; ?>

                  <?php case ('in_progress'): ?>
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
                      Waiting your decision
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                  <?php break; ?>

                  <?php case ('delegated'): ?>
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
                      Waiting Academic Editor
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                  <?php break; ?>
                <?php endswitch; ?>
              <?php endif; ?>
            </td>
          <?php endif; ?>
          <td class="min-w-48 w-[1%] px-6 py-2">
            <div class="-my-1 flex items-center truncate text-sm">
              <span class="sr-only">Open user menu</span>
              <div class="relative h-8 w-8 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
                <svg class="absolute -left-1 h-10 w-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                    clip-rule="evenodd">
                  </path>
                </svg>
              </div>
              <div class="mx-3 hidden w-fit text-left md:block" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                  <?php echo e($task->manuscript->authors->where('pivot.is_corresponding_author', true)->first()->getFullName()); ?>

                </p>
                <p class="truncate text-left text-xs font-medium italic text-gray-900 dark:text-gray-300">
                  (Corresponding Author)
                </p>
                <button type="button" x-data
                  x-on:click.prevent.stop="$dispatch('open-modal', 'modal-author-info'); $dispatch('set-authors-info', <?php echo \Illuminate\Support\Js::from($task->manuscript->authors->toArray())->toHtml() ?>)"
                  class="mt-1 truncate text-left text-xs font-medium italic text-gray-900 underline-offset-2 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-300"
                  role="none">
                  Click this for more info
                </button>
              </div>
            </div>
          </td>
          <td class="w-[1%] px-6 py-2"><?php echo e(Carbon\Carbon::parse($task->manuscript->submitted_at)->format('d M Y')); ?>

          </td>
          <?php if(true): ?>
            </tr>
          <?php endif; ?>
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

      <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'modal-author-info','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'modal-author-info','focusable' => true]); ?>
        <div class="card relative !p-0 sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg"
          x-data="{
              authors: []
          }" x-init="$watch('show', val => {
              if (!val) {
                  setTimeout(() => authors = [], 500);
              }
          })" x-on:set-authors-info.window="authors = $event.detail">
          <div class="flex items-center justify-between p-4">
            <h3 class="text-xl font-bold">Authors</h3>
            <button class="button error !p-2" type="button" x-on:click="$dispatch('close')">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z" />
              </svg>
            </button>
          </div>
          <div class="w-full">
            <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['columns' => [
                ['label' => 'AUTHORS', 'name' => 'AUTHOR', 'isSortable' => false],
                ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
            ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                ['label' => 'AUTHORS', 'name' => 'AUTHOR', 'isSortable' => false],
                ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
            ])]); ?>
              <template x-for="(author, index) in authors">
                <tr
                  class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                  <td valign="top" class="max-w-64px truncate px-6 py-2">
                    <div class="flex flex-col items-start">
                      <input type="hidden" name="authorsId[]" x-model="author.id">
                      <h3 class="text-base font-bold"
                        x-text="`${author.title ? `${author.title} `: ''}${author.first_name ? `${author.first_name} `: ''}${author.last_name ? `${author.last_name} `: ''}${author.degree ? `${author.degree} `: ''}`">
                      </h3>
                      <template x-if="author.pivot.is_corresponding_author">
                        <p class="text-sm italic">(Corresponding Author)</p>
                      </template>
                      <p class="mt-6 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline"
                        x-text="author.email">
                      </p>
                      <template x-if="author.orcid_id">
                        <div class="mt-2 flex items-center gap-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                            <path fill="currentColor"
                              d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                          </svg>
                          <p x-text="author.orcid_id"
                            class="text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">
                          </p>
                        </div>
                      </template>
                    </div>
                  </td>
                  <td valign="top" class="lg:min-w-96 min-w-min px-6 py-2">
                    <div class="flex flex-col items-start">
                      <p class="text-sm font-bold" x-text="`${author.institution ? `${author.institution}, ` : ''}`">
                      </p>
                      <p class="text-sm"
                        x-text="`${author.department ? `${author.department}, ` : ''}${author.position??''}`">
                      </p>
                      <p class="mt-3 text-sm font-normal" x-text="author.address"></p>
                      <p class="text-sm font-normal"
                        x-text="`${author.city ? `${author.city}, ` : ''}${author.province ? `${author.province}, ` : ''}${author.country?.name ? `${author.country?.name}, ` : ''}${author.postal_code ? `ID ${author.postal_code}` : ''}`">
                      </p>
                    </div>
                  </td>
                </tr>
              </template>
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
    </div>
  </div>
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
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/pages/tasks/index.blade.php ENDPATH**/ ?>