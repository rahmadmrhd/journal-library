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
<?php $component->withAttributes(['sizeHideSidebar' => 'xl','title' => 'Detail Manuscript','subGate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subGate),'class' => 'px-4 pt-4']); ?>
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
          <div class="column"><a
              href="<?php echo e(route('manuscripts.show', ['subGate' => $subGate->slug, 'manuscript' => $manuscript->parent->id])); ?>"
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
          <?php $__currentLoopData = $manuscript->logs()->with('user')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="mb-3 ms-4">
              <div
                class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700">
              </div>
              <time
                class="mb-1 text-xs font-normal leading-none text-gray-400 dark:text-gray-400"><?php echo e(\Carbon\Carbon::parse($log->created_at)->format('d M Y H:i T')); ?>

                <span class="font-bold">by
                  <?php echo e($log->user == null ? 'System' : (Auth::user()->id == $log->user->id ? 'Me' : $log->user->getFullName())); ?>

                </span>
              </time>
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
  <?php if(isset($task)): ?>
    <?php
      $roleSlug = isset($task) ? $task->role()->first('slug')->slug : null;
    ?>
    <?php if($roleSlug != 'editor-assistant'): ?>
      <?php
        $parentTask = $task->parent;
        $parentTaskDetail = $parentTask->details()->latest()->first();
        if ($task->details->whereNotNull('submitted_at')->count() > 0 && $roleSlug != 'reviewer') {
            $currentTask = $task->details->whereNotNull('submitted_at')->first();
            $currentTask->taskUser = $task->user;
            $currentTask->taskRole = $task->role;
            $currentAndChildren = collect([
                $currentTask,
                ...$task
                    ->children()
                    ->with(['user', 'role'])
                    ->whereHas('details', function ($query) {
                        $query->whereNotNull('submitted_at');
                    })
                    ->get()
                    ->map(function ($child) {
                        $detail = $child->details->first();
                        $detail->taskUser = $child->user;
                        $detail->taskRole = $child->role;
                        return $detail;
                    }),
            ]);
        }
      ?>
      <div class="card mt-6" x-data="{ expand: false }">
        <button type="button" x-on:click="expand=!expand"
          class="mb-3 flex w-full items-center gap-x-2 border-b border-gray-300 pb-2 dark:border-gray-700">
          <svg class="svg-dropdown" x-bind:class="!expand && '-rotate-90'" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
          <h3 class="text-left text-xl font-extrabold lg:text-3xl">
            Progress
          </h3>
        </button>
        <?php if (isset($component)) { $__componentOriginalc0e765c3912d7e0ec5da45dc70dc15d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc0e765c3912d7e0ec5da45dc70dc15d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tabs-panel','data' => ['xShow' => 'expand','withFragment' => false,'tabs' => [
            [
                'label' =>
                    $roleSlug == 'editor-in-chief'
                        ? 'Editor Assistant'
                        : ($roleSlug == 'academic-editor'
                            ? 'Editor In Chief'
                            : 'Academic Editor'),
                'name' => 'slot1',
            ],
            ...isset($currentAndChildren)
                ? $currentAndChildren
                    ->map(function ($task, $key) use ($roleSlug) {
                        if ($roleSlug == 'editor-in-chief') {
                            return [
                                'label' => $key == 0 ? 'Editor In Chief' : 'Academic Editor',
                                'name' => 'slot' . $key + 2,
                            ];
                        }
                        return [
                            'label' => $key == 0 ? 'Academic Editor' : 'Reviewer ' . $key,
                            'name' => 'slot' . $key + 2,
                        ];
                    })
                    ->toArray()
                : [],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabs-panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'expand','withFragment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'tabs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            [
                'label' =>
                    $roleSlug == 'editor-in-chief'
                        ? 'Editor Assistant'
                        : ($roleSlug == 'academic-editor'
                            ? 'Editor In Chief'
                            : 'Academic Editor'),
                'name' => 'slot1',
            ],
            ...isset($currentAndChildren)
                ? $currentAndChildren
                    ->map(function ($task, $key) use ($roleSlug) {
                        if ($roleSlug == 'editor-in-chief') {
                            return [
                                'label' => $key == 0 ? 'Editor In Chief' : 'Academic Editor',
                                'name' => 'slot' . $key + 2,
                            ];
                        }
                        return [
                            'label' => $key == 0 ? 'Academic Editor' : 'Reviewer ' . $key,
                            'name' => 'slot' . $key + 2,
                        ];
                    })
                    ->toArray()
                : [],
        ])]); ?>
           <?php $__env->slot('slot1', null, ['class' => 'space-y-3']); ?> 
            <div class="user-info mb-4">
              <h4 class="text-lg font-bold">User Information</h4>
              <?php if (isset($component)) { $__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.invite-users','data' => ['disabled' => true,'subGate' => $subGate,'users' => [$parentTask->user],'label' => 'User']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('invite-users'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => true,'subGate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subGate),'users' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([$parentTask->user]),'label' => 'User']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7)): ?>
