<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    "data" => "",
    "module_name",
    "module_path",
    "module_title" => "",
    "module_icon" => "",
    "module_action" => "",
]));

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

foreach (array_filter(([
    "data" => "",
    "module_name",
    "module_path",
    "module_title" => "",
    "module_icon" => "",
    "module_action" => "",
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="card">
    <?php if($slot != ""): ?>
        <div class="card-body">
            <?php echo e($slot); ?>

        </div>
    <?php else: ?>
        <div class="card-body">
            <?php if (isset($component)) { $__componentOriginal57a22d33ea7984d606412297cfe33b67 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57a22d33ea7984d606412297cfe33b67 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.section-header','data' => ['data' => $data,'moduleName' => $module_name,'moduleTitle' => $module_title,'moduleIcon' => $module_icon,'moduleAction' => $module_action]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data),'module_name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_name),'module_title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_title),'module_icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_icon),'module_action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_action)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57a22d33ea7984d606412297cfe33b67)): ?>
<?php $attributes = $__attributesOriginal57a22d33ea7984d606412297cfe33b67; ?>
<?php unset($__attributesOriginal57a22d33ea7984d606412297cfe33b67); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57a22d33ea7984d606412297cfe33b67)): ?>
<?php $component = $__componentOriginal57a22d33ea7984d606412297cfe33b67; ?>
<?php unset($__componentOriginal57a22d33ea7984d606412297cfe33b67); ?>
<?php endif; ?>

            <div class="row mt-4">
                <div class="col-12">
                    <?php if (isset($component)) { $__componentOriginalaf5c73767219669181ba5b1c1bb351ca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaf5c73767219669181ba5b1c1bb351ca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.section-show-table','data' => ['data' => $data,'moduleName' => $module_name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.section-show-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data),'module_name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_name)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaf5c73767219669181ba5b1c1bb351ca)): ?>
<?php $attributes = $__attributesOriginalaf5c73767219669181ba5b1c1bb351ca; ?>
<?php unset($__attributesOriginalaf5c73767219669181ba5b1c1bb351ca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaf5c73767219669181ba5b1c1bb351ca)): ?>
<?php $component = $__componentOriginalaf5c73767219669181ba5b1c1bb351ca; ?>
<?php unset($__componentOriginalaf5c73767219669181ba5b1c1bb351ca); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <?php if($data != ""): ?>
                    <small class="text-muted float-end text-end">
                        <?php echo app('translator')->get("Updated at"); ?>
                        : <?php echo e($data->updated_at->diffForHumans()); ?>,
                        <br class="d-block d-sm-none" />
                        <?php echo app('translator')->get("Created at"); ?>
                        : <?php echo e($data->created_at->isoFormat("LLLL")); ?>

                    </small>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/digioh/resources/views/components/backend/layouts/show.blade.php ENDPATH**/ ?>