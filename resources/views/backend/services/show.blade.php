@extends('backend.layouts.app')
@php use Illuminate\Support\Str; @endphp

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item route='{{ route("backend.$module_name.index") }}' icon="{{ $module_icon }}">
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
                :data="$service"
            >
                <x-slot name="toolbar">
                    @if(Route::has('frontend.services.show'))
                        <a class="btn btn-info btn-sm me-1" href="{{ route('frontend.services.show', $service->slug) }}" target="_blank" rel="noopener">
                            <i class="fas fa-external-link-alt"></i>
                            {{ __('View Public') }}
                        </a>
                    @endif

                    <x-buttons.edit
                        class="me-1"
                        title="{{ __('Edit') }} {{ ucwords(Str::singular($module_name)) }}"
                        route='{{ route("backend.$module_name.edit", $service) }}'
                        small="true"
                    />

                    <a class="btn btn-secondary btn-sm" href="{{ route("backend.$module_name.index") }}">
                        <i class="fas fa-list"></i>
                        {{ __('List') }}
                    </a>
                </x-slot>
            </x-backend.section-header>

            <div class="row g-4 mt-3">
                <div class="col-lg-4 text-center">
                    @if($service->image)
                        @php
                            $imageUrl = Str::startsWith($service->image, ['http://', 'https://'])
                                ? $service->image
                                : asset($service->image);
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $service->name }}" class="img-fluid rounded border" style="max-height: 220px">
                    @else
                        <div class="border rounded p-4 text-muted">
                            {{ __('No image uploaded') }}
                        </div>
                    @endif
                </div>

                <div class="col-lg-8">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">{{ __('Name') }}</dt>
                        <dd class="col-sm-8">{{ $service->name }}</dd>

                        <dt class="col-sm-4">{{ __('Slug') }}</dt>
                        <dd class="col-sm-8">{{ $service->slug }}</dd>

                        <dt class="col-sm-4">{{ __('Description') }}</dt>
                        <dd class="col-sm-8">{!! $service->description ?: '<span class="text-muted">-</span>' !!}</dd>

                        <dt class="col-sm-4">{{ __('Featured on Home') }}</dt>
                        <dd class="col-sm-8">
                            <span class="badge {{ $service->featured_on_home ? 'bg-primary' : 'bg-secondary' }}">
                                {{ $service->featured_on_home ? __('Yes') : __('No') }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">{{ __('Status') }}</dt>
                        <dd class="col-sm-8">
                            @php($status = \App\Enums\ServiceStatus::tryFrom($service->status ?? '') ?? \App\Enums\ServiceStatus::Draft)
                            <span class="badge @class([
                                'bg-success' => $status === \App\Enums\ServiceStatus::Published,
                                'bg-warning text-dark' => $status === \App\Enums\ServiceStatus::Draft,
                                'bg-secondary' => $status === \App\Enums\ServiceStatus::Unpublished,
                            ])">
                                {{ $status->label() }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">{{ __('Our Works') }}</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-info">{{ $service->posts_count }}</span>
                            <span class="text-muted small">{{ __('proyek') }}</span>
                        </dd>

                        <dt class="col-sm-4">{{ __('Sort Order') }}</dt>
                        <dd class="col-sm-8">{{ $service->sort_order ?? 0 }}</dd>

                        <dt class="col-sm-4">{{ __('Updated') }}</dt>
                        <dd class="col-sm-8">{{ optional($service->updated_at)->isoFormat('llll') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
