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

    $aboutTagline = $locale === 'en'
        ? (setting('about_tagline_en') ?: setting('about_tagline'))
        : setting('about_tagline');
    $aboutTagline = $aboutTagline ?: (
        $locale === 'en'
            ? 'Beyond Expectations, Beyond Experiences'
            : 'Melampaui Ekspektasi, Menciptakan Pengalaman'
    );

    $visionText = $locale === 'en'
        ? (setting('about_vision_en') ?: setting('about_vision'))
        : setting('about_vision');

    $missionIntro = $locale === 'en'
        ? (setting('about_mission_intro_en') ?: setting('about_mission_intro'))
        : setting('about_mission_intro');

    $missionKeywordsRaw = $locale === 'en'
        ? (setting('about_mission_keywords_en') ?: setting('about_mission_keywords'))
        : setting('about_mission_keywords');

    $missionKeywords = collect(preg_split("/\r\n|\r|\n/", (string) $missionKeywordsRaw))
        ->filter(fn ($line) => trim($line) !== '')
        ->map(function ($line) {
            $parts = array_map('trim', explode('|', $line, 3));
            $parts = array_pad($parts, 3, '');

            return [
                'letter' => strtoupper($parts[0]),
                'title' => $parts[1],
                'description' => $parts[2],
            ];
        })
        ->whenEmpty(function ($collection) use ($locale) {
            return collect([
                ['letter' => 'L', 'title' => $locale === 'en' ? 'Reliability' : 'Keandalan', 'description' => $locale === 'en' ? 'Always dependable across every touchpoint.' : 'Selalu bisa diandalkan di setiap detail.'],
                ['letter' => 'E', 'title' => $locale === 'en' ? 'Effective' : 'Efektif', 'description' => $locale === 'en' ? 'Designing experiences that drive results.' : 'Merancang pengalaman yang tepat sasaran.'],
                ['letter' => 'T', 'title' => $locale === 'en' ? 'Teamwork' : 'Kolaborasi', 'description' => $locale === 'en' ? 'Working closely with clients & partners.' : 'Bergerak bersama klien dan partner.'],
                ['letter' => 'S', 'title' => $locale === 'en' ? 'Service' : 'Layanan', 'description' => $locale === 'en' ? 'End-to-end, proactive support.' : 'Layanan menyeluruh dan proaktif.'],
                ['letter' => 'G', 'title' => $locale === 'en' ? 'Integrity' : 'Integritas', 'description' => $locale === 'en' ? 'Transparency builds trust.' : 'Transparansi menjaga kepercayaan.'],
                ['letter' => 'O', 'title' => $locale === 'en' ? 'Outstanding' : 'Terkesan', 'description' => $locale === 'en' ? 'Always creating memorable output.' : 'Selalu menghadirkan hasil yang mengesankan.'],
            ]);
        });
    $missionLetters = $missionKeywords->pluck('letter')->filter()->map(fn ($letter) => strtoupper($letter))->implode(' . ');

    $timelineRaw = setting('about_timeline');
    $timelineItems = collect(preg_split("/\r\n|\r|\n/", (string) $timelineRaw))
        ->filter(fn ($line) => trim($line) !== '')
        ->map(function ($line) {
            $parts = array_map('trim', explode('|', $line, 3));
            $parts = array_pad($parts, 3, '');

            return [
                'year' => $parts[0],
                'title' => $parts[1],
                'description' => $parts[2],
            ];
        })
        ->whenEmpty(function () {
            return collect([
                ['year' => '2015', 'title' => 'Starting off as CV DIGIOH', 'description' => 'Business line: Digital Signage Rent'],
                ['year' => '2016', 'title' => 'New formation as PT Digital Open House', 'description' => 'Launching full-service event division'],
                ['year' => '2017', 'title' => 'New product development: digiSELFIE', 'description' => 'Interactive activation for events'],
                ['year' => '2018-2019', 'title' => 'New products: digiGAMES etc.', 'description' => 'Mirror booth, interactive white board, on-site gamification'],
                ['year' => '2020-2021', 'title' => 'Virtual expansion', 'description' => 'Virtual Event Organizer & digiSELFIE AR'],
                ['year' => '2022', 'title' => 'Business development', 'description' => 'Hybrid & offline event organizer'],
                ['year' => '2024 - Recent', 'title' => 'Advanced experiences', 'description' => 'Expo, competitions, and high-level meetings'],
            ]);
        });

    $foundersSetting = setting('about_founders', []);
    $founders = collect(is_array($foundersSetting) ? $foundersSetting : [])
        ->filter(function ($founder) {
            return ! empty($founder['name']) || ! empty($founder['title']) || ! empty($founder['photo']);
        })
        ->values();
