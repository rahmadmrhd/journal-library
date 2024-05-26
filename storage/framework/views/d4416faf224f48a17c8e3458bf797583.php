<?php $__env->startPush('head'); ?>
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/manuscript.css'); ?>
<?php $__env->stopPush(); ?>
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sizeHideSidebar' => 'xl','title' => 'Detail Manuscript']); ?>
  <div id="alert-group">

  </div>
  <div class="card">
    <div class="border-b-2 border-gray-200 pb-2 dark:border-gray-700">
      <h1 class="text-xl font-extrabold sm:text-2xl lg:text-4xl">#<?php echo e($manuscript->code); ?></h1>
    </div>

    <div class="detail-box mt-6">
      <div class="row">
        <div class="column !text-base !font-bold">Title</div>
        <div class="column !text-base !font-bold"><?php echo e($manuscript->title); ?></div>
      </div>
      <div class="row">
        <div class="column">Category</div>
        <div class="column"><?php echo e($manuscript->category->name); ?></div>
      </div>
      <div class="row">
        <div class="column">Abstract</div>
        <div class="column"><?php echo e($manuscript->abstract); ?></div>
      </div>
      <div class="row">
        <div class="column">Keywords</div>
        <div class="column">
          <ul class="flex w-full max-w-full flex-wrap justify-end gap-2" focusable
            x-on:click="$refs.keywordInput.focus()">
            <?php $__currentLoopData = $manuscript->keywords->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li
                class="flex w-fit max-w-full items-center !rounded-full border bg-gray-50 shadow-md dark:border-none dark:bg-gray-600">
                <span
                  class="text-ellipsis border-gray-100 px-2 py-1 text-sm dark:border-gray-700"><?php echo e($keyword); ?></span>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>
      <?php if($manuscript->parent): ?>
        <div class="row">
          <div class="column">The previously submitted Manuscript ID</div>
          <div class="column"><a href="<?php echo e(route('manuscripts.show', $manuscript->parent->id)); ?>"
              class="font-bold underline-offset-2 hover:text-blue-500 hover:underline">#<?php echo e($manuscript->parent->code); ?></a>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <?php if($manuscript->cover_letter): ?>
      <div>
        <?php if (isset($component)) { $__componentOriginal1b606bb65de8a0565179d9555ac96c54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b606bb65de8a0565179d9555ac96c54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-editor','data' => ['label' => 'Cover Letter','class' => 'mt-6','variable' => 'coverLetterEditor','disabled' => true,'initValue' => $manuscript->cover_letter ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-editor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Cover Letter','class' => 'mt-6','variable' => 'coverLetterEditor','disabled' => true,'initValue' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($manuscript->cover_letter ?? null)]); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1b606bb65de8a0565179d9555ac96c54)): ?>
