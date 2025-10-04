<section class="relative overflow-hidden bg-white dark:bg-slate-900/40">
    <div class="absolute inset-x-0 -top-40 h-64 bg-gradient-to-r from-indigo-100 via-purple-100 to-transparent opacity-70 blur-3xl dark:from-indigo-500/20 dark:via-blue-500/10"></div>
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
        <div class="grid gap-12 lg:grid-cols-[1.15fr_.85fr] lg:items-center">
            <div class="relative z-10">
                @php($locale = app()->getLocale())
                <span class="text-xs font-semibold uppercase tracking-[0.35em] text-indigo-500">{{ $locale === 'en' ? 'About Digioh' : 'Tentang Digioh' }}</span>
                @php($aboutTitle = $locale === 'en' ? (setting('about_title_en') ?: setting('about_title')) : setting('about_title'))
                @php($aboutBody = $locale === 'en' ? (setting('about_body_en') ?: setting('about_body')) : setting('about_body'))
                <h2 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white lg:text-4xl">
                    {{ $aboutTitle ?: ($locale==='en' ? 'Digital transformation with a human touch' : 'Transformasi digital yang manusiawi') }}
                </h2>
                <div class="mt-5 space-y-4 text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                    {!! $aboutBody !!}
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-400">
                        Learn more about us
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">
                        Start a conversation
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>

                <div class="mt-8 grid gap-6 sm:grid-cols-3">
                    <div class="rounded-2xl border border-slate-100 bg-white/60 p-4 shadow-sm backdrop-blur dark:border-slate-800/60 dark:bg-slate-900/60">
                        <div class="text-sm font-semibold text-slate-900 dark:text-white">Collaborative approach</div>
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">We align business outcomes and user experience in every sprint.</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white/60 p-4 shadow-sm backdrop-blur dark:border-slate-800/60 dark:bg-slate-900/60">
                        <div class="text-sm font-semibold text-slate-900 dark:text-white">Multidisciplinary team</div>
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Product strategists, designers, engineers, and growth analysts working as one squad.</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white/60 p-4 shadow-sm backdrop-blur dark:border-slate-800/60 dark:bg-slate-900/60">
                        <div class="text-sm font-semibold text-slate-900 dark:text-white">Measurable impact</div>
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Every solution is launched with clear success metrics and ongoing optimisation.</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -inset-6 rounded-3xl bg-gradient-to-br from-indigo-200 via-purple-200 to-transparent opacity-60 blur-3xl dark:from-indigo-500/20 dark:via-blue-600/20"></div>
                <div class="relative overflow-hidden rounded-[2rem] border border-slate-100 shadow-xl dark:border-slate-800/60">
                    @if(setting('about_image'))
                        <img class="h-full w-full object-cover" src="{{ asset(setting('about_image')) }}" alt="{{ setting('about_title') }}">
                    @else
                        <img class="h-full w-full object-cover" src="{{ asset('img/logo.png') }}" alt="Digioh">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>
