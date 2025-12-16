<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((["url" => "/", "icon" => "fa-solid fa-cube", "text" => "Menu", "permission" => "view_backend"]));

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

foreach (array_filter((["url" => "/", "icon" => "fa-solid fa-cube", "text" => "Menu", "permission" => "view_backend"]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permission)): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e($url); ?>">
            <i class="nav-icon <?php echo e($icon); ?>"></i>
            &nbsp;<?php echo e($text); ?>

        </a>
    </li>
<?php endif; ?>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/backend/sidebar-nav-item.blade.php ENDPATH**/ ?>