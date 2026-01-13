<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    "data" => "",
    "toolbar" => "",
    "title" => "",
    "subtitle" => "",
    "module_name" => "",
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
    "toolbar" => "",
    "title" => "",
    "subtitle" => "",
    "module_name" => "",
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

<div class="d-flex justify-content-between">
    <div class="align-self-center">
        <?php if($slot != ""): ?>
            <h4 class="card-title mb-0">
                <?php echo e($slot); ?>

            </h4>
        <?php else: ?>
            <h4 class="card-title mb-0">
                <i class="<?php echo e($module_icon); ?>"></i>
                <?php echo e(__($module_title)); ?>

                <small class="text-muted"><?php echo e(__($module_action)); ?></small>
            </h4>
        <?php endif; ?>

        <?php if($subtitle): ?>
            <div class="small text-medium-emphasis">
                <?php echo e($subtitle); ?>

            </div>
        <?php endif; ?>
    </div>
    <?php if($toolbar): ?>
        <div class="btn-toolbar d-block text-end" role="toolbar" aria-label="Toolbar with buttons">
            <?php echo e($toolbar); ?>

        </div>
    <?php else: ?>
        <div class="btn-toolbar d-block text-end" role="toolbar" aria-label="Toolbar with buttons">
            <?php if(Str::endsWith(Route::currentRouteName(), "index")): ?>
                <?php if (isset($component)) { $__componentOriginal03c0e80d38d2a15cf58878ae679803f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03c0e80d38d2a15cf58878ae679803f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.buttons.return-back','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.buttons.return-back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03c0e80d38d2a15cf58878ae679803f0)): ?>
<?php $attributes = $__attributesOriginal03c0e80d38d2a15cf58878ae679803f0; ?>
<?php unset($__attributesOriginal03c0e80d38d2a15cf58878ae679803f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03c0e80d38d2a15cf58878ae679803f0)): ?>
<?php $component = $__componentOriginal03c0e80d38d2a15cf58878ae679803f0; ?>
<?php unset($__componentOriginal03c0e80d38d2a15cf58878ae679803f0); ?>
<?php endif; ?>

                <?php if(auth()->user()->can("add_" . $module_name) && Route::has("backend." . $module_name . ".create")): ?>
                    <?php if (isset($component)) { $__componentOriginal9ea0105027514645b96ba9a83bc7d3f4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ea0105027514645b96ba9a83bc7d3f4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.buttons.create','data' => ['title' => ''.e(__('Create')).' '.e(ucwords(Str::singular($module_name))).'','small' => 'true','route' => ''.e(route("backend.$module_name.create")).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.buttons.create'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Create')).' '.e(ucwords(Str::singular($module_name))).'','small' => 'true','route' => ''.e(route("backend.$module_name.create")).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ea0105027514645b96ba9a83bc7d3f4)): ?>
<?php $attributes = $__attributesOriginal9ea0105027514645b96ba9a83bc7d3f4; ?>
<?php unset($__attributesOriginal9ea0105027514645b96ba9a83bc7d3f4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ea0105027514645b96ba9a83bc7d3f4)): ?>
<?php $component = $__componentOriginal9ea0105027514645b96ba9a83bc7d3f4; ?>
<?php unset($__componentOriginal9ea0105027514645b96ba9a83bc7d3f4); ?>
<?php endif; ?>
                <?php endif; ?>

                <?php if(auth()->user()->can("restore_" . $module_name) && Route::has("backend." . $module_name . ".trashed")): ?>
                    <div class="btn-group">
                        <button
                            class="btn btn-secondary btn-sm dropdown-toggle"
                            data-coreui-toggle="dropdown"
                            type="button"
                            aria-expanded="false"
                        >
                            <i class="fas fa-cog"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route("backend.$module_name.trashed")); ?>">
                                    <i class="fas fa-eye-slash"></i>
                                    <?php echo app('translator')->get("View trash"); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php elseif(Str::endsWith(Route::currentRouteName(), "create")): ?>
                <a
                    class="btn btn-secondary btn-sm ms-1"
                    data-toggle="tooltip"
                    href="<?php echo e(route("backend.$module_name.index")); ?>"
                    title="<?php echo e(__($module_title)); ?> List"
                >
                    <i class="fas fa-list-ul"></i>
                    List
                </a>
            <?php elseif(Str::endsWith(Route::currentRouteName(), "edit")): ?>
                <?php if (isset($component)) { $__componentOriginal8110bcd06083da5640cb413b304f0671 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8110bcd06083da5640cb413b304f0671 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.buttons.show','data' => ['class' => 'ms-1','title' => ''.e(__('Show')).' '.e(ucwords(Str::singular($module_name))).'','route' => ''.route("backend.$module_name.show", $data).'','small' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('buttons.show'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ms-1','title' => ''.e(__('Show')).' '.e(ucwords(Str::singular($module_name))).'','route' => ''.route("backend.$module_name.show", $data).'','small' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8110bcd06083da5640cb413b304f0671)): ?>
