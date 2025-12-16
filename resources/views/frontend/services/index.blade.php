@extends("frontend.layouts.app")

@section("title")
    {{ __('Products & Services') }}
@endsection

@section("content")
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-[#11224e] text-white">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/30 to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-gradient-to-l from-[#ffa630]/40 to-transparent animate-pulse-slow"></div>
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12 lg:py-16">
            <div class="text-center">
                <span data-aos="fade-down" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    {{ __('Service Portfolio') }}
                </span>
                <h1 data-aos="fade-up" data-aos-delay="100" class="mt-4 text-3xl font-bold leading-tight sm:text-5xl">
                    {{ __('Products & Services') }}
                </h1>
                <p data-aos="fade-up" data-aos-delay="200" class="mx-auto mt-4 max-w-2xl text-base text-white/80">
                    {{ __('Solusi experiential + creative tech + business development untuk eksekusi event tanpa pemborosan.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- Services List - Alternating Layout --}}
    <section class="bg-white py-16">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-12">
            @if($services->count())
                <div class="space-y-16 lg:space-y-24">
                    @foreach($services as $index => $service)
                        @php
                            $isEven = $index % 2 === 0;
                            $features = $service->features ?? [];
                        @endphp
                        
                        <div class="grid items-center gap-8 lg:grid-cols-2 lg:gap-16" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            {{-- Image/Placeholder - Order changes based on index --}}
                            <div class="{{ $isEven ? 'lg:order-1' : 'lg:order-2' }}">
                                <div class="aspect-[4/3] overflow-hidden rounded-[24px] bg-gradient-to-br from-slate-100 to-slate-50 shadow-lg">
                                    @if($service->image)
                                        <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center">
                                            @if($service->icon)
                                                <i class="{{ $service->icon }} text-6xl text-[#5c83c4]/40"></i>
                                            @else
                                                <svg class="h-24 w-24 text-[#5c83c4]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="{{ $isEven ? 'lg:order-2' : 'lg:order-1' }}">
                                {{-- Title with Icon --}}
                                <div class="flex items-center gap-4">
                                    @if($service->icon)
                                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#11224e] text-white shadow-lg">
                                            <i class="{{ $service->icon }} text-xl"></i>
                                        </div>
                                    @endif
                                    <h2 class="text-2xl font-bold uppercase tracking-wide text-[#11224e]">
                                        {{ $service->name }}
                                    </h2>
                                </div>

                                {{-- Description --}}
                                <p class="mt-4 text-slate-600 leading-relaxed">
                                    {{ strip_tags($service->description) }}
                                </p>

                                {{-- Features Grid --}}
                                @if(count($features) > 0)
                                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                        @foreach($features as $feature)
                                            <div class="flex items-center gap-3">
                                                <svg class="h-5 w-5 flex-shrink-0 text-[#5c83c4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="text-sm text-slate-700">{{ $feature }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Price & CTA --}}
                                <div class="mt-8 flex flex-wrap items-center gap-4">
                                    <div>
                                        @if($service->price)
                                            <p class="text-xl font-bold text-[#5c83c4]">{{ $service->price }}</p>
                                        @else
                                            <p class="text-xl font-bold text-[#5c83c4]">{{ __('Custom Quote') }}</p>
                                        @endif
                                        @if($service->price_note)
                                            <p class="text-sm text-[#ffa630]">{{ $service->price_note }}</p>
                                        @else
                                            <p class="text-sm text-[#ffa630]">{{ __('Professional setup included') }}</p>
                                        @endif
                                    </div>
                                    <a href="{{ route('contact') }}" class="inline-flex items-center rounded-lg bg-[#11224e] px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition hover:bg-[#1a3366]">
                                        {{ __('Get Quote') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Divider (except last) --}}
                        @if(!$loop->last)
                            <div class="border-t border-slate-200"></div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-8 text-center text-slate-600">
                    {{ __('Belum ada layanan yang aktif.') }}
                </p>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-[#f4f6fb]" data-aos="fade-up">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="rounded-[32px] border border-[#d5def3] bg-gradient-to-r from-white to-[#f4f6fb] px-8 py-10 text-center shadow-lg shadow-[#11224e]/5">
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-[#f17720]">{{ __('Need a custom activation?') }}</p>
                <h3 class="mt-4 text-2xl font-bold text-[#11224e] sm:text-3xl">
                    {{ __('Kolaborasikan ide Anda dengan tim konsultan Digioh') }}
                </h3>
                <p class="mt-3 text-sm text-[#11224e]/80">
                    {{ __('Kami siap membantu merancang blueprint program, memilih teknologi immersive, dan menyiapkan strategi business development yang tepat.') }}
                </p>
                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('contact') }}" class="inline-flex items-center rounded-full bg-[#ffa630] px-6 py-3 text-sm font-semibold text-[#11224e] shadow-lg shadow-[#ffa630]/30 transition-all duration-300 hover:-translate-y-1 hover:bg-[#fcbf64] hover:shadow-xl">
                        {{ __('Hubungi tim kami') }}
                    </a>
                    <a href="mailto:{{ config('mail.from.address') }}" class="inline-flex items-center rounded-full border border-[#11224e]/20 px-6 py-3 text-sm font-semibold text-[#11224e] transition-all duration-300 hover:border-[#11224e] hover:bg-[#11224e] hover:text-white">
                        {{ __('Kirim brief via email') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
