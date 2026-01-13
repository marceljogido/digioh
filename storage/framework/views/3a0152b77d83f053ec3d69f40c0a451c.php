<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((["route" => "#", "icon" => "", "title" => "", "type" => ""]));

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

foreach (array_filter((["route" => "#", "icon" => "", "title" => "", "type" => ""]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($type): ?>
    <li class="breadcrumb-item active" aria-current="page">
        <span>
            <?php if($icon): ?>
                <i class="<?php echo e($icon); ?>"></i>
            <?php endif; ?>

            <?php echo e($slot); ?>

        </span>
    </li>
<?php else: ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e($route); ?>">
            <i class="<?php echo e($icon); ?>"></i>
            <?php echo e($slot); ?>

        </a>
    </li>
<?php endif; ?>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/backend/breadcrumb-item.blade.php ENDPATH**/ ?>