@extends('frontend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')

<section class="relative overflow-hidden bg-[#11224e] pt-28 md:pt-32 lg:pt-12 pb-16 text-white scroll-mt-32">
    <div class="pointer-events-none absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#ffa630]/30 to-transparent"></div>
    <div class="pointer-events-none absolute inset-y-0 right-0 w-1/3 bg-gradient-to-l from-[#5c83c4]/35 to-transparent"></div>
    <div class="relative mx-auto flex max-w-screen-xl flex-col gap-8 px-4 sm:px-10 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex-1 space-y-5">
            <p class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.4em] text-white/80">
                {{ __('Showcase Portfolio') }}
            </p>
            <h1 class="text-3xl font-black tracking-tight sm:text-4xl">
                {{ __('Our Work & Experience Gallery') }}
            </h1>
            <p class="text-sm leading-relaxed text-white/75 sm:text-base">
                {{ __('Kumpulan studi kasus, event, dan project experiential yang kami orkestrasi untuk brand & institusi. Gunakan filter di samping untuk menemukan referensi yang paling relevan.') }}
            </p>
            <div class="grid gap-4 text-sm text-white/80 sm:grid-cols-3">
                <div class="rounded-2xl border border-white/30 bg-white/10 px-4 py-3 backdrop-blur">
                    <p class="text-xs uppercase tracking-wide text-white/60">{{ __('Total project') }}</p>
                    <p class="text-2xl font-black">{{ $posts->total() }}</p>
                </div>
            </div>
        </div>
        <div class="w-full max-w-lg rounded-[32px] border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur">
            <h2 class="text-sm font-semibold uppercase tracking-[0.4em] text-white/70">{{ __('Filter project') }}</h2>
            <form method="GET" class="mt-4 space-y-4">
                <div class="flex flex-col space-y-2">
                    <label for="q" class="text-xs font-semibold uppercase tracking-wide text-white/60">{{ __('Cari judul / insight') }}</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-white/40">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        </span>
                        <input type="text" id="q" name="q" value="{{ request('q') }}" placeholder="{{ __('Misal: expo, AR, launching') }}" class="w-full rounded-2xl border border-white/15 bg-white/10 pl-9 pr-3 py-2 text-sm text-white placeholder:text-white/40 focus:border-white focus:outline-none focus:ring-0" />
                    </div>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="service" class="text-xs font-semibold uppercase tracking-wide text-white/60">{{ __('Layanan') }}</label>
                    <select id="service" name="service" class="rounded-2xl border border-white/20 bg-white/90 px-3 py-2 text-sm text-[#0b152e] focus:border-white focus:outline-none focus:ring-0">
                        <option value="">{{ __('Semua layanan') }}</option>
                        @foreach($services as $svc)
                            <option value="{{ $svc->slug }}" @selected(request('service') === $svc->slug)>{{ $svc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="year" class="text-xs font-semibold uppercase tracking-wide text-white/60">{{ __('Tahun event') }}</label>
                    <select id="year" name="year" class="rounded-2xl border border-white/20 bg-white/90 px-3 py-2 text-sm text-[#0b152e] focus:border-white focus:outline-none focus:ring-0">
                        <option value="">{{ __('Semua tahun') }}</option>
                        @foreach($years as $yearOption)
                            <option value="{{ $yearOption }}" @selected((int)request('year') === (int)$yearOption)>{{ $yearOption }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="inline-flex items-center rounded-full bg-[#ffa630] px-5 py-2 text-sm font-semibold text-[#11224e] shadow hover:bg-[#fcbf64] transition">
                        {{ __('Terapkan filter') }}
                    </button>
                    @if(request()->hasAny(['q','service','year']))
                        <a href="{{ route('frontend.ourwork.index') }}" class="inline-flex items-center rounded-full border border-white/30 px-5 py-2 text-sm font-semibold text-white hover:bg-white/10">
                            {{ __('Reset') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

<section class="bg-[#f4f6fb] text-gray-600 p-6 sm:p-12">
    <div class="mx-auto max-w-screen-xl space-y-10">
        @if($posts->count())
            <div class="flex flex-col gap-2 text-sm text-[#11224e]/80 sm:flex-row sm:items-center sm:justify-between">
                @php
                    $from = $posts->firstItem();
                    $to = $posts->lastItem();
                @endphp
                <div class="flex flex-wrap items-center gap-3">
                    <span class="font-semibold text-[#11224e]">
                        {{ $from && $to
                            ? __('Proyek :from-:to dari :total', ['from' => $from, 'to' => $to, 'total' => $posts->total()])
                            : __('Menampilkan :count item', ['count' => $posts->count()]) }}
                    </span>
                </div>
                <form method="GET" class="flex items-center gap-2 text-xs text-[#11224e]">
                    @foreach(request()->except('per_page', 'page') as $key => $value)
                        @if(is_array($value))
                            @foreach($value as $subValue)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $subValue }}">
                            @endforeach
                        @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                    <label for="per_page" class="font-semibold uppercase tracking-wide">{{ __('Jumlah per halaman') }}</label>
                    <select id="per_page" name="per_page" class="rounded-xl border border-[#d5def3] bg-white px-2 py-1 text-sm text-[#0b152e]" onchange="this.form.submit()">
                        @foreach($perPageOptions as $option)
                            <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    @php
                        $details_url = route('frontend.posts.show', [encode_id($post->id), $post->slug]);
                    @endphp
                    <a href="{{ $details_url }}" class="flex h-full flex-col overflow-hidden rounded-[32px] border border-[#d5def3] bg-white shadow-lg shadow-[#11224e]/5 transition hover:-translate-y-1.5 hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-[#ffa630]/60">
                        <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-100">
                            <img src="{{ asset($post->image ?: 'img/default_post.svg') }}" alt="{{ $post->name }}" class="h-full w-full object-cover">
                        </div>
                        <div class="flex flex-1 flex-col gap-4 p-5">
                            @php
                                $dateLabel = '';
                                $startDate = $post->event_start_date;
                                $endDate = $post->event_end_date;
                                if ($startDate) {
                                    if ($endDate && !$startDate->isSameDay($endDate)) {
                                        $sameMonth = $startDate->format('mY') === $endDate->format('mY');
                                        $startFormat = $sameMonth ? $startDate->isoFormat('D') : $startDate->isoFormat('D MMM');
                                        $endFormat = $endDate->isoFormat('D MMM YYYY');
                                        $dateLabel = "{$startFormat} - {$endFormat}";
                                    } else {
                                        $dateLabel = $startDate->isoFormat('D MMM YYYY');
                                    }
                                } elseif ($post->published_at) {
                                    $dateLabel = $post->published_at->isoFormat('D MMM YYYY');
                                } elseif ($post->created_at) {
                                    $dateLabel = $post->created_at->isoFormat('D MMM YYYY');
                                }
                            @endphp
                            <div class="flex items-center justify-between text-xs text-[#5c83c4] font-semibold">
                                <span>{{ $dateLabel ?? '' }}</span>
                                @if($post->event_location)
                                    <span class="flex items-center gap-1">
                                        <svg class="h-3.5 w-3.5 text-[#f17720]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                        {{ $post->event_location }}
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-lg font-semibold text-[#11224e]">{{ $post->name }}</h3>
                            <p class="text-sm text-[#11224e]/80">{{ \Str::limit(strip_tags($post->intro ?: $post->content), 160) }}</p>

                            @if($post->services->count())
                                <div class="flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-wide text-[#5c83c4]">
                                    <span>{{ __('Layanan') }}:</span>
                                    <span>{{ $post->services->sortBy('name')->pluck('name')->join(', ') }}</span>
                                </div>
                            @endif
                            @if(!empty($post->scope_of_work_list))
                                <div class="flex flex-wrap gap-2 text-xs text-[#11224e]/70">
                                    @foreach($post->scope_of_work_list as $scope)
                                        <span class="inline-flex items-center rounded-full bg-[#eef2ff] px-3 py-1 font-semibold capitalize text-[#11224e]">{{ $scope }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="pt-6">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500">
                {{ __('Belum ada konten sesuai filter.') }}
            </div>
        @endif
    </div>
</section>

@endsection
