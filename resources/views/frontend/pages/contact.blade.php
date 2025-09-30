@extends('frontend.layouts.app')

@section('title')
	{{ __('Contact') }}
@endsection

@section('content')
	<section class="bg-white dark:bg-gray-800">
		<div class="mx-auto max-w-screen-md px-4 py-16 sm:px-6 lg:px-8">
			<h1 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">{{ __('Contact Us') }}</h1>

    			@if(session('flash_success'))
    				<div class="mb-6 rounded bg-green-50 p-3 text-green-700">{{ session('flash_success') }}</div>
    			@endif

    			<form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
				@csrf
                <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" />

				<div>
					<label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="name">{{ __('Nama') }}</label>
					<input class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" id="name" name="name" type="text" value="{{ old('name') }}" required />
				</div>

				<div>
					<label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="email">{{ __('Email') }}</label>
					<input class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" id="email" name="email" type="email" value="{{ old('email') }}" required />
				</div>

				<div>
					<label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="subject">{{ __('Subjek (opsional)') }}</label>
					<input class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" id="subject" name="subject" type="text" value="{{ old('subject') }}" />
				</div>

				<div>
					<label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="message">{{ __('Pesan') }}</label>
					<textarea class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
				</div>

				<div>
					<button class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">
						{{ __('Kirim') }}
					</button>
				</div>
			</form>
		</div>
	</section>
@endsection


