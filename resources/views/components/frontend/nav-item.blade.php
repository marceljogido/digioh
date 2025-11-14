@props([
    "href" => route("home"),
    "title",
    "active" => "",
    "target" => "_self",
])

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
        class="{{ $initialClass }}"
        data-nav-link="true"
        data-base-class="{{ $baseClasses }}"
        data-light-class="{{ $lightClass }}"
        data-light-active-class="{{ $lightActiveClass }}"
        data-dark-class="{{ $darkClass }}"
        data-dark-active-class="{{ $darkActiveClass }}"
        data-active="{{ $active ? 'true' : 'false' }}"
        href="{{ $href }}"
        target="{{ $target }}"
        @if($active) aria-current="page" @endif
    >
        {{ $slot }}
    </a>
</li>