<?php $attributes = $__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7; ?>
<?php unset($__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7)): ?>
<?php $component = $__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7; ?>
<?php unset($__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7); ?>
<?php endif; ?>
            </div>
            

            <?php if (isset($component)) { $__componentOriginal1b606bb65de8a0565179d9555ac96c54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b606bb65de8a0565179d9555ac96c54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-editor','data' => ['id' => 'editorslot1','label' => 'Notes','initValue' => $parentTaskDetail->notes,'disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-editor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'editorslot1','label' => 'Notes','initValue' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($parentTaskDetail->notes),'disabled' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.files','data' => ['label' => 'File Attachments','files' => $parentTaskDetail->files,'isReadOnly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('files'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'File Attachments','files' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($parentTaskDetail->files),'isReadOnly' => true]); ?>
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
           <?php $__env->endSlot(); ?>

          <?php if(isset($currentAndChildren)): ?>
            <?php $__currentLoopData = $currentAndChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childrenTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php $__env->slot('slot' . ($loop->iteration + 1), null, []); ?> 
                <div class="user-info mb-4">
                  <h4 class="text-lg font-bold">User Information</h4>
                  <?php if (isset($component)) { $__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.invite-users','data' => ['disabled' => true,'subGate' => $subGate,'users' => [$childrenTask->taskUser],'label' => 'User']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('invite-users'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => true,'subGate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subGate),'users' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([$childrenTask->taskUser]),'label' => 'User']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7)): ?>
