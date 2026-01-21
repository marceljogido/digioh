@extends("frontend.layouts.app")

@section("title")
    {{ $service->name }}
@endsection

@section("meta_description", Str::limit(strip_tags($service->description), 160))

@section("content")
    @php
        $heroSlides = collect();
        $videoData = $service->video_data;

        // 1. Video Slide
        if ($videoData) {
            $heroSlides->push([
                'type' => 'video',
                'provider' => $videoData['provider'],
                'embed' => $videoData['embed_url'],
                'thumbnail' => $service->image ? asset($service->image) : null,
            ]);
        }

        // 2. Main Image Slide (only if not used as thumbnail, or if you want it as separate slide)
        // Usually if there is video, image is just thumbnail. But let's add it if no video, OR as secondary slide.
        if ($service->image && !$videoData) {
             $heroSlides->push([
                'type' => 'image',
                'src' => asset($service->image),
            ]);
        } elseif ($service->image && $videoData) {
             // Optional: Add main image as 2nd slide even if video exists
             $heroSlides->push([
                'type' => 'image',
                'src' => asset($service->image),
            ]);
        }

        // 3. Gallery Slides
        if (!empty($service->gallery_images)) {
            foreach ($service->gallery_images as $gPath) {
                 $heroSlides->push([
                    'type' => 'image',
                    'src' => asset($gPath),
                ]);
            }
        }

        $heroSlides = $heroSlides->unique(function ($slide) {
             return $slide['type'] === 'image' ? $slide['src'] : 'video-'.$slide['embed'];
        })->values();

        $sliderId = 'service-slider-'.$service->id;
    @endphp

    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden bg-[#11224e] text-white">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/30 to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-1/3 bg-gradient-to-l from-[#ffa630]/30 to-transparent"></div>
        
        <div class="relative mx-auto flex max-w-6xl flex-col gap-12 px-4 py-16 sm:px-6 lg:flex-row lg:items-center">
            
            {{-- Left Column: Info --}}
            <div class="flex-1 space-y-6">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    {{ __('Service Detail') }}
                </span>
                
                <h1 class="text-3xl font-bold leading-tight sm:text-5xl">
                    {{ $service->name }}
                </h1>

                @if ($service->description)
                    <div class="text-base text-white/80 line-clamp-3">
                        {{ Str::limit(strip_tags($service->description), 200) }}
                    </div>
                @endif

                {{-- 1. Keunggulan / Highlights Row (Features) --}}
                @if(!empty($service->features) && is_array($service->features))
                    <div class="mb-6 flex flex-wrap gap-3">
                        @foreach($service->features as $feature)
                            <div class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/5 px-6 py-2 backdrop-blur-sm transition hover:bg-white/10">
                                <span class="text-sm font-bold text-white">
                                    {{ $feature }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- 2. Main Stats Row (Projects / Satisfaction / Status) --}}
                <div class="flex flex-wrap gap-4">
                    {{-- Proyek Count --}}
                    <div class="flex min-w-[140px] flex-col items-center justify-center rounded-[2rem] border border-white/20 bg-white/10 px-6 py-5 backdrop-blur-md transition hover:bg-white/15">
                        <span class="text-center text-lg font-bold leading-tight text-[#ffa630]">
                            {{ $service->posts->count() }}+
                        </span>
                        <span class="mt-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white/80">
                            {{ __('Project') }}
                        </span>
                    </div>

                    {{-- Satisfaction (Static 100%) --}}
                    <div class="flex min-w-[140px] flex-col items-center justify-center rounded-[2rem] border border-white/20 bg-white/10 px-6 py-5 backdrop-blur-md transition hover:bg-white/15">
                        <span class="text-center text-lg font-bold leading-tight text-[#5c83c4]">
                            100%
                        </span>
                        <span class="mt-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white/80">
                            {{ __('Satisfaction') }}
                        </span>
                    </div>

                    {{-- Status (Available) --}}
                    <div class="flex min-w-[140px] flex-col items-center justify-center rounded-[2rem] border border-white/20 bg-white/10 px-6 py-5 backdrop-blur-md transition hover:bg-white/15">
                        <span class="text-center text-lg font-bold leading-tight text-[#ffa630]">
                            {{ __('Available') }}
                        </span>
                        <span class="mt-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white/80">
                            {{ __('Status') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Right Column: Slider --}}
            <div class="flex-1">
                @if($heroSlides->isNotEmpty())
                    <div class="relative overflow-hidden rounded-[32px] shadow-2xl shadow-black/20" data-hero-slider="{{ $sliderId }}">
                        @foreach($heroSlides as $index => $slide)
                            <button
                                type="button"
                                data-slide
                                data-slide-type="{{ $slide['type'] }}"
                                @if($slide['type'] === 'image')
                                    data-slide-src="{{ $slide['src'] }}"
                                @else
                                    data-slide-provider="{{ $slide['provider'] }}"
                                    data-slide-video="{{ $slide['embed'] }}"
                                @endif
                                class="block w-full overflow-hidden transition-all duration-500 {{ $index === 0 ? 'relative opacity-100 pointer-events-auto' : 'absolute inset-0 opacity-0 pointer-events-none' }}"
                                style="aspect-ratio: 16 / 9;"
                            >
                                @if($slide['type'] === 'image')
                                    <img
                                        class="h-full w-full object-cover"
                                        src="{{ $slide['src'] }}"
                                        alt="{{ $service->name }} slide {{ $index + 1 }}"
                                        style="aspect-ratio: 16 / 9;"
                                    />
                                @else
                                    <div class="pointer-events-none relative flex h-full w-full flex-col items-center justify-center overflow-hidden bg-gradient-to-br from-[#11224e] via-[#5c83c4] to-[#ffa630] p-8 text-center text-white" style="aspect-ratio: 16 / 9;">
                                        @if(!empty($slide['thumbnail']))
                                            <img src="{{ $slide['thumbnail'] }}" alt="{{ $service->name }} video thumbnail" class="absolute inset-0 h-full w-full object-cover opacity-60">
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-b from-[#040f2c]/70 via-[#040f2c]/35 to-transparent"></div>
                                        <div class="relative flex flex-col items-center gap-4">
                                            <span class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-white/90 text-[#11224e] shadow-xl shadow-black/30">
                                                <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M8.75 6.73a.75.75 0 0 1 1.12-.66l8 4.77a.75.75 0 0 1 0 1.32l-8 4.77a.75.75 0 0 1-1.12-.66z"/></svg>
                                            </span>
                                            <p class="text-2xl font-semibold tracking-wide drop-shadow-[0_4px_12px_rgba(0,0,0,0.45)]">{{ __('Putar Video') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </button>
                        @endforeach
                        
                        {{-- Navigation Arrows --}}
                        @if($heroSlides->count() > 1)
                            <button type="button" class="absolute left-6 top-1/2 -translate-y-1/2 rounded-full bg-white/80 p-3 text-[#11224e] shadow hover:bg-white" data-slide-prev>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                            </button>
                            <button type="button" class="absolute right-6 top-1/2 -translate-y-1/2 rounded-full bg-white/80 p-3 text-[#11224e] shadow hover:bg-white" data-slide-next>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            </button>
                            <div class="pointer-events-none absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2">
                                @foreach($heroSlides as $index => $slide)
                                    <span data-slide-dot class="h-2 w-2 rounded-full {{ $index === 0 ? 'bg-[#ffa630]' : 'bg-white/40' }}"></span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    {{-- Fallback if no media --}}
                     <div class="rounded-[32px] bg-[#0b132f]/30 p-12 text-center text-white border border-white/10">
                        <p class="text-lg font-semibold">{{ __('Konten visual belum tersedia') }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Lightbox Modal --}}
        <div class="fixed inset-0 z-50 hidden bg-[#0b132f]/90 backdrop-blur" data-hero-lightbox="{{ $sliderId }}">
            <div class="absolute inset-0 flex items-center justify-center gap-6 px-6">
                <button type="button" class="rounded-full bg-white/80 p-3 text-[#11224e] shadow hover:bg-white" data-lightbox-prev>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                </button>
                <div class="flex max-h-[80vh] w-full max-w-5xl flex-col items-center justify-center">
                    <img data-lightbox-image class="hidden max-h-[80vh] w-full rounded-2xl object-contain shadow-2xl" style="aspect-ratio: 16 / 9;" alt="{{ $service->name }}">
                    <div data-lightbox-video-wrapper class="relative hidden w-full">
                        <div class="w-full overflow-hidden rounded-2xl bg-black shadow-2xl" style="aspect-ratio: 16 / 9;">
                            <iframe
                                data-lightbox-video-iframe
                                class="hidden h-full w-full"
                                src=""
                                title="Video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                            <video data-lightbox-video-file class="hidden h-full w-full bg-black object-contain" controls playsinline></video>
                        </div>
                    </div>
                </div>
                <button type="button" class="rounded-full bg-white/80 p-3 text-[#11224e] shadow hover:bg-white" data-lightbox-next>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </button>
            </div>
            <button type="button" class="absolute right-6 top-6 z-50 rounded-full bg-white/80 p-3 text-[#11224e] hover:bg-white transition" data-lightbox-close>
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </section>

    {{-- SECTION 1: ABOUT --}}
    <section class="relative bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                <div class="space-y-6">
                    <span class="text-sm font-bold uppercase tracking-widest text-[#ffa630]">
                        {{ __('Tentang Layanan Ini') }}
                    </span>
                    <h2 class="text-4xl font-bold text-[#11224e]">
                        {{ __('Apa yang kami tawarkan') }}
                    </h2>
                    <p class="text-lg text-[#5c83c4]">
                        {{ __('Solusi lengkap dari konsep hingga eksekusi.') }}
                    </p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full bg-[#ffa630] px-8 py-4 text-sm font-bold text-[#11224e] shadow-lg shadow-[#ffa630]/30 transition hover:bg-[#ffb04a] hover:-translate-y-1">
                        {{ __('Konsultasi Gratis') }}
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/></svg>
                    </a>
                </div>
                <div class="prose prose-lg text-[#11224e]/80">
                    {!! $service->description !!}
                    @if(!empty($service->features) && is_array($service->features))
                        <div class="mt-6 flex flex-wrap gap-2 not-prose">
                            @foreach($service->features as $feature)
                                <span class="rounded-full bg-[#f4f6fb] px-3 py-1 text-xs font-semibold text-[#11224e]">{{ $feature }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2: CTA --}}
    <section class="relative bg-[#11224e] py-24 text-center">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#ffa630]">
                {{ __('Siap Memulai?') }}
            </span>
            <h2 class="mt-4 text-4xl font-bold text-white sm:text-5xl">
                {{ __('Wujudkan event impian Anda bersama kami') }}
            </h2>
            <p class="mt-6 text-xl text-white/70">
                {{ __('Konsultasikan kebutuhan Anda dan dapatkan proposal khusus dari tim expert kami.') }}
            </p>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                 <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full bg-[#ffa630] px-8 py-4 text-sm font-bold text-[#11224e] shadow-lg shadow-[#ffa630]/30 transition hover:bg-[#ffb04a] hover:-translate-y-1">
                        {{ $service->button_text ?? 'Hubungi Kami' }}
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/></svg>
                 </a>
                 <a href="{{ route('frontend.services.index') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-8 py-4 text-sm font-bold text-white backdrop-blur transition hover:bg-white/10">
                        {{ __('Lihat Semua Layanan') }}
                 </a>
            </div>
        </div>
    </section>

    {{-- SECTION 3: OTHER SERVICES --}}
    @if(isset($otherServices) && $otherServices->isNotEmpty())
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                 <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#ffa630]">
                    {{ __('Jelajahi Lebih Lanjut') }}
                </span>
                <h2 class="mt-2 text-3xl font-bold text-[#11224e]">
                    {{ __('Layanan lainnya') }}
                </h2>
            </div>
            
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($otherServices as $other)
                    <a href="{{ route('frontend.services.show', $other->slug) }}" class="group flex items-center rounded-2xl border border-[#d5def3] bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-[#ffa630] hover:shadow-lg">
                        <div class="mr-4 h-12 w-12 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100 p-2">
                             @if($other->icon)
                                <i class="{{ $other->icon }} text-2xl text-[#11224e]"></i>
                             @elseif($other->image)
                                <img src="{{ asset($other->image) }}" class="h-full w-full object-cover" alt="{{ $other->name }}">
                             @else
                                <img src="{{ asset('img/default_service.svg') }}" class="h-full w-full object-cover opacity-50" alt="{{ $other->name }}">
                             @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-[#11224e] group-hover:text-[#ffa630] truncate">{{ $other->name }}</h3>
                            <p class="text-sm text-[#11224e]/60 truncate">{{ $other->category ?? 'Service' }}</p>
                        </div>
                        <div class="ml-4 text-[#d5def3] transition group-hover:text-[#ffa630]">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection

@push("after-style")
@endpush

@push("after-scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-hero-slider]').forEach(function (slider) {
                const slides = slider.querySelectorAll('[data-slide]');
                const dots = slider.querySelectorAll('[data-slide-dot]');
                if (!slides.length) {
                    return;
                }

                const sliderId = slider.getAttribute('data-hero-slider');
                const lightbox = document.querySelector('[data-hero-lightbox="'+ sliderId +'"]');
                const lightboxImg = lightbox?.querySelector('[data-lightbox-image]');
                const videoWrapper = lightbox?.querySelector('[data-lightbox-video-wrapper]');
                const iframeEl = lightbox?.querySelector('[data-lightbox-video-iframe]');
                const videoEl = lightbox?.querySelector('[data-lightbox-video-file]');
                let current = 0;

                const updateBodyScroll = (open) => {
                    document.documentElement.classList.toggle('overflow-y-hidden', open);
                    document.body.classList.toggle('overflow-y-hidden', open);
                };

                const stopEmbeddedPlayback = () => {
                    if (iframeEl) {
                        iframeEl.src = '';
                        iframeEl.classList.add('hidden');
                    }
                    if (videoEl) {
                        videoEl.pause();
                        videoEl.removeAttribute('src');
                        videoEl.load();
                        videoEl.classList.add('hidden');
                    }
                    videoWrapper?.classList.add('hidden');
                };

                const updateLightboxMedia = (index) => {
                    if (!lightbox || !slides[index]) {
                        return;
                    }

                    const target = slides[index];
                    const type = target.dataset.slideType || 'image';
                    if (type === 'video') {
                        if (!videoWrapper) return;
                        videoWrapper.classList.remove('hidden');
                        lightboxImg?.classList.add('hidden');
                        const provider = target.dataset.slideProvider || 'iframe';
                        const source = target.dataset.slideVideo || '';

                        if (provider === 'file') {
                            if (iframeEl) {
                                iframeEl.src = '';
                                iframeEl.classList.add('hidden');
                            }
                            if (videoEl) {
                                if (videoEl.src !== source) {
                                    videoEl.src = source;
                                    videoEl.load();
                                }
                                videoEl.classList.remove('hidden');
                            }
                        } else {
                            if (videoEl) {
                                videoEl.pause();
                                videoEl.removeAttribute('src');
                                videoEl.load();
                                videoEl.classList.add('hidden');
                            }
                            if (iframeEl) {
                                if (iframeEl.src !== source) {
                                    iframeEl.src = source;
                                }
                                iframeEl.classList.remove('hidden');
                            }
                        }
                    } else {
                        videoWrapper?.classList.add('hidden');
                        if (iframeEl) {
                            iframeEl.src = '';
                            iframeEl.classList.add('hidden');
                        }
                        if (videoEl) {
                            videoEl.pause();
                            videoEl.removeAttribute('src');
                            videoEl.load();
                            videoEl.classList.add('hidden');
                        }
                        if (lightboxImg) {
                            lightboxImg.src = target.dataset.slideSrc || '';
                            lightboxImg.classList.remove('hidden');
                        }
                    }
                };

                const showSlide = (index) => {
                    slides.forEach((slide, idx) => {
                        const isActive = idx === index;
                        slide.classList.toggle('opacity-0', !isActive);
                        slide.classList.toggle('opacity-100', isActive);
                        slide.classList.toggle('absolute', !isActive);
                        slide.classList.toggle('relative', isActive);
                        slide.classList.toggle('pointer-events-none', !isActive);
                        slide.classList.toggle('pointer-events-auto', isActive);
                    });
                    dots.forEach((dot, idx) => {
                        dot.classList.toggle('bg-[#ffa630]', idx === index);
                        dot.classList.toggle('bg-white/40', idx !== index);
                    });
                    updateLightboxMedia(index);
                };

                const goNext = () => {
                    current = (current + 1) % slides.length;
                    showSlide(current);
                };

                const goPrev = () => {
                    current = (current - 1 + slides.length) % slides.length;
                    showSlide(current);
                };

                slider.querySelector('[data-slide-next]')?.addEventListener('click', goNext);
                slider.querySelector('[data-slide-prev]')?.addEventListener('click', goPrev);

                slides.forEach((slide, idx) => {
                    slide.addEventListener('click', function () {
                        if (!lightbox) return;
                        current = idx;
                        showSlide(current);
                        lightbox.classList.remove('hidden');
                        updateBodyScroll(true);
                    });
                });

                lightbox?.querySelector('[data-lightbox-close]')?.addEventListener('click', function () {
                    if (!lightbox) return;
                    lightbox.classList.add('hidden');
                    updateBodyScroll(false);
                    stopEmbeddedPlayback();
                });

                lightbox?.addEventListener('click', function (event) {
                    if (event.target === lightbox) {
                        lightbox.classList.add('hidden');
                        updateBodyScroll(false);
                        stopEmbeddedPlayback();
                    }
                });

                lightbox?.querySelector('[data-lightbox-next]')?.addEventListener('click', function (event) {
                    event.stopPropagation();
                    goNext();
                });

                lightbox?.querySelector('[data-lightbox-prev]')?.addEventListener('click', function (event) {
                    event.stopPropagation();
                    goPrev();
                });

                document.addEventListener('keydown', function (event) {
                    if (!lightbox || lightbox.classList.contains('hidden')) {
                        return;
                    }
                    if (event.key === 'Escape') {
                        lightbox.classList.add('hidden');
                        updateBodyScroll(false);
                        stopEmbeddedPlayback();
                    } else if (event.key === 'ArrowRight') {
                        goNext();
                    } else if (event.key === 'ArrowLeft') {
                        goPrev();
                    }
                });

                showSlide(0);
            });
        });
    </script>
@endpush
