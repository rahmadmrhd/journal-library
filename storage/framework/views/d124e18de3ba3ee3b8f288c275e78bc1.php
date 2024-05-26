<nav role="navigation" aria-label="<?php echo e(__('Pagination Navigation')); ?>" class="flex items-center justify-between">
  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
    <div class="flex min-w-0 flex-1 items-center gap-8">
      <form class="flex items-center gap-1" method="GET">
        <label for="show" class="block text-sm font-medium text-gray-900 dark:text-white">Show</label>
        <select name="show" value="<?php echo e($paginator->perPage()); ?>" onchange="showOnChanged(event)"
          class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-2 py-1 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
          <option value="10" <?php echo e(request('show') == 10 ? 'selected' : ''); ?>>10</option>
          <option value="20" <?php echo e(request('show') == 20 ? 'selected' : ''); ?>>20</option>
          <option value="50" <?php echo e(request('show') == 50 ? 'selected' : ''); ?>>50</option>
          <option value="100" <?php echo e(request('show') == 100 ? 'selected' : ''); ?>>100</option>
          <option value="all" <?php echo e(request('show') == 'all' ? 'selected' : ''); ?>>All</option>
          <?php if(request('show') != 'all' &&
                  request('show') != '' &&
                  request('show') != '10' &&
                  request('show') != '20' &&
                  request('show') != '50' &&
                  request('show') != '100'): ?>
            <option value="<?php echo e($paginator->perPage()); ?>" selected disabled><?php echo e($paginator->perPage()); ?></option>
          <?php endif; ?>
        </select>
      </form>
      <p class="text-sm leading-5 text-gray-700 dark:text-gray-400">
        <?php echo __('Showing'); ?>

        <?php if($paginator->firstItem()): ?>
          <span class="font-medium"><?php echo e($paginator->firstItem()); ?></span>
          <?php echo __('to'); ?>

          <span class="font-medium"><?php echo e($paginator->lastItem()); ?></span>
        <?php else: ?>
          <?php echo e($paginator->count()); ?>

        <?php endif; ?>
        <?php echo __('of'); ?>

        <span class="font-medium"><?php echo e($paginator->total()); ?></span>
        <?php echo __('results'); ?>

      </p>
    </div>

    <?php if($paginator->hasPages()): ?>
      <ul class="flex h-8 items-center -space-x-px text-sm">
        
        <?php if($paginator->onFirstPage()): ?>
          <span href="#" aria-disabled="true" aria-label="<?php echo e(__('pagination.previous')); ?>"
            class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 dark:border-gray-600 dark:bg-gray-800">
            <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 1 1 5l4 4" />
            </svg>
          </span>
        <?php else: ?>
          <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo e(__('pagination.previous')); ?>"
            class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:!text-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
            <span class="sr-only">Previous</span>
            <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 1 1 5l4 4" />
            </svg>
          </a>
        <?php endif; ?>


        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
          <?php if(is_string($element)): ?>
            <span aria-disabled="true">
              <span
                class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 dark:border-gray-600 dark:bg-gray-800"><?php echo e($element); ?></span>
            </span>
          <?php endif; ?>

          
          <?php if(is_array($element)): ?>
            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($page == $paginator->currentPage()): ?>
                <span aria-current="page">
                  <span
                    class="relative z-10 -ml-px inline-flex h-8 cursor-default items-center border border-gray-300 bg-blue-700 px-3 text-sm font-medium leading-tight text-white dark:border-gray-600"><?php echo e($page); ?></span>
                </span>
              <?php else: ?>
                <a class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:!text-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
                  href="<?php echo e($url); ?>" aria-label="<?php echo e(__('Go to page :page', ['page' => $page])); ?>">
                  <?php echo e($page); ?>

                </a>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        
        <?php if($paginator->hasMorePages()): ?>
          <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo e(__('pagination.next')); ?>"
            class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:!text-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
            <span class="sr-only">Next</span>
            <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 9 4-4-4-4" />
            </svg>
          </a>
        <?php else: ?>
          <span aria-disabled="true" aria-label="<?php echo e(__('pagination.next')); ?>"
            class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 dark:border-gray-600 dark:bg-gray-800">
            <span class="sr-only">Next</span>
            <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 9 4-4-4-4" />
            </svg>
          </span>
        <?php endif; ?>
      </ul>
    <?php endif; ?>
  </div>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/js/components/pagination.js']); ?>
</nav>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/components/pagination.blade.php ENDPATH**/ ?>