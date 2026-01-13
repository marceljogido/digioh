<?php ($locale = app()->getLocale()); ?>
<?php ($aboutTitle = $locale === 'en' ? (setting('about_title_en') ?: setting('about_title')) : setting('about_title')); ?>
<?php ($aboutBody = $locale === 'en' ? (setting('about_body_en') ?: setting('about_body')) : setting('about_body')); ?>
<?php ($aboutTagline = $locale === 'en' ? (setting('about_tagline_en') ?: setting('about_tagline')) : setting('about_tagline')); ?>
<?php ($aboutTagline = $aboutTagline ?: ($locale === 'en' ? 'Beyond Expectations, Beyond Experiences' : 'Melampaui ekspektasi, menciptakan pengalaman')); ?>
<?php ($aboutExcerpt = $aboutBody ? \Illuminate\Support\Str::limit(strip_tags($aboutBody), 1500, '...') : null); ?>

<section 
    id="about-us"
    class="group relative overflow-hidden bg-white dark:bg-slate-950 py-24"
    x-data="{ mouseX: 0, mouseY: 0, active: false }"
    @mousemove="mouseX = $event.clientX; mouseY = $event.clientY; active = true"
    @mouseleave="active = false"
>
    
    <div 
        class="pointer-events-none absolute inset-0 z-0 transition-opacity duration-1000"
        :class="active ? 'opacity-100' : 'opacity-0'"
        :style="`background: radial-gradient(circle 800px at ${mouseX}px ${mouseY}px, rgba(92, 131, 196, 0.06), transparent 80%)`"
    ></div>

    
    <div class="pointer-events-none absolute -left-20 top-0 h-96 w-96 rounded-full bg-indigo-500/5 blur-3xl dark:bg-indigo-500/10"></div>
    <div class="pointer-events-none absolute -right-20 bottom-0 h-96 w-96 rounded-full bg-orange-500/5 blur-3xl dark:bg-orange-500/10"></div>

    <div class="relative z-10 mx-auto max-w-screen-xl px-4 sm:px-12">
        <div class="grid gap-16 lg:grid-cols-[1.1fr_.9fr] lg:items-center">
            <div data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="h-1.5 w-12 rounded-full bg-gradient-to-r from-orange-500 to-red-500 shadow-lg shadow-orange-500/20"></span>
                    <span class="text-xs font-bold uppercase tracking-[0.4em] text-[#f17720] dark:text-[#ffa630]"><?php echo e($locale === 'en' ? 'Who We Are' : 'Tentang Kami'); ?></span>
                </div>
                <h2 class="mt-6 text-4xl font-black tracking-tight text-[#11224e] dark:text-white sm:text-5xl lg:text-6xl">
                    <?php echo e($aboutTitle ?: ($locale === 'en' ? 'About DigiOH' : 'Tentang DigiOH')); ?>

                </h2>
                <?php if($aboutTagline): ?>
                    <p class="mt-6 text-lg font-bold uppercase tracking-widest text-[#f17720] opacity-90">
                        <?php echo e($aboutTagline); ?>

                    </p>
                <?php endif; ?>
                <div class="mt-8 space-y-6 text-lg leading-relaxed text-slate-600 dark:text-slate-300">
                    <?php if($aboutExcerpt): ?>
                        <?php echo nl2br(e($aboutExcerpt)); ?>

                    <?php else: ?>
                        <p><?php echo e($locale === 'en' ? 'Digital transformation with a human touch.' : 'Transformasi digital yang manusiawi.'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="mt-12 flex flex-wrap items-center gap-6">
                    <a href="<?php echo e(route('about')); ?>" class="group/btn relative inline-flex items-center justify-center overflow-hidden rounded-full bg-[#11224e] px-8 py-4 text-sm font-bold text-white shadow-xl transition-all duration-300 hover:bg-[#1a3a6e] hover:-translate-y-1 active:scale-95 dark:bg-[#ffa630] dark:text-[#11224e] dark:hover:bg-white">
                        <span class="relative z-10"><?php echo e($locale === 'en' ? 'Learn more about us' : 'Pelajari selengkapnya'); ?></span>
                        <div class="absolute inset-0 z-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-0 transition-opacity duration-300 group-hover:opacity-100 dark:from-white dark:to-white"></div>
                    </a>
                    <a href="<?php echo e(route('contact')); ?>" class="group flex items-center gap-3 text-sm font-bold text-[#11224e] transition-colors hover:text-[#f17720] dark:text-indigo-200 dark:hover:text-[#ffa630]">
                        <?php echo e($locale === 'en' ? 'Start a conversation' : 'Mulai diskusi'); ?>

                        <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>
            </div>

            <div 
                class="perspective-container relative z-20 hidden lg:block"
                data-aos="fade-left"
                x-data="{ rotateX: 0, rotateY: 0 }"
                @mousemove="
                    const card = $el.getBoundingClientRect();
                    const x = $event.clientX - card.left;
                    const y = $event.clientY - card.top;
                    const centerX = card.width / 2;
                    const centerY = card.height / 2;
                    rotateX = ((y - centerY) / centerY) * -10;
                    rotateY = ((x - centerX) / centerX) * 10;
                "
                @mouseleave="rotateX = 0; rotateY = 0"
            >
                <div class="absolute -inset-10 rounded-full bg-gradient-to-br from-orange-200/40 via-indigo-100/20 to-transparent blur-3xl dark:from-indigo-500/20 dark:via-blue-600/10"></div>
                
                <div 
                    class="tilt-box relative transition-transform duration-200 ease-out"
                    :style="`transform: rotateX(${rotateX}deg) rotateY(${rotateY}deg)`"
                >
                    <div class="relative overflow-hidden img-squircle border-8 border-white bg-white shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)] dark:border-slate-800 dark:bg-slate-900 tilt-content">
                        <?php if(setting('about_image')): ?>
                            <img class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo e(asset(setting('about_image'))); ?>" alt="<?php echo e($aboutTitle ?: 'Digioh'); ?>">
                        <?php else: ?>
                            <img class="h-full w-full object-cover" src="<?php echo e(asset('img/about-placeholder.jpg')); ?>" alt="Digioh">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#11224e]/20 via-transparent opacity-60"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/frontend/pages/partials/about-snippet.blade.php ENDPATH**/ ?>