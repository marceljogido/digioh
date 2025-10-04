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

            <div class="row mt-4">
                <div class="col">
                    {{ html()->form("POST", route("backend.$module_name.store"))->open() }}

                    @if (count(config("setting_fields", [])))
                        <div class="mb-4">
                            <label for="setting-section-select" class="form-label"><b>Select Setting Section</b></label>
                            <select id="setting-section-select" class="form-select">
                                @foreach (config("setting_fields") as $section => $fields)
                                    <option value="{{ $section }}">{{ $fields['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach (config("setting_fields") as $section => $fields)
                            <div id="setting-section-{{ $section }}" class="setting-section-content card card-accent-primary mb-4">
                                <div class="card-header">
                                    <i class="{{ Arr::get($fields, "icon", "glyphicon glyphicon-flash") }}"></i>
                                    &nbsp;{{ $fields["title"] }}
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">{{ $fields["desc"] }}</p>

                                    <div class="row mt-3">
                                        <div class="col">
                                            @foreach ($fields["elements"] as $field)
                                                @includeIf("backend.settings.fields." . $field["type"])
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="row m-b-md">
                        <div class="col-md-12">
                            <x-backend.buttons.save />
                        </div>
                    </div>

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('setting-section-select');
        const sections = document.querySelectorAll('.setting-section-content');

        function toggleSections() {
            const selectedValue = select.value;
            sections.forEach(section => {
                if (section.id === 'setting-section-' + selectedValue) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }

        // Initial toggle
        toggleSections();

        // Add event listener
        select.addEventListener('change', toggleSections);
    });
</script>
@endpush
