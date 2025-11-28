@extends('backend.layouts.app')

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
                :data="$faq"
                :module_name="$module_name"
                :module_title="$module_title"
                :module_icon="$module_icon"
                :module_action="$module_action"
            />

            <div class="row mt-4">
                <div class="col-md-6">
                    <dl class="row">
                        @foreach(available_locales() as $locale)
                            <dt class="col-sm-4">{{ __('Question') }} ({{ strtoupper($locale) }})</dt>
                            <dd class="col-sm-8">{{ $faq->getTranslation('question', $locale, false) ?: 'N/A' }}</dd>
                        @endforeach

                        <dt class="col-sm-4">{{ __('Status') }}</dt>
                        <dd class="col-sm-8">
                            <span class="badge {{ $faq->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $faq->is_active ? __('Active') : __('Inactive') }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">{{ __('Sort Order') }}</dt>
                        <dd class="col-sm-8">{{ $faq->sort_order }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">{{ __('Created At') }}</dt>
                        <dd class="col-sm-8">{{ optional($faq->created_at)->isoFormat('LLLL') }}</dd>

                        <dt class="col-sm-4">{{ __('Updated At') }}</dt>
                        <dd class="col-sm-8">{{ optional($faq->updated_at)->isoFormat('LLLL') }}</dd>
                    </dl>
                </div>
            </div>

            <div class="row mt-4">
                @foreach(available_locales() as $locale)
                    <div class="col-md-6">
                        <h5>{{ __('Answer') }} ({{ strtoupper($locale) }})</h5>
                        <div class="border rounded p-3 bg-light">
                            {!! $faq->getTranslation('answer', $locale, false)
                                ? nl2br(e($faq->getTranslation('answer', $locale, false)))
                                : '<span class="text-muted">N/A</span>' !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
