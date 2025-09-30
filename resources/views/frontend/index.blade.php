@extends("frontend.layouts.app")

@section("title")
    {{ app_name() }}
@endsection

@section("content")
    @php($slides = \Modules\Slider\Models\Slider::active()->sorted()->get())
    @if($slides->isNotEmpty())
        <section class="relative w-full overflow-hidden bg-white dark:bg-gray-800">
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
                @foreach($slides as $s)
                    <div class="w-full mb-8">
                        <img src="{{ asset($s->image) }}" alt="{{ $s->title }}" class="w-full h-auto rounded" />
                        @if($s->button_link)
                            <a href="{{ $s->button_link }}" class="inline-block mt-3 rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-900">
                                {{ $s->button_text ?? 'Learn more' }}
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @php($logos = \Modules\ClientLogo\Models\ClientLogo::active()->sorted()->get())
    @if($logos->count())
    <section class="bg-white dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-12">
            <h2 class="mb-4 text-2xl font-semibold dark:text-white">{{ __('Trusted by') }}</h2>
            <div x-data="{ atStart:true, atEnd:false }"
                 x-init="setInterval(()=>{ const el=$refs.track; if(!el) return; if(!atEnd){ el.scrollBy({left:(el.clientWidth*0.5), behavior:'smooth'}); } else { el.scrollTo({left:0, behavior:'smooth'}); } }, 4000)"
                 class="relative">
                <div x-ref="track"
                     class="flex gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4"
                     x-on:scroll.debounce.50ms="
                        const el=$refs.track;
                        atStart = el.scrollLeft <= 0;
                        atEnd = Math.ceil(el.scrollLeft + el.clientWidth) >= el.scrollWidth;
                     ">
                    @foreach($logos as $logo)
                        <div class="shrink-0 snap-start w-1/2 sm:w-1/3 md:w-1/5 flex items-center justify-center">
                            @if($logo->website_url)
                                <a href="{{ $logo->website_url }}" target="_blank" rel="nofollow noopener" title="{{ $logo->client_name }}">
                                    <img loading="lazy" class="h-12 opacity-70 hover:opacity-100 transition grayscale" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}">
                                </a>
                            @else
                                <img loading="lazy" class="h-12 opacity-70 hover:opacity-100 transition grayscale" src="{{ asset($logo->logo) }}" alt="{{ $logo->client_name }}" title="{{ $logo->client_name }}">
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" class="absolute left-0 top-1/2 -translate-y-1/2 rounded bg-white/70 px-2 py-1 shadow dark:bg-gray-700"
                        x-on:click="$refs.track.scrollBy({left:-($refs.track.clientWidth*0.8), behavior:'smooth'})"
                        x-bind:class="{'invisible': atStart}">‹</button>
                <button type="button" class="absolute right-0 top-1/2 -translate-y-1/2 rounded bg-white/70 px-2 py-1 shadow dark:bg-gray-700"
                        x-on:click="$refs.track.scrollBy({left:($refs.track.clientWidth*0.8), behavior:'smooth'})"
                        x-bind:class="{'invisible': atEnd}">›</button>
            </div>
        </div>
    </section>
    @endif

    {{-- Tentang Kami (Cuplikan) --}}
    @include('frontend.pages.partials.about-snippet')

    @php($works = \Modules\OurWork\Models\OurWork::active()->where('featured_on_home', true)->sorted()->take(4)->get())
    @if($works->count())
        <section class="bg-white dark:bg-gray-800">
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
                <h2 class="mb-6 text-2xl font-semibold dark:text-white">Our Work</h2>
                <div class="grid gap-6 md:grid-cols-4">
                    @foreach($works as $w)
                        <div class="rounded border p-4">
                            @if($w->icon_class)<i class="{{ $w->icon_class }} mb-2 text-xl"></i>@endif
                            <div class="font-semibold">{{ $w->name }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">{{ \Str::limit(strip_tags($w->excerpt ?: $w->description), 90) }}</div>
                            <a class="mt-2 inline-block text-primary-600 hover:underline" href="{{ route('frontend.ourwork.show', [encode_id($w->id), $w->slug]) }}">Detail</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @php($featuredPosts = \Modules\Post\Models\Post::published()->featured()->take(3)->get())
    @if($featuredPosts->count())
    <section class="bg-white dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
            <h2 class="mb-6 text-2xl font-semibold dark:text-white">{{ __('Blog Terbaru') }}</h2>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach($featuredPosts as $post)
                    <a href="{{ route('frontend.posts.show', [encode_id($post->id), $post->slug]) }}" class="block rounded border p-4 hover:shadow">
                        <div class="font-semibold">{{ $post->name }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">{{ \Str::limit(strip_tags($post->content ?? ''), 120) }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    
@endsection
