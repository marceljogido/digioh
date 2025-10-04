@extends("frontend.layouts.app")

@section("title")
    {{ __('Products & Services') }}
@endsection

@section("content")
    <section class="bg-slate-900 text-white">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <h1 class="text-3xl font-bold sm:text-4xl">{{ __('Products & Services') }}</h1>
            <p class="mt-3 max-w-2xl text-sm text-slate-300">{{ __('Layanan yang kami sediakan untuk mendukung kebutuhan event dan aktivasi brand Anda.') }}</p>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            @if($services->count())
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($services as $service)
                        <a href="{{ route('frontend.services.show', $service->slug) }}" class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800/50 dark:bg-slate-900 dark:shadow-black/30">
                            @if($service->image)
                                <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="h-40 w-full object-cover">
                            @endif
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    @if($service->icon)
                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                                            @if(strpos($service->icon, '<') !== false && strpos($service->icon, '>') !== false)
                                                {!! $service->icon !!}
                                            @else
                                                <img src="{{ asset($service->icon) }}" alt="{{ $service->name }}" class="h-7 w-7">
                                            @endif
                                        </div>
                                    @endif
                                    <h3 class="mt-6 text-lg font-semibold text-slate-900 dark:text-white">{{ $service->name }}</h3>
                                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">{{ \Str::limit(strip_tags($service->description), 160) }}</p>
                                </div>
                                <div class="mt-6 flex items-center gap-2 text-sm font-semibold text-indigo-600 dark:text-indigo-300">
                                    {{ __('Lihat detail layanan') }}
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-600 dark:text-slate-300">{{ __('Belum ada layanan yang aktif.') }}</p>
            @endif
        </div>
    </section>
@endsection
