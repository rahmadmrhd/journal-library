<?php if (isset($component)) { $__componentOriginala6488acc797ee40bc55ed6344dee8ea1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6488acc797ee40bc55ed6344dee8ea1 = $attributes; } ?>
<?php $component = App\View\Components\AuthLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('auth-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AuthLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
  <div class="relative flex w-full flex-col items-center justify-end p-4 dark:divide-gray-700 sm:flex-row">
    <div class="w-full">
      <?php if (isset($component)) { $__componentOriginal658ef33603e1ca2f78ce9edf336217b6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal658ef33603e1ca2f78ce9edf336217b6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-image','data' => ['class' => 'max-w-96 mx-auto h-full w-full fill-current text-blue-700 dark:text-sky-900 sm:h-96 sm:w-96']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('auth-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-w-96 mx-auto h-full w-full fill-current text-blue-700 dark:text-sky-900 sm:h-96 sm:w-96']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal658ef33603e1ca2f78ce9edf336217b6)): ?>
<?php $attributes = $__attributesOriginal658ef33603e1ca2f78ce9edf336217b6; ?>
<?php unset($__attributesOriginal658ef33603e1ca2f78ce9edf336217b6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal658ef33603e1ca2f78ce9edf336217b6)): ?>
<?php $component = $__componentOriginal658ef33603e1ca2f78ce9edf336217b6; ?>
<?php unset($__componentOriginal658ef33603e1ca2f78ce9edf336217b6); ?>
<?php endif; ?>
    </div>

    <div class="sm:min-w-80 my-6 w-full sm:my-0 sm:pl-6">
      <div class="mb-6 mt-4">
        <div class="mb-6">
          <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold"><?php echo e('Welcome'); ?></h1>
            <?php if (isset($component)) { $__componentOriginal7e1bed0f6ee7d1b97e403070a0a4cdd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7e1bed0f6ee7d1b97e403070a0a4cdd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toggle-theme','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('toggle-theme'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7e1bed0f6ee7d1b97e403070a0a4cdd4)): ?>
<?php $attributes = $__attributesOriginal7e1bed0f6ee7d1b97e403070a0a4cdd4; ?>
<?php unset($__attributesOriginal7e1bed0f6ee7d1b97e403070a0a4cdd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7e1bed0f6ee7d1b97e403070a0a4cdd4)): ?>
<?php $component = $__componentOriginal7e1bed0f6ee7d1b97e403070a0a4cdd4; ?>
<?php unset($__componentOriginal7e1bed0f6ee7d1b97e403070a0a4cdd4); ?>
<?php endif; ?>
          </div>
          <h3 class="text-sm text-gray-800 dark:text-gray-300">Login to continue</h3>
        </div>

        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'error','timeout' => 5000,'messages' => count($errors->get('status')) > 0 ? $errors->get('status') : session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','timeout' => 5000,'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(count($errors->get('status')) > 0 ? $errors->get('status') : session('status'))]); ?>
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
        <form method="POST" action="<?php echo e(route('login', $subGate->slug, absolute: false)); ?>">
          <?php echo csrf_field(); ?>
          <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['label' => __('Email or Username'),'id' => 'emailOrUsername','name' => 'emailOrUsername','type' => 'text','value' => old('emailOrUsername'),'required' => true,'autofocus' => true,'autocomplete' => 'username','messages' => $errors->get('emailOrUsername'),'status' => $errors->has('emailOrUsername') ? 'error' : '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Email or Username')),'id' => 'emailOrUsername','name' => 'emailOrUsername','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('emailOrUsername')),'required' => true,'autofocus' => true,'autocomplete' => 'username','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('emailOrUsername')),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->has('emailOrUsername') ? 'error' : '')]); ?>
             <?php $__env->slot('icon', null, []); ?> 
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
              </svg>
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
          <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'mt-3','label' => __('Password'),'id' => 'password','name' => 'password','type' => 'password','value' => old('password'),'required' => true,'autofocus' => true,'autocomplete' => 'current_password','messages' => $errors->get('password'),'status' => $errors->has('password') ? 'error' : '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-3','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Password')),'id' => 'password','name' => 'password','type' => 'password','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('password')),'required' => true,'autofocus' => true,'autocomplete' => 'current_password','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->has('password') ? 'error' : '')]); ?>
             <?php $__env->slot('icon', null, []); ?> 
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
              </svg>
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

          <!-- Remember Me -->
          <div class="mt-4 flex items-center justify-between gap-2">
            <label for="remember_me" class="inline-flex items-center">
              <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
                name="remember">
              <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"><?php echo e(__('Remember me')); ?></span>
            </label>
            <?php if(Route::has('password.request')): ?>
              <a class="rounded-md text-sm text-gray-600 hover:text-gray-900 hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                href="<?php echo e(route('password.request', $subGate->slug, absolute: false)); ?>">
                <?php echo e(__('Forgot your password?')); ?>

              </a>
            <?php endif; ?>
          </div>

          <div class="mt-6 flex items-center justify-start gap-4">
            <button
              class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
              Log In
            </button>
            <small class="text-gray-600 dark:text-gray-400">OR</small>
            <a href="<?php echo e(Illuminate\Support\Facades\Config::get('orcid.auth_link') . '/auth'); ?>" title="Login with ORCID"
              class="inline-block h-8 w-8 rounded-full bg-white shadow-md focus:outline-none focus:ring-2 focus:ring-lime-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
              <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-[#a6ce39] focus:text-lime-300 dark:hover:text-lime-300" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
              </svg>
            </a>
          </div>
          <div class="mt-6 gap-4 text-sm text-gray-600 dark:text-gray-400">
            Not a Member?
            <a class="text-blue-600 hover:text-gray-900 focus:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-blue-500 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
              href="<?php echo e(route('register', $subGate->slug, absolute: false)); ?>">
              Sign Up
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6488acc797ee40bc55ed6344dee8ea1)): ?>
<?php $attributes = $__attributesOriginala6488acc797ee40bc55ed6344dee8ea1; ?>
<?php unset($__attributesOriginala6488acc797ee40bc55ed6344dee8ea1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6488acc797ee40bc55ed6344dee8ea1)): ?>
<?php $component = $__componentOriginala6488acc797ee40bc55ed6344dee8ea1; ?>
<?php unset($__componentOriginala6488acc797ee40bc55ed6344dee8ea1); ?>
<?php endif; ?>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/auth/login.blade.php ENDPATH**/ ?>