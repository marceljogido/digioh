@extends('frontend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')

<section class="bg-gray-100 text-gray-600 py-16">
    <div class="container mx-auto flex px-5 items-center justify-center flex-col">
        <div class="text-center lg:w-2/3 w-full">
            <h1 class="text-3xl sm:text-4xl mb-4 font-medium text-gray-800">
                {{ __($module_title) }}
            </h1>
            <p class="mb-8 leading-relaxed text-gray-600">
                {{ __('Kumpulan studi kasus dan kegiatan terbaru dari layanan kami.') }}
            </p>

            @include('frontend.includes.messages')
        </div>
    </div>
    </section>

    <section class="bg-white text-gray-600 p-6 sm:p-12">
        <div class="mx-auto max-w-screen-xl">
            <livewire:our-work-index />
        </div>
    </section>

@endsection
