@extends("frontend.layouts.app")

@section("title")
    {{ $$module_name_singular->name }}
@endsection

@section("content")
    @php
        $startDate = $$module_name_singular->event_start_date;
        $endDate = $$module_name_singular->event_end_date;
        $heroImages = collect();
        if ($$module_name_singular->image) {
            $heroImages->push(asset($$module_name_singular->image));
        }
        $galleryImages = collect($$module_name_singular->gallery_images ?? [])->filter()->map(function ($path) {
            return \Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])
                ? $path
                : \Illuminate\Support\Facades\Storage::url($path);
        });
        $heroImages = $heroImages->merge($galleryImages)->unique()->values();
        $sliderId = 'hero-slider-'.$$module_name_singular->id;
    @endphp
    <section class="relative overflow-hidden bg-[#11224e] text-white">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/30 to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-1/3 bg-gradient-to-l from-[#ffa630]/30 to-transparent"></div>
        <div class="relative mx-auto flex max-w-6xl flex-col gap-12 px-4 py-16 sm:px-6 lg:flex-row lg:items-center">
            <div class="flex-1 space-y-6">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    {{ __('Our Work Detail') }}
                </span>
                <h1 class="text-3xl font-bold leading-tight sm:text-5xl">
                    {{ $$module_name_singular->name }}
                </h1>
                @if ($$module_name_singular->intro != "")
                    <div class="text-base text-white/80">
                        {!! $$module_name_singular->intro !!}
                    </div>
                @endif
                @if(!empty($$module_name_singular->scope_of_work_list))
                    <div class="flex flex-wrap gap-2">
                        @foreach($$module_name_singular->scope_of_work_list as $scope)
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-semibold tracking-wide text-white">{{ $scope }}</span>
                        @endforeach
                    </div>
                @endif
                <div class="grid gap-4 text-sm text-white/80 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/20 bg-white/5 p-4">
                        <p class="text-xs uppercase tracking-wide text-white/60">{{ __('Periode') }}</p>
                        <p class="text-lg font-semibold text-white">
                            @if($startDate)
                                @if($endDate && !$startDate->isSameDay($endDate))
                                    {{ $startDate->isoFormat('D MMM YYYY') }} - {{ $endDate->isoFormat('D MMM YYYY') }}
                                @else
                                    {{ $startDate->isoFormat('D MMM YYYY') }}
                                @endif
                            @else
                                {{ optional($$module_name_singular->published_at)->isoFormat('D MMM YYYY') }}
                            @endif
                        </p>
                    </div>
                    @if($$module_name_singular->event_location)
                        <div class="rounded-2xl border border-white/20 bg-white/5 p-4">
                            <p class="text-xs uppercase tracking-wide text-white/60">{{ __('Lokasi') }}</p>
                            <p class="text-lg font-semibold text-white">{{ $$module_name_singular->event_location }}</p>
                        </div>
                    @endif
                </div>
                @include("frontend.includes.messages")
            </div>
            <div class="flex-1">
                <div class="relative rounded-[32px] border border-white/20 bg-white/5 p-3 shadow-2xl shadow-black/20 backdrop-blur" data-hero-slider="{{ $sliderId }}">
                    <div class="relative overflow-hidden rounded-2xl">
                        @foreach($heroImages as $index => $imageUrl)
                            <button type="button" data-slide data-slide-preview="{{ $imageUrl }}" class="aspect-video w-full object-cover transition-all duration-500 {{ $index === 0 ? 'relative opacity-100 pointer-events-auto' : 'absolute inset-0 opacity-0 pointer-events-none' }}">
                                <img
                                    class="h-full w-full object-cover"
                                    src="{{ $imageUrl }}"
                                    alt="{{ $$module_name_singular->name }} slide {{ $index + 1 }}"
                                />
                            </button>
                        @endforeach
                    </div>
                    @if($heroImages->count() > 1)
                        <button type="button" class="absolute left-6 top-1/2 -translate-y-1/2 rounded-full bg-white/80 p-3 text-[#11224e] shadow hover:bg-white" data-slide-prev>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                        </button>
                        <button type="button" class="absolute right-6 top-1/2 -translate-y-1/2 rounded-full bg-white/80 p-3 text-[#11224e] shadow hover:bg-white" data-slide-next>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </button>
                        <div class="pointer-events-none absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2">
                            @foreach($heroImages as $index => $imageUrl)
                                <span data-slide-dot class="h-2 w-2 rounded-full {{ $index === 0 ? 'bg-[#ffa630]' : 'bg-white/40' }}"></span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="fixed inset-0 z-50 hidden bg-[#0b132f]/90 backdrop-blur" data-hero-lightbox="{{ $sliderId }}">
            <button type="button" class="absolute right-6 top-6 rounded-full bg-white/80 p-3 text-[#11224e]" data-lightbox-close>
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="absolute inset-0 flex items-center justify-center gap-6 px-6">
                <button type="button" class="rounded-full bg-white/80 p-3 text-[#11224e] shadow hover:bg-white" data-lightbox-prev>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                </button>
                <img data-lightbox-image class="max-h-[80vh] max-w-[90vw] rounded-2xl object-contain shadow-2xl" src="{{ $heroImages->first() }}" alt="{{ $$module_name_singular->name }}">
                <button type="button" class="rounded-full bg-white/80 p-3 text-[#11224e] shadow hover:bg-white" data-lightbox-next>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </button>
            </div>
        </div>
    </section>

    <section class="bg-[#f4f6fb] px-4 py-16 sm:px-6">
        <div class="mx-auto grid max-w-6xl gap-10 lg:grid-cols-[minmax(0,3fr)_minmax(320px,1fr)]">
            <div class="space-y-4 text-[#11224e]">
                <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-[#ffa630]">
                    <span>{{ __('Cerita inti') }}</span>
                    <span>1</span>
                </div>
                <div class="prose max-w-none text-[#11224e]/90 prose-headings:text-[#11224e] prose-a:text-[#5c83c4]">
                    {!! $$module_name_singular->content !!}
                </div>
                <div class="grid gap-6 border-t border-[#d5def3] pt-4 text-sm sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-[#5c83c4]">{{ __('Tim proyek') }}</p>
                        <p class="mt-1 font-semibold">{{ isset($$module_name_singular->created_by_alias) ? $$module_name_singular->created_by_alias : $$module_name_singular->created_by_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-[#5c83c4]">{{ __('Tanggal publikasi') }}</p>
                        <p class="mt-1 font-semibold">{{ optional($$module_name_singular->published_at)->isoFormat('LLLL') }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[20px] border border-[#ffa630]/30 bg-white p-6 shadow-sm shadow-[#ffa630]/20 text-[#11224e]">
                <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-[#ffa630]">
                    <span>{{ __('Info proyek') }}</span>
                    <span>2</span>
                </div>
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-[#5c83c4]">{{ __('Status publikasi') }}</p>
                        <p class="mt-1 font-semibold text-[#11224e]">{{ ucfirst($$module_name_singular->status) }}</p>
                    </div>
                    @if($$module_name_singular->category)
                        <div>
                            <p class="text-xs uppercase tracking-wide text-[#5c83c4]">{{ __('Kategori') }}</p>
                            <p class="mt-1 font-semibold text-[#11224e]">{{ $$module_name_singular->category->name }}</p>
                        </div>
                    @endif
                    @if($$module_name_singular->services->count())
                        <div>
                            <p class="text-xs uppercase tracking-wide text-[#5c83c4]">{{ __('Layanan terlibat') }}</p>
                            <p class="mt-1 font-semibold text-[#11224e]">
                                {{ $$module_name_singular->services->sortBy('name')->pluck('name')->join(', ') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-[#ffa630]">
                    <span>{{ __('Terbaru lainnya') }}</span>
                </div>
                <p class="text-sm text-[#5c83c4]">{{ __('Our Work Terbaru') }} · {{ __('Portofolio terbaru yang baru saja kami publikasikan.') }}</p>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @php $recent = \Modules\Post\Models\Post::where('is_our_work', true)->published()->latest()->take(3)->get(); @endphp
                    @foreach($recent as $item)
                        @php($recentUrl = route('frontend.posts.show', [encode_id($item->id), $item->slug]))
                        <a href="{{ $recentUrl }}" class="flex h-full flex-col overflow-hidden rounded-2xl border border-[#d5def3] bg-[#f4f6fb] text-[#11224e] shadow-sm shadow-[#11224e]/10 transition hover:-translate-y-1 hover:border-[#ffa630] hover:shadow-lg">
                            <div class="relative h-40 w-full overflow-hidden">
                                <img src="{{ asset($item->image ?: 'img/default_post.svg') }}" alt="{{ $item->name }}" class="h-full w-full object-cover">
                                <span class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></span>
                            </div>
                            <div class="flex flex-1 flex-col gap-2 p-4">
                                <div class="text-xs text-[#5c83c4] font-semibold flex items-center justify-between">
                                    <span>{{ optional($item->published_at)->isoFormat('D MMM YYYY') }}</span>
                                    @if($item->event_location)
                                        <span class="flex items-center gap-1 text-[#ffa630]">
                                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                            {{ $item->event_location }}
                                        </span>
                                    @endif
                                </div>
                                <h4 class="text-base font-semibold group-hover:text-[#ffa630]">{{ $item->name }}</h4>
                                <p class="text-sm text-[#11224e]/70">{{ \Str::limit(strip_tags($item->intro ?: $item->content), 110) }}</p>
                                @if($item->services->count())
                                    <p class="mt-auto text-xs text-[#5c83c4]">{{ $item->services->sortBy('name')->pluck('name')->join(', ') }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
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
                let current = 0;

                const updateBodyScroll = (open) => {
                    document.documentElement.classList.toggle('overflow-y-hidden', open);
                    document.body.classList.toggle('overflow-y-hidden', open);
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
                    if (lightboxImg && slides[index]) {
                        lightboxImg.src = slides[index].dataset.slidePreview;
                    }
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
                    lightbox.classList.add('hidden');
                    updateBodyScroll(false);
                });

                lightbox?.addEventListener('click', function (event) {
                    if (event.target === lightbox) {
                        lightbox.classList.add('hidden');
                        updateBodyScroll(false);
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
