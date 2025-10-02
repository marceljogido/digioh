@extends('frontend.layouts.app')

@php
    $locale = app()->getLocale();
    $defaultTitle = $locale === 'en' ? 'About DigiOH' : 'Tentang DigiOH';

    $aboutTitle = $locale === 'en'
        ? (setting('about_title_en') ?: setting('about_title'))
        : setting('about_title');
    $aboutTitle = $aboutTitle ?: $defaultTitle;

    $aboutBody = $locale === 'en'
        ? (setting('about_body_en') ?: setting('about_body'))
        : setting('about_body');
    $aboutBody = $aboutBody ?: (
        $locale === 'en'
            ? '<p>DigiOH is a digital studio helping brands grow through creative solutions and technology.</p>'
            : '<p>DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi.</p>'
    );

    $founders = collect(range(1, 3))
        ->map(function ($i) {
            return [
                'name' => setting("about_founder_{$i}_name"),
                'title' => setting("about_founder_{$i}_title"),
                'photo' => setting("about_founder_{$i}_photo"),
                'linkedin' => setting("about_founder_{$i}_linkedin"),
            ];
        })
        ->filter(fn ($f) => ! empty($f['name']))
        ->values();
@endphp

@section('title', $aboutTitle)

@section('content')
    @if (setting('about_image'))
        <section class="relative overflow-hidden">
            <img src="{{ asset(setting('about_image')) }}" alt="{{ $aboutTitle }}" class="h-56 w-full object-cover sm:h-80" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-slate-900/30 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 mx-auto max-w-screen-xl px-4 py-8 sm:px-12">
                <h1 class="text-3xl font-bold text-white sm:text-4xl">{{ $aboutTitle }}</h1>
            </div>
        </section>
    @endif

    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
            <div class="prose max-w-none dark:prose-invert">
                {!! $aboutBody !!}
            </div>
        </div>
    </section>

    @if ($founders->count())
        <section class="bg-slate-50 dark:bg-slate-950">
            <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
                <div class="mb-8">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-500">{{ __('Founding Team') }}</span>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white">{{ __('Orang di balik Digioh') }}</h2>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ($founders as $f)
                        <div class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800 dark:bg-slate-900">
                            @if (! empty($f['photo']))
                                <img src="{{ asset($f['photo']) }}" alt="{{ $f['name'] }}" class="h-28 w-28 rounded-2xl object-cover" />
                            @else
                                <div class="flex h-28 w-28 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                                    <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 1115 0v.75H4.5v-.75z" /></svg>
                                </div>
                            @endif
                            <h3 class="mt-6 text-lg font-semibold text-slate-900 dark:text-white">{{ $f['name'] }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-300">{{ $f['title'] }}</p>
                            <div class="mt-4 flex items-center gap-3">
                                @if (! empty($f['linkedin']))
                                    <a href="{{ $f['linkedin'] }}" target="_blank" rel="noopener" class="inline-flex items-center rounded-full border border-slate-200 px-3 py-1 text-xs font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                                        <svg class="mr-2 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.22 8.5H4.78V24H.22V8.5zM8.54 8.5H13v2.11h.07c.62-1.17 2.14-2.4 4.41-2.4 4.72 0 5.59 3.11 5.59 7.15V24h-4.56v-6.63c0-1.58-.03-3.62-2.2-3.62-2.2 0-2.53 1.72-2.53 3.5V24H8.54V8.5z" /></svg>
                                        LinkedIn
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 text-white">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70">{{ __('Mari berkolaborasi') }}</span>
                    <h2 class="mt-4 text-3xl font-bold sm:text-4xl">{{ __('Tertarik membangun pengalaman yang berkesan?') }}</h2>
                    <p class="mt-4 max-w-2xl text-sm text-white/80">{{ __('Hubungi kami untuk mendiskusikan rencana Anda. Tim kami siap membantu menyiapkan solusi dan timeline yang realistis.') }}</p>
                    <div class="mt-6 flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-indigo-600 shadow-lg shadow-black/10 hover:bg-indigo-50">{{ __('Hubungi kami') }}</a>
                        <a href="{{ route('frontend.services.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-white hover:text-white/90">{{ __('Lihat layanan') }}
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
                <div class="hidden h-full w-full rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl shadow-indigo-900/30 backdrop-blur lg:flex">
                    <div class="flex flex-1 flex-col justify-between gap-6 text-sm text-white/80">
                        <div>
                            <h3 class="text-lg font-semibold text-white">{{ __('Nilai inti kami') }}</h3>
                            <ul class="mt-3 space-y-2">
                                <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-white"></span><span>{{ __('Kolaborasi dan transparansi dalam setiap sprint.') }}</span></li>
                                <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-white"></span><span>{{ __('Pengalaman pengguna di atas segalanya.') }}</span></li>
                                <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 rounded-full bg-white"></span><span>{{ __('Engineering disiplin & scalable untuk jangka panjang.') }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
