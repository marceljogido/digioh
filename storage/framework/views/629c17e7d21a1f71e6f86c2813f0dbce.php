

<?php $__env->startSection('title'); ?> <?php echo e(__($module_action)); ?> <?php echo e(__($module_title)); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginal73d065ab05177f56255c078a05ab5686 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73d065ab05177f56255c078a05ab5686 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.breadcrumbs','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginal5e5b40e973d9c7c18a583cb81079b74e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.breadcrumb-item','data' => ['route' => ''.e(route("backend.$module_name.index")).'','icon' => ''.e($module_icon).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.breadcrumb-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route("backend.$module_name.index")).'','icon' => ''.e($module_icon).'']); ?>
            <?php echo e(__($module_title)); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e)): ?>
<?php $attributes = $__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e; ?>
<?php unset($__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e5b40e973d9c7c18a583cb81079b74e)): ?>
<?php $component = $__componentOriginal5e5b40e973d9c7c18a583cb81079b74e; ?>
<?php unset($__componentOriginal5e5b40e973d9c7c18a583cb81079b74e); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal5e5b40e973d9c7c18a583cb81079b74e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.breadcrumb-item','data' => ['type' => 'active']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.breadcrumb-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'active']); ?><?php echo e(__($module_action)); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e)): ?>
<?php $attributes = $__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e; ?>
<?php unset($__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e5b40e973d9c7c18a583cb81079b74e)): ?>
<?php $component = $__componentOriginal5e5b40e973d9c7c18a583cb81079b74e; ?>
<?php unset($__componentOriginal5e5b40e973d9c7c18a583cb81079b74e); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73d065ab05177f56255c078a05ab5686)): ?>
<?php $attributes = $__attributesOriginal73d065ab05177f56255c078a05ab5686; ?>
<?php unset($__attributesOriginal73d065ab05177f56255c078a05ab5686); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73d065ab05177f56255c078a05ab5686)): ?>
<?php $component = $__componentOriginal73d065ab05177f56255c078a05ab5686; ?>
<?php unset($__componentOriginal73d065ab05177f56255c078a05ab5686); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginald36b52f60875c92b52c37822caf252de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald36b52f60875c92b52c37822caf252de = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.layouts.edit','data' => ['data' => $service,'moduleName' => $module_name,'modulePath' => $module_path,'moduleTitle' => $module_title,'moduleIcon' => $module_icon,'moduleAction' => $module_action]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.layouts.edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service),'module_name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_name),'module_path' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_path),'module_title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_title),'module_icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_icon),'module_action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_action)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald36b52f60875c92b52c37822caf252de)): ?>
<?php $attributes = $__attributesOriginald36b52f60875c92b52c37822caf252de; ?>
<?php unset($__attributesOriginald36b52f60875c92b52c37822caf252de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald36b52f60875c92b52c37822caf252de)): ?>
<?php $component = $__componentOriginald36b52f60875c92b52c37822caf252de; ?>
<?php unset($__componentOriginald36b52f60875c92b52c37822caf252de); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/services/edit.blade.php ENDPATH**/ ?>