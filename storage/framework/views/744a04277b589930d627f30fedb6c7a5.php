<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(language_direction()); ?>">
    <head>
        <?php echo $__env->make('partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </head>

    <body>
        <!-- Header -->
        <?php echo $__env->make('frontend.includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <main class="">
            <?php echo e($slot); ?>

        </main>

        <!-- Footer -->
        <?php echo $__env->make('frontend.includes.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Scripts -->
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

        <?php echo $__env->yieldPushContent('after-scripts'); ?>
    </body>
</html><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>