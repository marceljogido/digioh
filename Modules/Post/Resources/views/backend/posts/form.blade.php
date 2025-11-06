@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $postEntity = $data ?? null;
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
@endphp

<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "name";
            $field_lable = __("Name");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
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
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "intro";
            $field_lable = __("Intro");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "content";
            $field_lable = __("Content");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
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

<x-library.select2 />
