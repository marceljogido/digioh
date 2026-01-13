<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((["small" => "true"]));

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

foreach (array_filter((["small" => "true"]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<button
    onclick="window.history.back();"
    class="btn btn-warning <?php echo e($small == "true" ? "btn-sm" : ""); ?> m-1"
    data-toggle="tooltip"
    title="<?php echo e(__("Return Back")); ?>"
>
    <i class="fas fa-reply fa-fw"></i>
    <?php echo $slot != "" ? "&nbsp;" . $slot : ""; ?>

</button>
<?php /**PATH /var/www/digioh/resources/views/components/backend/buttons/return-back.blade.php ENDPATH**/ ?>