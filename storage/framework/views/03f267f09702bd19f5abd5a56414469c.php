<!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
    <div class="alert alert-danger" role="alert">
        <p>
            <i class="fa fa-exclamation-triangle"></i>
            <?php echo e(__("Please fix the following errors & try again!")); ?>

        </p>
        <ul>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </ul>
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->

<?php if (isset($component)) { $__componentOriginal96031147be5983e70892f56ce73af4cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal96031147be5983e70892f56ce73af4cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.flash-message','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.flash-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal96031147be5983e70892f56ce73af4cf)): ?>
<?php $attributes = $__attributesOriginal96031147be5983e70892f56ce73af4cf; ?>
<?php unset($__attributesOriginal96031147be5983e70892f56ce73af4cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal96031147be5983e70892f56ce73af4cf)): ?>
<?php $component = $__componentOriginal96031147be5983e70892f56ce73af4cf; ?>
<?php unset($__componentOriginal96031147be5983e70892f56ce73af4cf); ?>
<?php endif; ?>

<!--[if BLOCK]><![endif]--><?php if(session("status")): ?>
    <p class="alert alert-success"><?php echo e(session("status")); ?></p>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/frontend/includes/messages.blade.php ENDPATH**/ ?>