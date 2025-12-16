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
                    <x-backend.buttons.return-back :small="true" />
                    @can("add_" . $module_name)
                        <a href="{{ route('backend.'.$module_name.'.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> {{ __('Create Backup') }}
                        </a>
                    @endcan
                </x-slot>
            </x-backend.section-header>

            <div class="row mt-4">
                <div class="col">
                    @if (count($backups))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th>{{ __("File Name") }}</th>
                                        <th style="width: 100px" class="text-center">{{ __("Size") }}</th>
                                        <th style="width: 150px" class="text-center">{{ __("Date") }}</th>
                                        <th style="width: 120px" class="text-center">{{ __("Age") }}</th>
                                        <th style="width: 180px" class="text-end">{{ __("Action") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($backups as $key => $backup)
                                        <tr>
                                            <td class="text-muted">{{ ++$key }}</td>
                                            <td>
                                                <i class="fas fa-file-archive text-warning me-2"></i>
                                                <strong>{{ $backup["file_name"] }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info">{{ $backup["file_size"] }}</span>
                                            </td>
                                            <td class="text-center text-muted small">
                                                {{ $backup["date_created"] }}
                                            </td>
                                            <td class="text-center text-muted small">
                                                {{ $backup["date_ago"] }}
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a
                                                        href="{{ route('backend.'.$module_name.'.download', $backup['file_name']) }}"
                                                        class="btn btn-outline-primary"
                                                        title="{{ __('Download') }}"
                                                    >
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <a
                                                        href="{{ route('backend.'.$module_name.'.delete', $backup['file_name']) }}"
                                                        class="btn btn-outline-danger"
                                                        onclick="return confirm('{{ __('Are you sure you want to delete this backup?') }}')"
                                                        title="{{ __('Delete') }}"
                                                    >
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-database fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-3">{{ __("No backup has been created yet!") }}</p>
                            @can("add_" . $module_name)
                                <a href="{{ route('backend.'.$module_name.'.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus me-1"></i> {{ __('Create Your First Backup') }}
                                </a>
                            @endcan
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if(count($backups))
            <div class="card-footer">
                <div class="text-muted small">
                    <i class="fas fa-info-circle me-1"></i>
                    Total {{ count($backups) }} {{ __('backup(s)') }}
                </div>
            </div>
        @endif
    </div>
@endsection
