@extends("frontend.layouts.app")

@section("title")
    {{ app_name() }}
@endsection

@section("content")
    @php
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

        $stats = $stats ?? collect(range(1, 3))->map(function ($index) use ($defaultStats) {
            $value = setting("home_stat_{$index}_value");
            $label = setting("home_stat_{$index}_label");

            return [
                'value' => $value ?: $defaultStats[$index - 1]['value'],
                'label' => $label ?: $defaultStats[$index - 1]['label'],
            ];
        });

        $defaultServices = [
            [
                'title' => __('Strategi Digital & Discovery'),
                'description' => __('Kami bekerja bersama Anda untuk memahami kebutuhan bisnis dan menyusun roadmap produk yang realistis serta terukur.'),
                'icon' => '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 015.273-3.12c.37-.08.63-.391.63-.772V4.5a.75.75 0 01.75-.75A2.25 2.25 0 0118 6v2.25c0 .621.504 1.125 1.125 1.125h1.006c1.026 0 1.945.694 2.054 1.715a9.03 9.03 0 01-.972 5.186M6.633 10.5a2.25 2.25 0 10-3.633 2.769 8.966 8.966 0 00.614 5.093c.16.363.502.588.889.588H9.75A2.25 2.25 0 0012 16.5v-1.125c0-.621-.504-1.125-1.125-1.125h-.642c-.598 0-1.05-.533-.879-1.11a9.04 9.04 0 011.493-2.88M6.633 10.5a9.06 9.06 0 011.74 4.5"/></svg>',
            ],
            [
                'title' => __('Desain Experience & Branding'),
                'description' => __('Tim UI/UX kami membangun tampilan yang elegan dan mudah digunakan, lengkap dengan guideline merek yang konsisten di semua saluran.'),
                'icon' => '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.647A48.627 48.627 0 017.5 15.75m11.85-5.603a60.436 60.436 0 01.491 6.647 48.623 48.623 0 00-3.572-2.804M7.5 15.75l2.25-1.5m6.75 0l-2.25-1.5m-2.25 1.5l.36-.24c.284-.19.426-.285.426-.41 0-.125-.142-.22-.426-.41L12 12.75m0 2.25l-.36.24c-.284.19-.426.285-.426.41 0 .125.142.22.426.41l.36.24m0-1.3l2.25-1.5m-2.25 1.5l-2.25-1.5M7.5 19.5l3.75-2.5m5.25 0l-3.75 2.5M3 9.75c2.347-1.718 5.16-2.75 9-2.75s6.653 1.032 9 2.75M3 9.75C4.89 11.737 8.247 12.75 12 12.75s7.11-1.013 9-3M3 9.75A49.087 49.087 0 0112 9c3.328 0 6.165.3 9 .75"/></svg>',
            ],
            [
                'title' => __('Pengembangan Produk End-to-End'),
                'description' => __('Kami membangun aplikasi web maupun mobile yang skalabel dengan praktik engineering modern, CI/CD, dan pengujian menyeluruh.'),
                'icon' => '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 8.25V6zM13.5 6A2.25 2.25 0 0115.75 3.75H18a2.25 2.25 0 012.25 2.25v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0112.5 20.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 15.75A2.25 2.25 0 0115.75 13.5H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>',
            ],
            [
                'title' => __('Optimalisasi & Growth Marketing'),
                'description' => __('Kami mendukung peluncuran dan pengembangan produk melalui analitik, eksperimen, dan kampanye digital yang terukur.'),
                'icon' => '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l7.5 7.5V13.5H3zM3 10.5h7.5V3L3 10.5zm10.5 0H21L13.5 3v7.5zm0 3H21l-7.5 7.5V13.5z"/></svg>',
            ],
        ];

        $locale = app()->getLocale();
        $services = collect(range(1, 4))->map(function ($index) use ($defaultServices, $locale) {
            $title = $locale === 'en' ? (setting("home_service_{$index}_title_en") ?: setting("home_service_{$index}_title")) : setting("home_service_{$index}_title");
            $description = $locale === 'en' ? (setting("home_service_{$index}_description_en") ?: setting("home_service_{$index}_description")) : setting("home_service_{$index}_description");
            $icon = setting("home_service_{$index}_icon");

            return [
                'title' => $title ?: $defaultServices[$index - 1]['title'],
                'description' => $description ?: $defaultServices[$index - 1]['description'],
                'icon' => $icon ?: $defaultServices[$index - 1]['icon'],
            ];
        })->filter(fn ($service) => !empty($service['title']));

        $dbServices = \App\Models\Service::active()->where('featured_on_home', true)->sorted()->get();
        if ($dbServices->count()) {
            $services = $dbServices->map(function ($s) use ($locale) {
                return [
                    'title' => $locale === 'en' ? ($s->name_en ?: $s->name) : $s->name,
                    'description' => $locale === 'en' ? ($s->description_en ?: $s->description) : $s->description,
                    'icon' => $s->icon,
                    'slug' => $s->slug,
                ];
            });
        }

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
            ? $faqEntries->values()->map(function ($faq, $index) use ($locale, $defaultFaqs) {
                $default = $defaultFaqs[$index % count($defaultFaqs)];

                $question = $locale === 'en'
                    ? ($faq->question_en ?: $faq->question)
                    : ($faq->question ?: $faq->question_en);

                $answer = $locale === 'en'
                    ? ($faq->answer_en ?: $faq->answer)
                    : ($faq->answer ?: $faq->answer_en);

                return [
                    'question' => $question ?: $default['question'],
                    'answer' => $answer ?: $default['answer'],
                ];
            })
            : collect($defaultFaqs);

        $works = \Modules\OurWork\Models\OurWork::active()->where('featured_on_home', true)->sorted()->take(6)->get();
        $blogPosts = \Modules\Post\Models\Post::published()->featured()->take(3)->get();

        $cta = [
            'title' => setting('home_cta_title') ?: __('Siap berkolaborasi?'),
            'subtitle' => setting('home_cta_subtitle') ?: __('Mari ciptakan pengalaman digital yang berdampak bagi pelanggan Anda.'),
            'primary_text' => setting('home_cta_primary_text') ?: __('Diskusikan proyek Anda'),
            'primary_link' => setting('home_cta_primary_link') ?: route('contact'),
            'secondary_text' => setting('home_cta_secondary_text') ?: __('Pelajari proses kerja kami'),
            'secondary_link' => setting('home_cta_secondary_link') ?: route('about'),
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
    @endphp

    @if($slides->isNotEmpty())
        <section
            x-data='{
                slides: @json($heroSlides->values()),
                current: 0,
                interval: null,
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

            <div class="relative z-10 mx-auto flex min-h-screen max-w-screen-xl flex-col justify-center gap-6 px-4 py-20 sm:px-12">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium uppercase tracking-wider text-indigo-200">{{ __('Konsultan Transformasi Digital') }}</span>
                    <template x-if="slides[current]?.title">
                        <h1 class="mt-6 text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl" x-text="slides[current].title"></h1>
                    </template>
                    <template x-if="slides[current]?.subtitle">
                        <p class="mt-4 text-base text-slate-200 sm:text-lg" x-text="slides[current].subtitle"></p>
                    </template>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <template x-if="slides[current]?.button_text">
                        <a :href="slides[current].button_link || '#contact'" class="inline-flex items-center justify-center rounded-full bg-indigo-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            <span x-text="slides[current].button_text"></span>
                        </a>
                    </template>
                    <a href="#services" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-100 hover:text-white">
                        <span>{{ __('Lihat layanan kami') }}</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>
            </div>

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
    @else
        <section class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 text-white">
            <div class="absolute -left-20 top-[-140px] h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -right-28 bottom-[-160px] h-96 w-96 rounded-full bg-purple-500/20 blur-3xl"></div>

            <div class="mx-auto flex max-w-screen-xl flex-col gap-10 px-4 py-24 sm:flex-row sm:items-center sm:justify-between sm:px-12">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium uppercase tracking-wider">{{ __('Solusi Event & Activation') }}</span>
                    <h1 class="mt-6 text-4xl font-bold leading-tight sm:text-5xl">{{ __('Hadirkan pengalaman brand yang berkesan di setiap touchpoint.') }}</h1>
                    <p class="mt-4 text-base text-blue-100 sm:text-lg">{{ __('Tim DigiOH membantu Anda dari ide, produksi konten, hingga strategi growth.') }}</p>
                    <div class="mt-6 flex flex-wrap items-center gap-4">
                        <a href="#services" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-slate-900/10 hover:bg-slate-100">{{ __('Lihat layanan kami') }}</a>
                        @php($__waNum = preg_replace('/[^0-9]/','', setting('whatsapp_number') ?? ''))
                        @php($__waMsg = rawurlencode(setting('whatsapp_prefill') ?? 'Halo DigiOH, saya ingin berdiskusi.'))
                        @php($__waLink = $__waNum ? "https://wa.me/$__waNum?text=$__waMsg" : route('contact'))
                        <a href="{{ $__waLink }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-semibold text-white hover:text-blue-50">
                            {{ __('Hubungi kami') }}
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                    <div class="mt-6 flex flex-col gap-2 text-xs font-semibold uppercase tracking-wide text-indigo-200 sm:flex-row sm:items-center sm:gap-6">
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                            <span>{{ __('Produksi konten on-site & studio') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                            <span>{{ __('Tim lapangan multidisiplin') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                            <span>{{ __('Pelaporan performa yang terukur') }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden max-w-lg sm:block">
                    <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <img src="{{ asset('digioh-logo.svg') }}" alt="Digital Illustration" class="w-full">
                    </div>
                </div>
            </div>
        </section>
    @endif
    @include('frontend.pages.partials.about-snippet')
    @if($stats->count())
        <section class="bg-slate-900 text-white">
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
                <div class="mb-10 max-w-xl">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-300">{{ __('Angka yang menunjukkan dampak DigiOH') }}</span>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    @foreach($stats as $stat)
                        <div class="flex-shrink-0 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-lg shadow-black/10 backdrop-blur min-w-[240px] max-w-xs">
                            <div class="text-3xl font-bold tracking-tight text-white">{{ $stat['value'] }}</div>
                            <p class="mt-2 text-sm text-slate-300">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($services->count())
    <section id="services" class="bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="max-w-3xl">
                <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-500">{{ __('Layanan utama') }}</span>
                @php($servicesHeading = app()->getLocale() === 'en' ? (setting('home_services_heading_en') ?: setting('home_services_heading')) : setting('home_services_heading'))
                <h2 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white">{{ $servicesHeading ?: __('Kami membantu perusahaan merancang, membangun, dan mengembangkan produk digital end-to-end.') }}</h2>
                <p class="mt-4 text-sm text-slate-600 dark:text-slate-300">{{ __('Dari fase discovery hingga pertumbuhan produk, tim multidisiplin kami siap mendampingi organisasi Anda mencapai objektif bisnis.') }}</p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach($services as $service)
                    <div class="group flex h-full flex-col justify-between rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800/50 dark:bg-slate-900 dark:shadow-black/30">
                        <div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                                {!! $service['icon'] !!}
                            </div>
                            <h3 class="mt-6 text-lg font-semibold text-slate-900 dark:text-white">{{ $service['title'] }}</h3>
                            <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">{{ $service['description'] }}</p>
                        </div>
                        <div class="mt-6 flex items-center gap-2 text-sm font-semibold text-indigo-600 dark:text-indigo-300">
                            @if(!empty($service['slug']))
                                <a href="{{ route('frontend.services.show', $service['slug']) }}" class="inline-flex items-center gap-2">
                                    {{ __('Pelajari layanan ini') }}
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </a>
                            @else
                                {{ __('Pelajari layanan ini') }}
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    
    @if(setting('home_show_portfolio', false) && $works->count())
        <section id="portfolio" class="bg-white dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-500">{{ __('Portofolio terbaru') }}</span>
                        <h2 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white">{{ __('Kisah sukses transformasi digital mitra kami') }}</h2>
                        <p class="mt-4 text-sm text-slate-600 dark:text-slate-300">{{ __('Kami membantu brand dari berbagai industri merancang pengalaman digital yang berdampak. Berikut beberapa highlight proyek yang baru saja kami selesaikan.') }}</p>
                    </div>
                    <a href="{{ route('frontend.ourwork.index') ?? '#' }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">
                        {{ __('Lihat semua studi kasus') }}
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($works as $work)
                        <article class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800/60 dark:bg-slate-900 dark:shadow-black/30">
                            @if($work->cover_image)
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset($work->cover_image) }}" alt="{{ $work->name }}" class="h-48 w-full object-cover transition duration-700 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                                    <div class="absolute bottom-3 left-4 text-xs font-medium uppercase tracking-wider text-white/80">{{ __('Featured project') }}</div>
                                </div>
                            @endif
                            <div class="flex flex-1 flex-col gap-4 p-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $work->name }}</h3>
                                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ \Str::limit(strip_tags($work->excerpt ?: $work->description), 120) }}</p>
                                </div>
                                <div class="mt-auto flex items-center justify-between text-sm font-semibold text-indigo-600 dark:text-indigo-300">
                                    <a href="{{ route('frontend.ourwork.show', [encode_id($work->id), $work->slug]) }}" class="inline-flex items-center gap-2">
                                        {{ __('Lihat studi kasus') }}
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                    </a>
                                    @if($work->industry)
                                        <span class="text-xs font-medium uppercase tracking-wide text-slate-400 dark:text-slate-500">{{ $work->industry }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
    </section>

    @endif

    @if($blogPosts->count())
    <section id="insights" class="bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-500">{{ __('Blog & insight terbaru') }}</span>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white">{{ __('Wawasan seputar produk digital, teknologi, dan pertumbuhan bisnis') }}</h2>
                </div>
                <a href="{{ route('frontend.ourwork.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">
                    {{ __('Lihat semua') }}
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach($blogPosts as $post)
                    <article class="flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800/60 dark:bg-slate-900 dark:shadow-black/30">
                        <img src="{{ asset($post->image ?: 'img/default_post.svg') }}" alt="{{ $post->name }}" class="h-44 w-full object-cover">
                        <div class="flex flex-1 flex-col gap-4 p-6">
                            <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-indigo-500">
                                <span>{{ __('Insight') }}</span>
                                <span class="h-1 w-1 rounded-full bg-indigo-200"></span>
                                <span>{{ $post->published_at ? $post->published_at->isoFormat('D MMM YYYY') : $post->created_at->isoFormat('D MMM YYYY') }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $post->name }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-300">{{ \Str::limit(strip_tags($post->intro ?: $post->content), 140) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('frontend.posts.show', [encode_id($post->id), $post->slug]) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">
                                    {{ __('Baca selengkapnya') }}
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($logos->count())
    <section class="relative overflow-hidden bg-white dark:bg-gray-900" id="partners">
        <style>
            /* Trusted by visual polish */
            #partners .trusted-marquee,
            #partners [role="list"] {
                display: flex;
                align-items: center;
                gap: 2rem;
            }
            #partners .trusted-marquee-item {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: .5rem 1rem;
                border-radius: .75rem;
                background: transparent;
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
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ __('Trusted by') }}</h2>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Brand-brand ini telah bekerja bersama kami untuk menghadirkan solusi digital terbaik.') }}</p>
                </div>
                <div class="hidden sm:flex items-center gap-2 text-sm text-slate-400 dark:text-slate-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 4.5 19.5 12l-6.75 7.5M4.5 4.5 11.25 12 4.5 19.5"></path>
                    </svg>
                    <span>{{ __('Geser untuk melihat lainnya') }}</span>
                </div>
            </div>

            <div class="relative mt-10">
                @if($useMarquee)
                    <div class="pointer-events-none absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-white via-white/80 to-transparent dark:from-gray-900 dark:via-gray-900/80"></div>
                    <div class="pointer-events-none absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-white via-white/80 to-transparent dark:from-gray-900 dark:via-gray-900/80"></div>
                    <div class="trusted-marquee" role="list">
                        @foreach($marqueeLogos as $logo)
                            <div class="trusted-marquee-item" role="listitem">
                                @if($logo->website_url)
                                    <a href="{{ $logo->website_url }}" target="_blank" rel="nofollow noopener" title="{{ $logo->client_name }}">
                                        <img loading="lazy" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}">
                                    </a>
                                @else
                                    <img loading="lazy" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}" title="{{ $logo->client_name }}">
                                @endif>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6" role="list">
                        @foreach($logos as $logo)
                            <div class="trusted-marquee-item" role="listitem">
                                @if($logo->website_url)
                                    <a href="{{ $logo->website_url }}" target="_blank" rel="nofollow noopener" title="{{ $logo->client_name }}">
                                        <img loading="lazy" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}">
                                    </a>
                                @else
                                    <img loading="lazy" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}" title="{{ $logo->client_name }}">
                                @endif>
                            </div>
                        @endforeach
                    </div>
                @endif>
            </div>
        </div>
    </section>
    @endif

    <section id="why-us" class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 text-white">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="mx-auto max-w-3xl text-center">
                <span class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70">{{ __('Why Choose Us') }}</span>
                <h2 class="mt-3 text-3xl font-bold sm:text-4xl">{{ __('A Few Reasons Why We Might Be The Right One') }}</h2>
                <p class="mt-4 text-sm text-white/80">{{ __('Kami memadukan strategi, desain, dan engineering untuk menghadirkan solusi digital yang berdampak dan terukur.') }}</p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 text-white">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5M21 12A9 9 0 113 12a9 9 0 1118 0z"/></svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-white">{{ __('Berorientasi Hasil') }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ __('Setiap inisiatif memiliki metrik sukses yang jelas dan kami mengoptimalkannya secara berkelanjutan.') }}</p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 text-white">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h12A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6z"/></svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-white">{{ __('Desain & Pengalaman Kelas Satu') }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ __('UI/UX elegan dan mudah digunakan, konsisten di seluruh touchpoint brand Anda.') }}</p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 text-white">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5h18M3 12h18M3 16.5h18"/></svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-white">{{ __('Engineering yang Andal') }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ __('Praktik modern (CI/CD, testing, security) untuk produk yang tangguh dan skalabel.') }}</p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 text-white">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3"/></svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-white">{{ __('Tim Multidisiplin') }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ __('Strategist, desainer, engineer, dan analis growth bekerja sebagai satu skuad.') }}</p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 text-white">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 1118 0z"/></svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-white">{{ __('Proses Transparan') }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ __('Sprint mingguan, demo rutin, dan komunikasi yang selalu terbuka.') }}</p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 text-white">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25l3 3 6-6M4.5 6.75h15"/></svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-white">{{ __('Kemitraan Jangka Panjang') }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ __('Kami hadir tidak hanya saat peluncuran, tapi juga untuk fase pertumbuhan Anda.') }}</p>
                </div>
            </div>
        </div>
    </section>

    @if($instagramSection['enabled'] && $instagramSection['embeds']->count())
    <section id="instagram" class="bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="max-w-3xl text-center mx-auto">
                <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-500">{{ __('Instagram') }}</span>
                @if($instagramSection['title'])
                    <h2 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white">{{ $instagramSection['title'] }}</h2>
                @endif
                @if($instagramSection['subtitle'])
                    <p class="mt-4 text-sm text-slate-600 dark:text-slate-300">{{ $instagramSection['subtitle'] }}</p>
                @endif
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-{{ min($instagramSection['embeds']->count(), 3) }}">
                @foreach($instagramSection['embeds'] as $embed)
                    <div class="flex justify-center">
                        <div class="w-full max-w-sm">
                            {!! $embed !!}
                        </div>
                    </div>
                @endforeach
            </div>

            @if($instagramSection['profile_url'] && $instagramSection['cta_text'])
                <div class="mt-10 text-center">
                    <a href="{{ $instagramSection['profile_url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.624 5.367 12.013 11.987 12.013s12.013-5.389 12.013-12.013C24.029 5.367 18.641.001 12.017.001zM8.449 12.017c0-1.971 1.597-3.568 3.568-3.568s3.568 1.597 3.568 3.568-1.597 3.568-3.568 3.568-3.568-1.597-3.568-3.568zm7.675-3.976a.83.83 0 11-1.66 0 .83.83 0 011.66 0zM12.017 4.422c2.278 0 2.548.009 3.448.05.832.038 1.284.177 1.585.294.398.155.683.34.982.639.299.299.484.584.639.982.117.301.256.753.294 1.585.041.9.05 1.17.05 3.448s-.009 2.548-.05 3.448c-.038.832-.177 1.284-.294 1.585-.155.398-.34.683-.639.982-.299.299-.584.484-.982.639-.301.117-.753.256-1.585.294-.9.041-1.17.05-3.448.05s-2.548-.009-3.448-.05c-.832-.038-1.284-.177-1.585-.294a2.64 2.64 0 01-.982-.639 2.64 2.64 0 01-.639-.982c-.117-.301-.256-.753-.294-1.585-.041-.9-.05-1.17-.05-3.448s.009-2.548.05-3.448c.038-.832.177-1.284.294-1.585.155-.398.34-.683.639-.982.299-.299.584-.484.982-.639.301-.117.753-.256 1.585-.294.9-.041 1.17-.05 3.448-.05zm0-1.622c-2.317 0-2.608.01-3.518.052-.91.042-1.532.187-2.077.4-.562.218-1.04.51-1.515.985-.475.475-.767.953-.985 1.515-.213.545-.358 1.167-.4 2.077-.042.91-.052 1.201-.052 3.518s.009 2.608.052 3.518c.042.91.187 1.532.4 2.077.218.562.51 1.04.985 1.515.475.475.953.767 1.515.985.545.213 1.167.358 2.077.4.91.042 1.201.052 3.518.052s2.608-.01 3.518-.052c.91-.042 1.532-.187 2.077-.4.562-.218 1.04-.51 1.515-.985.475-.475.767-.953.985-1.515.213-.545.358-1.167.4-2.077.042-.91.052-1.201.052-3.518s-.01-2.608-.052-3.518c-.042-.91-.187-1.532-.4-2.077a4.085 4.085 0 00-.985-1.515 4.085 4.085 0 00-1.515-.985c-.545-.213-1.167-.358-2.077-.4-.91-.042-1.201-.052-3.518-.052z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $instagramSection['cta_text'] }}</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
    @endif

    @if($faqs->count())
    <section id="faq" class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="max-w-3xl">
                <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-500">{{ __('FAQ') }}</span>
                <h2 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white">{{ __('Pertanyaan yang sering kami terima') }}</h2>
                <p class="mt-4 text-sm text-slate-600 dark:text-slate-300">{{ __('Masih punya pertanyaan lain? Hubungi kami, tim kami akan dengan senang hati membantu.') }}</p>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-2" x-data="{ open: 0 }">
                @foreach($faqs as $index => $faq)
                    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-slate-800/60 dark:bg-slate-900 dark:shadow-black/30">
                        <button type="button" class="flex w-full items-center justify-between gap-3 text-left" @click="open === {{ $index }} ? open = null : open = {{ $index }}">
                            <span class="text-base font-semibold text-slate-900 dark:text-white">{{ $faq['question'] }}</span>
                            <svg class="h-5 w-5 text-indigo-500 transition" :class="{ 'rotate-45': open === {{ $index }} }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        </button>
                        <div x-cloak x-show="open === {{ $index }}" x-transition class="mt-4 text-sm text-slate-600 dark:text-slate-300">
                            {!! nl2br(e($faq['answer'])) !!}
                        </div>
                    </div>
                @endforeach>
            </div>
        </div>
    </section>
    @endif

    <section id="contact" class="bg-slate-900">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-400">{{ __('Mari mulai') }}</span>
                    <h2 class="mt-4 text-3xl font-bold text-white sm:text-4xl">{{ __('Cerita sukses Anda berikutnya bisa dimulai dari sini.') }}</h2>
                    <p class="mt-4 max-w-xl text-sm text-slate-300">{{ __('Kirimkan detail kebutuhan dan tim kami akan merespons dalam 12 hari kerja. Kami juga dapat menjadwalkan discovery call singkat untuk memahami objektif Anda.') }}</p>
                    <div class="mt-6 flex flex-wrap items-center gap-6 text-sm text-slate-300">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-500/20 text-indigo-300">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v1.128c0 .387-.19.75-.508.967l-8.25 5.5a1.125 1.125 0 01-1.234 0l-8.25-5.5a1.125 1.125 0 01-.508-.967V6.75z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 8.91l7.36 4.906c.53.353 1.25.353 1.78 0l7.36-4.906"/><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5h15"/></svg>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-slate-400">{{ __('Email kami') }}</div>
                                <a href="mailto:{{ setting('contact_email') ?? 'hello@digioh.id' }}" class="font-semibold text-slate-200 hover:text-white">{{ setting('contact_email') ?? 'hello@digioh.id' }}</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-500/20 text-indigo-300">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-slate-400">{{ __('Kunjungi studio kami') }}</div>
                                <p class="font-semibold text-slate-200">{{ setting('contact_address') ?? 'Jakarta & Yogyakarta' }}</p>
                            </div>
                        </div>
                        @if(setting('contact_map_embed'))
                            <div class="mt-6 overflow-hidden rounded-2xl">
                                {!! setting('contact_map_embed') !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="rounded-3xl border border-slate-800 bg-slate-950/60 p-8 shadow-2xl shadow-black/20">
                    <h3 class="text-lg font-semibold text-white">{{ __('Ceritakan rencana Anda') }}</h3>
                    <p class="mt-2 text-sm text-slate-300">{{ __('Isi formulir singkat di bawah ini dan kami akan segera menghubungi Anda kembali.') }}</p>
                    <form class="mt-6 space-y-4" action="{{ route('contact') }}" method="GET">
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-400" for="contact-name">{{ __('Nama') }}</label>
                            <input id="contact-name" type="text" placeholder="{{ __('Nama lengkap') }}" class="mt-2 w-full rounded-full border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-indigo-400 focus:outline-none focus:ring-0" required>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-400" for="contact-email">{{ __('Email') }}</label>
                            <input id="contact-email" type="email" placeholder="you@company.com" class="mt-2 w-full rounded-full border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-indigo-400 focus:outline-none focus:ring-0" required>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-400" for="contact-message">{{ __('Ringkasan kebutuhan') }}</label>
                            <textarea id="contact-message" rows="4" placeholder="{{ __('Jelaskan tujuan dan tantangan utama bisnis Anda...') }}" class="mt-2 w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-indigo-400 focus:outline-none focus:ring-0"></textarea>
                        </div>
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-indigo-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-400">{{ __('Kirim pesan') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


































































