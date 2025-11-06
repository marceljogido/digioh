@extends("frontend.layouts.app")

@section("title")
    {{ $service->name }}
@endsection

@section("content")
    @if($service->image)
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-slate-900/40"></div>
            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="h-56 w-full object-cover sm:h-72">
        </section>
    @endif
    <section class="bg-slate-900 text-white">
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
            <div class="flex items-start gap-4">
                @if($service->icon)
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10">
                        @if(strpos($service->icon, '<') !== false && strpos($service->icon, '>') !== false)
                            {!! $service->icon !!}
                        @else
                            <img src="{{ asset($service->icon) }}" alt="{{ $service->name }}" class="h-7 w-7">
                        @endif
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold sm:text-4xl">{{ $service->name }}</h1>
                    <p class="mt-3 max-w-2xl text-sm text-white/80">{{ __('Layanan ini kami rancang untuk memperkuat pengalaman event dan aktivasi brand Anda.') }}</p>
                </div>
            </div>
        </div>
    </section>

    @if($relatedWorks->count())
        <section class="bg-slate-50 dark:bg-slate-950">
            <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ __('Our Works for this service') }}</h2>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                            {{ __('Aktivitas pilihan yang pernah kami kerjakan dengan layanan ini.') }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 grid gap-6 md:grid-cols-3">
                    @foreach($relatedWorks as $work)
                        @php($url = route('frontend.posts.show', [encode_id($work->id), $work->slug]))
                        <article class="flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800/60 dark:bg-slate-900 dark:shadow-black/30">
                            <img src="{{ asset($work->image ?: 'img/default_post.svg') }}" alt="{{ $work->name }}" class="h-44 w-full object-cover">
                            <div class="flex flex-1 flex-col gap-4 p-6">
                                <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-indigo-500">
                                    @php($start = $work->event_start_date)
                                    @php($end = $work->event_end_date)
                                    @if($start)
                                        @if($end && !$start->isSameDay($end))
                                            <span>{{ $start->isoFormat('D MMM') }} - {{ $end->isoFormat('D MMM YYYY') }}</span>
                                        @else
                                            <span>{{ $start->isoFormat('D MMM YYYY') }}</span>
                                        @endif
                                    @else
                                        <span>{{ $work->published_at ? $work->published_at->isoFormat('D MMM YYYY') : $work->created_at->isoFormat('D MMM YYYY') }}</span>
                                    @endif
                                    @if(!empty($work->event_location))
                                        <span class="h-1 w-1 rounded-full bg-indigo-200"></span>
                                        <span>{{ $work->event_location }}</span>
                                    @endif
                                </div>
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $work->name }}</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-300">{{ \Str::limit(strip_tags($work->intro ?: $work->content), 140) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ $url }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">
                                        {{ __('Lihat detail') }}
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
            @if($service->description)
                <div class="prose max-w-none dark:prose-invert">
                    {!! $service->description !!}
                </div>
            @endif
        </div>
    </section>

    @if($posts->count())
        <section class="bg-slate-50 dark:bg-slate-950">
            <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
                <div class="flex items-end justify-between">
                    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ __('Kegiatan terbaru untuk layanan ini') }}</h2>
                </div>

                <div class="mt-8 grid gap-6 md:grid-cols-3">
                    @foreach($posts as $post)
                        <article class="flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800/60 dark:bg-slate-900 dark:shadow-black/30">
                            <img src="{{ asset($post->image ?: 'img/default_post.svg') }}" alt="{{ $post->name }}" class="h-44 w-full object-cover">
                            <div class="flex flex-1 flex-col gap-4 p-6">
                            <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-indigo-500">
                                @php($start = $post->event_start_date)
                                @php($end = $post->event_end_date)
                                @if($start)
                                    @if($end && !$start->isSameDay($end))
                                        <span>{{ $start->isoFormat('D MMM') }} - {{ $end->isoFormat('D MMM YYYY') }}</span>
                                    @else
                                        <span>{{ $start->isoFormat('D MMM YYYY') }}</span>
                                    @endif
                                @else
                                    <span>{{ $post->published_at ? $post->published_at->isoFormat('D MMM YYYY') : $post->created_at->isoFormat('D MMM YYYY') }}</span>
                                @endif
                                @if(!empty($post->event_location))
                                    <span class="h-1 w-1 rounded-full bg-indigo-200"></span>
                                    <span>{{ $post->event_location }}</span>
                                @endif
                            </div>
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $post->name }}</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-300">{{ \Str::limit(strip_tags($post->intro ?: $post->content), 140) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('frontend.posts.show', [encode_id($post->id), $post->slug]) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">
                                        {{ __('Lihat kegiatan') }}
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    @endif
@endsection
