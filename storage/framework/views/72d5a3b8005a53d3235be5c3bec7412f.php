<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="<?php echo e(setting('meta_description')); ?>" />
<meta name="keyword" content="<?php echo e(setting('meta_keyword')); ?>" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

<title><?php echo e($title ?? ''); ?> | <?php echo e(config('app.name')); ?></title>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('img/favicon.png')); ?>" />
<link rel="icon" type="image/png" href="<?php echo e(asset('img/favicon.png')); ?>" />
<link rel="shortcut icon" href="<?php echo e(asset('img/favicon.png')); ?>" />
<link rel="icon" type="image/ico" href="<?php echo e(asset('img/favicon.png')); ?>" />

<!-- Meta Includes -->
<?php echo $__env->make('frontend.includes.meta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Styles -->
<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app-frontend.css', 'resources/js/app-frontend.js']); ?>
<?php echo $__env->yieldPushContent('after-styles'); ?>

<!-- Google Analytics -->
<?php if (isset($component)) { $__componentOriginal5a71c2c3670795ec464153e22b9d2874 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a71c2c3670795ec464153e22b9d2874 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.google-analytics','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('google-analytics'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a71c2c3670795ec464153e22b9d2874)): ?>
<?php $attributes = $__attributesOriginal5a71c2c3670795ec464153e22b9d2874; ?>
<?php unset($__attributesOriginal5a71c2c3670795ec464153e22b9d2874); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a71c2c3670795ec464153e22b9d2874)): ?>
<?php $component = $__componentOriginal5a71c2c3670795ec464153e22b9d2874; ?>
<?php unset($__componentOriginal5a71c2c3670795ec464153e22b9d2874); ?>
<?php endif; ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/partials/head.blade.php ENDPATH**/ ?>