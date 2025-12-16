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
    @endphp

    @if($slides->isNotEmpty())
        <section
            x-data='{
                slides: @json($heroSlides->values()),
                current: 0,
                interval: null,
                titleFallbackText: @json(__('PT. Digital Open House - Transformasi Digital Tanpa Ribet')),
                subtitleFallbackText: @json(__('Kami membantu brand tumbuh melalui strategi, desain, dan teknologi digital end-to-end.')),
                ctaFallbackText: @json(__('Diskusikan proyek Anda')),
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
                        {{ __('PT. Digital Open House') }}
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

                @if($heroHighlights->filter(fn($item) => !empty($item['value']) || !empty($item['label']))->count())
                    <div class="flex flex-wrap gap-3">
                        @foreach($heroHighlights as $highlight)
                            <div class="group flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 text-white backdrop-blur transition hover:bg-white/15">
                                <span class="text-2xl font-semibold leading-none">{{ $highlight['value'] ?? '' }}</span>
                                <span class="max-w-[10rem] text-xs font-medium uppercase tracking-wide text-slate-200 group-hover:text-white">
                                    {{ $highlight['label'] ?? '' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
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
    @else
        <section class="relative overflow-hidden bg-gradient-to-r from-[#11224e] via-[#5c83c4] to-[#ffa630] text-white">
            <div class="absolute -left-20 top-[-140px] h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -right-28 bottom-[-160px] h-96 w-96 rounded-full bg-orange-400/30 blur-3xl"></div>

            <div class="mx-auto flex max-w-screen-xl flex-col gap-10 px-4 py-24 sm:flex-row sm:items-center sm:justify-between sm:px-12">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium uppercase tracking-wider">{{ __('Solusi Event & Activation') }}</span>
                    <h1 class="mt-6 text-4xl font-bold leading-tight sm:text-5xl">{{ __('Hadirkan pengalaman brand yang berkesan di setiap touchpoint.') }}</h1>
                    <p class="mt-4 text-base text-blue-100 sm:text-lg">{{ __('Tim DigiOH membantu Anda dari ide, produksi konten, hingga strategi growth.') }}</p>
                    <div class="mt-6 flex flex-wrap items-center gap-4">
                        <a href="#services" class="inline-flex items-center justify-center rounded-full bg-[#ffa630] px-6 py-3 text-sm font-semibold text-[#11224e] shadow-lg shadow-[#11224e]/30 transition hover:bg-[#f17720]">{{ __('Lihat layanan kami') }}</a>
                        @php($__waNum = preg_replace('/[^0-9]/','', setting('whatsapp_number') ?? ''))
                        @php($__waMsg = rawurlencode(setting('whatsapp_prefill') ?? 'Halo DigiOH, saya ingin berdiskusi.'))
                        @php($__waLink = $__waNum ? "https://wa.me/$__waNum?text=$__waMsg" : route('contact'))
                        <a href="{{ $__waLink }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-semibold text-white/90 hover:text-white">
                            {{ __('Hubungi kami') }}
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                    <div class="mt-6 flex flex-col gap-2 text-xs font-semibold uppercase tracking-wide text-indigo-200 sm:flex-row sm:items-center sm:gap-6">
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#ffa630]"></span>
                            <span>{{ __('Produksi konten on-site & studio') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#ffa630]"></span>
                            <span>{{ __('Tim lapangan multidisiplin') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#ffa630]"></span>
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
        <section class="fade-in relative overflow-hidden bg-gradient-to-b from-[#5c83c4] via-[#4f6da9] to-[#11224e] text-white">
            <div class="absolute inset-0 opacity-25 animate-pulse-slow" style="background-image: radial-gradient(circle at 20% 10%, rgba(255,166,48,.35), transparent 45%), radial-gradient(circle at 80% 0%, rgba(241,119,32,.25), transparent 35%), radial-gradient(circle at 50% 90%, rgba(92,131,196,.4), transparent 50%);"></div>
            <div class="relative mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
                <div class="mb-10 max-w-xl text-center mx-auto" data-aos="fade-up">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-[#ffa630]">{{ __('Angka yang menunjukkan dampak DigiOH') }}</span>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    @foreach($stats as $index => $stat)
                        <div data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}" class="stat-card flex-shrink-0 min-w-[220px] max-w-xs flex flex-col items-center rounded-3xl border border-white/25 bg-white/10 p-6 text-center shadow-[0_20px_70px_rgba(0,0,0,0.25)] backdrop-blur hover-glow transition-all duration-300 hover:-translate-y-1">
                            <div class="text-3xl font-bold tracking-tight text-[#ffa630]">{{ $stat['value'] }}</div>
                            <p class="mt-2 text-sm text-white/80">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($services->count())
    <section id="services" class="bg-white dark:bg-slate-950">
        <div class="mx-auto max-w-screen-xl px-4 py-16 text-center sm:px-12">
            <span data-aos="fade-down" class="text-xs font-semibold uppercase tracking-[0.3em] text-[#f17720]">{{ __('Our Services') }}</span>
            <h2 data-aos="fade-up" data-aos-delay="100" class="mt-3 text-3xl font-bold text-[#11224e] dark:text-white">{{ __('Layanan yang kami tawarkan') }}</h2>
            <p data-aos="fade-up" data-aos-delay="200" class="mx-auto mt-4 max-w-3xl text-sm text-slate-600 dark:text-slate-100">{{ __('We help companies design, build, and grow end-to-end digital products.') }}</p>

            <div class="mt-12 grid gap-10 md:grid-cols-2 xl:grid-cols-4">
                @foreach($services->take(8) as $index => $service)
                    <article data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 100) }}" class="flex h-full flex-col items-center text-center gap-4 rounded-3xl border border-[#e9e6df] bg-white p-6 shadow-sm hover-lift dark:border-slate-800/60 dark:bg-slate-900 dark:shadow-black/40">
                        @php($imagePath = $service['image'] ?? null)
                        <div class="h-28 w-28 rounded-full border-4 border-[#ffa630] bg-white p-1 shadow-lg shadow-[#ffa630]/30">
                            <div class="h-full w-full overflow-hidden rounded-full">
                                @if($imagePath)
                                    <img src="{{ asset($imagePath) }}" alt="{{ $service['title'] }}" class="h-full w-full object-cover">
                                @elseif(!empty($service['icon']) && strpos($service['icon'], '<') === false)
                                    <img src="{{ asset($service['icon']) }}" alt="{{ $service['title'] }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-[#f8f7f5] text-[#ffa630]">
                                        <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/></svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-[#11224e] dark:text-white">{{ $service['title'] }}</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-100">{{ $service['description'] }}</p>
                        @if(!empty($service['slug']))
                            <a href="{{ route('frontend.services.show', $service['slug']) }}" class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-[#f17720] dark:text-[#ffa630]">
                                {{ __('Pelajari layanan ini') }}
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($blogPosts->count())
    <section id="our-works" class="bg-gradient-to-b from-[#5c83c4] via-[#4f6da9] to-[#11224e] text-white scroll-mt-16 lg:scroll-mt-24 -mt-8 lg:-mt-12">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-aos="fade-up">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-[#ffa630]">{{ __('Beyond Expectations Stories') }}</span>
                    <h2 class="mt-3 text-3xl font-bold text-white">{{ __('OUR RECENT PROJECT AND EVENTS') }}</h2>
                </div>
                <a href="{{ route('frontend.ourwork.index') }}" class="inline-flex items-center gap-2 rounded-full border border-white px-4 py-2 text-sm font-semibold text-white transition-all duration-300 hover:bg-white hover:text-[#11224e] hover:-translate-y-1">
                    {{ __('Jelajahi Ourwork') }}
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>

            <div class="mt-10 grid gap-10 md:grid-cols-3">
                @foreach($blogPosts as $index => $post)
                    @php($summary = \Str::limit(strip_tags($post->intro ?: $post->content), 140))
                    <article data-aos="fade-up" data-aos-delay="{{ $index * 150 }}" class="group flex flex-col gap-4 rounded-[32px] border border-white/20 bg-white/5 p-6 shadow-[0_25px_80px_rgba(0,0,0,0.3)] hover-lift">
                        <div class="overflow-hidden rounded-[24px] bg-white/10">
                            <img
                                src="{{ asset($post->image ?: 'img/default_post.svg') }}"
                                alt="{{ $post->name }}"
                                class="h-64 w-full object-cover transition duration-700 group-hover:scale-105"
                            >
                        </div>
                        <div class="space-y-3 text-white">
                            <div class="flex flex-wrap items-center gap-2 text-xs font-medium uppercase tracking-widest text-white/70">
                                <span>{{ __('Project Highlight') }}</span>
                                <span class="mx-1 h-1 w-1 rounded-full bg-[#ffa630]"></span>
                                <span>{{ $post->published_at ? $post->published_at->isoFormat('D MMM YYYY') : $post->created_at->isoFormat('D MMM YYYY') }}</span>
                            </div>
                            <h3 class="text-2xl font-semibold">{{ $post->name }}</h3>
                            <p class="text-base text-white/80">{{ $summary }}</p>
                            <a href="{{ route('frontend.posts.show', [encode_id($post->id), $post->slug]) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#ffa630] hover:text-white">
                                {{ __('Lihat detail proyek') }}
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
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
                    <h2 class="text-2xl font-semibold text-[#11224e] dark:text-white">{{ __('Trusted by') }}</h2>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Brand-brand ini telah bekerja bersama kami untuk menghadirkan solusi digital terbaik.') }}</p>
                </div>
            </div>

            <div class="relative mt-10">
                @if($useMarquee)
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
                        @foreach($marqueeLogos as $logo)
                            <div class="trusted-marquee-item" role="listitem">
                                @if($logo->website_url)
                                    <a
                                        href="{{ $logo->website_url }}"
                                        target="_blank"
                                        rel="nofollow noopener"
                                        title="{{ $logo->client_name }}"
                                        draggable="false"
                                        @click="if(moved){ $event.preventDefault(); }"
                                    >
                                        <img loading="lazy" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}" draggable="false">
                                    </a>
                                @else
                                    <img
                                        loading="lazy"
                                        src="{{ asset($logo->logo) }}"
                                        alt="{{ $logo->client_name }}"
                                        title="{{ $logo->client_name }}"
                                        draggable="false"
                                        @click="if(moved){ $event.preventDefault(); }"
                                    >
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6" role="list">
                        @foreach($logos as $logo)
                            <div class="trusted-marquee-item" role="listitem">
                                @if($logo->website_url)
                                    <a href="{{ $logo->website_url }}" target="_blank" rel="nofollow noopener" title="{{ $logo->client_name }}">
                                        <img loading="lazy" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}" draggable="false">
                                    </a>
                                @else
                                    <img loading="lazy" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}" title="{{ $logo->client_name }}" draggable="false">
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- <section id="why-us" class="fade-in relative overflow-hidden bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 text-white">
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
    </section> --}}

    @if($instagramSection['enabled'] && $instagramSection['embeds']->count())
    <section id="instagram" class="fade-in relative overflow-hidden bg-gradient-to-b from-[#5c83c4] via-[#4f6da9] to-[#11224e] text-white">
        <div class="absolute inset-0 opacity-35" style="background-image: radial-gradient(circle at 10% 15%, rgba(255,166,48,.35), transparent 45%), radial-gradient(circle at 85% 0%, rgba(241,119,32,.25), transparent 40%), radial-gradient(circle at 50% 90%, rgba(92,131,196,.5), transparent 50%);"></div>
        <div class="relative mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="mx-auto max-w-3xl text-center space-y-4">
                <span class="inline-flex items-center justify-center rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#ffa630]">{{ __('Instagram') }}</span>
                @if($instagramSection['title'])
                    <h2 class="text-3xl font-bold text-white sm:text-4xl">{{ $instagramSection['title'] }}</h2>
                @endif
                @if($instagramSection['subtitle'])
                    <p class="text-sm text-slate-200">{{ $instagramSection['subtitle'] }}</p>
                @endif
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-{{ min($instagramSection['embeds']->count(), 3) }}">
                @foreach($instagramSection['embeds'] as $embed)
                    <div class="flex justify-center">
                        <div class="w-full max-w-sm rounded-[32px] border border-white/20 bg-white/10 p-4 shadow-[0_20px_80px_rgba(0,0,0,0.25)] backdrop-blur">
                            <div class="overflow-hidden rounded-2xl bg-black/10">
                                {!! $embed !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($instagramSection['profile_url'] && $instagramSection['cta_text'])
                <div class="mt-10 text-center">
                    <a href="{{ $instagramSection['profile_url'] }}" target="_blank" rel="noopener" class="btn-animated inline-flex items-center gap-3 rounded-full bg-[#ffa630] px-8 py-3 text-sm font-semibold text-[#11224e] shadow-lg shadow-[#11224e]/40 transition hover:-translate-y-0.5 hover:bg-[#f17720]">
                        <svg class="h-5 w-5 text-[#11224e]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.624 5.367 12.013 11.987 12.013s12.013-5.389 12.013-12.013C24.029 5.367 18.641.001 12.017.001zM8.449 12.017c0-1.971 1.597-3.568 3.568-3.568s3.568 1.597 3.568 3.568-1.597 3.568-3.568 3.568-3.568-1.597-3.568-3.568zm7.675-3.976a.83.83 0 11-1.66 0 .83.83 0 011.66 0zM12.017 4.422c2.278 0 2.548.009 3.448.05.832.038 1.284.177 1.585.294.398.155.683.34.982.639.299.299.484.584.639.982.117.301.256.753.294 1.585.041.9.05 1.17.05 3.448s-.009 2.548-.05 3.448c-.038.832-.177 1.284-.294 1.585-.155.398-.34.683-.639.982-.299.299-.584.484-.982.639-.301.117-.753.256-1.585.294-.9.041-1.17.05-3.448.05s-2.548-.009-3.448-.05c-.832-.038-1.284-.177-1.585-.294a2.64 2.64 0 01-.982-.639 2.64 2.64 0 01-.639-.982c-.117-.301-.256-.753-.294-1.585-.041-.9-.05-1.17-.05-3.448s.009-2.548.05-3.448c.038-.832.177-1.284.294-1.585.155-.398.34-.683.639-.982.299-.299.584-.484.982-.639.301-.117.753-.256 1.585-.294.9-.041 1.17-.05 3.448-.05zm0-1.622c-2.317 0-2.608.01-3.518.052-.91.042-1.532.187-2.077.4-.562.218-1.04.51-1.515.985-.475.475-.767.953-.985 1.515-.213.545-.358 1.167-.4 2.077-.042.91-.052 1.201-.052 3.518s.009 2.608.052 3.518c.042.91.187 1.532.4 2.077.218.562.51 1.04.985 1.515.475.475.953.767 1.515.985.545.213 1.167.358 2.077.4.91.042 1.201.052 3.518.052s2.608-.01 3.518-.052c.91-.042 1.532-.187 2.077-.4.562-.218 1.04-.51 1.515-.985.475-.475.767-.953.985-1.515.213-.545.358-1.167.4-2.077.042-.91.052-1.201.052-3.518s-.01-2.608-.052-3.518c-.042-.91-.187-1.532-.4-2.077a4.085 4.085 0 00-.985-1.515 4.085 4.085 0 00-1.515-.985c-.545-.213-1.167-.358-2.077-.4-.91-.042-1.201-.052-3.518-.052z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $instagramSection['cta_text'] }}</span>
                        <svg class="h-4 w-4 text-[#11224e]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
    @endif

    @if($faqs->count())
    <section id="faq" class="fade-in bg-gradient-to-b from-white via-[#f8faff] to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="mx-auto max-w-screen-lg px-4 py-20 sm:px-12">
            <div class="text-center" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 rounded-full border border-[#ffa630]/30 bg-[#ffa630]/10 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.3em] text-[#f17720]">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/></svg>
                    {{ __('FAQ') }}
                </span>
                <h2 class="mt-4 text-3xl font-bold text-[#11224e] dark:text-white sm:text-4xl">{{ __('Pertanyaan yang sering kami terima') }}</h2>
                <p class="mx-auto mt-4 max-w-2xl text-sm text-slate-600 dark:text-slate-300">{{ __('Masih punya pertanyaan lain? Hubungi kami, tim kami akan dengan senang hati membantu.') }}</p>
            </div>

            <div class="mt-12 space-y-4" x-data="{ open: null }">
                @foreach($faqs as $faq)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}" 
                         class="group rounded-2xl border transition-all duration-300"
                         :class="open === {{ $loop->index }} ? 'border-[#ffa630] bg-gradient-to-r from-[#ffa630]/5 to-[#5c83c4]/5 shadow-lg shadow-[#ffa630]/10' : 'border-[#e9e6df] bg-white hover:border-[#ffa630]/50 hover:shadow-md dark:border-slate-700 dark:bg-slate-800'">
                        
                        <button type="button" 
                                class="flex w-full items-center gap-4 px-5 py-5 text-left" 
                                @click="open === {{ $loop->index }} ? open = null : open = {{ $loop->index }}">
                            <!-- Number badge -->
                            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#ffa630] to-[#f17720] text-sm font-bold text-white shadow-md shadow-[#ffa630]/30 transition-transform duration-300 group-hover:scale-105">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="flex-1 text-base font-semibold text-[#11224e] dark:text-white">{{ $faq['question'] }}</span>
                            <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full transition-all duration-300"
                                  :class="open === {{ $loop->index }} ? 'bg-[#ffa630] text-white rotate-180' : 'bg-[#f8f7f5] text-[#f17720] dark:bg-slate-700'">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </span>
                        </button>
                        
                        <div x-cloak x-show="open === {{ $loop->index }}" 
                             x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0" 
                             x-transition:enter-end="opacity-100" 
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100" 
                             x-transition:leave-end="opacity-0">
                            <div class="border-t border-dashed border-[#e9e6df] px-5 py-5 pl-[4.5rem] dark:border-slate-700">
                                <p class="text-sm leading-relaxed text-slate-600 dark:text-slate-300 faq-answer">{!! nl2br(e($faq['answer'])) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Contact CTA -->
            <div data-aos="fade-up" class="mt-12 text-center">
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('Tidak menemukan jawaban yang Anda cari?') }}</p>
                <a href="{{ route('contact') }}" class="mt-3 inline-flex items-center gap-2 rounded-full bg-[#11224e] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-[#11224e]/30 transition hover:-translate-y-0.5 hover:bg-[#1a3a6e] dark:bg-[#ffa630] dark:text-[#11224e] dark:shadow-[#ffa630]/30">
                    {{ __('Hubungi Tim Kami') }}
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
    @endif

    {{-- <section id="contact" class="fade-in relative overflow-hidden bg-gradient-to-b from-[#5c83c4] via-[#4f6da9] to-[#11224e] text-white">
        <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 10% 0%, rgba(255,166,48,.35), transparent 45%), radial-gradient(circle at 85% 5%, rgba(241,119,32,.25), transparent 35%), radial-gradient(circle at 55% 100%, rgba(92,131,196,.45), transparent 45%);"></div>
        <div class="relative mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                ...
            </div>
        </div>
    </section> --}}
@endsection











