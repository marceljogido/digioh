<footer class="relative overflow-hidden bg-slate-950 text-slate-200">
    <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-indigo-500/20 via-blue-600/10 to-transparent"></div>
    <div class="absolute -left-24 top-20 h-72 w-72 rounded-full bg-indigo-500/10 blur-3xl"></div>
    <div class="absolute -right-32 -bottom-16 h-80 w-80 rounded-full bg-purple-500/10 blur-3xl"></div>

    <div class="relative mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
        <div class="grid gap-12 lg:grid-cols-[1.2fr_0.8fr_0.8fr]">
            <div class="space-y-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3 text-xl font-semibold">
                    <img src="{{ asset('digioh-logo.svg') }}" alt="{{ app_name() }}" class="h-10 w-auto" />
                    <span class="hidden text-sm font-medium uppercase tracking-[0.3em] text-indigo-300 sm:block">{{ __('Digital Experience Studio') }}</span>
                </a>
                <p class="text-sm leading-relaxed text-slate-400">
                    {!! setting('meta_description') !!}
                </p>
                <div class="space-y-3 text-sm text-slate-300">
                    <div class="flex items-center gap-3">
                        <svg class="h-4 w-4 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v1.128c0 .387-.19.75-.508.967l-8.25 5.5a1.125 1.125 0 01-1.234 0l-8.25-5.5a1.125 1.125 0 01-.508-.967V6.75z"/></svg>
                        <a href="mailto:{{ setting('contact_email') ?? 'hello@digioh.id' }}" class="hover:text-white">{{ setting('contact_email') ?? 'hello@digioh.id' }}</a>
                    </div>
                    <div class="flex items-centered gap-3">
                        <svg class="h-4 w-4 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        <span>{{ setting('contact_address') ?? 'Jakarta & Yogyakarta' }}</span>
                    </div>
                </div>
                <div class="pt-2">
                    <x-frontend.social.all-social-url class="flex flex-wrap gap-3" />
                </div>
            </div>

            <div class="grid gap-6 text-sm sm:grid-cols-2 lg:grid-cols-1">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-300">{{ __('Navigasi') }}</p>
                    <ul class="mt-4 space-y-3 text-slate-400">
                        <li><a href="{{ route('home') }}" class="transition hover:text-white">{{ __('Beranda') }}</a></li>
                        @php($__waNum = preg_replace('/[^0-9]/','', setting('whatsapp_number') ?? ''))
                        @php($__waMsg = rawurlencode(setting('whatsapp_prefill') ?? 'Halo DigiOH, saya ingin berdiskusi.'))
                        @php($__waLink = $__waNum ? "https://wa.me/$__waNum?text=$__waMsg" : route('contact'))
                        <li><a href="{{ route('frontend.services.index') }}" class="transition hover:text-white">{{ __('Layanan kami') }}</a></li>
                        <li><a href="{{ $__waLink }}" target="_blank" rel="noopener" class="transition hover:text-white">{{ __('Hubungi kami') }}</a></li>
                        <li><a href="{{ route('about') }}" class="transition hover:text-white">{{ __('Tentang Digioh') }}</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-300">{{ __('Sumber daya') }}</p>
                    <ul class="mt-4 space-y-3 text-slate-400">
                        <li><a href="{{ route('frontend.posts.index') }}" class="transition hover:text-white">{{ __('Our Work') }}</a></li>
                        <li><a href="{{ url('/#faq') }}" class="transition hover:text-white">{{ __('FAQ') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="space-y-6 text-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-300">{{ __('Ayo mulai') }}</p>
                <p class="text-slate-400">{{ __('Punya rencana event atau kebutuhan digital? Kami siap membantu dari ide hingga eksekusi.') }}</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-400">{{ __('Hubungi kami') }}</a>
                    <a href="{{ route('frontend.services.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-700 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-900">{{ __('Layanan kami') }}</a>
                </div>
                <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-4 text-slate-300">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-300">{{ __('Area layanan') }}</p>
                    <p class="mt-2 text-sm">{{ __('Indonesia (on-site) & remote collaboration') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-16 flex flex-col gap-4 border-t border-slate-800 pt-6 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
            <p>© Copyright 2025 digiOH. All Rights Reserved</p>
            <div class="flex flex-wrap items-center gap-4"></div>
        </div>
    </div>
</footer>