<?php $attributes = $__attributesOriginal8110bcd06083da5640cb413b304f0671; ?>
<?php unset($__attributesOriginal8110bcd06083da5640cb413b304f0671); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8110bcd06083da5640cb413b304f0671)): ?>
<?php $component = $__componentOriginal8110bcd06083da5640cb413b304f0671; ?>
<?php unset($__componentOriginal8110bcd06083da5640cb413b304f0671); ?>
<?php endif; ?>
            <?php elseif(Str::endsWith(Route::currentRouteName(), "show")): ?>
                <?php if(Route::has("frontend.$module_name.show")): ?>
                    <?php if (isset($component)) { $__componentOriginald23d8ee3ad97d36881921619814f19d1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald23d8ee3ad97d36881921619814f19d1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.buttons.public','data' => ['class' => '','title' => ''.e(__('Public')).'','route' => ''.route("frontend.$module_name.show", encode_id($data->id)).'','small' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.buttons.public'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => '','title' => ''.e(__('Public')).'','route' => ''.route("frontend.$module_name.show", encode_id($data->id)).'','small' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald23d8ee3ad97d36881921619814f19d1)): ?>
<?php $attributes = $__attributesOriginald23d8ee3ad97d36881921619814f19d1; ?>
<?php unset($__attributesOriginald23d8ee3ad97d36881921619814f19d1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald23d8ee3ad97d36881921619814f19d1)): ?>
<?php $component = $__componentOriginald23d8ee3ad97d36881921619814f19d1; ?>
<?php unset($__componentOriginald23d8ee3ad97d36881921619814f19d1); ?>
<?php endif; ?>
                <?php endif; ?>

                <?php if(auth()->user()->can("edit_" . $module_name) && Route::has("backend." . $module_name . ".edit")): ?>
                    <?php if (isset($component)) { $__componentOriginal3fb88f3c798c2fbfcf9069ea6a28e03f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fb88f3c798c2fbfcf9069ea6a28e03f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.buttons.edit','data' => ['class' => 'm-1','title' => ''.e(__('Edit')).' '.e(ucwords(Str::singular($module_name))).'','route' => ''.route("backend.$module_name.edit", $data).'','small' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('buttons.edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'm-1','title' => ''.e(__('Edit')).' '.e(ucwords(Str::singular($module_name))).'','route' => ''.route("backend.$module_name.edit", $data).'','small' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fb88f3c798c2fbfcf9069ea6a28e03f)): ?>
<?php $attributes = $__attributesOriginal3fb88f3c798c2fbfcf9069ea6a28e03f; ?>
<?php unset($__attributesOriginal3fb88f3c798c2fbfcf9069ea6a28e03f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fb88f3c798c2fbfcf9069ea6a28e03f)): ?>
<?php $component = $__componentOriginal3fb88f3c798c2fbfcf9069ea6a28e03f; ?>
<?php unset($__componentOriginal3fb88f3c798c2fbfcf9069ea6a28e03f); ?>
<?php endif; ?>
                <?php endif; ?>

                <a
                    class="btn btn-secondary btn-sm"
                    data-toggle="tooltip"
                    href="<?php echo e(route("backend.$module_name.index")); ?>"
                    title="<?php echo e(ucwords($module_name)); ?> List"
                >
                    <i class="fas fa-list"></i>
                    <?php echo e(__("List")); ?>

                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<hr />
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/backend/section-header.blade.php ENDPATH**/ ?>