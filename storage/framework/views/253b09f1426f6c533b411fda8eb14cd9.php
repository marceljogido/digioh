<!DOCTYPE html>
<html lang="<?php echo e(str_replace("_", "-", app()->currentLocale())); ?>" dir="<?php echo e(language_direction()); ?>">
    <head>
        <meta charset="utf-8" />
        <link href="<?php echo e(asset("img/favicon.png")); ?>" rel="apple-touch-icon" sizes="76x76" />
        <link type="image/png" href="<?php echo e(asset("img/favicon.png")); ?>" rel="icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo $__env->yieldContent("title"); ?> | <?php echo e(config("app.name")); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo e(setting("meta_description")); ?>" />
        <meta name="keyword" content="<?php echo e(setting("meta_keyword")); ?>" />
        <?php echo $__env->make("frontend.includes.meta", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Shortcut Icon -->
        <link href="<?php echo e(asset("img/favicon.png")); ?>" rel="shortcut icon" />
        <link type="image/ico" href="<?php echo e(asset("img/favicon.png")); ?>" rel="icon" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

        <!-- AOS Animate On Scroll -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <?php echo app('Illuminate\Foundation\Vite')(["resources/css/app-frontend.css", "resources/js/app-frontend.js"]); ?>

        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


        <!-- Custom Animations -->
        <style>
            /* Smooth transitions base - apply to all interactive elements */
            a, button, .card, article, [class*="hover-"] {
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                -webkit-transform: translateZ(0);
                transform: translateZ(0);
            }

            /* Fade animations */
            .animate-fade-in { animation: fadeIn 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
            .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
            .animate-fade-in-down { animation: fadeInDown 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
            .animate-scale-in { animation: scaleIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fadeInDown {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes scaleIn {
                from { opacity: 0; transform: scale(0.95); }
                to { opacity: 1; transform: scale(1); }
            }

            /* Smooth hover effects - using cubic-bezier for natural feel */
            .hover-lift { 
                transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), 
                            box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                will-change: transform, box-shadow;
            }
            .hover-lift:hover { 
                transform: translateY(-6px); 
                box-shadow: 0 16px 32px rgba(0,0,0,0.12); 
            }
            
            .hover-glow { 
                transition: box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                will-change: box-shadow;
            }
            .hover-glow:hover { 
                box-shadow: 0 0 24px rgba(92, 131, 196, 0.3); 
            }

            /* Gradient animation */
            .animate-gradient {
                background-size: 200% 200%;
                animation: gradientShift 8s ease infinite;
            }
            @keyframes gradientShift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }

            /* Pulse animation - more subtle */
            .animate-pulse-slow { animation: pulseSlow 4s ease-in-out infinite; }
            @keyframes pulseSlow {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.8; }
            }

            /* Counter animation preparation */
            .counter-animate { opacity: 0; transform: translateY(20px); }
            .counter-animate.visible { 
                opacity: 1; 
                transform: translateY(0); 
                transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); 
            }

            /* Override any jarring transitions on cards */
            article, .card, [class*="rounded-"] {
                transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), 
                            box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                            border-color 0.3s ease;
            }
        </style>


        <?php echo $__env->yieldPushContent("after-styles"); ?>

        <?php if (isset($component)) { $__componentOriginal5a71c2c3670795ec464153e22b9d2874 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a71c2c3670795ec464153e22b9d2874 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.google-analytics','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('google-analytics'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a71c2c3670795ec464153e22b9d2874)): ?>
<?php $attributes = $__attributesOriginal5a71c2c3670795ec464153e22b9d2874; ?>
<?php unset($__attributesOriginal5a71c2c3670795ec464153e22b9d2874); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a71c2c3670795ec464153e22b9d2874)): ?>
<?php $component = $__componentOriginal5a71c2c3670795ec464153e22b9d2874; ?>
<?php unset($__componentOriginal5a71c2c3670795ec464153e22b9d2874); ?>
<?php endif; ?>
    </head>

    <?php
        $hasHeroOverlap = request()->routeIs('frontend.index') || request()->routeIs('home');
    ?>
    <body class="bg-transparent <?php echo e($hasHeroOverlap ? 'hero-overlap' : 'pt-16'); ?>">
        <?php if (isset($component)) { $__componentOriginalc560413a08e91edcc1296f14882e3c6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc560413a08e91edcc1296f14882e3c6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.selected-theme','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('selected-theme'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc560413a08e91edcc1296f14882e3c6a)): ?>
<?php $attributes = $__attributesOriginalc560413a08e91edcc1296f14882e3c6a; ?>
<?php unset($__attributesOriginalc560413a08e91edcc1296f14882e3c6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc560413a08e91edcc1296f14882e3c6a)): ?>
<?php $component = $__componentOriginalc560413a08e91edcc1296f14882e3c6a; ?>
<?php unset($__componentOriginalc560413a08e91edcc1296f14882e3c6a); ?>
<?php endif; ?>

        <?php echo $__env->make("frontend.includes.header", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <main class="bg-white dark:bg-gray-800">
            <?php echo $__env->yieldContent("content"); ?>
        </main>

        <?php echo $__env->make("frontend.includes.footer", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <style>
            /* Reset margin default browser */
            html,
            body {
                margin: 0;
                padding: 0;
            }

            /* Default offset for fixed navbar on most pages */
            body.pt-16 {
                padding-top: 4rem;
            }

            /* Home hero overlaps navbar */
            body.hero-overlap {
                padding-top: 0;
            }

            body.hero-overlap main > section.relative.isolate.overflow-hidden {
                margin-top: -4rem; /* match navbar height */
                padding-top: 4rem;
            }
        </style>

        <!-- Scripts -->
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

        
        <!-- AOS Animate On Scroll -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50,
                delay: 0,
            });
        </script>

        <?php echo $__env->yieldPushContent("after-scripts"); ?>
    </body>
</html>
<?php /**PATH /var/www/digioh/resources/views/frontend/layouts/app.blade.php ENDPATH**/ ?>