<?php $attributes = $__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7; ?>
<?php unset($__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7)): ?>
<?php $component = $__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7; ?>
<?php unset($__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7); ?>
<?php endif; ?>
                </div>
                
                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'deadline'.e($loop->iteration + 1).'','name' => 'deadline','type' => 'number','min' => '0','value' => $childrenTask?->deadline_invites ?? 7,'required' => true,'disabled' => true,'description' => 'Deadline in days','label' => 'Deadline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'deadline'.e($loop->iteration + 1).'','name' => 'deadline','type' => 'number','min' => '0','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($childrenTask?->deadline_invites ?? 7),'required' => true,'disabled' => true,'description' => 'Deadline in days','label' => 'Deadline']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <div class="user-info my-4">
                  <h4 class="text-lg font-bold">
                    <?php echo e($childrenTask->taskRole->slug == 'editor-in-chief' ? 'Invite Academic Editor' : 'Invite Reviewer'); ?>

                  </h4>

                  <?php if (isset($component)) { $__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.invite-users','data' => ['subGate' => $subGate,'users' => $childrenTask->invites,'isReadOnly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('invite-users'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['subGate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subGate),'users' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($childrenTask->invites),'isReadOnly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7)): ?>
<?php $attributes = $__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7; ?>
<?php unset($__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7)): ?>
<?php $component = $__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7; ?>
<?php unset($__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7); ?>
<?php endif; ?>
                </div>

                <?php if (isset($component)) { $__componentOriginal1b606bb65de8a0565179d9555ac96c54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b606bb65de8a0565179d9555ac96c54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-editor','data' => ['id' => 'editorslot'.e($loop->iteration + 1).'','label' => 'Notes','initValue' => $childrenTask->notes,'disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-editor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'editorslot'.e($loop->iteration + 1).'','label' => 'Notes','initValue' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($childrenTask->notes),'disabled' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.files','data' => ['label' => 'File Attachments','files' => $childrenTask->files,'isReadOnly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('files'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'File Attachments','files' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($childrenTask->files),'isReadOnly' => true]); ?>
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
               <?php $__env->endSlot(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
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
    <?php endif; ?>

    <?php
      if (($roleSlug == 'editor-assistant' || $roleSlug == 'reviewer') && !isset($detail)) {
          $detail = $task->details->first();
      }
    ?>
    <?php if(isset($detail)): ?>
      <?php
        if (isset($detail?->invites)) {
            $detail->invites = $detail->invites->map(function ($invite) {
                $differentDays = date_diff(\Carbon\Carbon::now(), \Carbon\Carbon::parse($invite->pivot->invited_at))
                    ->days;
                $invite->pivot->inDeadline = $differentDays > $invite->pivot->deadline;
                return $invite;
            });
        }
      ?>
      <div class="card mt-6">
        <div class="mb-2 border-b border-gray-300 pb-2 dark:border-gray-700">
          <h3 class="text-left text-xl font-extrabold lg:text-3xl">
            <?php echo e($roleSlug == 'reviewer' ? 'Your Review' : 'Your Decision'); ?>

          </h3>
          <p class="mt-2 text-sm font-thin italic">
            <?php echo e('Please provide your ' . ($roleSlug == 'reviewer' ? 'review' : 'decision') . ' on this manuscript.'); ?>

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
        <form class="mt-3 space-y-3"
          action="<?php echo e(route('tasks.update', ['subGate' => $subGate->slug, 'task' => $task])); ?>" method="POST"
          x-data="{
              decision: <?php echo \Illuminate\Support\Js::from($detail->decision ?? null)->toHtml() ?> ?? '',
              assignTo: <?php echo \Illuminate\Support\Js::from($roleSlug)->toHtml() ?> == 'reviewer' ? 'Academic Editor' : null
          }" x-init="$watch('decision', value => {
              if (<?php echo \Illuminate\Support\Js::from($roleSlug)->toHtml() ?> == 'reviewer') {
                  assignTo = 'Academic Editor';
                  return;
              }
              if (value != 'accept' && value != 'continue') {
                  assignTo = 'Author';
                  return;
              }
              switch (<?php echo \Illuminate\Support\Js::from($roleSlug)->toHtml() ?>) {
                  case 'editor-assistant':
                      assignTo = 'Editor In Chief';
                      break;
                  case 'editor-in-chief':
                      assignTo = value == 'accept' ? 'Publisher' : 'Academic Editor';
                      break;
                  case 'academic-editor':
                      assignTo = value == 'accept' ? 'Editor In Chief' : 'Reviewers';
                      break;
              }
          })">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <?php if(isset($detail->responses)): ?>
            <?php if (isset($component)) { $__componentOriginal796e6762dfd97b47af46b34eb9eb6ed7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal796e6762dfd97b47af46b34eb9eb6ed7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.custom-forms','data' => ['readonly' => ($detail->submitted_at ?? null) != null,'fields' => $detail->responses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('custom-forms'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['readonly' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($detail->submitted_at ?? null) != null),'fields' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($detail->responses)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal796e6762dfd97b47af46b34eb9eb6ed7)): ?>
<?php $attributes = $__attributesOriginal796e6762dfd97b47af46b34eb9eb6ed7; ?>
<?php unset($__attributesOriginal796e6762dfd97b47af46b34eb9eb6ed7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal796e6762dfd97b47af46b34eb9eb6ed7)): ?>
<?php $component = $__componentOriginal796e6762dfd97b47af46b34eb9eb6ed7; ?>
<?php unset($__componentOriginal796e6762dfd97b47af46b34eb9eb6ed7); ?>
<?php endif; ?>
          <?php endif; ?>
          <?php if($roleSlug != 'reviewer'): ?>
            <?php if(isset(($detail->toRole ?? null)->name)): ?>
              <div class="mt-6 max-w-screen-sm">
                <div class="grid grid-cols-[auto_1fr] border-b border-gray-200 dark:border-gray-700 lg:grid-cols-2">
                  <div class="flex items-center px-4 py-2 text-sm">Assigned to</div>
                  <div class="flex items-center justify-end px-4 py-2 text-right text-sm !font-bold">
                    <?php echo e(($detail->toRole ?? null)->name); ?>

                  </div>
                </div>
              </div>
            <?php else: ?>
              <template x-if="decision">
                <div class="mt-6 max-w-screen-sm">
                  <div class="grid grid-cols-[auto_1fr] border-b border-gray-200 dark:border-gray-700 lg:grid-cols-2">
                    <div class="flex items-center px-4 py-2 text-sm">Assign To</div>
                    <div class="flex items-center justify-end px-4 py-2 text-right text-sm !font-bold"
                      x-text="assignTo">
                    </div>
                  </div>
                </div>
              </template>
            <?php endif; ?>
          <?php endif; ?>
          <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'max-w-screen-sm','id' => 'decision','type' => 'select','label' => ''.e($roleSlug == 'reviewer' ? 'Recomendation Decision' : 'Decision').'','name' => 'decision','required' => true,'xModel' => 'decision','disabled' => ($detail->submitted_at ?? null) != null,'messages' => $errors->get('decision'),'status' => $errors->has('decision') ? 'error' : '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-w-screen-sm','id' => 'decision','type' => 'select','label' => ''.e($roleSlug == 'reviewer' ? 'Recomendation Decision' : 'Decision').'','name' => 'decision','required' => true,'x-model' => 'decision','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($detail->submitted_at ?? null) != null),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('decision')),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->has('decision') ? 'error' : '')]); ?>
            <option value="" disabled selected>-- Select Decision --</option>
            <?php if($roleSlug == 'editor-in-chief'): ?>
              <option value="accept" <?php echo e(($detail->decision ?? null) == 'accept' ? 'selected' : ''); ?>>Accept To Publish
              </option>
              <option value="continue" <?php echo e(($detail->decision ?? null) == 'accept' ? 'selected' : ''); ?>>Accept To
                Review
              </option>
            <?php elseif($roleSlug == 'academic-editor'): ?>
              <option value="accept" <?php echo e(($detail->decision ?? null) == 'accept' ? 'selected' : ''); ?>>Accept</option>
              <option value="continue" <?php echo e(($detail->decision ?? null) == 'accept' ? 'selected' : ''); ?>>Accept To
                Review
              </option>
            <?php elseif($roleSlug == 'reviewer'): ?>
              <option value="accept" <?php echo e(($detail->decision ?? null) == 'accept' ? 'selected' : ''); ?>>Accept</option>
            <?php endif; ?>
            <?php if($roleSlug == 'editor-assistant'): ?>
              <option value="accept" <?php echo e(($detail->decision ?? null) == 'accept' ? 'selected' : ''); ?>>Accept</option>
              <option value="revision" <?php echo e(($detail->decision ?? null) == 'revision' ? 'selected' : ''); ?>>Needs
                Revision
              </option>
            <?php else: ?>
              <option value="minor_revision" <?php echo e(($detail->decision ?? null) == 'minor_revision' ? 'selected' : ''); ?>>
                Minor
                Revision
              </option>
              <option value="major_revision" <?php echo e(($detail->decision ?? null) == 'major_revision' ? 'selected' : ''); ?>>
                Major
                Revision
              </option>
            <?php endif; ?>
            <option value="reject" <?php echo e(($detail->decision ?? null) == 'reject' ? 'selected' : ''); ?>>Reject</option>
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

          <?php if($roleSlug == 'editor-in-chief' || $roleSlug == 'academic-editor'): ?>
            <template x-if="decision == 'continue'">
              <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'deadline','name' => 'deadline','type' => 'number','min' => '0','value' => $detail->deadline_invites ?? (null ?? 7),'required' => true,'disabled' => ($detail->submitted_at ?? null) != null,'description' => 'Deadline in days','label' => 'Deadline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'deadline','name' => 'deadline','type' => 'number','min' => '0','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($detail->deadline_invites ?? (null ?? 7)),'required' => true,'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($detail->submitted_at ?? null) != null),'description' => 'Deadline in days','label' => 'Deadline']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
            </template>
            <template x-if="decision == 'continue'">
              <?php if (isset($component)) { $__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.invite-users','data' => ['subGate' => $subGate,'label' => $roleSlug == 'editor-in-chief' ? 'Academic Editor' : 'Reviewer','labelBox' => $roleSlug == 'editor-in-chief' ? 'Invite Academic Editor' : 'Invite Reviewer','users' => $detail->invites ?? null,'isReadOnly' => ($detail->submitted_at ?? null) != null,'name' => $roleSlug == 'editor-in-chief' ? 'academic_editor' : 'reviewer','role' => $roleSlug == 'editor-in-chief' ? 'academic-editor' : 'reviewer','maxInvite' => 2,'excepts' => $manuscript->authors->pluck('id')->toArray(),'minInvite' => $roleSlug == 'editor-in-chief' ? 1 : 2]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('invite-users'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['subGate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subGate),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($roleSlug == 'editor-in-chief' ? 'Academic Editor' : 'Reviewer'),'labelBox' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($roleSlug == 'editor-in-chief' ? 'Invite Academic Editor' : 'Invite Reviewer'),'users' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($detail->invites ?? null),'isReadOnly' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($detail->submitted_at ?? null) != null),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($roleSlug == 'editor-in-chief' ? 'academic_editor' : 'reviewer'),'role' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($roleSlug == 'editor-in-chief' ? 'academic-editor' : 'reviewer'),'maxInvite' => 2,'excepts' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($manuscript->authors->pluck('id')->toArray()),'minInvite' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($roleSlug == 'editor-in-chief' ? 1 : 2)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7)): ?>
