@extends('backend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
			<div>
				<i class="{{ $module_icon }}"></i>
				<strong>{{ __($module_title) }}</strong>
				<span class="text-muted">#{{ $$module_name_singular->id }}</span>
			</div>
			<div>
				<a href="{{ route('backend.'.$module_name.'.edit', $$module_name_singular->id) }}" class="btn btn-sm btn-primary">
					<i class="fa fa-pen"></i> {{ __('Edit') }}
				</a>
			</div>
		</div>
		<div class="card-body">
			@include('backend.includes.errors')

			<div class="row g-4">
				<div class="col-md-3 text-center">
					@if($$module_name_singular->logo)
						<img src="{{ asset($$module_name_singular->logo) }}" alt="{{ $$module_name_singular->client_name }}" class="img-fluid rounded border" style="max-height:100px">
					@endif
				</div>
				<div class="col-md-9">
					<div class="mb-2"><strong>{{ __('Client Name') }}:</strong> {{ $$module_name_singular->client_name ?: '-' }}</div>
					<div class="mb-2">
						<strong>{{ __('Website') }}:</strong>
						@if($$module_name_singular->website_url)
							<a href="{{ $$module_name_singular->website_url }}" target="_blank" rel="nofollow noopener">{{ $$module_name_singular->website_url }}</a>
						@else
							-
						@endif
					</div>
					<div class="mb-2">
						<strong>{{ __('Status') }}:</strong>
						<span class="badge {{ $$module_name_singular->is_active ? 'bg-success' : 'bg-secondary' }}">
							{{ $$module_name_singular->is_active ? __('Published') : __('Unpublished') }}
						</span>
					</div>
					<div class="mb-2"><strong>{{ __('Sort Order') }}:</strong> {{ $$module_name_singular->sort_order }}</div>
					<div class="text-muted">
						<small>{{ __('Updated') }}: {{ $$module_name_singular->updated_at->isoFormat('llll') }}</small>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection