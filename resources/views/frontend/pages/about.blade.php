@extends('frontend.layouts.app')

@section('title')
	{{ setting('about_title') ?: 'About' }}
@endsection

@section('content')
	<section class="bg-white dark:bg-gray-800">
		<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-12">
			@if(setting('about_image'))
				<img class="mb-8 w-full rounded" src="{{ asset(setting('about_image')) }}" alt="{{ setting('about_title') }}" />
			@endif
			<h1 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">
				{{ setting('about_title') }}
			</h1>
			<div class="prose max-w-none dark:prose-invert">
				{!! setting('about_body') !!}
			</div>
		</div>
	</section>
@endsection


