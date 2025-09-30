<section class="bg-white dark:bg-gray-800">
	<div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-12">
		<div class="grid gap-6 md:grid-cols-3">
			<div class="md:col-span-2">
				<h2 class="mb-4 text-2xl font-semibold dark:text-white">
					{{ setting('about_title') }}
				</h2>
				<div class="prose max-w-none line-clamp-5 dark:prose-invert">
					{!! setting('about_body') !!}
				</div>
				<div class="mt-4">
					<a href="{{ route('about') }}" class="text-primary-600 hover:underline">
						{{ __('Baca Selengkapnya') }}
					</a>
				</div>
			</div>
			@if(setting('about_image'))
				<div>
					<img class="w-full rounded" src="{{ asset(setting('about_image')) }}" alt="{{ setting('about_title') }}">
				</div>
			@endif
		</div>
	</div>
</section>