<?php $attributes = $__attributesOriginal1b606bb65de8a0565179d9555ac96c54; ?>
<?php unset($__attributesOriginal1b606bb65de8a0565179d9555ac96c54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1b606bb65de8a0565179d9555ac96c54)): ?>
<?php $component = $__componentOriginal1b606bb65de8a0565179d9555ac96c54; ?>
<?php unset($__componentOriginal1b606bb65de8a0565179d9555ac96c54); ?>
<?php endif; ?>
      </div>
    <?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc0e765c3912d7e0ec5da45dc70dc15d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc0e765c3912d7e0ec5da45dc70dc15d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tabs-panel','data' => ['class' => 'mt-6','withFragment' => true,'tabs' => [
        [
            'label' => 'Files',
            'name' => 'files',
        ],
        [
            'label' => 'Authors',
            'name' => 'authors',
        ],
        ...$manuscript->funders->count() > 0
            ? [
                [
                    'label' => 'Funding',
                    'name' => 'Funding',
                ],
            ]
            : [],
        [
            'label' => 'Details',
            'name' => 'details',
        ],
        [
            'label' => 'Timeline',
            'name' => 'timeline',
        ],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabs-panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-6','withFragment' => true,'tabs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        [
            'label' => 'Files',
            'name' => 'files',
        ],
        [
            'label' => 'Authors',
            'name' => 'authors',
        ],
        ...$manuscript->funders->count() > 0
            ? [
                [
                    'label' => 'Funding',
                    'name' => 'Funding',
                ],
            ]
            : [],
        [
            'label' => 'Details',
            'name' => 'details',
        ],
        [
            'label' => 'Timeline',
            'name' => 'timeline',
        ],
    ])]); ?>
      <?php
        $manuscript->isShow = true;
      ?>
       <?php $__env->slot('files', null, []); ?> 
        <?php echo $__env->make('pages.manuscripts.form.upload-file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <?php $__env->endSlot(); ?>

      
       <?php $__env->slot('authors', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['columns' => [
            ['label' => 'AUTHOR', 'name' => 'AUTHOR', 'isSortable' => false],
            ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
            ...$manuscript->isReview ? [] : [['label' => ' ', 'isSortable' => false]],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['label' => 'AUTHOR', 'name' => 'AUTHOR', 'isSortable' => false],
            ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
            ...$manuscript->isReview ? [] : [['label' => ' ', 'isSortable' => false]],
        ])]); ?>
          <?php $__currentLoopData = $manuscript->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
              <td valign="top" class="max-w-64px truncate px-6 py-2">
                <div class="flex flex-col items-start">
                  <h3 class="text-base font-bold"><?php echo e($author->getFullName()); ?></h3>
                  <?php if($author->pivot->is_corresponding_author): ?>
                    <p class="text-sm italic">(Corresponding Author)</p>
                  <?php endif; ?>
                  <a class="mt-4 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline"><?php echo e($author->email); ?>

                  </a>
                  <?php if($author->orcid_id): ?>
                    <div class="mt-2 flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                      </svg>
                      <a href="https://orcid.org/"
                        class="text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">
                        <?php echo e($author->orcid_id); ?>

                      </a>
                    </div>
                  <?php endif; ?>
                </div>
              </td>
              <td valign="top" class="px-6 py-2">
                <div class="flex flex-col items-start">
                  <p class="text-sm font-bold">
                    <?php echo e($author->institution ? $author->institution . ',' : ''); ?>

                  </p>
                  <p class="text-sm">
                    <?php echo e($author->department ? $author->department . ',' : ''); ?>

                    <?php echo e($author->position); ?>

                  </p>
                  <p class="mt-5 text-sm font-normal"><?php echo e($author->address); ?>

                  </p>
                  <p class="text-sm font-normal">
                    <?php echo e($author->city ? $author->city . ',' : ''); ?>

                    <?php echo e($author->province ? $author->province . ',' : ''); ?>

                    <?php echo e($author->country?->name ? $author->country?->name . ',' : ''); ?>

                    <?php echo e($author->postal_code ? 'ID ' . $author->postal_code : ''); ?>

                  </p>
                </div>
              </td>
              <?php if(!isset($manuscript->isReview)): ?>
                <td class="w-[100px] space-x-1 whitespace-nowrap p-4"></td>
              <?php endif; ?>
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
       <?php $__env->endSlot(); ?>

       <?php $__env->slot('details', null, []); ?> 
        <?php echo $__env->make('pages.manuscripts.form.details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <?php $__env->endSlot(); ?>

       <?php $__env->slot('timeline', null, []); ?> 
        <ol class="relative border-s border-gray-200 dark:border-gray-700">
          <?php $__currentLoopData = $manuscript->logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="mb-3 ms-4">
              <div
                class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700">
              </div>
              <time
                class="mb-1 text-xs font-normal leading-none text-gray-400 dark:text-gray-500"><?php echo e(\Carbon\Carbon::parse($log->created_at)->format('d M Y H:i T')); ?></time>
              <h3 class="text-base font-semibold text-gray-900 dark:text-white"><?php echo e($log->activity); ?></h3>
              <p class="text-sm font-normal text-gray-500 dark:text-gray-400"><?php echo e($log->description); ?></p>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
       <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc0e765c3912d7e0ec5da45dc70dc15d7)): ?>
