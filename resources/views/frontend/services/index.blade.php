@extends("frontend.layouts.app")

@section("title")
    {{ __('Products & Services') }}
@endsection

@section("content")
    <section class="relative overflow-hidden bg-[#11224e] text-white">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/30 to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-gradient-to-l from-[#ffa630]/40 to-transparent"></div>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-12 lg:flex lg:items-center lg:gap-16">
            <div class="flex-1 space-y-6">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    {{ __('Service Portfolio') }}
                </span>
                <h1 class="text-3xl font-bold leading-tight sm:text-5xl">
                    {{ __('Products & Services') }}
                </h1>
                <p class="max-w-2xl text-base text-white/80">
                    {{ __('Solusi experiential + creative tech + business development untuk eksekusi event tanpa pemborosan.') }}
                </p>
            </div>
            <div class="mt-12 flex-1 lg:mt-0">
                <div class="rounded-[32px] border border-white/20 bg-white/10 p-8 shadow-2xl backdrop-blur">
                    <p class="text-sm font-semibold uppercase tracking-[0.4em] text-white/70">{{ __('Signature pillars') }}</p>
                    <ul class="mt-4 space-y-3 text-white/80">
                        <li class="flex items-start gap-3">
                            <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#ffa630]/20 text-[#ffa630]">
                                <span class="text-xs font-semibold">1</span>
                            </span>
                            <div>
                                <p class="font-semibold">{{ __('Creative & Experience Design') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#5c83c4]/20 text-[#5c83c4]">
                                <span class="text-xs font-semibold">2</span>
                            </span>
                            <div>
                                <p class="font-semibold">{{ __('Technology & Production') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#f17720]/20 text-[#f17720]">
                                <span class="text-xs font-semibold">3</span>
                            </span>
                            <div>
                                <p class="font-semibold">{{ __('Business Acceleration') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f4f6fb]">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">

            @if($services->count())
                <div class="mt-10 grid gap-7 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                    @foreach($services as $service)
                        <article class="flex h-full flex-col overflow-hidden rounded-[28px] border border-[#d5def3] bg-white shadow-lg shadow-[#11224e]/5 transition hover:-translate-y-1 hover:shadow-xl">
                            @if($service->image)
                                <div class="relative h-40 w-full overflow-hidden">
                                    <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                                    <span class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></span>
                                </div>
                            @endif
                            <div class="flex flex-1 flex-col gap-4 px-6 py-6">
                                <div class="flex items-center gap-4">
                                    @if($service->icon)
                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#ffa630]/15 text-[#f17720]">
                                            @if(strpos($service->icon, '<') !== false && strpos($service->icon, '>') !== false)
                                                {!! $service->icon !!}
                                            @else
                                                <img src="{{ asset($service->icon) }}" alt="{{ $service->name }}" class="h-7 w-7 object-contain">
                                            @endif
                                        </div>
                                    @else
                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#5c83c4]/15 text-[#5c83c4]">
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l7.5-7.5 4.5 4.5L21 4.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 20.25l7.5-7.5 4.5 4.5L21 11.25"/></svg>
                                        </div>
                                    @endif
                                    <div class="text-xs font-semibold uppercase tracking-wide text-[#5c83c4]">
                                        {{ $service->category ?: __('Experiential Service') }}
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <h3 class="text-xl font-semibold text-[#11224e]">
                                        {{ $service->name }}
                                    </h3>
                                    <p class="text-sm text-[#11224e]/80">
                                        {{ \Str::limit(strip_tags($service->description), 170) }}
                                    </p>
                                </div>

                                <div class="mt-auto flex items-center justify-between pt-4 text-sm font-semibold text-[#5c83c4]">
                                    <a href="{{ route('frontend.services.show', $service->slug) }}" class="inline-flex items-center gap-2 hover:text-[#f17720]">
                                        {{ __('Lihat detail layanan') }}
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                    </a>
                                    <a href="{{ route('frontend.services.show', $service->slug) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#11224e]/5 text-[#11224e] hover:bg-[#11224e] hover:text-white">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="mt-8 rounded-2xl border border-dashed border-[#d5def3] bg-white px-6 py-5 text-sm text-[#11224e]/70">
                    {{ __('Belum ada layanan yang aktif.') }}
                </p>
            @endif
        </div>
    </section>

    <section class="bg-white">
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
                    <a href="{{ route('contact') }}" class="inline-flex items-center rounded-full bg-[#ffa630] px-6 py-3 text-sm font-semibold text-[#11224e] shadow hover:bg-[#fcbf64]">
                        {{ __('Hubungi tim kami') }}
                    </a>
                    <a href="mailto:{{ config('mail.from.address') }}" class="inline-flex items-center rounded-full border border-[#11224e]/20 px-6 py-3 text-sm font-semibold text-[#11224e] hover:border-[#11224e]">
                        {{ __('Kirim brief via email') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
