@extends('frontend.layouts.app')

@section('title', __('Contact'))

@section('content')
@php
    $defaultContactEmail = 'dukunganteknis@digioh.com';
    $defaultContactAddress = 'Fatmawati Festival Blok A-7, Jalan RS Fatmawati no. 50 Seberang Rumah Duka Fatmawati, Jl. RS. Fatmawati Raya No.50, RT.4/RW.4, West Cilandak, Cilandak, South Jakarta City, Jakarta 12430';
@endphp
<section class="relative overflow-hidden bg-[#11224e] text-white">
    <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#5c83c4]/30 to-transparent"></div>
    <div class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-gradient-to-l from-[#ffa630]/40 to-transparent animate-pulse-slow"></div>
    <div class="mx-auto flex max-w-screen-xl flex-col gap-8 px-4 py-12 sm:px-12 lg:flex-row lg:items-center">
        <div class="flex-1 space-y-6">
            <span data-aos="fade-down" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                {{ __('Let us collaborate') }}
            </span>
            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl font-bold leading-tight sm:text-5xl">
                {{ __('Cerita dan kebutuhan Anda adalah titik awal ide kami') }}
            </h1>
            <p data-aos="fade-up" data-aos-delay="200" class="max-w-2xl text-sm text-white/80">
                {{ __('Hubungi tim Digioh untuk mendiskusikan event, experiential marketing, atau proyek business development berikutnya.') }}
            </p>
        </div>
    </div>
</section>

<section class="bg-[#f4f6fb]">
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
        @if(session('flash_success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-800">
                {{ session('flash_success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800" role="alert">
                <p class="font-semibold">{{ __('Terjadi kesalahan. Mohon periksa isian berikut:') }}</p>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
            <div data-aos="fade-right" class="rounded-[40px] border border-[#d5def3] bg-gradient-to-br from-white via-[#f8faff] to-[#eef2ff] px-6 py-8 shadow-2xl shadow-[#11224e]/10 space-y-6 hover-glow">
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-[#5c83c4]">{{ __('Kunjungi') }}</p>
                @php
                    $mapAddress = setting('contact_address') ?? $defaultContactAddress;
                    $mapLink = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($mapAddress);
                    $mapEmbedCode = setting('contact_map_embed');
                @endphp
                <div class="overflow-hidden rounded-3xl border border-[#d5def3] bg-white shadow-lg shadow-[#11224e]/5">
                    @if($mapEmbedCode)
                        {{-- Use custom embed from admin settings --}}
                        <div class="contact-map-embed [&>iframe]:w-full [&>iframe]:h-[320px] [&>iframe]:border-0">
                            {!! $mapEmbedCode !!}
                        </div>
                    @else
                        {{-- Fallback: generate embed from address --}}
                        @php
                            $mapEmbed = 'https://maps.google.com/maps?q=' . urlencode($mapAddress) . '&z=16&output=embed';
                        @endphp
                        <iframe
                            src="{{ $mapEmbed }}"
                            width="100%"
                            height="320"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @endif
                </div>

                <div class="relative overflow-hidden rounded-3xl border border-[#e2e9fb] bg-gradient-to-br from-[#eef3ff] to-white px-6 py-5 shadow-[0_25px_45px_rgba(17,34,78,0.07)]">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#e9efff] text-[#5c83c4] shadow-inner shadow-white/60">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c4.243 0 7.5-3.134 7.5-7.5S16.243 6 12 6 4.5 9.134 4.5 13.5 7.757 21 12 21z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 11.25a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"/></svg>
                        </span>
                        <div class="space-y-1">
                            <p class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/60">{{ __('Lokasi studio') }}</p>
                            <p class="text-sm font-semibold leading-relaxed text-[#11224e]">
                                {{ $mapAddress }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ $mapLink }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-[#5c83c4] transition hover:text-[#324a7d]">
                            {{ __('Buka di Google Maps') }}
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75v6.5a3 3 0 01-3 3h-6.5M17.25 6.75h-6.5a3 3 0 00-3 3v6.5M17.25 6.75L6.75 17.25"/></svg>
                        </a>
                    </div>
                </div>

                <div class="rounded-3xl border border-[#dee6fb] bg-white/70 px-5 py-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#11224e]/60">{{ __('Terhubung di sosial media') }}</p>
                        <div class="flex flex-wrap gap-2 text-[#11224e] [&>a]:inline-flex [&>a]:h-10 [&>a]:w-10 [&>a]:items-center [&>a]:justify-center [&>a]:rounded-full [&>a]:border [&>a]:border-[#e4e9fb] [&>a]:bg-[#f6f8ff] [&>a]:transition [&>a]:hover:-translate-y-0.5 [&>a]:hover:bg-white">
                            <x-frontend.social.website_url />
                            <x-frontend.social.instagram_url />
                            <x-frontend.social.facebook_url />
                            <x-frontend.social.twitter_url />
                            <x-frontend.social.youtube_url />
                            <x-frontend.social.whatsapp_url />
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-left" data-aos-delay="200" class="rounded-[32px] border border-[#d5def3] bg-white px-6 py-6 shadow-lg shadow-[#11224e]/5 hover-glow">
                <h3 class="text-lg font-semibold text-[#11224e]">{{ __('Kirimkan brief singkat Anda') }}</h3>
                <p class="mt-1 text-sm text-[#11224e]/80">{{ __('Ceritakan tujuan utama, tanggal, serta ekspektasi outcome. Kami akan hubungi Anda untuk sesi diskusi lanjut.') }}</p>
                <form action="{{ route('contact.store') }}" method="POST" class="mt-6 space-y-4" novalidate>
                    @csrf
                    <input type="text" name="website" id="contact-website" class="sr-only" aria-hidden="true" tabindex="-1" autocomplete="off">

                    <div>
                        <label for="name" class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/70">{{ __('Nama') }}</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="100" autocomplete="name" class="mt-2 w-full rounded-full border border-[#d5def3] bg-white px-4 py-3 text-sm text-[#11224e] placeholder:text-[#11224e]/40 focus:border-[#5c83c4] focus:outline-none @error('name') border-red-400 focus:border-red-500 @enderror" required aria-required="true" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/70">{{ __('Email') }}</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" maxlength="150" autocomplete="email" class="mt-2 w-full rounded-full border border-[#d5def3] bg-white px-4 py-3 text-sm text-[#11224e] placeholder:text-[#11224e]/40 focus:border-[#5c83c4] focus:outline-none @error('email') border-red-400 focus:border-red-500 @enderror" required aria-required="true" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/70">{{ __('Subjek (opsional)') }}</label>
                        <input id="subject" name="subject" type="text" value="{{ old('subject') }}" maxlength="150" class="mt-2 w-full rounded-full border border-[#d5def3] bg-white px-4 py-3 text-sm text-[#11224e] placeholder:text-[#11224e]/40 focus:border-[#5c83c4] focus:outline-none @error('subject') border-red-400 focus:border-red-500 @enderror" aria-invalid="{{ $errors->has('subject') ? 'true' : 'false' }}">
                        @error('subject')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="text-xs font-semibold uppercase tracking-wide text-[#11224e]/70">{{ __('Pesan') }}</label>
                        <textarea id="message" name="message" rows="5" minlength="10" class="mt-2 w-full rounded-2xl border border-[#d5def3] bg-white px-4 py-3 text-sm text-[#11224e] placeholder:text-[#11224e]/40 focus:border-[#5c83c4] focus:outline-none @error('message') border-red-400 focus:border-red-500 @enderror" required aria-required="true" aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-3 pt-4 sm:grid-cols-2">
                        @php
                            $waNumber = preg_replace('/[^0-9]/', '', setting('whatsapp_number') ?? '');
                            $waPrefill = setting('whatsapp_prefill') ?? 'Halo Digioh, saya ingin berdiskusi.';
                        @endphp
                        <button type="button" id="send-wa" data-wa-number="{{ $waNumber }}" data-wa-prefill="{{ $waPrefill }}" class="inline-flex w-full items-center justify-center rounded-full bg-[#25d366] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-[#25d366]/30 transition hover:bg-[#1fb358] focus:outline-none focus:ring-2 focus:ring-[#25d366]/60 focus:ring-offset-2 focus:ring-offset-white">
                            {{ __('Kirim via WhatsApp') }}
                        </button>
                        <a href="mailto:{{ setting('contact_email') ?? $defaultContactEmail }}" class="inline-flex w-full items-center justify-center rounded-full border border-[#d5def3] bg-white px-6 py-3 text-sm font-semibold text-[#11224e] transition hover:border-[#5c83c4] hover:text-[#5c83c4] focus:outline-none focus:ring-2 focus:ring-[#d5def3] focus:ring-offset-2 focus:ring-offset-white">
                            {{ __('Kirim via Email') }}
                        </a>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const btn = document.getElementById('send-wa');
                            if (!btn) {
                                return;
                            }
                            btn.addEventListener('click', function () {
                                const rawNum = btn.dataset.waNumber || '';
                                if (!rawNum) {
                                    window.location.href = 'mailto:{{ setting('contact_email') ?? $defaultContactEmail }}';
                                    return;
                                }
                                const prefill = btn.dataset.waPrefill || '';
                                const getValue = (id) => document.getElementById(id)?.value?.trim() || '';
                                const name = getValue('name');
                                const email = getValue('email');
                                const subject = getValue('subject');
                                const message = getValue('message');
                                const lines = [
                                    prefill,
                                    '',
                                    'Nama: ' + name,
                                    'Email: ' + email,
                                    'Subjek: ' + subject,
                                    '',
                                    message
                                ];
                                const base = 'https://wa.me/' + rawNum + '?text=';
                                window.open(base + encodeURIComponent(lines.join('\n')), '_blank');
                            });
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
