@php($locale = app()->getLocale())
@php($aboutTitle = $locale === 'en' ? (setting('about_title_en') ?: setting('about_title')) : setting('about_title'))
@php($aboutBody = $locale === 'en' ? (setting('about_body_en') ?: setting('about_body')) : setting('about_body'))
@php($aboutTagline = $locale === 'en' ? (setting('about_tagline_en') ?: setting('about_tagline')) : setting('about_tagline'))
@php($aboutTagline = $aboutTagline ?: ($locale === 'en' ? 'Beyond Expectations, Beyond Experiences' : 'Melampaui ekspektasi, menciptakan pengalaman'))
@php($aboutExcerpt = $aboutBody ? \Illuminate\Support\Str::limit(strip_tags($aboutBody), 1500, '...') : null)

<section class="relative overflow-hidden bg-white dark:bg-slate-900/40">
    <div class="absolute inset-x-0 -top-32 h-56 bg-gradient-to-r from-indigo-100 via-purple-100 to-transparent opacity-60 blur-3xl dark:from-indigo-500/20 dark:via-blue-500/10"></div>
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
        <div class="grid gap-10 lg:grid-cols-[1.1fr_.9fr] lg:items-center">
            <div>
                <div class="flex items-center gap-3">
                    <span class="h-2 w-12 rounded-full bg-orange-500"></span>
                    <span class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">{{ $locale === 'en' ? 'About us' : 'Tentang kami' }}</span>
                </div>
                <h2 class="mt-4 text-4xl font-black uppercase text-slate-900 dark:text-white">
                    {{ $aboutTitle ?: ($locale === 'en' ? 'About DigiOH' : 'Tentang DigiOH') }}
                </h2>
                @if($aboutTagline)
                    <p class="mt-4 text-sm font-semibold uppercase tracking-wide text-orange-500">
                        {{ $aboutTagline }}
                    </p>
                @endif
                <div class="mt-5 space-y-4 text-base leading-relaxed text-slate-700 dark:text-slate-300">
                    @if($aboutExcerpt)
                        {!! nl2br(e($aboutExcerpt)) !!}
                    @else
                        <p>{{ $locale === 'en' ? 'Digital transformation with a human touch.' : 'Transformasi digital yang manusiawi.' }}</p>
                    @endif
                </div>
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-500">
                        {{ $locale === 'en' ? 'Learn more about us' : 'Pelajari selengkapnya' }}
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-900 hover:text-slate-700 dark:text-indigo-200 dark:hover:text-white">
                        {{ $locale === 'en' ? 'Start a conversation' : 'Mulai diskusi' }}
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="absolute -inset-6 rounded-[2.5rem] bg-gradient-to-br from-orange-200 via-yellow-100 to-transparent opacity-70 blur-3xl dark:from-indigo-500/30 dark:via-blue-600/20"></div>
                <div class="relative overflow-hidden rounded-[2.5rem] border border-slate-100 shadow-xl dark:border-slate-800/60">
                    @if(setting('about_image'))
                        <img class="h-full w-full object-cover" src="{{ asset(setting('about_image')) }}" alt="{{ $aboutTitle ?: 'Digioh' }}">
                    @else
                        <img class="h-full w-full object-cover" src="{{ asset('img/about-placeholder.jpg') }}" alt="Digioh">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>
