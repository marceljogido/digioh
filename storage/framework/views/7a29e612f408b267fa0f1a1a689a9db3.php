<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class' => 'my-6 flex justify-center space-x-6']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['class' => 'my-6 flex justify-center space-x-6']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => $class])); ?>>
    <?php if (isset($component)) { $__componentOriginal7cb3ac0e6d29b71866d61c1cdc3467a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cb3ac0e6d29b71866d61c1cdc3467a5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.website_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.website_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cb3ac0e6d29b71866d61c1cdc3467a5)): ?>
<?php $attributes = $__attributesOriginal7cb3ac0e6d29b71866d61c1cdc3467a5; ?>
<?php unset($__attributesOriginal7cb3ac0e6d29b71866d61c1cdc3467a5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cb3ac0e6d29b71866d61c1cdc3467a5)): ?>
<?php $component = $__componentOriginal7cb3ac0e6d29b71866d61c1cdc3467a5; ?>
<?php unset($__componentOriginal7cb3ac0e6d29b71866d61c1cdc3467a5); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala179f6485965f9712e9f4438282a6da4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala179f6485965f9712e9f4438282a6da4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.instagram_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.instagram_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala179f6485965f9712e9f4438282a6da4)): ?>
<?php $attributes = $__attributesOriginala179f6485965f9712e9f4438282a6da4; ?>
<?php unset($__attributesOriginala179f6485965f9712e9f4438282a6da4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala179f6485965f9712e9f4438282a6da4)): ?>
<?php $component = $__componentOriginala179f6485965f9712e9f4438282a6da4; ?>
<?php unset($__componentOriginala179f6485965f9712e9f4438282a6da4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal883415bda26e38a22de70aa073118938 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883415bda26e38a22de70aa073118938 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.facebook_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.facebook_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal883415bda26e38a22de70aa073118938)): ?>
<?php $attributes = $__attributesOriginal883415bda26e38a22de70aa073118938; ?>
<?php unset($__attributesOriginal883415bda26e38a22de70aa073118938); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal883415bda26e38a22de70aa073118938)): ?>
<?php $component = $__componentOriginal883415bda26e38a22de70aa073118938; ?>
<?php unset($__componentOriginal883415bda26e38a22de70aa073118938); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc7f1447138c3d9189e7941fbec9a6db2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7f1447138c3d9189e7941fbec9a6db2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.twitter_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.twitter_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7f1447138c3d9189e7941fbec9a6db2)): ?>
<?php $attributes = $__attributesOriginalc7f1447138c3d9189e7941fbec9a6db2; ?>
<?php unset($__attributesOriginalc7f1447138c3d9189e7941fbec9a6db2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7f1447138c3d9189e7941fbec9a6db2)): ?>
<?php $component = $__componentOriginalc7f1447138c3d9189e7941fbec9a6db2; ?>
<?php unset($__componentOriginalc7f1447138c3d9189e7941fbec9a6db2); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal9e394dcad86405fa8456f31f5ca8f4cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9e394dcad86405fa8456f31f5ca8f4cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.youtube_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.youtube_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9e394dcad86405fa8456f31f5ca8f4cf)): ?>
<?php $attributes = $__attributesOriginal9e394dcad86405fa8456f31f5ca8f4cf; ?>
<?php unset($__attributesOriginal9e394dcad86405fa8456f31f5ca8f4cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9e394dcad86405fa8456f31f5ca8f4cf)): ?>
<?php $component = $__componentOriginal9e394dcad86405fa8456f31f5ca8f4cf; ?>
<?php unset($__componentOriginal9e394dcad86405fa8456f31f5ca8f4cf); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal05ebc73cbf10977681feb8cdde62256e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal05ebc73cbf10977681feb8cdde62256e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.social.whatsapp_url','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.social.whatsapp_url'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal05ebc73cbf10977681feb8cdde62256e)): ?>
<?php $attributes = $__attributesOriginal05ebc73cbf10977681feb8cdde62256e; ?>
<?php unset($__attributesOriginal05ebc73cbf10977681feb8cdde62256e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal05ebc73cbf10977681feb8cdde62256e)): ?>
<?php $component = $__componentOriginal05ebc73cbf10977681feb8cdde62256e; ?>
<?php unset($__componentOriginal05ebc73cbf10977681feb8cdde62256e); ?>
<?php endif; ?>
</div>
<?php /**PATH /var/www/digioh/resources/views/components/frontend/social/all-social-url.blade.php ENDPATH**/ ?>