@php($isEdit = isset($service) && $service->exists)
<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <label class="form-label" for="name">Name</label>
        {!! field_required('required') !!}
        <input type="text" name="name" id="name" value="{{ old('name', $service->name ?? '') }}" class="form-control" required>
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label class="form-label" for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug ?? '') }}" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <label class="form-label" for="name_en">Name (EN)</label>
        <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $service->name_en ?? '') }}" class="form-control">
    </div>
    <div class="col-12 col-md-6 mb-3">
        <!-- spacer / future field -->
    </div>
    <div class="col-12 mb-3">
        <label class="form-label" for="description_en">Description (EN)</label>
        <textarea class="form-control" name="description_en" id="description_en" rows="4">{{ old('description_en', $service->description_en ?? '') }}</textarea>
    </div>
    <hr>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', $service->description ?? '') }}</textarea>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <label class="form-label" for="image">Image</label>
        <input class="form-control" type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small class="text-muted d-block mt-1">Unggah gambar maksimal 2&nbsp;MB (JPG, JPEG, PNG, GIF, atau WEBP).</small>
        @if($isEdit && !empty($service->image))
            <div class="mt-2">
                <a href="{{ asset($service->image) }}" target="_blank" class="small">{{ __('Lihat gambar saat ini') }}</a>
            </div>
        @endif
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label class="form-label" for="icon">Icon (SVG/HTML)</label>
        <textarea class="form-control" name="icon" id="icon" rows="3" placeholder='<svg class="h-7 w-7" ...></svg>'>{{ old('icon', $service->icon ?? '') }}</textarea>
        <small class="text-muted">Paste inline SVG or small HTML icon snippet.</small>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <label class="form-label" for="sort_order">Sort Order</label>
        <input type="number" min="0" name="sort_order" id="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" class="form-control">
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="form-check mt-4">
            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" @checked(old('is_active', $service->is_active ?? true))>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
    </div>
    <div class="col-12 col-md-3 mb-3">
        <div class="form-check mt-4">
            <input class="form-check-input" type="checkbox" value="1" id="featured_on_home" name="featured_on_home" @checked(old('featured_on_home', $service->featured_on_home ?? true))>
            <label class="form-check-label" for="featured_on_home">Tampilkan di Home</label>
        </div>
    </div>
</div>
