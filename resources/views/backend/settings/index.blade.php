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

                    @php
                        $settingSections = $settingSections ?? [];
                        $currentSection = $selectedSection ?? (count($settingSections) ? array_key_first($settingSections) : null);
                    @endphp

                    @if (count($settingSections))
                        {{ html()->hidden('active_section', $currentSection)->id('active_section_input') }}

                        <div class="mb-4">
                            <label for="setting-section-select" class="form-label"><b>Select Setting Section</b></label>
                            <select id="setting-section-select" class="form-select">
                                @foreach ($settingSections as $section => $fields)
                                    <option value="{{ $section }}" @selected($section === $currentSection)>{{ $fields['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach ($settingSections as $section => $fields)
                            <div id="setting-section-{{ $section }}" class="setting-section-content card card-accent-primary mb-4" @if($section !== $currentSection) style="display:none" @endif>
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
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('setting-section-select');
        const sections = document.querySelectorAll('.setting-section-content');
        const activeSectionInput = document.getElementById('active_section_input');
        const defaultSection = '{{ $currentSection }}';

        if (!select) {
            return;
        }

        function toggleSections() {
            const selectedValue = select.value;
            sections.forEach(section => {
                if (section.id === 'setting-section-' + selectedValue) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });

            if (activeSectionInput) {
                activeSectionInput.value = selectedValue;
            }
        }

        // Initial toggle
        if (select && defaultSection) {
            select.value = defaultSection;
        }
        toggleSections();

        // Add event listener
        select.addEventListener('change', toggleSections);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const editors = document.querySelectorAll('textarea.richtext');
        if (editors.length && typeof ClassicEditor !== 'undefined') {
            editors.forEach((textarea) => {
                ClassicEditor
                    .create(textarea, {
                        toolbar: [
                            'heading', '|',
                            'bold', 'italic', 'underline', '|',
                            'bulletedList', 'numberedList', '|',
                            'link', 'insertTable', '|',
                            'undo', 'redo'
                        ],
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                            ]
                        },
                        table: {
                            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                        }
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            textarea.value = editor.getData();
                        });
                    })
                    .catch(error => console.error(error));
            });
        }
    });
</script>
@endpush