@endphp

@section('title', $aboutTitle)

@section('content')
    @include('frontend.pages.partials.about-snippet')

    <section class="bg-[#FFF7F1] py-16">
        <div class="max-w-6xl mx-auto px-6 lg:px-0 flex flex-col lg:flex-row gap-12 items-center">
            <div class="relative">
                <div class="w-64 h-64 rounded-full bg-gradient-to-b from-[#FF9A3C] to-[#FF6A00] flex flex-col items-center justify-center text-white text-center shadow-xl">
                    <p class="text-xs tracking-[0.25em] uppercase">DIGIOH</p>
                    <p class="text-4xl font-extrabold leading-tight mt-1">{{ $locale === 'en' ? 'Our Story' : 'Kisah Kami' }}</p>
                    <p class="text-[11px] mt-1 tracking-wide">PT DIGITAL OPEN HOUSE</p>
                    <p class="text-[11px] mt-3 px-6 leading-relaxed opacity-90">
                        {{ $locale === 'en' ? 'Delivering meaningful experiences through technology, creativity, and human-centered execution.' : 'Menghadirkan pengalaman berkesan melalui teknologi, kreativitas, dan eksekusi yang berpusat pada manusia.' }}
                    </p>
                </div>
            </div>
            @php
                $timelinePalette = [
                    ['dot' => 'bg-[#d96a1c]', 'pill' => 'border-[#d96a1c] text-[#d96a1c]'],
                    ['dot' => 'bg-[#d9501c]', 'pill' => 'border-[#d9501c] text-[#d9501c]'],
                    ['dot' => 'bg-[#ff7f32]', 'pill' => 'border-[#ff7f32] text-[#ff7f32]'],
                    ['dot' => 'bg-[#d04a6f]', 'pill' => 'border-[#d04a6f] text-[#d04a6f]'],
                    ['dot' => 'bg-[#a65ad8]', 'pill' => 'border-[#a65ad8] text-[#a65ad8]'],
                    ['dot' => 'bg-[#f08acb]', 'pill' => 'border-[#f08acb] text-[#f08acb]'],
                ];
                $timelineItems = $timelineItems->values();
            @endphp
            <div class="flex-1 relative">
                <div class="absolute left-5 top-3 bottom-3 border-l-2 border-dashed border-orange-200/80"></div>
                <p class="text-xs uppercase tracking-[0.3em] text-orange-500 mb-2">{{ $locale === 'en' ? 'Journey' : 'Perjalanan' }}</p>
                <h2 class="text-3xl font-bold mb-2">{{ $locale === 'en' ? 'Our Journey Through the Years' : 'Perjalanan Kami dari Tahun ke Tahun' }}</h2>
                <p class="text-sm text-gray-600 mb-6 max-w-xl">{{ $locale === 'en' ? 'A decade of innovation, growth, and experience excellence in event technology.' : 'Satu dekade inovasi, pertumbuhan, dan pengalaman unggul dalam teknologi acara.' }}</p>
                <div class="space-y-6">
                    @foreach($timelineItems as $index => $timeline)
                        @php($palette = $timelinePalette[$index % count($timelinePalette)])
                        <div class="flex gap-6 pl-10">
                            <div class="flex flex-col items-center">
                                <span class="w-4 h-4 rounded-full shadow {{ $palette['dot'] }}"></span>
                            </div>
                            <div class="flex-1 space-y-2">
                                <div class="inline-flex min-w-[190px] items-center justify-center rounded-full border-2 bg-white px-6 py-2 text-lg font-semibold uppercase tracking-wide shadow-sm {{ $palette['pill'] }}">
                                    {{ $timeline['year'] }}
                                </div>
                                <div class="text-sm">
                                    <p class="font-semibold text-slate-900">{{ $timeline['title'] }}</p>
                                    <p class="text-slate-600">{{ $timeline['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-b from-slate-50 via-white to-white py-16 dark:from-slate-900/70">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-12">
            <div class="rounded-[32px] border border-slate-200 bg-white p-10 shadow-lg dark:border-slate-800 dark:bg-slate-900">
                <p class="text-3xl font-black uppercase text-[#2c55a2]">{{ $locale === 'en' ? 'Vision' : 'Visi' }}</p>
                <div class="mt-6 h-1 w-16 bg-gradient-to-r from-[#2c55a2] to-[#6fa3ff]"></div>
                @if($visionText)
                    <p class="mt-6 text-lg leading-relaxed text-slate-700 dark:text-slate-200">{{ $visionText }}</p>
                @endif
            </div>
            <div class="mt-10 rounded-[32px] bg-[#ffa630] p-10 text-white shadow-2xl">
                <p class="text-3xl font-black uppercase tracking-wide">{{ $locale === 'en' ? 'Mission' : 'Misi' }}</p>
                <div class="mt-4 h-1 w-20 bg-white/70"></div>
                @if($missionLetters)
                    <p class="mt-6 text-4xl font-black tracking-[0.4em]">{{ $missionLetters }}</p>
                @endif
                @if($missionIntro)
                    <p class="mt-4 text-sm text-white/85">{{ $missionIntro }}</p>
                @endif
                <div class="mt-8 grid gap-6 text-center text-sm font-semibold uppercase text-white/85 sm:grid-cols-3 lg:grid-cols-6">
                    @foreach($missionKeywords as $mission)
                        <div class="flex flex-col items-center gap-1">
                            <p class="text-xl font-black tracking-wide">{{ strtoupper($mission['letter']) }}</p>
                            <p>{{ $mission['title'] }}</p>
                            <p class="text-xs font-normal text-white/80">{{ $mission['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <?php if ($founders->isNotEmpty()): ?>
        <section class="bg-slate-50 dark:bg-slate-950">
            <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
                <div class="mb-8">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-500">{{ __('Founding Team') }}</span>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white">{{ __('Orang di balik Digioh') }}</h2>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    <?php foreach ($founders as $f): ?>
                        <?php
                            $photoPath = $f['photo'] ?? null;
                            $photoUrl = $photoPath
                                ? (\Illuminate\Support\Str::startsWith($photoPath, ['http://', 'https://', '//']) ? $photoPath : asset($photoPath))
                                : null;
                        ?>
                        <div class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800 dark:bg-slate-900">
                            @if ($photoUrl)
                                <img src="{{ $photoUrl }}" alt="{{ $f['name'] }}" class="h-28 w-28 rounded-2xl object-cover" />
                            @else
                                <div class="flex h-28 w-28 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                                    <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 1115 0v.75H4.5v-.75z" /></svg>
                                </div>
                            @endif
                            <h3 class="mt-6 text-lg font-semibold text-slate-900 dark:text-white">{{ $f['name'] }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-300">{{ $f['title'] }}</p>
                            <div class="mt-4 flex items-center gap-3">
                                @if (! empty($f['linkedin']))
                                    <a href="{{ $f['linkedin'] }}" target="_blank" rel="noopener" class="inline-flex items-center rounded-full border border-slate-200 px-3 py-1 text-xs fontu?i font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                                        <svg class="mr-2 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.22 8.5H4.78V24H.22V8.5zM8.54 8.5H13v2.11h.07c.62-1.17 2.14-2.4 4.41-2.4 4.72 0 5.59 3.11 5.59 7.15V24h-4.56v-6.63c0-1.58-.03-3.62-2.2-3.62-2.2 0-2.53 1.72-2.53 3.5V24H8.54V8.5z" /></svg>
                                        LinkedIn
                                    </a>
                                @endif
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

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
