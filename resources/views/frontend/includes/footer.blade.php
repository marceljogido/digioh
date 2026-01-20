<footer class="relative overflow-hidden bg-gradient-to-b from-[#5c83c4] via-[#4f6da9] to-[#11224e] text-white/80">
    @php
        $defaultContactEmail = 'dukunganteknis@digioh.com';
        $defaultContactAddress = 'Fatmawati Festival Blok A-7, Jalan RS Fatmawati no. 50 Seberang Rumah Duka Fatmawati, Jl. RS. Fatmawati Raya No.50, RT.4/RW.4, West Cilandak, Cilandak, South Jakarta City, Jakarta 12430';
    @endphp
    <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white/20 via-transparent to-transparent"></div>
    <div class="absolute -left-16 top-10 h-48 w-48 rounded-full bg-[#ffa630]/10 blur-3xl"></div>
    <div class="absolute -right-20 -bottom-12 h-60 w-60 rounded-full bg-[#5c83c4]/15 blur-3xl"></div>

    <div class="relative mx-auto max-w-screen-xl px-4 py-10 sm:px-10">
        <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr_0.8fr]">
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3 text-xl font-semibold">
                    <img src="{{ asset('/img/DIGIOH_Main Logo_Flat Color White.svg') }}" alt="{{app_name() }}" class="h-10 w-auto" />
                </a>
                <p class="text-xs leading-relaxed text-white/70">
                    {!! (app()->getLocale() == 'en' && setting('app_description_en')) ? setting('app_description_en') : setting('meta_description') !!}
                </p>
                <div class="space-y-2 text-sm text-white/85">
                    <div class="flex items-center gap-4">
                        <span class="inline-flex h-10 w-10 shrink-0 aspect-square items-center justify-center rounded-full border border-white/20 bg-white/5 text-[#ffa630]">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v1.128c0 .387-.19.75-.508.967l-8.25 5.5a1.125 1.125 0 01-1.234 0l-8.25-5.5a1.125 1.125 0 01-.508-.967V6.75z"/></svg>
                        </span>
                        <a href="mailto:{{ setting('contact_email') ?? $defaultContactEmail }}" class="hover:text-white">{{ setting('contact_email') ?? $defaultContactEmail }}</a>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="mt-1 inline-flex h-10 w-10 shrink-0 aspect-square items-center justify-center rounded-full border border-white/20 bg-white/5 text-[#ffa630]">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        </span>
                        <span class="leading-relaxed">{!! nl2br(e((app()->getLocale() == 'en' && setting('contact_address_en')) ? setting('contact_address_en') : (setting('contact_address') ?? $defaultContactAddress))) !!}</span>
                    </div>
                </div>
                <div class="pt-1">
                    <x-frontend.social.all-social-url class="flex flex-wrap gap-2 [&>a]:text-white/70 [&>a]:text-sm" />
                </div>
            </div>

            <div class="space-y-4 text-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70">{{ __('Menu & Resources') }}</p>
                <ul class="grid gap-3 text-white/70 sm:grid-cols-2">
                    <li><a href="{{ route('home') }}" class="transition hover:text-white">{{ __('Beranda') }}</a></li>
                    <li><a href="{{ route('frontend.ourwork.index') }}" class="transition hover:text-white">{{ __('Our Work') }}</a></li>
                    <li><a href="{{ route('frontend.services.index') }}" class="transition hover:text-white">{{ __('Layanan kami') }}</a></li>
                    <li><a href="{{ route('about') }}" class="transition hover:text-white">{{ __('Tentang Digioh') }}</a></li>
                    @php($__waNum = preg_replace('/[^0-9]/','', setting('whatsapp_number') ?? ''))
                    @php($__waMsg = rawurlencode(setting('whatsapp_prefill') ?? 'Halo DigiOH, saya ingin berdiskusi.'))
                    @php($__waLink = $__waNum ? "https://wa.me/$__waNum?text=$__waMsg" : route('contact'))
                    <li><a href="{{ $__waLink }}" target="_blank" rel="noopener" class="transition hover:text-white">{{ __('Hubungi kami') }}</a></li>
                    <li><a href="{{ url('/#faq') }}" class="transition hover:text-white">{{ __('FAQ') }}</a></li>


                </ul>
            </div>

            <div class="space-y-3 text-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70">{{ __('Visit Our Location') }}</p>
                @if(setting('footer_map_embed'))
                    <div class="footer-map overflow-hidden rounded-2xl border border-white/15 shadow-[0_20px_60px_rgba(0,0,0,0.3)]">
                        {!! setting('footer_map_embed') !!}
                    </div>
                @else
                    <p class="text-white/70">{{ setting('contact_address') ?? $defaultContactAddress }}</p>
                @endif
            </div>
        </div>

        <div class="mt-10 flex flex-col gap-3 border-t border-white/10 pt-4 text-xs text-white/60 sm:flex-row sm:items-center sm:justify-between">
            <p>© {{ date('Y') }} digiOH. All Rights Reserved.</p>
            <div class="flex flex-wrap items-center gap-4"></div>
        </div>
    </div>
</footer>
