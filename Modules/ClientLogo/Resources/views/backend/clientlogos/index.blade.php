@extends('backend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
			<div>
				<i class="{{ $module_icon }}"></i>
				<strong>{{ __($module_title) }}</strong>
			</div>
			<a href="{{ route('backend.'.$module_name.'.create') }}" class="btn btn-sm btn-primary">
				<i class="fa fa-plus"></i> {{ __('Add') }}
			</a>
		</div>
		<div class="card-body">
			@include('backend.includes.errors')

			<div class="table-responsive">
				<table class="table table-striped align-middle">
					<thead>
						<tr>
							<th style="width:72px">{{ __('Logo') }}</th>
							<th>{{ __('Client Name') }}</th>
							<th>{{ __('Website') }}</th>
							<th>{{ __('Status') }}</th>
							<th>{{ __('Sort') }}</th>
							<th>{{ __('Updated') }}</th>
							<th class="text-end" style="width:140px">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@forelse($$module_name as $$module_name_singular)
							<tr>
								<td>
									@if($$module_name_singular->logo)
										<img src="{{ asset($$module_name_singular->logo) }}" alt="{{ $$module_name_singular->client_name }}" style="height:40px">
									@endif
								</td>
								<td class="fw-semibold">{{ $$module_name_singular->client_name ?: '-' }}</td>
								<td>
									@if($$module_name_singular->website_url)
										<a href="{{ $$module_name_singular->website_url }}" target="_blank" rel="nofollow noopener">
											{{ \Illuminate\Support\Str::limit($$module_name_singular->website_url, 28) }}
										</a>
									@else
										-
									@endif
								</td>
								<td>
									<span class="badge {{ $$module_name_singular->is_active ? 'bg-success' : 'bg-secondary' }}">
										{{ $$module_name_singular->is_active ? __('Published') : __('Unpublished') }}
									</span>
								</td>
								<td>{{ $$module_name_singular->sort_order }}</td>
								<td>
									@php($diff = now()->diffInHours($$module_name_singular->updated_at))
									{{ $diff < 25 ? $$module_name_singular->updated_at->diffForHumans() : $$module_name_singular->updated_at->isoFormat('llll') }}
								</td>
								<td class="text-end">
									@include('backend.includes.action_column', ['module_name' => $module_name, 'data' => $$module_name_singular])
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="7" class="text-center text-muted py-4">{{ __('No data found') }}</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			<div class="mt-3 d-flex justify-content-center">
				{{ $$module_name->links() }}
			</div>
		</div>
	</div>
@endsection
