@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item type="active" icon="{{ $module_icon }}">
            {{ __($module_title) }}
        </x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <x-backend.section-header>
                <i class="{{ $module_icon }}"></i>
                {{ __($module_title) }}
                <small class="text-muted">{{ __($module_action) }}</small>

                <x-slot name="toolbar">
                    <x-backend.buttons.create
                        title="{{ __('Create') }} {{ ucwords(Str::singular($module_name)) }}"
                        route='{{ route("backend.$module_name.create") }}'
                        :small="true"
                    />
                </x-slot>
            </x-backend.section-header>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 56px;">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Active</th>
                            <th>Sort</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($services as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ \Str::limit(strip_tags($item->description), 90) }}</td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $item->sort_order }}</td>
                            <td class="text-end">
                                <x-backend.buttons.edit small="true" title="Edit Service" route='{{ route("backend.services.edit", $item) }}' />
                                <a
                                    href="{{ route('backend.services.destroy', $item) }}"
                                    class="btn btn-danger btn-sm"
                                    data-method="DELETE"
                                    data-token="{{ csrf_token() }}"
                                    data-toggle="tooltip"
                                    title="{{ __('Delete') }}"
                                >
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No services yet</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12 col-sm-7">
                    <div class="float-left">{!! $services->total() !!} {{ __("labels.backend.total") }}</div>
                </div>
                <div class="col-12 col-sm-5">
                    <div class="float-end">
                        {{ $services->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
