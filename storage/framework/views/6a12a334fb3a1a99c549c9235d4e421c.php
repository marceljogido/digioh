<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    "data" => "",
    "module_name",
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
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<p>
    <?php echo app('translator')->get("All values of :module_name (Id: :id)", ["module_name" => ucwords(Str::singular($module_name)), "id" => $data->id]); ?>
</p>
<table class="table-responsive-sm table-hover table-bordered table">
    <?php
    $all_columns = $data->getTableColumns();
    ?>

    <thead>
        <tr>
            <th scope="col">
                <strong>
                    <?php echo app('translator')->get("Name"); ?>
                </strong>
            </th>
            <th scope="col">
                <strong>
                    <?php echo app('translator')->get("Value"); ?>
                </strong>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <strong>
                        <?php echo e(__(label_case($column->name))); ?>

                    </strong>
                </td>
                <td>
                    <?php echo show_column_value($data, $column); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>


<?php if (isset($component)) { $__componentOriginala2772d123992ff773f161a8f4fee8224 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2772d123992ff773f161a8f4fee8224 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.library.lightbox','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('library.lightbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2772d123992ff773f161a8f4fee8224)): ?>
<?php $attributes = $__attributesOriginala2772d123992ff773f161a8f4fee8224; ?>
<?php unset($__attributesOriginala2772d123992ff773f161a8f4fee8224); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2772d123992ff773f161a8f4fee8224)): ?>
<?php $component = $__componentOriginala2772d123992ff773f161a8f4fee8224; ?>
<?php unset($__componentOriginala2772d123992ff773f161a8f4fee8224); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/backend/section-show-table.blade.php ENDPATH**/ ?>