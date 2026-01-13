<?php $__env->startSection("title"); ?>
    <?php echo e(app_name()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <?php
        $slides = \Modules\Slider\Models\Slider::active()->sorted()->get();
        $logos = \Modules\ClientLogo\Models\ClientLogo::active()->sorted()->get();
        $useMarquee = $logos->count() > 5;
        $marqueeLogos = $useMarquee ? $logos->concat($logos) : $logos;
        $heroSlides = $slides->map(function ($slide) {
            return [
                'title' => $slide->title,
                'subtitle' => $slide->subtitle,
                'image' => asset($slide->image),
                'button_text' => $slide->button_text,
                'button_link' => $slide->button_link,
            ];
        });

        $defaultStats = [
            ['value' => '12+', 'label' => __('Tahun pengalaman')],
            ['value' => '150+', 'label' => __('Proyek berhasil diselesaikan')],
            ['value' => '98%', 'label' => __('Pelanggan yang kembali bekerja bersama')],
        ];

        $stats = collect($stats ?? $defaultStats);
        $heroHighlights = $stats->take(3);

        $genericServiceIcon = '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5L6 12z"/></svg>';
        $defaultServices = [
            [
                'title' => __('Strategi Digital & Discovery'),
                'description' => __('Kami bekerja bersama Anda untuk memahami kebutuhan bisnis dan menyusun roadmap produk yang realistis serta terukur.'),
                'icon' => $genericServiceIcon,
            ],
            [
                'title' => __('Desain Experience & Branding'),
                'description' => __('Tim UI/UX kami membangun tampilan yang elegan dan mudah digunakan, lengkap dengan guideline merek yang konsisten di semua saluran.'),
                'icon' => $genericServiceIcon,
            ],
            [
                'title' => __('Pengembangan Produk End-to-End'),
                'description' => __('Kami membangun aplikasi web maupun mobile yang skalabel dengan praktik engineering modern, CI/CD, dan pengujian menyeluruh.'),
                'icon' => $genericServiceIcon,
            ],
            [
                'title' => __('Optimalisasi & Growth Marketing'),
                'description' => __('Kami mendukung peluncuran dan pengembangan produk melalui analitik, eksperimen, dan kampanye digital yang terukur.'),
                'icon' => $genericServiceIcon,
            ],
        ];

        $locale = app()->getLocale();
        $dbServices = \App\Models\Service::active()->where('featured_on_home', true)->sorted()->get();
        $services = $dbServices->count()
            ? $dbServices->map(function ($s) use ($genericServiceIcon) {
                return [
                    'title' => $s->name,
                    'description' => $s->description,
                    'icon' => $s->icon ?: $genericServiceIcon,
                    'image' => $s->image,
                    'slug' => $s->slug,
                ];
            })
            : collect($defaultServices)->map(function ($service) {
                return array_merge($service, ['slug' => null]);
            });

        $defaultFaqs = [
            [
                'question' => __('Berapa lama estimasi pengerjaan satu proyek digital?'),
                'answer' => __('Waktu pengerjaan bergantung pada kompleksitas fitur. Rata-rata produk digital MVP kami selesaikan dalam 8-12 minggu termasuk fase discovery, desain, serta pengembangan.'),
            ],
            [
                'question' => __('Apakah tim kami bisa berkolaborasi dengan tim internal klien?'),
                'answer' => __('Tentu. Kami terbiasa bekerja secara kolaboratif lewat sprint mingguan, ritual agile, dan alat komunikasi yang transparan agar tim internal Anda tetap terinformasi.'),
            ],
            [
                'question' => __('Layanan purna jual apa saja yang tersedia?'),
                'answer' => __('Kami menyediakan support operasional, maintenance, optimalisasi performa, hingga growth marketing untuk produk yang sudah dirilis.'),
            ],
            [
                'question' => __('Bagaimana pola kerja dan metode pembiayaan di Digioh?'),
                'answer' => __('Kami fleksibel dengan model fixed scope maupun retainer. Setelah discovery selesai, kami serahkan proposal detail lengkap dengan timeline, deliverable, dan estimasi biaya.'),
            ],
        ];

        $faqEntries = \App\Models\Faq::active()->sorted()->get();

        $faqs = $faqEntries->isNotEmpty()
            ? $faqEntries->values()->map(function ($faq, $index) use ($defaultFaqs) {
                $default = $defaultFaqs[$index % count($defaultFaqs)];

                $question = $faq->question;
                $answer = $faq->answer;

                return [
                    'question' => $question ?: $default['question'],
                    'answer' => $answer ?: $default['answer'],
                ];
            })
            : collect($defaultFaqs);

        $blogPosts = \Modules\Post\Models\Post::published()->featured()->take(3)->get();

        $cta = [
            'title' => __('Siap berkolaborasi?'),
            'subtitle' => __('Mari ciptakan pengalaman digital yang berdampak bagi pelanggan Anda.'),
            'primary_text' => __('Diskusikan proyek Anda'),
            'primary_link' => route('contact'),
            'secondary_text' => __('Pelajari proses kerja kami'),
            'secondary_link' => route('about'),
        ];

        // Instagram video section data
        $instagramSection = [
            'enabled' => setting('instagram_section_enabled', false),
            'title' => $locale === 'en' ? (setting('instagram_section_title_en') ?: setting('instagram_section_title')) : setting('instagram_section_title'),
            'subtitle' => $locale === 'en' ? (setting('instagram_section_subtitle_en') ?: setting('instagram_section_subtitle')) : setting('instagram_section_subtitle'),
            'embeds' => collect([
                setting('instagram_embed_1'),
                setting('instagram_embed_2'),
                setting('instagram_embed_3'),
            ])->filter()->values(),
            'profile_url' => setting('instagram_profile_url'),
            'cta_text' => $locale === 'en' ? (setting('instagram_cta_text_en') ?: setting('instagram_cta_text')) : setting('instagram_cta_text'),
        ];
    ?>

    <?php if($slides->isNotEmpty()): ?>
        <section
            x-data='{
                slides: <?php echo json_encode($heroSlides->values(), 15, 512) ?>,
                current: 0,
                interval: null,
                titleFallbackText: <?php echo json_encode(__('PT. Digital Open House - Transformasi Digital Tanpa Ribet'), 15, 512) ?>,
                subtitleFallbackText: <?php echo json_encode(__('Kami membantu brand tumbuh melalui strategi, desain, dan teknologi digital end-to-end.')) ?>,
                ctaFallbackText: <?php echo json_encode(__('Diskusikan proyek Anda'), 15, 512) ?>,
                ctaFallbackLink: "#contact",
                start() {
                    this.stop();
                    if (this.slides.length > 1) {
                        this.interval = setInterval(() => { this.next(); }, 6000);
                    }
                },
                stop() {
                    if (this.interval) {
                        clearInterval(this.interval);
                        this.interval = null;
                    }
                },
                next() {
                    this.current = (this.current + 1) % this.slides.length;
                },
                prev() {
                    this.current = (this.current - 1 + this.slides.length) % this.slides.length;
                },
                go(index) {
                    this.current = index;
                    this.start();
                }
            }'
            x-init="start()"
            @mouseenter="stop()"
            @mouseleave="start()"
            class="relative isolate overflow-hidden bg-slate-950 text-white"
        >
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="current === index" x-transition.opacity class="absolute inset-0">
                    <img :src="slide.image" alt="" class="h-full w-full object-cover" />
                    <div class="absolute inset-0 bg-slate-950/70"></div>
                </div>
            </template>

            <div class="relative z-10 mx-auto flex min-h-screen max-w-screen-xl flex-col justify-center gap-8 px-4 py-24 sm:px-12">
                <div class="max-w-3xl space-y-6">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.3em] text-indigo-200">
                        <?php echo e(__('PT. Digital Open House')); ?>

                    </span>
                    <h1 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl" x-text="slides[current]?.title || titleFallbackText"></h1>
                    <p class="text-base text-slate-200 sm:text-lg" x-text="slides[current]?.subtitle || subtitleFallbackText"></p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a
                            :href="slides[current]?.button_link || ctaFallbackLink"
                            class="btn-animated inline-flex items-center justify-center rounded-full bg-indigo-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:-translate-y-0.5 hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                        >
                            <span x-text="slides[current]?.button_text || ctaFallbackText"></span>
                        </a>
                    </div>
                </div>

                <?php if($heroHighlights->filter(fn($item) => !empty($item['value']) || !empty($item['label']))->count()): ?>
                    <div class="flex flex-wrap gap-3">
                        <?php $__currentLoopData = $heroHighlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="group flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 text-white backdrop-blur transition hover:bg-white/15">
                                <span class="text-2xl font-semibold leading-none"><?php echo e($highlight['value'] ?? ''); ?></span>
                                <span class="max-w-[10rem] text-xs font-medium uppercase tracking-wide text-slate-200 group-hover:text-white">
                                    <?php echo e($highlight['label'] ?? ''); ?>

                                </span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-slate-950 via-slate-950/70 via-20% to-transparent"></div>

            <template x-if="slides.length > 1">
                <div class="pointer-events-none absolute inset-x-0 bottom-8 z-10 flex justify-center gap-3">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button
                            type="button"
                            class="pointer-events-auto h-2 w-8 rounded-full bg-white/40 transition"
                            :class="{ 'bg-white': current === index }"
                            @click.prevent="go(index)"
                        ></button>
                    </template>
                </div>
            </template>

            <template x-if="slides.length > 1">
                <div class="absolute inset-y-0 left-0 z-10 hidden items-center px-4 sm:flex">
                    <button type="button" class="pointer-events-auto hidden h-11 w-11 items-center justify-center rounded-full border border-white/30 bg-white/10 backdrop-blur transition hover:bg-white/20 sm:flex" @click="prev()">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                    </button>
                </div>
            </template>
            <template x-if="slides.length > 1">
                <div class="absolute inset-y-0 right-0 z-10 hidden items-center px-4 sm:flex">
                    <button type="button" class="pointer-events-auto hidden h-11 w-11 items-center justify-center rounded-full border border-white/30 bg-white/10 backdrop-blur transition hover:bg-white/20 sm:flex" @click="next()">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </button>
                </div>
            </template>
        </section>
    <?php else: ?>
        <section class="relative overflow-hidden bg-gradient-to-r from-[#11224e] via-[#5c83c4] to-[#ffa630] text-white">
            <div class="absolute -left-20 top-[-140px] h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -right-28 bottom-[-160px] h-96 w-96 rounded-full bg-orange-400/30 blur-3xl"></div>

            <div class="mx-auto flex max-w-screen-xl flex-col gap-10 px-4 py-24 sm:flex-row sm:items-center sm:justify-between sm:px-12">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium uppercase tracking-wider"><?php echo e(__('Solusi Event & Activation')); ?></span>
                    <h1 class="mt-6 text-4xl font-bold leading-tight sm:text-5xl"><?php echo e(__('Hadirkan pengalaman brand yang berkesan di setiap touchpoint.')); ?></h1>
                    <p class="mt-4 text-base text-blue-100 sm:text-lg"><?php echo e(__('Tim DigiOH membantu Anda dari ide, produksi konten, hingga strategi growth.')); ?></p>
                    <div class="mt-6 flex flex-wrap items-center gap-4">
                        <a href="#services" class="inline-flex items-center justify-center rounded-full bg-[#ffa630] px-6 py-3 text-sm font-semibold text-[#11224e] shadow-lg shadow-[#11224e]/30 transition hover:bg-[#f17720]"><?php echo e(__('Lihat layanan kami')); ?></a>
                        <?php ($__waNum = preg_replace('/[^0-9]/','', setting('whatsapp_number') ?? '')); ?>
                        <?php ($__waMsg = rawurlencode(setting('whatsapp_prefill') ?? 'Halo DigiOH, saya ingin berdiskusi.')); ?>
                        <?php ($__waLink = $__waNum ? "https://wa.me/$__waNum?text=$__waMsg" : route('contact')); ?>
                        <a href="<?php echo e($__waLink); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-semibold text-white/90 hover:text-white">
                            <?php echo e(__('Hubungi kami')); ?>

                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                    <div class="mt-6 flex flex-col gap-2 text-xs font-semibold uppercase tracking-wide text-indigo-200 sm:flex-row sm:items-center sm:gap-6">
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#ffa630]"></span>
                            <span><?php echo e(__('Produksi konten on-site & studio')); ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#ffa630]"></span>
                            <span><?php echo e(__('Tim lapangan multidisiplin')); ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#ffa630]"></span>
                            <span><?php echo e(__('Pelaporan performa yang terukur')); ?></span>
                        </div>
                    </div>
                </div>
                <div class="hidden max-w-lg sm:block">
                    <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <img src="<?php echo e(asset('digioh-logo.svg')); ?>" alt="Digital Illustration" class="w-full">
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php echo $__env->make('frontend.pages.partials.about-snippet', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if($stats->count()): ?>
        <section class="fade-in relative overflow-hidden bg-gradient-to-b from-[#5c83c4] via-[#4f6da9] to-[#11224e] text-white">
            <div class="absolute inset-0 opacity-25 animate-pulse-slow" style="background-image: radial-gradient(circle at 20% 10%, rgba(255,166,48,.35), transparent 45%), radial-gradient(circle at 80% 0%, rgba(241,119,32,.25), transparent 35%), radial-gradient(circle at 50% 90%, rgba(92,131,196,.4), transparent 50%);"></div>
            <div class="relative mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
                <div class="mb-10 max-w-xl text-center mx-auto" data-aos="fade-up">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-[#ffa630]"><?php echo e(__('Angka yang menunjukkan dampak DigiOH')); ?></span>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div data-aos="zoom-in" data-aos-delay="<?php echo e($index * 100); ?>" class="stat-card flex flex-1 min-w-[300px] max-w-[400px] lg:min-w-0 lg:max-w-none lg:flex-none lg:w-[calc(25%-1.5rem)] items-center gap-5 rounded-3xl border border-white/25 bg-white/10 px-8 py-6 shadow-[0_20px_70px_rgba(0,0,0,0.25)] backdrop-blur hover-glow transition-all duration-300 hover:-translate-y-1">
                            <div class="text-4xl font-bold tracking-tight text-[#ffa630]"><?php echo e($stat['value']); ?></div>
                            <p class="text-xs font-semibold uppercase tracking-widest text-white/90"><?php echo e($stat['label']); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($services->count()): ?>
    <section 
        id="services" 
        class="group mesh-gradient relative overflow-hidden py-24 sm:py-32"
        x-data="{ mouseX: 0, mouseY: 0, active: false }"
        @mousemove="mouseX = $event.clientX; mouseY = $event.clientY; active = true"
        @mouseleave="active = false"
    >
        
        <div 
            class="pointer-events-none absolute inset-0 z-0 transition-opacity duration-1000"
            :class="active ? 'opacity-100' : 'opacity-0'"
            :style="`background: radial-gradient(circle 600px at ${mouseX}px ${mouseY}px, rgba(255, 166, 48, 0.08), transparent 80%)`"
        ></div>


        

        <div class="floating-orb left-[10%] top-[20%] h-64 w-64 bg-indigo-500/20 dark:bg-indigo-500/40"></div>
        <div class="floating-orb right-[5%] top-[10%] h-80 w-80 bg-[#ffa630]/20 dark:bg-[#ffa630]/30" style="animation-delay: -2s;"></div>
        <div class="floating-orb bottom-[10%] left-[20%] h-72 w-72 bg-[#f17720]/20 dark:bg-[#f17720]/30" style="animation-delay: -5s;"></div>

        <div class="relative z-10 mx-auto max-w-screen-xl px-4 sm:px-12">
            <div class="mb-20 text-center">
                <div data-aos="fade-down" class="inline-flex items-center gap-3 rounded-full bg-white/40 px-6 py-2 text-xs font-bold uppercase tracking-[0.4em] text-[#f17720] shadow-sm backdrop-blur-md dark:bg-white/5 dark:text-[#ffa630]">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-[#f17720]"></span>
                    <?php echo e(__('Our Expertise')); ?>

                </div>
                <h2 data-aos="fade-up" data-aos-delay="100" class="mt-8 text-4xl font-black tracking-tight text-[#11224e] dark:text-white sm:text-5xl lg:text-6xl">
                    <?php echo e(__('Layanan yang kami tawarkan')); ?>

                </h2>
                <div data-aos="fade-up" data-aos-delay="200" class="mx-auto mt-8 h-1.5 w-24 rounded-full bg-gradient-to-r from-[#ffa630] to-[#f17720]"></div>
                <p data-aos="fade-up" data-aos-delay="300" class="mx-auto mt-8 max-w-2xl text-lg font-medium leading-relaxed text-slate-600 dark:text-slate-300">
                    <?php echo e(__('Kami membantu produk Anda bertransformasi melalui strategi digital yang tajam, desain yang memukau, dan teknologi mutakhir.')); ?>

                </p>
            </div>


            <div class="flex flex-wrap justify-center gap-10">
                <?php $__currentLoopData = $services->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article 
                        data-aos="fade-up" 
                        data-aos-delay="<?php echo e(100 + ($index * 100)); ?>" 
                        x-data="{ rotateX: 0, rotateY: 0 }"
                        @mousemove="
                            const card = $el.getBoundingClientRect();
                            const x = $event.clientX - card.left;
                            const y = $event.clientY - card.top;
                            const centerX = card.width / 2;
                            const centerY = card.height / 2;
                            rotateX = ((y - centerY) / centerY) * -15;
                            rotateY = ((x - centerX) / centerX) * 15;
                        "
                        @mouseleave="rotateX = 0; rotateY = 0"
                        class="glass-card glow-border group relative flex flex-col items-center gap-8 rounded-[2.5rem] p-10 text-center transition-all duration-500 hover:-translate-y-4 w-full sm:w-[calc(50%-2.5rem)] lg:w-[calc(25%-2.5rem)] min-w-[240px] perspective-container"
                    >
                        
                        <div 
                            class="tilt-box relative z-20"
                            :style="`transform: rotateX(${rotateX}deg) rotateY(${rotateY}deg)`"
                        >
                            <div class="absolute inset-0 -m-4 rounded-[3rem] bg-gradient-to-br from-[#ffa630] to-[#f17720] opacity-0 blur-2xl transition-opacity duration-500 group-hover:opacity-20"></div>
                            <div class="relative flex h-36 w-36 items-center justify-center img-squircle border-4 border-white bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900 tilt-content">
                                <?php ($imagePath = $service['image'] ?? null); ?>
                                <?php if($imagePath): ?>
                                    <img src="<?php echo e(asset($imagePath)); ?>" alt="<?php echo e($service['title']); ?>" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <?php elseif(!empty($service['icon']) && strpos($service['icon'], '<') === false): ?>
                                    <img src="<?php echo e(asset($service['icon'])); ?>" alt="<?php echo e($service['title']); ?>" class="h-full w-full object-cover">
                                <?php else: ?>
                                    <div class="flex h-16 w-16 items-center justify-center text-[#ffa630] [&>svg]:h-full [&>svg]:w-full">
                                        <?php echo $service['icon'] ?? '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>'; ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="space-y-4 tilt-content">
                            <h3 class="text-2xl font-extrabold tracking-tight text-[#11224e] transition-colors duration-300 group-hover:text-[#f17720] dark:text-white dark:group-hover:text-[#ffa630]">
                                <?php echo e($service['title']); ?>

                            </h3>
                            <p class="text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                                <?php echo e(\Str::limit($service['description'], 140)); ?>

                            </p>
                        </div>

                        <?php if(!empty($service['slug'])): ?>
                            <a 
                                href="<?php echo e(route('frontend.services.show', $service['slug'])); ?>" 
                                class="mt-auto inline-flex items-center gap-3 rounded-full bg-gradient-to-r from-[#11224e] to-[#1a3a6e] px-8 py-3 text-sm font-bold text-white shadow-lg transition-all duration-300 hover:from-[#ffa630] hover:to-[#f17720] hover:shadow-[#ffa630]/30 dark:from-[#ffa630] dark:to-[#f17720] dark:text-[#11224e] dark:hover:from-white dark:hover:to-white tilt-content"
                            >
                                <?php echo e(__('Jelajahi Solusi')); ?>

                                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>


        </div>
    </section>
    <?php endif; ?>

    <?php if($blogPosts->count()): ?>
    <section id="our-works" class="bg-gradient-to-b from-[#5c83c4] via-[#4f6da9] to-[#11224e] text-white scroll-mt-16 lg:scroll-mt-24 -mt-8 lg:-mt-12">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-aos="fade-up">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-[#ffa630]"><?php echo e(__('Beyond Expectations Stories')); ?></span>
                    <h2 class="mt-3 text-3xl font-bold text-white"><?php echo e(__('OUR RECENT PROJECT AND EVENTS')); ?></h2>
                </div>
                <a href="<?php echo e(route('frontend.ourwork.index')); ?>" class="inline-flex items-center gap-2 rounded-full border border-white px-4 py-2 text-sm font-semibold text-white transition-all duration-300 hover:bg-white hover:text-[#11224e] hover:-translate-y-1">
                    <?php echo e(__('Jelajahi Ourwork')); ?>

                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>

            <div class="mt-10 grid gap-10 md:grid-cols-3">
                <?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($summary = \Str::limit(strip_tags($post->intro ?: $post->content), 140)); ?>
                    <article data-aos="fade-up" data-aos-delay="<?php echo e($index * 150); ?>" class="group flex flex-col gap-4 rounded-[32px] border border-white/20 bg-white/5 p-6 shadow-[0_25px_80px_rgba(0,0,0,0.3)] hover-lift">
                        <div class="overflow-hidden rounded-[24px] bg-white/10">
                            <img
                                src="<?php echo e(asset($post->image ?: 'img/default_post.svg')); ?>"
                                alt="<?php echo e($post->name); ?>"
                                class="h-64 w-full object-cover transition duration-700 group-hover:scale-105"
                            >
                        </div>
                        <div class="space-y-3 text-white">
                            <div class="flex flex-wrap items-center gap-2 text-xs font-medium uppercase tracking-widest text-white/70">
                                <span><?php echo e(__('Project Highlight')); ?></span>
                                <span class="mx-1 h-1 w-1 rounded-full bg-[#ffa630]"></span>
                                <span><?php echo e($post->published_at ? $post->published_at->isoFormat('D MMM YYYY') : $post->created_at->isoFormat('D MMM YYYY')); ?></span>
                            </div>
                            <h3 class="text-2xl font-semibold"><?php echo e($post->name); ?></h3>
                            <p class="text-base text-white/80"><?php echo e($summary); ?></p>
                            <a href="<?php echo e(route('frontend.posts.show', [encode_id($post->id), $post->slug])); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-[#ffa630] hover:text-white">
                                <?php echo e(__('Lihat detail proyek')); ?>

                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if($logos->count()): ?>
    <section class="relative overflow-hidden bg-white dark:bg-gray-900" id="partners">
        <style>
            /* Trusted by visual polish */
            #partners .trusted-marquee {
                display: flex;
                align-items: center;
                gap: 2rem;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                scroll-padding: 1rem;
                padding-bottom: .5rem;
                cursor: grab;
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            #partners .trusted-marquee::-webkit-scrollbar {
                display: none;
            }
            #partners .trusted-marquee:active {
                cursor: grabbing;
            }
            #partners .trusted-marquee-item {
                flex: 0 0 auto;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: .5rem 1rem;
                border-radius: .75rem;
                background: transparent;
                scroll-snap-align: center;
            }
            #partners .trusted-marquee-item img {
                max-height: 44px;
                width: auto;
                filter: grayscale(100%);
                opacity: .75;
                transition: filter .2s ease, opacity .2s ease, transform .2s ease;
            }
            @media (min-width: 640px){
                #partners .trusted-marquee-item img { max-height: 52px; }
            }
            #partners .trusted-marquee-item:hover img {
                filter: grayscale(0%);
                opacity: 1;
                transform: translateY(-2px);
            }
        </style>
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="flex flex-col gap-4">
                <div>
                    <h2 class="text-2xl font-semibold text-[#11224e] dark:text-white"><?php echo e(__('Trusted by')); ?></h2>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('Brand-brand ini telah bekerja bersama kami untuk menghadirkan solusi digital terbaik.')); ?></p>
                </div>
            </div>

            <div class="relative mt-10">
                <?php if($useMarquee): ?>
                    <div class="pointer-events-none absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-white via-white/80 to-transparent dark:from-gray-900 dark:via-gray-900/80"></div>
                    <div class="pointer-events-none absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-white via-white/80 to-transparent dark:from-gray-900 dark:via-gray-900/80"></div>
                    <div
                        class="trusted-marquee"
                        role="list"
                        x-data="{
                            isDown: false,
                            startX: 0,
                            scrollStart: 0,
                            moved: false,
                            startDrag(event) {
                                this.isDown = true;
                                this.moved = false;
                                this.startX = this.pageX(event);
                                this.scrollStart = this.$refs.logoTrack.scrollLeft;
                            },
                            drag(event) {
                                if (!this.isDown) return;
                                event.preventDefault();
                                this.moved = true;
                                const x = this.pageX(event);
                                const walk = x - this.startX;
                                this.$refs.logoTrack.scrollLeft = this.scrollStart - walk;
                            },
                            endDrag() {
                                this.isDown = false;
                                setTimeout(() => (this.moved = false), 60);
                            },
                            pageX(event) {
                                if (event.touches && event.touches.length) {
                                    return event.touches[0].pageX;
                                }
                                return event.pageX;
                            }
                        }"
                        x-ref="logoTrack"
                        @mousedown.prevent="startDrag($event)"
                        @touchstart.prevent="startDrag($event)"
                        @mouseleave="endDrag()"
                        @mouseup.window="endDrag()"
                        @touchend.window="endDrag()"
                        @mousemove="drag($event)"
                        @touchmove="drag($event)"
                    >
                        <?php $__currentLoopData = $marqueeLogos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="trusted-marquee-item" role="listitem">
                                <?php if($logo->website_url): ?>
                                    <a
                                        href="<?php echo e($logo->website_url); ?>"
                                        target="_blank"
                                        rel="nofollow noopener"
                                        title="<?php echo e($logo->client_name); ?>"
                                        draggable="false"
                                        @click="if(moved){ $event.preventDefault(); }"
                                    >
                                        <img loading="lazy" src="<?php echo e(asset($logo->logo)); ?>" alt="<?php echo e($logo->client_name); ?>" draggable="false">
                                    </a>
                                <?php else: ?>
                                    <img
                                        loading="lazy"
                                        src="<?php echo e(asset($logo->logo)); ?>"
                                        alt="<?php echo e($logo->client_name); ?>"
                                        title="<?php echo e($logo->client_name); ?>"
                                        draggable="false"
                                        @click="if(moved){ $event.preventDefault(); }"
                                    >
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6" role="list">
                        <?php $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="trusted-marquee-item" role="listitem">
                                <?php if($logo->website_url): ?>
                                    <a href="<?php echo e($logo->website_url); ?>" target="_blank" rel="nofollow noopener" title="<?php echo e($logo->client_name); ?>">
                                        <img loading="lazy" src="<?php echo e(asset($logo->logo)); ?>" alt="<?php echo e($logo->client_name); ?>" draggable="false">
                                    </a>
                                <?php else: ?>
                                    <img loading="lazy" src="<?php echo e(asset($logo->logo)); ?>" alt="<?php echo e($logo->client_name); ?>" title="<?php echo e($logo->client_name); ?>" draggable="false">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    

    <?php if($instagramSection['enabled'] && $instagramSection['embeds']->count()): ?>
    <section id="instagram" class="fade-in relative overflow-hidden bg-gradient-to-b from-[#5c83c4] via-[#4f6da9] to-[#11224e] text-white">
        <div class="absolute inset-0 opacity-35" style="background-image: radial-gradient(circle at 10% 15%, rgba(255,166,48,.35), transparent 45%), radial-gradient(circle at 85% 0%, rgba(241,119,32,.25), transparent 40%), radial-gradient(circle at 50% 90%, rgba(92,131,196,.5), transparent 50%);"></div>
        <div class="relative mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="mx-auto max-w-3xl text-center space-y-4">
                <span class="inline-flex items-center justify-center rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#ffa630]"><?php echo e(__('Instagram')); ?></span>
                <?php if($instagramSection['title']): ?>
                    <h2 class="text-3xl font-bold text-white sm:text-4xl"><?php echo e($instagramSection['title']); ?></h2>
                <?php endif; ?>
                <?php if($instagramSection['subtitle']): ?>
                    <p class="text-sm text-slate-200"><?php echo e($instagramSection['subtitle']); ?></p>
                <?php endif; ?>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-<?php echo e(min($instagramSection['embeds']->count(), 3)); ?>">
                <?php $__currentLoopData = $instagramSection['embeds']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex justify-center">
                        <div class="w-full max-w-sm rounded-[32px] border border-white/20 bg-white/10 p-4 shadow-[0_20px_80px_rgba(0,0,0,0.25)] backdrop-blur">
                            <div class="overflow-hidden rounded-2xl bg-black/10">
                                <?php echo $embed; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($instagramSection['profile_url'] && $instagramSection['cta_text']): ?>
                <div class="mt-10 text-center">
                    <a href="<?php echo e($instagramSection['profile_url']); ?>" target="_blank" rel="noopener" class="btn-animated inline-flex items-center gap-3 rounded-full bg-[#ffa630] px-8 py-3 text-sm font-semibold text-[#11224e] shadow-lg shadow-[#11224e]/40 transition hover:-translate-y-0.5 hover:bg-[#f17720]">
                        <svg class="h-5 w-5 text-[#11224e]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.624 5.367 12.013 11.987 12.013s12.013-5.389 12.013-12.013C24.029 5.367 18.641.001 12.017.001zM8.449 12.017c0-1.971 1.597-3.568 3.568-3.568s3.568 1.597 3.568 3.568-1.597 3.568-3.568 3.568-3.568-1.597-3.568-3.568zm7.675-3.976a.83.83 0 11-1.66 0 .83.83 0 011.66 0zM12.017 4.422c2.278 0 2.548.009 3.448.05.832.038 1.284.177 1.585.294.398.155.683.34.982.639.299.299.484.584.639.982.117.301.256.753.294 1.585.041.9.05 1.17.05 3.448s-.009 2.548-.05 3.448c-.038.832-.177 1.284-.294 1.585-.155.398-.34.683-.639.982-.299.299-.584.484-.982.639-.301.117-.753.256-1.585.294-.9.041-1.17.05-3.448.05s-2.548-.009-3.448-.05c-.832-.038-1.284-.177-1.585-.294a2.64 2.64 0 01-.982-.639 2.64 2.64 0 01-.639-.982c-.117-.301-.256-.753-.294-1.585-.041-.9-.05-1.17-.05-3.448s.009-2.548.05-3.448c.038-.832.177-1.284.294-1.585.155-.398.34-.683.639-.982.299-.299.584-.484.982-.639.301-.117.753-.256 1.585-.294.9-.041 1.17-.05 3.448-.05zm0-1.622c-2.317 0-2.608.01-3.518.052-.91.042-1.532.187-2.077.4-.562.218-1.04.51-1.515.985-.475.475-.767.953-.985 1.515-.213.545-.358 1.167-.4 2.077-.042.91-.052 1.201-.052 3.518s.009 2.608.052 3.518c.042.91.187 1.532.4 2.077.218.562.51 1.04.985 1.515.475.475.953.767 1.515.985.545.213 1.167.358 2.077.4.91.042 1.201.052 3.518.052s2.608-.01 3.518-.052c.91-.042 1.532-.187 2.077-.4.562-.218 1.04-.51 1.515-.985.475-.475.767-.953.985-1.515.213-.545.358-1.167.4-2.077.042-.91.052-1.201.052-3.518s-.01-2.608-.052-3.518c-.042-.91-.187-1.532-.4-2.077a4.085 4.085 0 00-.985-1.515 4.085 4.085 0 00-1.515-.985c-.545-.213-1.167-.358-2.077-.4-.91-.042-1.201-.052-3.518-.052z" clip-rule="evenodd"/>
                        </svg>
                        <span><?php echo e($instagramSection['cta_text']); ?></span>
                        <svg class="h-4 w-4 text-[#11224e]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if($faqs->count()): ?>
    <section id="faq" class="fade-in bg-gradient-to-b from-white via-[#f8faff] to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="mx-auto max-w-screen-lg px-4 py-20 sm:px-12">
            <div class="text-center" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 rounded-full border border-[#ffa630]/30 bg-[#ffa630]/10 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.3em] text-[#f17720]">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/></svg>
                    <?php echo e(__('FAQ')); ?>

                </span>
                <h2 class="mt-4 text-3xl font-bold text-[#11224e] dark:text-white sm:text-4xl"><?php echo e(__('Pertanyaan yang sering kami terima')); ?></h2>
                <p class="mx-auto mt-4 max-w-2xl text-sm text-slate-600 dark:text-slate-300"><?php echo e(__('Masih punya pertanyaan lain? Hubungi kami, tim kami akan dengan senang hati membantu.')); ?></p>
            </div>

            <div class="mt-12 space-y-4" x-data="{ open: null }">
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 50); ?>" 
                         class="group rounded-2xl border transition-all duration-300"
                         :class="open === <?php echo e($loop->index); ?> ? 'border-[#ffa630] bg-gradient-to-r from-[#ffa630]/5 to-[#5c83c4]/5 shadow-lg shadow-[#ffa630]/10' : 'border-[#e9e6df] bg-white hover:border-[#ffa630]/50 hover:shadow-md dark:border-slate-700 dark:bg-slate-800'">
                        
                        <button type="button" 
                                class="flex w-full items-center gap-4 px-5 py-5 text-left" 
                                @click="open === <?php echo e($loop->index); ?> ? open = null : open = <?php echo e($loop->index); ?>">
                            <!-- Number badge -->
                            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#ffa630] to-[#f17720] text-sm font-bold text-white shadow-md shadow-[#ffa630]/30 transition-transform duration-300 group-hover:scale-105">
                                <?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?>

                            </span>
                            <span class="flex-1 text-base font-semibold text-[#11224e] dark:text-white"><?php echo e($faq['question']); ?></span>
                            <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full transition-all duration-300"
                                  :class="open === <?php echo e($loop->index); ?> ? 'bg-[#ffa630] text-white rotate-180' : 'bg-[#f8f7f5] text-[#f17720] dark:bg-slate-700'">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </span>
                        </button>
                        
                        <div x-cloak x-show="open === <?php echo e($loop->index); ?>" 
                             x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0" 
                             x-transition:enter-end="opacity-100" 
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100" 
                             x-transition:leave-end="opacity-0">
                            <div class="border-t border-dashed border-[#e9e6df] px-5 py-5 pl-[4.5rem] dark:border-slate-700">
                                <p class="text-sm leading-relaxed text-slate-600 dark:text-slate-300 faq-answer"><?php echo nl2br(e($faq['answer'])); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Contact CTA -->
            <div data-aos="fade-up" class="mt-12 text-center">
                <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('Tidak menemukan jawaban yang Anda cari?')); ?></p>
                <a href="<?php echo e(route('contact')); ?>" class="mt-3 inline-flex items-center gap-2 rounded-full bg-[#11224e] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-[#11224e]/30 transition hover:-translate-y-0.5 hover:bg-[#1a3a6e] dark:bg-[#ffa630] dark:text-[#11224e] dark:shadow-[#ffa630]/30">
                    <?php echo e(__('Hubungi Tim Kami')); ?>

                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.faq-answer').forEach(function(el) {
                el.innerHTML = el.innerHTML.replace(/#([a-zA-Z0-9_-]+)/g, '<a href="#$1" class="text-[#5c83c4] hover:text-[#ffa630] font-medium underline underline-offset-2 transition">#$1</a>');
            });
        });
    </script>
    <?php endif; ?>

    
<?php $__env->stopSection(); ?>












<?php echo $__env->make("frontend.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/frontend/index.blade.php ENDPATH**/ ?>