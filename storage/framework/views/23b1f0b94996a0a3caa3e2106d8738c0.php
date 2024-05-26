<form id="manuscript-form" action="<?php echo e(route('manuscripts.storeAuthors', $manuscript->id)); ?>" method="POST"
  class="flex flex-col gap-y-3" x-data="{
      show: <?php echo \Illuminate\Support\Js::from(old('isSoleAuthor', $manuscript->isSoleAuthor ?? true))->toHtml() ?> ? 1 : '',
      authors: Object.values(<?php echo \Illuminate\Support\Js::from($manuscript->authors ?? [])->toHtml() ?>),
      listAuthor: [],
      inputFocused: false,
      dropdownFocused: false,
      search: '',
  }" x-init="$watch('search', val => searchAuthors(val, (result) => listAuthor = result));"
  x-on:submit-sole-author.window="show = 1; authors = []">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>

  

  <div class="">
    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['disabled' => $manuscript->isReview,'xModel' => 'show','type' => 'radio','options' => [
        [
            'label' => 'I am the sole Author',
            'value' => true,
        ],
        [
            'label' => 'I have a Co-Author',
            'value' => false,
        ],
    ],'label' => 'Please confirm that you have entered the details of all your co-authors as these cannot be added to a paper once submitted or post-acceptance.','id' => 'isSoleAuthor','name' => 'isSoleAuthor','required' => true,'xOn:click' => '
        if(event.target.value == 1 && authors.length > 0) {
          $dispatch(\'open-modal\',\'modal-confirm-sole-author\');
          event.preventDefault();
        }
      ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($manuscript->isReview),'x-model' => 'show','type' => 'radio','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        [
            'label' => 'I am the sole Author',
            'value' => true,
        ],
        [
            'label' => 'I have a Co-Author',
            'value' => false,
        ],
    ]),'label' => 'Please confirm that you have entered the details of all your co-authors as these cannot be added to a paper once submitted or post-acceptance.','id' => 'isSoleAuthor','name' => 'isSoleAuthor','required' => true,'x-on:click' => '
        if(event.target.value == 1 && authors.length > 0) {
          $dispatch(\'open-modal\',\'modal-confirm-sole-author\');
          event.preventDefault();
        }
      ']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

    
    <div x-show="!show" class="relative mt-6 w-full">
      <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 xl:col-span-12','type' => 'search','label' => 'Add Author','id' => 'search_author','placeholder' => 'Search Authors','description' => 'Search by name, email, username, or ORCID','name' => 'search_author','xOn:focus' => 'inputFocused=true','xOn:focusout' => 'inputFocused=false','xModel.debounce.500ms' => 'search','xRef' => 'search','xOn:keydown' => '
            inputFocused=true;
            if(event.keyCode==13) { // 13 = enter
              event.preventDefault();
            }']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 xl:col-span-12','type' => 'search','label' => 'Add Author','id' => 'search_author','placeholder' => 'Search Authors','description' => 'Search by name, email, username, or ORCID','name' => 'search_author','x-on:focus' => 'inputFocused=true','x-on:focusout' => 'inputFocused=false','x-model.debounce.500ms' => 'search','x-ref' => 'search','x-on:keydown' => '
            inputFocused=true;
            if(event.keyCode==13) { // 13 = enter
              event.preventDefault();
            }']); ?>
        <?php $__env->slot('icon'); ?>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M15.5 12c2.5 0 4.5 2 4.5 4.5c0 .88-.25 1.71-.69 2.4l3.08 3.1L21 23.39l-3.12-3.07c-.69.43-1.51.68-2.38.68c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5m0 2a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5M10 4a4 4 0 0 1 4 4c0 .91-.31 1.75-.82 2.43c-.86.32-1.63.83-2.27 1.47L10 12a4 4 0 0 1-4-4a4 4 0 0 1 4-4M2 20v-2c0-2.12 3.31-3.86 7.5-4c-.32.78-.5 1.62-.5 2.5c0 1.29.38 2.5 1 3.5z" />
          </svg>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('ext'); ?>
          <button type="button" class="button primary">Create New Co-Author</button>
        <?php $__env->endSlot(); ?>
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
      
      <div focusable x-show="(dropdownFocused||inputFocused) && listAuthor.length > 0"
        x-on:mouseover="dropdownFocused=true" x-on:mouseleave="dropdownFocused=false"
        class="absolute z-10 mt-1 h-auto w-full rounded-lg bg-gray-50 px-4 pb-2 shadow-md dark:bg-gray-700">
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
          <template x-for="author in listAuthor.filter(key => authors.indexOf(key) < 0)">
            <tr
              class="cursor-pointer border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600"
              x-on:click.prevent.stop="
              if(authors.findIndex(key => key.id == author.id) < 0 && author.id != <?php echo \Illuminate\Support\Js::from(request()->user()->id)->toHtml() ?>){
              authors.push(author); 
              $refs.search.value=''; 
              $refs.search.focus();
            }else{
              showAlert('error', { messages: 'Author has already been added!', closeable: true, timeout: 5000 });
            }">
              <td valign="top" class="max-w-64px truncate px-6 py-2">
                <div class="flex flex-col items-start">
                  <h3 class="text-base font-bold" x-text="author.full_name"></h3>
                  <p class="mt-4 text-sm font-normal" x-text="author.email"></p>
                  <template x-if="author.orcid_id">
                    <div class="mt-2 flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                      </svg>
                      <p x-text="author.orcid_id" class="text-sm font-normal">
                      </p>
                    </div>
                  </template>
                </div>
              </td>
              <td valign="top" class="px-6 py-2">
                <div class="flex flex-col items-start">
                  <p class="text-sm font-bold"
                    x-text="`${author.institution ? `${author.institution}, ` : ''}${author.department ? `${author.department}, ` : ''}${author.position??''}`">
                  </p>
                  <p class="text-sm font-normal" x-text="author.address"></p>
                  <p class="text-sm font-normal"
                    x-text="`${author.city ? `${author.city}, ` : ''}${author.province ? `${author.province}, ` : ''}${author.country ? `${author.country}, ` : ''}${author.postal_code ? `ID ${author.postal_code}` : ''}`">
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

  </div>

  
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
    <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
      <?php
        $user = Auth::user();
      ?>
      <td valign="top" class="max-w-64px truncate px-6 py-2">
        <div class="flex flex-col items-start">
          <h3 class="text-base font-bold"><?php echo e($user->getFullName()); ?></h3>
          <p class="text-sm italic">(Corresponding Author)</p>
          <a class="mt-4 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline"><?php echo e($user->email); ?>

          </a>
          <?php if($user->orcid_id): ?>
            <div class="mt-2 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
              </svg>
              <a href="https://orcid.org/"
                class="text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">
                <?php echo e($user->orcid_id); ?>

              </a>
            </div>
          <?php endif; ?>
        </div>
      </td>
      <td valign="top" class="px-6 py-2">
        <div class="flex flex-col items-start">
          <p class="text-sm font-bold">
            <?php echo e($user->institution ? $user->institution . ',' : ''); ?>

          </p>
          <p class="text-sm">
            <?php echo e($user->department ? $user->department . ',' : ''); ?>

            <?php echo e($user->position); ?>

          </p>
          <p class="mt-5 text-sm font-normal"><?php echo e($user->address); ?>

          </p>
          <p class="text-sm font-normal">
            <?php echo e($user->city ? $user->city . ',' : ''); ?>

            <?php echo e($user->province ? $user->province . ',' : ''); ?>

            <?php echo e($user->country?->name ? $user->country?->name . ',' : ''); ?>

            <?php echo e($user->postal_code ? 'ID ' . $user->postal_code : ''); ?>

          </p>
        </div>
      </td>
      <?php if(!isset($manuscript->isReview)): ?>
        <td class="w-[100px] space-x-1 whitespace-nowrap p-4"></td>
      <?php endif; ?>
    </tr>
    <template x-for="(author, index) in authors">
      <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
        <td valign="top" class="max-w-64px truncate px-6 py-2">
          <div class="flex flex-col items-start">
            <input type="hidden" name="authorsId[]" x-model="author.id">
            <h3 class="text-base font-bold" x-text="author.full_name"></h3>
            <p class="mt-6 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline"
              x-text="author.email"></p>
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
        <td valign="top" class="px-6 py-2">
          <div class="flex flex-col items-start">
            <p class="text-sm font-bold" x-text="`${author.institution ? `${author.institution}, ` : ''}`">
            </p>
            <p class="text-sm" x-text="`${author.department ? `${author.department}, ` : ''}${author.position??''}`">
            </p>
            <p class="mt-3 text-sm font-normal" x-text="author.address"></p>
            <p class="text-sm font-normal"
              x-text="`${author.city ? `${author.city}, ` : ''}${author.province ? `${author.province}, ` : ''}${author.country?.name ? `${author.country?.name}, ` : ''}${author.postal_code ? `ID ${author.postal_code}` : ''}`">
            </p>
          </div>
        </td>
        <?php if(!isset($manuscript->isReview)): ?>
          <td class="w-[100px] space-x-1 whitespace-nowrap p-4">
            <button type="button" class="button error !p-2"
              x-on:click.stop="authors.splice(authors.findIndex((f)=>f.id == author.id), 1)">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
              </svg>
            </button>
          </td>
        <?php endif; ?>
        
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

</form>


<?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'add-coauthor-manually','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'add-coauthor-manually','focusable' => true]); ?>

  <div class="md:min-w-96 relative w-full self-start sm:max-h-full sm:self-center lg:w-[760px]">
    <div class="relative h-full bg-white shadow dark:bg-gray-800 sm:max-h-full sm:rounded-lg">
      <form id="funder-form" action="" method="POST" x-data="{
          index: -1,
          name: '',
          grants: [''],
      }" x-init="$watch('show', value => {
          if (!show) {
              name = '';
              grants = [''];
              index = -1;
          }
      });"
        x-on:edit-funding.window="name = $event.detail.name; grants = $event.detail.grants; index = $event.detail.index; "
        x-on:submit.prevent="
        index >= 0 ? $dispatch('update-funding', {name:name, grants:[...grants]}) :
        $dispatch('add-funding', {name:name, grants:[...grants], index:index});
        $dispatch('close')">
        
        <div
          class="flex w-full items-start justify-between rounded-t border-b p-5 dark:border-gray-700 dark:bg-gray-800">
          <h3 id="modal-title" class="text-xl font-semibold dark:text-white"
            x-text="index >= 0 ? 'Edit Funder' : 'Add Funder'"></h3>
        </div>

        
        <div class="mt-0 space-y-6 p-6">
          <form action="<?php echo e(route('profile.update', absolute: false)); ?>" method="POST" class="space-y-6">
            <div class="card divide-y-2 divide-gray-200 dark:divide-gray-700">
              <header class="">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                  <?php echo e(__('Personal Information')); ?>

                </h2>

              </header>
              <div class="grid max-w-screen-xl grid-cols-12 gap-x-6 gap-y-2 pt-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-4 xl:col-span-2','label' => __('Title'),'id' => 'title','name' => 'title','type' => 'text','value' => old('title', $user->title),'placeholder' => '(Dr., Mr., Mrs., etc.)','autocomplete' => 'title','messages' => $errors->get('title')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-4 xl:col-span-2','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Title')),'id' => 'title','name' => 'title','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('title', $user->title)),'placeholder' => '(Dr., Mr., Mrs., etc.)','autocomplete' => 'title','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('title'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-8 xl:col-span-4','label' => __('First Name'),'id' => 'first_name','name' => 'first_name','type' => 'text','value' => old('first_name', $user->first_name),'required' => true,'autocomplete' => 'first_name','messages' => $errors->get('first_name')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-8 xl:col-span-4','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('First Name')),'id' => 'first_name','name' => 'first_name','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('first_name', $user->first_name)),'required' => true,'autocomplete' => 'first_name','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('first_name'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-8 xl:col-span-4','label' => __('Last Name'),'id' => 'last_name','name' => 'last_name','type' => 'text','value' => old('last_name', $user->last_name),'required' => true,'autocomplete' => 'last_name','messages' => $errors->get('last_name')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-8 xl:col-span-4','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Last Name')),'id' => 'last_name','name' => 'last_name','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('last_name', $user->last_name)),'required' => true,'autocomplete' => 'last_name','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('last_name'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-4 xl:col-span-2','label' => __('Degree'),'id' => 'degree','name' => 'degree','type' => 'text','value' => old('degree', $user->degree),'autocomplete' => 'degree','messages' => $errors->get('degree'),'placeholder' => '(Ph.D., M.D., etc.)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-4 xl:col-span-2','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Degree')),'id' => 'degree','name' => 'degree','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('degree', $user->degree)),'autocomplete' => 'degree','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('degree')),'placeholder' => '(Ph.D., M.D., etc.)']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-9 xl:col-span-7','label' => __('Preferred Name (nickname)'),'id' => 'preferred_name','name' => 'preferred_name','type' => 'text','value' => old('preferred_name', $user->preferred_name),'autocomplete' => 'preferred_name','messages' => $errors->get('preferred_name')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-9 xl:col-span-7','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Preferred Name (nickname)')),'id' => 'preferred_name','name' => 'preferred_name','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('preferred_name', $user->preferred_name)),'autocomplete' => 'preferred_name','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('preferred_name'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
              </div>

            </div>

            <div class="card divide-y-2 divide-gray-200 dark:divide-gray-700">
              <header class="">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                  <?php echo e(__('Institution Related Information')); ?>

                </h2>
              </header>

              <div class="grid max-w-screen-xl grid-cols-12 gap-x-6 gap-y-2 pt-6">
                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-9 xl:col-span-7','label' => __('Institution'),'id' => 'institution','name' => 'institution','type' => 'text','value' => old('institution', $user->institution),'required' => true,'autocomplete' => 'institution','messages' => $errors->get('institution')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-9 xl:col-span-7','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Institution')),'id' => 'institution','name' => 'institution','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('institution', $user->institution)),'required' => true,'autocomplete' => 'institution','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('institution'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-6','label' => __('Department'),'id' => 'department','name' => 'department','type' => 'text','value' => old('department', $user->department),'required' => true,'autocomplete' => 'department','messages' => $errors->get('department')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-6','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Department')),'id' => 'department','name' => 'department','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('department', $user->department)),'required' => true,'autocomplete' => 'department','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('department'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-6','label' => __('Position'),'id' => 'position','name' => 'position','type' => 'text','value' => old('position', $user->position),'autocomplete' => 'position','messages' => $errors->get('position')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-6','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Position')),'id' => 'position','name' => 'position','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('position', $user->position)),'autocomplete' => 'position','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('position'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12','label' => __('Address'),'id' => 'address','name' => 'address','type' => 'textarea','value' => old('address', $user->address),'rows' => '2','required' => true,'autocomplete' => 'address','messages' => $errors->get('address')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Address')),'id' => 'address','name' => 'address','type' => 'textarea','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('address', $user->address)),'rows' => '2','required' => true,'autocomplete' => 'address','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('address'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-6 xl:col-span-4','label' => __('City'),'id' => 'city','name' => 'city','type' => 'text','value' => old('city', $user->city),'required' => true,'autocomplete' => 'city','messages' => $errors->get('city')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-6 xl:col-span-4','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('City')),'id' => 'city','name' => 'city','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('city', $user->city)),'required' => true,'autocomplete' => 'city','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('city'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-6 xl:col-span-4','label' => __('State or Province'),'id' => 'province','name' => 'province','type' => 'text','value' => old('province', $user->province),'required' => true,'autocomplete' => 'province','messages' => $errors->get('province')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-6 xl:col-span-4','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('State or Province')),'id' => 'province','name' => 'province','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('province', $user->province)),'required' => true,'autocomplete' => 'province','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('province'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-6 xl:col-span-4','label' => __('Postal Code or Zip'),'id' => 'postal_code','name' => 'postal_code','type' => 'text','value' => old('postal_code', $user->postal_code),'required' => true,'autocomplete' => 'postal_code','messages' => $errors->get('postal_code')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-6 xl:col-span-4','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Postal Code or Zip')),'id' => 'postal_code','name' => 'postal_code','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('postal_code', $user->postal_code)),'required' => true,'autocomplete' => 'postal_code','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('postal_code'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12 sm:col-span-9 xl:col-span-7','label' => __('Country'),'id' => 'country','name' => 'country','type' => 'select','value' => old('country', $user->country),'required' => true,'autocomplete' => 'country','messages' => $errors->get('country')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12 sm:col-span-9 xl:col-span-7','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Country')),'id' => 'country','name' => 'country','type' => 'select','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('country', $user->country)),'required' => true,'autocomplete' => 'country','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('country'))]); ?>
                  <option value="" selected disabled>-- <?php echo e(__('Select Country')); ?> --</option>
                  <?php $__currentLoopData = $countries ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($country['code']); ?>"
                      <?php echo e(old('country', $user->country) == $country['code'] ? 'selected' : ''); ?>>
                      <?php echo e($country['name']); ?>

                    </option>
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

              </div>

            </div>
            <div class="divide-y-2 divide-gray-200 dark:divide-gray-700">
              <div class="flex items-center gap-4">
                <button class="button primary">Save</button>
              </div>
            </div>
          </form>

        </div>

        
        <div class="flex items-center gap-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-700">
          <button id="submit-modal-btn" class="button primary" type="submit">
            Add
          </button>
          <button type="button" x-on:click.prevent="$dispatch('close')" class="button secondary">
            Cancel
          </button>
        </div>
      </form>
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


<?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'modal-confirm-sole-author','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'modal-confirm-sole-author','focusable' => true]); ?>
  <div class="max-w-2xl p-4 text-center md:p-5">
    <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
      <?php echo e(__('Are you sure you are the sole Author? If so, all Co-Authors you have added will be removed.')); ?>

    </h3>
    <div class="flex justify-center gap-3">
      <button id="submit-modal-btn" type="button" class="button primary"
        x-on:click="$dispatch('close'); $dispatch('submit-sole-author')">
        <?php echo e(__('Yes, I am the sole Author')); ?>

      </button>
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

<?php echo app('Illuminate\Foundation\Vite')('resources/js/form-submission/authors-institutions.js'); ?>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/pages/manuscripts/form/authors-institutions.blade.php ENDPATH**/ ?>