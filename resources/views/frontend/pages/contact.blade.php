@extends('frontend.layouts.app')

@section('title')
	{{ __('Contact') }}
@endsection

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 text-white">
        <div class="absolute inset-x-0 -top-32 h-48 bg-gradient-to-b from-white/10 to-transparent opacity-40"></div>
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium uppercase tracking-wider">{{ __('Mari mulai') }}</span>
                <h1 class="mt-4 text-3xl font-bold sm:text-4xl">{{ __('Ceritakan rencana Anda') }}</h1>
                <p class="mt-3 text-sm text-white/80">{{ __('Isi formulir atau hubungi kami — tim kami akan merespons dalam 1-2 hari kerja.') }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
            @if(session('flash_success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800 dark:border-green-900/40 dark:bg-green-900/30 dark:text-green-200">{{ session('flash_success') }}</div>
            @endif

            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
                <div class="space-y-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('Kontak langsung') }}</h2>
                        <div class="mt-4 grid gap-4 sm:grid-cols-2">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v1.128c0 .387-.19.75-.508.967l-8.25 5.5a1.125 1.125 0 01-1.234 0l-8.25-5.5a1.125 1.125 0 01-.508-.967V6.75z"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs uppercase tracking-wide text-slate-500">{{ __('Email') }}</div>
                                    <a href="mailto:{{ setting('contact_email') ?? 'hello@digioh.id' }}" class="font-semibold text-slate-900 hover:text-indigo-600 dark:text-white">{{ setting('contact_email') ?? 'hello@digioh.id' }}</a>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs uppercase tracking-wide text-slate-500">{{ __('Alamat') }}</div>
                                    <div class="font-semibold text-slate-900 dark:text-white">{{ setting('contact_address') ?? 'Jakarta & Yogyakarta' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <x-frontend.social.all-social-url class="flex flex-wrap gap-3" />
                        </div>
                    </div>

                    @if(setting('contact_map_embed'))
                        <div class="overflow-hidden rounded-3xl border border-slate-200 shadow-sm dark:border-slate-800">
                            {!! setting('contact_map_embed') !!}
                        </div>
                    @endif
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('Kirimkan pesan') }}</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ __('Ringkas saja — ceritakan tujuan dan kebutuhan utama Anda.') }}</p>
                    <form action="{{ route('contact.store') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" />

                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="name">{{ __('Nama') }}</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-2 w-full rounded-full border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-white" required>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="email">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-2 w-full rounded-full border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-white" required>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="subject">{{ __('Subjek (opsional)') }}</label>
                            <input id="subject" name="subject" type="text" value="{{ old('subject') }}" class="mt-2 w-full rounded-full border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="message">{{ __('Pesan') }}</label>
                            <textarea id="message" name="message" rows="5" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-white" required>{{ old('message') }}</textarea>
                        </div>
                        @php($__waNum = preg_replace('/[^0-9]/','', setting('whatsapp_number') ?? ''))
                        @php($__waMsg = rawurlencode(setting('whatsapp_prefill') ?? 'Halo DigiOH, saya ingin berdiskusi.'))
                        @php($__waLink = $__waNum ? "https://wa.me/$__waNum?text=$__waMsg" : null)
                        <button type="button" id="send-wa" class="inline-flex w-full items-center justify-center rounded-full bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-green-600/30 transition hover:bg-green-500">{{ __('Kirim via WhatsApp') }}</button>
                        <script>
                            document.getElementById('send-wa').addEventListener('click', function(){
                                const num = '{{ $__waNum }}';
                                if(!num){ window.location.href = '{{ route('contact') }}'; return; }
                                const name = encodeURIComponent(document.getElementById('name').value || '');
                                const email = encodeURIComponent(document.getElementById('email').value || '');
                                const subject = encodeURIComponent(document.getElementById('subject').value || '');
                                const message = encodeURIComponent(document.getElementById('message').value || '');
                                const base = 'https://wa.me/' + num + '?text=';
                                const intro = `{{ setting('whatsapp_prefill') ?? 'Halo DigiOH, saya ingin berdiskusi.' }}`;
                                const text = encodeURIComponent(intro) + '%0A%0A' +
                                    `Nama: ${name}%0AEmail: ${email}%0ASubjek: ${subject}%0A%0A${message}`;
                                window.open(base + text, '_blank');
                            });
                        </script>
                        <div class="text-xs text-slate-500 mt-2">{{ __('Atau') }} <a href="mailto:{{ setting('contact_email') ?? 'hello@digioh.id' }}" class="underline">{{ __('kirim via email') }}</a></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


