<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    "data" => null,
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
    "data" => null,
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.section-header','data' => ['moduleName' => $module_name,'moduleTitle' => $module_title,'moduleIcon' => $module_icon,'moduleAction' => $module_action]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['module_name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_name),'module_title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_title),'module_icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_icon),'module_action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_action)]); ?>
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
                <div class="col">
                    <?php echo e(html()->form("POST", route("backend.$module_name.store"))->acceptsFiles()->open()); ?>


                    <?php echo $__env->make("$module_path.$module_name.form", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <div class="row">
                        <div class="col-6">
                            <?php if (isset($component)) { $__componentOriginal9ea0105027514645b96ba9a83bc7d3f4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ea0105027514645b96ba9a83bc7d3f4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.buttons.create','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.buttons.create'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Create <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ea0105027514645b96ba9a83bc7d3f4)): ?>
<?php $attributes = $__attributesOriginal9ea0105027514645b96ba9a83bc7d3f4; ?>
<?php unset($__attributesOriginal9ea0105027514645b96ba9a83bc7d3f4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ea0105027514645b96ba9a83bc7d3f4)): ?>
<?php $component = $__componentOriginal9ea0105027514645b96ba9a83bc7d3f4; ?>
<?php unset($__componentOriginal9ea0105027514645b96ba9a83bc7d3f4); ?>
<?php endif; ?>
                        </div>
                        <div class="col-6">
                            <div class="float-end">
                                <?php if (isset($component)) { $__componentOriginal5794c7fc05153298c931f4198c188381 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5794c7fc05153298c931f4198c188381 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.buttons.cancel','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.buttons.cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5794c7fc05153298c931f4198c188381)): ?>
<?php $attributes = $__attributesOriginal5794c7fc05153298c931f4198c188381; ?>
<?php unset($__attributesOriginal5794c7fc05153298c931f4198c188381); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5794c7fc05153298c931f4198c188381)): ?>
<?php $component = $__componentOriginal5794c7fc05153298c931f4198c188381; ?>
<?php unset($__componentOriginal5794c7fc05153298c931f4198c188381); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php echo e(html()->form()->close()); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <?php if($data && $data->updated_at): ?>
                    <small class="text-muted float-end text-end">
                        <?php echo app('translator')->get("Updated at"); ?>
                        : <?php echo e($data->updated_at->diffForHumans()); ?>,
                        <br class="d-block d-sm-none" />
                        <?php echo app('translator')->get("Created at"); ?>
                        : <?php echo e($data->created_at?->isoFormat("LLLL") ?? '-'); ?>

                    </small>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/backend/layouts/create.blade.php ENDPATH**/ ?>