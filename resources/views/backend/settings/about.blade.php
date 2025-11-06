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
            <x-backend.section-header
                :module_name="$module_name"
                :module_title="$module_title"
                :module_icon="$module_icon"
                :module_action="$module_action"
            />

            <div class="row mt-4">
                <div class="col">
                    {{ html()->form('POST', route("backend.$module_name.store"))->acceptsFiles()->open() }}
                    {{ html()->hidden('active_section', 'about') }}

                    @foreach ($fields as $field)
                        @includeIf('backend.settings.fields.' . $field['type'])
                    @endforeach

                    <div class="row mt-4">
                        <div class="col">
                            <x-backend.buttons.save />
                            <a href="{{ route("backend.$module_name.index") }}" class="btn btn-secondary ms-2">
                                {{ __('Back to Settings') }}
                            </a>
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
