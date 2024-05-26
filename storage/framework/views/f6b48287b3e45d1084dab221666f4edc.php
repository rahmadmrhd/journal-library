<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>
    <?php echo e(isset($title) ? $title . ' | ' . config('app.name_alias', 'Laravel') : config('app.name', 'Laravel')); ?>

  </title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js', 'resources/js/components/alert.js']); ?>

  <?php echo $__env->yieldPushContent('head'); ?>
</head>
<?php echo $__env->yieldContent('body'); ?>

</html>
<?php /**PATH D:\Project App\Kerja Praktek\journal-library\resources\views/layouts/master.blade.php ENDPATH**/ ?>