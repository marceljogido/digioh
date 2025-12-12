@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    use Modules\Post\Models\Post;

    $postEntity = ($data instanceof Post) ? $data : null;
    $serviceOptions = \App\Models\Service::sorted()->pluck('name','id');
    $selectedServices = old('service_ids', $postEntity ? $postEntity->services->pluck('id')->toArray() : []);
    $existingGallery = $postEntity && is_array($postEntity->gallery_images) ? $postEntity->gallery_images : [];
    $removeGalleryOld = old('remove_gallery', []);
    $featuredLimit = 3;
    $currentIsFeatured = $postEntity ? (bool) $postEntity->is_featured : false;
    $oldIsFeatured = (bool) old('is_featured', $currentIsFeatured);
    $featuredCount = \Modules\Post\Models\Post::query()
        ->where('is_featured', true)
        ->when($postEntity, function ($query) use ($postEntity) {
            $query->where('id', '!=', $postEntity->id);
        })
        ->count();
    $featuredLimitReached = $featuredCount >= $featuredLimit;
    $disableFeaturedToggle = $featuredLimitReached && ! $oldIsFeatured;

    // Bilingual support
    $locales = available_locales();
    $sourceLocale = config('translatable.source_locale', 'id');
@endphp

<div class="row">
    @foreach($locales as $locale)
        <div class="col-12 col-sm-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="name_{{ $locale }}">
                    {{ __('Name') }} ({{ strtoupper($locale) }})
                    @if($locale === $sourceLocale) <span class="text-danger">*</span> @endif
                </label>
                <input
                    type="text"
                    name="name[{{ $locale }}]"
                    id="name_{{ $locale }}"
                    value="{{ old("name.$locale", $postEntity?->getTranslation('name', $locale, false)) }}"
                    class="form-control"
                    placeholder="{{ __('Name') }}"
                    @if($locale === $sourceLocale) required @endif
                >
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "slug";
            $field_lable = __("Slug");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row">
    @foreach($locales as $locale)
        <div class="col-12 mb-3">
            <div class="form-group">
                <label class="form-label" for="intro_{{ $locale }}">
                    {{ __('Intro') }} ({{ strtoupper($locale) }})
                    @if($locale === $sourceLocale) <span class="text-danger">*</span> @endif
                </label>
                <textarea
                    name="intro[{{ $locale }}]"
                    id="intro_{{ $locale }}"
                    class="form-control richtext"
                    placeholder="{{ __('Intro') }}"
                    @if($locale === $sourceLocale) required @endif
                >{{ old("intro.$locale", $postEntity?->getTranslation('intro', $locale, false)) }}</textarea>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    @foreach($locales as $locale)
        <div class="col-12 mb-3">
            <div class="form-group">
                <label class="form-label" for="content_{{ $locale }}">
                    {{ __('Content') }} ({{ strtoupper($locale) }})
                    @if($locale === $sourceLocale) <span class="text-danger">*</span> @endif
                </label>
                <textarea
                    name="content[{{ $locale }}]"
                    id="content_{{ $locale }}"
                    class="form-control richtext"
                    placeholder="{{ __('Content') }}"
                    @if($locale === $sourceLocale) required @endif
                >{{ old("content.$locale", $postEntity?->getTranslation('content', $locale, false)) }}</textarea>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "image";
            $field_lable = __("Cover Image");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            <input
                type="file"
                name="{{ $field_name }}"
                id="{{ $field_name }}"
                class="form-control"
                accept=".jpg,.jpeg,.png,.gif,.webp"
            >
            <small class="text-muted d-block mt-1">
                {{ __('Unggah gambar JPG, PNG, GIF, atau WEBP maksimal 2 MB.') }}
                @if(optional($postEntity)->image)
                    <br>{{ __('Biarkan kosong jika tidak ingin mengganti gambar yang ada.') }}
                @endif
            </small>
            @if(optional($postEntity)->image)
                <div class="mt-3">
                    <p class="text-muted mb-2">{{ __('Gambar saat ini') }}:</p>
                    <img src="{{ asset($postEntity->image) }}"
                         alt="{{ $postEntity->name }}"
                         style="max-height: 160px"
                         class="rounded border">
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="service_ids">{{ __('Services') }}</label>
            <select name="service_ids[]" id="service_ids" class="form-select select2" multiple>
                @foreach($serviceOptions as $id => $name)
                    <option value="{{ $id }}" @selected(in_array($id, $selectedServices))>{{ $name }}</option>
                @endforeach
            </select>
            <small class="text-muted">{{ __('Pilih satu atau lebih layanan yang terlibat dalam proyek ini.') }}</small>
        </div>
    </div>
    <div class="col-12 col-md-3 mb-3">
        <div class="form-group">
            <label class="form-label d-block" for="is_featured">{{ __('Show on Home') }}</label>
            <input type="hidden" name="is_featured" value="0">
            <div class="form-check form-switch mt-2">
                <input
                    class="form-check-input"
                    type="checkbox"
                    value="1"
                    id="is_featured"
                    name="is_featured"
                    @checked($oldIsFeatured)
                    @disabled($disableFeaturedToggle)
                >
                <label class="form-check-label" for="is_featured">{{ __('Tampilkan di home blog') }}</label>
            </div>
            @if($disableFeaturedToggle)
                <small class="text-danger d-block mt-2">
                    {{ __('Batas :max konten di beranda sudah terpenuhi. Nonaktifkan salah satu konten lain terlebih dahulu.', ['max' => $featuredLimit]) }}
                </small>
            @else
                <small class="text-muted d-block mt-2">
                    {{ __('Tandai untuk menampilkan artikel di beranda (maksimal :max konten).', ['max' => $featuredLimit]) }}
                </small>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "status";
            $field_lable = __("Status");
            $field_placeholder = __("Select an option");
            $required = "required";
            $select_options = \Modules\Post\Enums\PostStatus::toArray();
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class("form-select")->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "published_at";
            $field_lable = __("Published At");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="gallery_images">{{ __('Gallery Images') }}</label>
            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp" multiple>
            <small class="text-muted d-block mt-1">{{ __('Unggah beberapa gambar (maksimal 2 MB per file).') }}</small>
        </div>
    </div>
