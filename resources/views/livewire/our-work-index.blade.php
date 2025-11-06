<div>
    <div class="mb-8 rounded-3xl border border-slate-200 bg-white/70 p-6 shadow-sm backdrop-blur dark:border-slate-800 dark:bg-slate-900/60">
        <div class="flex items-start justify-between gap-4">
            <div class="w-full">
                <label for="q" class="block text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Cari') }}</label>
                <div class="relative mt-2">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </span>
                    <input type="text" id="q" wire:model.live="q" placeholder="{{ __('Cari judul atau isi...') }}" class="w-full rounded-2xl border border-slate-200 bg-white/80 pl-9 pr-3 py-2 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-0 dark:border-slate-700 dark:bg-slate-900 dark:text-white" />
                    <div wire:loading wire:target="q,service,sort" class="absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 animate-spin text-slate-400" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                    </div>
                </div>

                @if(($services ?? collect())->count())
                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <button type="button" wire:click="$set('service','')" class="rounded-full border px-3 py-1 text-xs font-medium transition @if($service==='') border-indigo-300 bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200 dark:bg-indigo-500/10 dark:text-indigo-300 @else border-slate-200 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 @endif">
                            {{ __('Semua') }}
                        </button>
                        @foreach($services as $svc)
                            <button type="button" wire:click="$set('service','{{ $svc->slug }}')" class="rounded-full border px-3 py-1 text-xs font-medium transition @if($service===$svc->slug) border-indigo-300 bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200 dark:bg-indigo-500/10 dark:text-indigo-300 @else border-slate-200 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 @endif">
                                {{ $svc->name }}
                            </button>
                        @endforeach

                        @if($q !== '' || $service !== '' || $sort !== 'newest')
                            <button type="button" wire:click="clearFilters" class="ml-2 rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                                {{ __('Hapus semua filter') }}
                            </button>
                        @endif
                    </div>
                @endif
            </div>

            <div class="hidden w-64 shrink-0 md:block">
                <label class="block text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Urutkan') }}</label>
                <div class="mt-2 flex flex-wrap gap-2">
                    <button type="button" wire:click="$set('sort','newest')" class="rounded-full border px-3 py-1 text-xs font-medium transition @if($sort==='newest') border-indigo-300 bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200 dark:bg-indigo-500/10 dark:text-indigo-300 @else border-slate-200 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 @endif">{{ __('Terbaru') }}</button>
                    <button type="button" wire:click="$set('sort','az')" class="rounded-full border px-3 py-1 text-xs font-medium transition @if($sort==='az') border-indigo-300 bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200 dark:bg-indigo-500/10 dark:text-indigo-300 @else border-slate-200 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 @endif">A - Z</button>
                    <button type="button" wire:click="$set('sort','oldest')" class="rounded-full border px-3 py-1 text-xs font-medium transition @if($sort==='oldest') border-indigo-300 bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200 dark:bg-indigo-500/10 dark:text-indigo-300 @else border-slate-200 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 @endif">{{ __('Terlama') }}</button>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Tahun') }}</label>
                        <select wire:model="year" class="mt-2 w-full rounded-lg border border-slate-200 bg-white/80 px-2 py-1 text-xs focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-900">
                            <option value="">{{ __('Semua') }}</option>
                            @foreach($years as $y)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Bulan') }}</label>
                        <select wire:model="month" class="mt-2 w-full rounded-lg border border-slate-200 bg-white/80 px-2 py-1 text-xs focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-900">
                            <option value="">{{ __('Semua') }}</option>
                            @foreach($months as $num => $label)
                                <option value="{{ $num }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 flex items-center justify-between text-xs text-slate-500">
            <div>
                {{ __('Total hasil') }}: <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $posts->total() }}</span>
            </div>
            <div class="md:hidden">
                <label class="mr-2">{{ __('Urutkan') }}</label>
                <select wire:model="sort" class="rounded-lg border border-slate-200 bg-white/80 px-2 py-1 text-xs focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-900">
                    <option value="newest">{{ __('Terbaru') }}</option>
                    <option value="az">A - Z</option>
                    <option value="oldest">{{ __('Terlama') }}</option>
                </select>
                <div class="mt-2 grid grid-cols-2 gap-2">
                    <select wire:model="year" class="rounded-lg border border-slate-200 bg-white/80 px-2 py-1 text-xs focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-900">
                        <option value="">{{ __('Semua Tahun') }}</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                    <select wire:model="month" class="rounded-lg border border-slate-200 bg-white/80 px-2 py-1 text-xs focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-900">
                        <option value="">{{ __('Semua Bulan') }}</option>
                        @foreach($months as $num => $label)
                            <option value="{{ $num }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    @if($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" wire:loading.class="opacity-60">
            @foreach ($posts as $post)
                @php($details_url = route('frontend.posts.show', [encode_id($post->id), $post->slug]))
                <a href="{{ $details_url }}" class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800/60 dark:bg-slate-900 dark:shadow-black/30">
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
                            @if($post->services->count())
                                <span class="h-1 w-1 rounded-full bg-indigo-200"></span>
                                <span>
                                    {{ $post->services->sortBy('name')->pluck('name')->join(', ') }}
                                </span>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $post->name }}</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-300">{{ \Str::limit(strip_tags($post->intro ?: $post->content), 140) }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="rounded-2xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">
            {{ __('Belum ada konten sesuai filter.') }}
        </div>
    @endif
</div>