<?php $attributes = $__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7; ?>
<?php unset($__attributesOriginal0f8af43c57a67e0ad9ec35556f37eff7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7)): ?>
<?php $component = $__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7; ?>
<?php unset($__componentOriginal0f8af43c57a67e0ad9ec35556f37eff7); ?>
<?php endif; ?>
            </template>
          <?php endif; ?>

          <?php if (isset($component)) { $__componentOriginal1b606bb65de8a0565179d9555ac96c54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b606bb65de8a0565179d9555ac96c54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-editor','data' => ['id' => 'notes','label' => 'Notes','name' => 'notes','variable' => 'notes','initValue' => $detail->notes ?? null,'disabled' => ($detail->submitted_at ?? null) != null,'messages' => $errors->get('notes')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-editor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'notes','label' => 'Notes','name' => 'notes','variable' => 'notes','initValue' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($detail->notes ?? null),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($detail->submitted_at ?? null) != null),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('notes'))]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.files','data' => ['label' => 'File Attachments','files' => $detail->files ?? null,'isReadOnly' => ($detail->submitted_at ?? null) != null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('files'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'File Attachments','files' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($detail->files ?? null),'isReadOnly' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($detail->submitted_at ?? null) != null)]); ?>
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
          <?php if($task->status == 'in_progress'): ?>
            <div class="mt-4 flex items-center justify-end gap-2 border-t border-gray-300 py-2 dark:border-gray-700">
              <input type="submit" name="submit" value="Save as Draft" class="button secondary">
              <input type="submit" name="submit" value="Submit" class="button primary">
            </div>
          <?php endif; ?>
        </form>
      </div>
    <?php endif; ?>
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