</div>

@if(count($existingGallery))
    <div class="row mb-3">
        <div class="col-12">
            <label class="form-label d-block">{{ __('Galeri Saat Ini') }}</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach($existingGallery as $galleryPath)
                    @php
                        $displayUrl = Str::startsWith($galleryPath, ['http://', 'https://'])
                            ? $galleryPath
                            : Storage::url($galleryPath);
                    @endphp
                    <div class="border rounded p-2 text-center" style="width: 140px;">
                        <img src="{{ $displayUrl }}" alt="Gallery Image" class="img-fluid rounded mb-2" style="max-height: 100px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_gallery[]" value="{{ $galleryPath }}" id="remove_gallery_{{ md5($galleryPath) }}" @checked(in_array($galleryPath, (array)$removeGalleryOld))>
                            <label class="form-check-label small" for="remove_gallery_{{ md5($galleryPath) }}">{{ __('Hapus') }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_start_date";
            $field_lable = __("Event Start");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_end_date";
            $field_lable = __("Event End");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_location";
            $field_lable = __("Event Location");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "scope_of_work";
            $field_lable = __("Scope of Work");
            $field_placeholder = __("Contoh: Stage design, Broadcast control, Talent handling");
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(['rows' => 2, "$required"]) }}
            <small class="text-muted d-block mt-1">{{ __('Pisahkan beberapa scope dengan koma (,) agar mudah difilter.') }}</small>
        </div>
    </div>
</div>

<x-library.select2 />

@once
    @push('after-scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof ClassicEditor === 'undefined') {
                    return;
                }

                document.querySelectorAll('textarea.richtext').forEach(function (textarea) {
                    if (textarea.dataset.editorInitialized === 'true') {
                        return;
                    }

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
                        .then(function (editor) {
                            textarea.dataset.editorInitialized = 'true';
                            textarea.editorInstance = editor;
                            editor.model.document.on('change:data', function () {
                                textarea.value = editor.getData();
                            });
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                });
            });
        </script>
    @endpush
@endonce

{{-- Auto Translate Button --}}
<div class="row mb-4">
    <div class="col-12">
        <button type="button" id="autoTranslateBtn" class="btn btn-outline-primary">
            <i class="fas fa-language me-2"></i>{{ __('Auto Translate ID → EN') }}
        </button>
        <small class="text-muted ms-2">{{ __('Otomatis terjemahkan konten Indonesia ke Inggris') }}</small>
    </div>
</div>

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const translateBtn = document.getElementById('autoTranslateBtn');
    if (!translateBtn) return;

    translateBtn.addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Translating...';

        try {
            // Get values from ID fields
            const nameId = document.getElementById('name_id')?.value || '';
            const introTextarea = document.getElementById('intro_id');
            const contentTextarea = document.getElementById('content_id');

            // Get CKEditor content if available
            let introId = introTextarea?.editorInstance?.getData() || introTextarea?.value || '';
            let contentId = contentTextarea?.editorInstance?.getData() || contentTextarea?.value || '';

            if (!nameId && !introId && !contentId) {
                alert('{{ __("Tidak ada konten Indonesia untuk diterjemahkan") }}');
                return;
            }

            const response = await fetch('{{ route("backend.translate.batch") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    texts: [nameId, introId, contentId],
                    source: 'id',
                    target: 'en'
                })
            });

            const data = await response.json();

            if (data.success) {
                const [nameEn, introEn, contentEn] = data.translations;

                // Set Name EN
                const nameEnField = document.getElementById('name_en');
                if (nameEnField && nameEn) nameEnField.value = nameEn;

                // Set Intro EN (handle CKEditor)
                const introEnTextarea = document.getElementById('intro_en');
                if (introEnTextarea && introEn) {
                    if (introEnTextarea.editorInstance) {
                        introEnTextarea.editorInstance.setData(introEn);
                    } else {
                        introEnTextarea.value = introEn;
                    }
                }

                // Set Content EN (handle CKEditor)
                const contentEnTextarea = document.getElementById('content_en');
                if (contentEnTextarea && contentEn) {
                    if (contentEnTextarea.editorInstance) {
                        contentEnTextarea.editorInstance.setData(contentEn);
                    } else {
                        contentEnTextarea.value = contentEn;
                    }
                }

                btn.innerHTML = '<i class="fas fa-check me-2"></i>Translated!';
                setTimeout(() => { btn.innerHTML = originalText; }, 2000);
            } else {
                throw new Error(data.message || 'Translation failed');
            }
        } catch (error) {
            console.error('Translation error:', error);
            alert('{{ __("Gagal menerjemahkan: ") }}' + error.message);
            btn.innerHTML = originalText;
        } finally {
            btn.disabled = false;
        }
    });
});
</script>
@endpush
