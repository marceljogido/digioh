<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    "route" => "",
    "icon" => "fas fa-desktop",
    "title",
    "small" => "",
    "class" => "",
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
    "route" => "",
    "icon" => "fas fa-desktop",
    "title",
    "small" => "",
    "class" => "",
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($route): ?>
    <a
        href="<?php echo e($route); ?>"
        class="btn btn-success <?php echo e($small == "true" ? "btn-sm" : ""); ?> <?php echo e($class); ?>"
        data-toggle="tooltip"
        title="<?php echo e($title); ?>"
    >
        <i class="<?php echo e($icon); ?>"></i>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button
        type="submit"
        class="btn btn-success <?php echo e($small == "true" ? "btn-sm" : ""); ?> <?php echo e($class); ?>"
        data-toggle="tooltip"
        title="<?php echo e($title); ?>"
    >
        <i class="<?php echo e($icon); ?>"></i>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH /var/www/digioh/resources/views/components/buttons/show.blade.php ENDPATH**/ ?>