<?php $__env->startPush('head'); ?>
  <meta name="_token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>
<form id="manuscript-form" method="POST" action="<?php echo e(route('manuscripts.storeBasicInformation', $manuscript->id)); ?>"
  class="flex flex-col gap-y-3">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>
  <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12','type' => 'textarea','rows' => '2','label' => 'Title','id' => 'title','name' => 'title','required' => true,'disabled' => $manuscript->isReview,'autofocus' => true,'status' => $errors->has('title') ? 'error' : '','messages' => $errors->get('title'),'value' => old('title', $manuscript->title ?? '')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12','type' => 'textarea','rows' => '2','label' => 'Title','id' => 'title','name' => 'title','required' => true,'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($manuscript->isReview),'autofocus' => true,'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->has('title') ? 'error' : ''),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('title')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('title', $manuscript->title ?? ''))]); ?>
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

  <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12','type' => 'select','label' => 'Please choose a category for your paper','id' => 'category_id','name' => 'category_id','disabled' => $manuscript->isReview,'required' => true,'autofocus' => true,'status' => $errors->has('category_id') ? 'error' : '','messages' => $errors->get('category_id'),'value' => old('category_id', $manuscript->category->id ?? '')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12','type' => 'select','label' => 'Please choose a category for your paper','id' => 'category_id','name' => 'category_id','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($manuscript->isReview),'required' => true,'autofocus' => true,'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->has('category_id') ? 'error' : ''),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('category_id')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('category_id', $manuscript->category->id ?? ''))]); ?>
    <option selected disabled>-- Select Category --</option>
    <?php if($manuscript->isReview && isset($manuscript->category->id)): ?>
      <option value="<?php echo e($manuscript->category->id); ?>" disabled selected><?php echo e($manuscript->category->name); ?></option>
    <?php else: ?>
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($category->id); ?>"
          <?php echo e(old('category_id', $manuscript->category->id ?? '') == $category->id ? 'selected' : ''); ?>>
          <?php echo e($category->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
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

  <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12','type' => 'textarea','rows' => '5','label' => 'Abstract','id' => 'abstract','name' => 'abstract','disabled' => $manuscript->isReview,'required' => true,'autofocus' => true,'status' => $errors->has('abstract') ? 'error' : '','messages' => $errors->get('abstract'),'value' => old('abstract', $manuscript->abstract ?? '')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12','type' => 'textarea','rows' => '5','label' => 'Abstract','id' => 'abstract','name' => 'abstract','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($manuscript->isReview),'required' => true,'autofocus' => true,'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->has('abstract') ? 'error' : ''),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('abstract')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('abstract', $manuscript->abstract ?? ''))]); ?>
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

  <div class="relative w-full" x-data="{
      keywords: <?php echo \Illuminate\Support\Js::from(old('keywords', $manuscript->keywords ?? []))->toHtml() ?>,
      optionsKeyword: [],
      inputFocused: false,
      dropdownFocused: false,
      search: '',
  }" x-init="$watch('search', val => searchKeywords(val, (result) => optionsKeyword = result))">
    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'col-span-12','type' => 'custom','rows' => '5','label' => 'Keywords','required' => true,'status' => $errors->has('keywords') ? 'error' : '','messages' => $errors->get('keywords'),'disabled' => $manuscript->isReview,'description' => 'Press enter to add more keywords']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-12','type' => 'custom','rows' => '5','label' => 'Keywords','required' => true,'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->has('keywords') ? 'error' : ''),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('keywords')),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($manuscript->isReview),'description' => 'Press enter to add more keywords']); ?>
      <ul class="input-text !flex w-full max-w-full !flex-wrap gap-2 p-2" focusable
        x-on:click="$refs.keywordInput.focus()">
        <template x-for="keyword in keywords" key="index">
          <li class="flex w-fit max-w-full items-center !rounded-full bg-white shadow-md dark:bg-gray-600">
            <span x-text="keyword"
              class="<?php if(!$manuscript->isReview): ?> border-r <?php endif; ?> text-ellipsis border-gray-100 px-2 py-1 text-sm dark:border-gray-700"></span>
            <?php if(!$manuscript->isReview): ?>
              <button type="button" x-on:click.prevent="keywords.splice(keywords.indexOf(keyword), 1)"
                class="button mr-1 border-none !p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z" />
                </svg>
              </button>
            <?php endif; ?>
            <input type="checkbox" class="hidden" name="keywords[]" x-bind:value="keyword" x-model="keywords">
          </li>
        </template>
        <input <?php echo $manuscript->isReview ? 'disabled' : ''; ?>

          class="flex-[1_1_auto] !border-none bg-gray-50 !py-0 text-sm text-gray-900 !outline-none !ring-0 dark:!bg-gray-700 dark:!text-white"
          type="text" x-ref="keywordInput" id="keywordsDropdownTrigger" x-on:focus="inputFocused=true"
          x-on:focusout="inputFocused=false" x-model.debounce.500ms="search"
          x-on:keydown="
            inputFocused=true;
            if(event.keyCode==13 && $el.value && keywords.indexOf($el.value)==-1 && $el.value.length >= 3){
              keywords.push($el.value); 
              $el.value='';
            }
            if((event.keyCode==8 || event.keyCode==46) && !$el.value){
              keywords.pop();
            } 
            if(!(/[0-9a-zA-Z\-\_\s]/i.test(event.key)) || event.keyCode==13) {
              event.preventDefault();
            }">
      </ul>
      
      <div focusable id="dropdownUsers" x-show="dropdownFocused||inputFocused" x-on:mouseover="dropdownFocused=true"
        x-on:mouseleave="dropdownFocused=false"
        class="top absolute z-10 mt-1 h-auto w-full rounded-lg bg-white shadow dark:bg-gray-700">
        <ul
          class="max-h-48 divide-y divide-gray-100 overflow-y-auto text-gray-700 dark:divide-gray-600 dark:text-gray-200"
          aria-labelledby="keywordsDropdownTrigger">
          <template x-for="keyword in optionsKeyword.filter(key => keywords.indexOf(key) < 0)">
            <li>
              <button type="button" class="button w-full !normal-case"
                x-on:click.prevent.stop="keywords.push(keyword); $refs.keywordInput.value=''; $refs.keywordInput.focus()">
                <span x-text="keyword"></span>
              </button>
            </li>
          </template>
        </ul>
      </div>
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
</form>

<?php echo app('Illuminate\Foundation\Vite')(['resources/js/form-submission/basic-information.js']); ?>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/pages/manuscripts/form/basic-information.blade.php ENDPATH**/ ?>