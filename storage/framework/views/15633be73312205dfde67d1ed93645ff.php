<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((["route" => "", "icon" => "fas fa-plus", "title" => "Create", "small" => "", "class" => ""]));

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

foreach (array_filter((["route" => "", "icon" => "fas fa-plus", "title" => "Create", "small" => "", "class" => ""]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($route): ?>
    <a
        class="btn btn-success <?php echo e($small == "true" ? "btn-sm" : ""); ?> <?php echo e($class); ?>"
        data-toggle="tooltip"
        href="<?php echo e($route); ?>"
        title="<?php echo e(__($title)); ?>"
    >
        <i class="<?php echo e($icon); ?> fa-fw"></i>
        <?php echo $slot != "" ? "&nbsp;" . $slot : ""; ?>

    </a>
<?php else: ?>
    <button
        class="btn btn-success <?php echo e($small == "true" ? "btn-sm" : ""); ?> <?php echo e($class); ?> m-1"
        data-toggle="tooltip"
        type="submit"
        title="<?php echo e(__($title)); ?>"
    >
        <i class="<?php echo e($icon); ?> fa-fw"></i>
        <?php echo $slot != "" ? "&nbsp;" . $slot : ""; ?>

    </button>
<?php endif; ?>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/backend/buttons/create.blade.php ENDPATH**/ ?>