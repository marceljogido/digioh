@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{ route("backend.$module_name.index") }}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header
            :module_name="$module_name"
            :module_title="$module_title"
            :module_icon="$module_icon"
            :module_action="$module_action"
            :data="$$module_name_singular"
        />

        <div class="row g-4 mt-3">
            <div class="col-md-3 text-center">
                @if($$module_name_singular->logo)
                    <img src="{{ asset($$module_name_singular->logo) }}" alt="{{ $$module_name_singular->client_name }}"
                         class="img-fluid rounded border" style="max-height:120px">
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
