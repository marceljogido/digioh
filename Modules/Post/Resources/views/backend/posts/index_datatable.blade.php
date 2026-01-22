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
            <x-backend.section-header
                :module_name="$module_name"
                :module_title="$module_title"
                :module_icon="$module_icon"
                :module_action="$module_action"
            />

            @php
                $currentYear = now()->year;
                $years = range($currentYear, $currentYear - 9);
                $months = [
                    1 => __('Januari'),
                    2 => __('Februari'),
                    3 => __('Maret'),
                    4 => __('April'),
                    5 => __('Mei'),
                    6 => __('Juni'),
                    7 => __('Juli'),
                    8 => __('Agustus'),
                    9 => __('September'),
                    10 => __('Oktober'),
                    11 => __('November'),
                    12 => __('Desember'),
                ];
            @endphp

            <div class="row mt-4">
                <div class="col">
                    <div class="row mb-3 g-2">
                        <div class="col-12 col-md-3">
                            <label for="filter-year" class="form-label small text-muted">{{ __('Filter Tahun') }}</label>
                            <select id="filter-year" class="form-select">
                                <option value="">{{ __('Semua Tahun') }}</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="filter-month" class="form-label small text-muted">{{ __('Filter Bulan') }}</label>
                            <select id="filter-month" class="form-select">
                                <option value="">{{ __('Semua Bulan') }}</option>
                                @foreach($months as $num => $label)
                                    <option value="{{ $num }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-auto align-self-end">
                            <button type="button" id="filter-reset" class="btn btn-outline-secondary btn-sm">
                                {{ __('Reset Filter') }}
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-bordered table-hover table" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        @lang("post::text.name")
                                    </th>
                                    <th>{{ __('Event Date') }}</th>
                                    <th>{{ __('Event Location') }}</th>
                                    <th>
                                        @lang("post::text.updated_at")
                                    </th>
                                    <th class="text-end">
                                        @lang("post::text.action")
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-7">
                    <div class="float-left"></div>
                </div>
                <div class="col-5">
                    <div class="float-end"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("after-styles")
    <!-- DataTables Core and Extensions -->
    <link href="{{ asset("vendor/datatable/datatables.min.css") }}" rel="stylesheet" />
@endpush

@push("after-scripts")
    <!-- DataTables Core and Extensions -->
    <script type="module" src="{{ asset("vendor/datatable/datatables.min.js") }}"></script>

    <script type="module">
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route("backend.$module_name.index_data") }}',
                data: function (d) {
                    d.year = $('#filter-year').val();
                    d.month = $('#filter-month').val();
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'event_period',
                    name: 'event_period',
                },
                {
                    data: 'event_location',
                    name: 'event_location',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ],
        });

        $('#filter-year, #filter-month').on('change', function () {
            $('#datatable').DataTable().draw();
        });

        $('#filter-reset').on('click', function () {
            $('#filter-year').val('');
            $('#filter-month').val('');
            $('#datatable').DataTable().draw();
        });
    </script>
@endpush