<?php $attributes = $__attributesOriginalc0e765c3912d7e0ec5da45dc70dc15d7; ?>
<?php unset($__attributesOriginalc0e765c3912d7e0ec5da45dc70dc15d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0e765c3912d7e0ec5da45dc70dc15d7)): ?>
<?php $component = $__componentOriginalc0e765c3912d7e0ec5da45dc70dc15d7; ?>
<?php unset($__componentOriginalc0e765c3912d7e0ec5da45dc70dc15d7); ?>
<?php endif; ?>
  </div>

  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $task ?? null)): ?>
    <div class="card mt-6">
      <div class="mb-2 border-b border-gray-300 pb-2 dark:border-gray-700">
        <h3 class="text-left text-xl font-extrabold lg:text-3xl">
          Your Decision
        </h3>
        <p class="mt-2 text-sm font-thin italic">
          Please provide your decision on this manuscript.
        </p>
      </div>
      <?php if(isset($alert)): ?>
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
      <form class="mt-3 space-y-3" action="<?php echo e(route('tasks.update', $task)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'decision','type' => 'select','label' => 'Decision','name' => 'decision','required' => true,'value' => $task->decision,'messages' => $errors->get('decision')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'decision','type' => 'select','label' => 'Decision','name' => 'decision','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($task->decision),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('decision'))]); ?>
          <option value="" disabled selected>-- Select Decision --</option>
          <option value="accept" <?php echo e($task->decision == 'accept' ? 'selected' : ''); ?>>Accept</option>
          <option value="reject" <?php echo e($task->decision == 'reject' ? 'selected' : ''); ?>>Reject</option>
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
        <?php if (isset($component)) { $__componentOriginal1b606bb65de8a0565179d9555ac96c54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b606bb65de8a0565179d9555ac96c54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-editor','data' => ['id' => 'notes','label' => 'Notes','name' => 'notes','variable' => 'notes','initValue' => $task->notes,'messages' => $errors->get('notes')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-editor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'notes','label' => 'Notes','name' => 'notes','variable' => 'notes','initValue' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($task->notes),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('notes'))]); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1b606bb65de8a0565179d9555ac96c54)): ?>
<?php $attributes = $__attributesOriginal1b606bb65de8a0565179d9555ac96c54; ?>
<?php unset($__attributesOriginal1b606bb65de8a0565179d9555ac96c54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1b606bb65de8a0565179d9555ac96c54)): ?>
<?php $component = $__componentOriginal1b606bb65de8a0565179d9555ac96c54; ?>
<?php unset($__componentOriginal1b606bb65de8a0565179d9555ac96c54); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal8459566a25c13b633088e398a4cbbc1f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8459566a25c13b633088e398a4cbbc1f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.files','data' => ['label' => 'File Attachments','files' => $task->files]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('files'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'File Attachments','files' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($task->files)]); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8459566a25c13b633088e398a4cbbc1f)): ?>
<?php $attributes = $__attributesOriginal8459566a25c13b633088e398a4cbbc1f; ?>
<?php unset($__attributesOriginal8459566a25c13b633088e398a4cbbc1f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8459566a25c13b633088e398a4cbbc1f)): ?>
<?php $component = $__componentOriginal8459566a25c13b633088e398a4cbbc1f; ?>
<?php unset($__componentOriginal8459566a25c13b633088e398a4cbbc1f); ?>
<?php endif; ?>
        <div class="mt-4 flex items-center justify-end gap-2 border-t border-gray-300 py-2 dark:border-gray-700">
          <input type="submit" name="submit" value="Save as Draft" class="button secondary">
          <input type="submit" name="submit" value="Submit" class="button primary">
        </div>
      </form>
    </div>
  <?php endif; ?>
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
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/pages/manuscripts/show.blade.php ENDPATH**/ ?>