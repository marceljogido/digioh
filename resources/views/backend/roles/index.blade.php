@extends("backend.layouts.app")

@section("title")
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section("breadcrumbs")
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item type="active" icon="{{ $module_icon }}">
            {{ __($module_title) }}
        </x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section("content")
    <div class="card">
        <div class="card-body">
            <x-backend.section-header>
                <i class="{{ $module_icon }}"></i>
                {{ __($module_title) }}
                <small class="text-muted">{{ __($module_action) }}</small>

                <x-slot name="toolbar">
                    <x-backend.buttons.return-back />
                    <x-backend.buttons.create
                        title="{{ __('Create') }} {{ ucwords(Str::singular($module_name)) }}"
                        route='{{ route("backend.$module_name.create") }}'
                        :small="true"
                    />
                </x-slot>
            </x-backend.section-header>

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th>{{ __("Name") }}</th>
                                    <th>{{ __("Permissions") }}</th>
                                    <th style="width: 100px" class="text-center">{{ __("Users") }}</th>
                                    <th style="width: 150px" class="text-end">{{ __("Action") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($$module_name as $index => $role)
                                    <tr>
                                        <td class="text-muted">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge bg-primary fs-6">
                                                <i class="fas fa-user-shield me-1"></i>
                                                {{ ucwords($role->name) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($role->permissions->count() > 0)
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach ($role->permissions->take(5) as $permission)
                                                        <span class="badge bg-secondary">{{ $permission->name }}</span>
                                                    @endforeach
                                                    @if($role->permissions->count() > 5)
                                                        <span class="badge bg-info">+{{ $role->permissions->count() - 5 }} more</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">No permissions</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-dark">{{ $role->users->count() }}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a
                                                    href="{{ route('backend.'.$module_name.'.show', $role) }}"
                                                    class="btn btn-outline-secondary"
                                                    title="{{ __('Show') }}"
                                                >
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @can("edit_" . $module_name)
                                                    <a
                                                        href="{{ route('backend.'.$module_name.'.edit', $role) }}"
                                                        class="btn btn-outline-primary"
                                                        title="{{ __('Edit') }}"
                                                    >
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-user-shield fa-2x mb-2 d-block"></i>
                                            {{ __('No roles found.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-7">
                    <div class="text-muted small">
                        Total {{ $$module_name->total() }} {{ __('roles') }}
                    </div>
                </div>
                <div class="col-5">
                    <div class="float-end">
                        {{ $$module_name->links("pagination::bootstrap-5") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
