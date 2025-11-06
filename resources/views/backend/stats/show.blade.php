@extends("backend.layouts.app")

@section("title")
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section("breadcrumbs")
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item route='{{ route("backend.$module_name.index") }}' icon="{{ $module_icon }}">
            {{ __($module_title) }}
        </x-backend.breadcrumb-item>
        <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section("content")
    <div class="card">
        <div class="card-body">
            <x-backend.section-header
                :data="$stat"
                :module_name="$module_name"
                :module_title="$module_title"
                :module_icon="$module_icon"
                :module_action="$module_action"
            />

            <div class="row mt-4">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">{{ __('Value') }}</dt>
                        <dd class="col-sm-8">{{ $stat->value }}</dd>

                        <dt class="col-sm-4">{{ __('Label (ID)') }}</dt>
                        <dd class="col-sm-8">{{ $stat->label }}</dd>

                        <dt class="col-sm-4">{{ __('Label (EN)') }}</dt>
                        <dd class="col-sm-8">{{ $stat->label_en ?: 'N/A' }}</dd>

                        <dt class="col-sm-4">{{ __('Sort Order') }}</dt>
                        <dd class="col-sm-8">{{ $stat->sort_order }}</dd>

                        <dt class="col-sm-4">{{ __('Status') }}</dt>
                        <dd class="col-sm-8">
                            <span class="badge {{ $stat->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $stat->is_active ? __('Active') : __('Inactive') }}
                            </span>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">{{ __('Created At') }}</dt>
                        <dd class="col-sm-8">{{ optional($stat->created_at)->isoFormat('LLLL') }}</dd>

                        <dt class="col-sm-4">{{ __('Updated At') }}</dt>
                        <dd class="col-sm-8">{{ optional($stat->updated_at)->isoFormat('LLLL') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
