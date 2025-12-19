<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    "href" => route("home"),
    "title",
    "active" => "",
    "target" => "_self",
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
    "href" => route("home"),
    "title",
    "active" => "",
    "target" => "_self",
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$baseClasses =
    'nav-link block rounded-full px-4 py-2 text-sm font-semibold tracking-tight transition duration-200 ease-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 md:text-base';
$lightClass = 'text-white/80 hover:bg-white/15 hover:text-white';
$lightActiveClass = 'bg-white/20 text-white shadow shadow-slate-900/20 backdrop-blur';
$darkClass = 'text-slate-700 hover:bg-slate-100 hover:text-slate-900';
$darkActiveClass = 'bg-slate-900/10 text-slate-900 shadow shadow-slate-900/10';

$initialClass = implode(' ', [
    $baseClasses,
    $active ? $lightActiveClass : $lightClass,
]);
?>

<li>
    <a
        class="<?php echo e($initialClass); ?>"
        data-nav-link="true"
        data-base-class="<?php echo e($baseClasses); ?>"
        data-light-class="<?php echo e($lightClass); ?>"
        data-light-active-class="<?php echo e($lightActiveClass); ?>"
        data-dark-class="<?php echo e($darkClass); ?>"
        data-dark-active-class="<?php echo e($darkActiveClass); ?>"
        data-active="<?php echo e($active ? 'true' : 'false'); ?>"
        href="<?php echo e($href); ?>"
        target="<?php echo e($target); ?>"
        <?php if($active): ?> aria-current="page" <?php endif; ?>
    >
        <?php echo e($slot); ?>

    </a>
</li>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/frontend/nav-item.blade.php ENDPATH**/ ?>