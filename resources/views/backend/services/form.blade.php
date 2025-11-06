@php
    use App\Enums\ServiceStatus;
    $service = $service ?? ($data ?? null);
    $isEdit = isset($service) && $service->exists;
    $statusOptions = $statusOptions ?? ServiceStatus::options();
    $selectedStatus = old('status', $service->status ?? ServiceStatus::Draft->value);
    $currentFeatured = old('featured_on_home', $service->featured_on_home ?? false);
    $featuredLimit = $featuredLimit ?? 4;
    $featuredLimitReached = $featuredLimitReached ?? false;
    $canFeature = $currentFeatured || ! $featuredLimitReached;
@endphp

<div class="row g-3">
    <div class="col-12 col-md-6">
        <label class="form-label" for="name">{{ __('Name') }}</label>
        {!! field_required('required') !!}
        <input type="text" name="name" id="name" value="{{ old('name', $service->name ?? '') }}" class="form-control" required>
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="slug">{{ __('Slug') }}</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug ?? '') }}" class="form-control">
        <small class="text-muted">{{ __('Biarkan kosong untuk otomatis memakai nama.') }}</small>
    </div>

    <div class="col-12">
        <label class="form-label" for="description">{{ __('Description') }}</label>
        <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', $service->description ?? '') }}</textarea>
    </div>

    <div class="col-12 col-lg-6">
        <label class="form-label" for="image">{{ __('Image') }}</label>
        <input class="form-control" type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small class="text-muted d-block mt-1">
            {{ __('Unggah gambar maksimal 2 MB (JPG, JPEG, PNG, GIF, atau WEBP). Disarankan ukuran 1200x800 piksel untuk tampilan optimal.') }}
        </small>
        @if($isEdit && !empty($service->image))
            <div class="mt-2">
                <a href="{{ asset($service->image) }}" target="_blank" class="small">{{ __('Lihat gambar saat ini') }}</a>
            </div>
        @endif
    </div>

    <div class="col-6 col-md-3">
        <label class="form-label" for="sort_order">{{ __('Sort Order') }}</label>
        <input type="number" min="0" name="sort_order" id="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" class="form-control">
        <small class="text-muted">{{ __('Angka lebih kecil tampil lebih awal.') }}</small>
    </div>

    <div class="col-6 col-md-3">
        <label class="form-label" for="status">{{ __('Status') }}</label>
        <select name="status" id="status" class="form-select">
            @foreach($statusOptions as $value => $label)
                <option value="{{ $value }}" @selected($selectedStatus === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label d-block" for="featured_on_home">{{ __('Tampilkan di Home') }}</label>
        <input type="hidden" name="featured_on_home" value="0">
        <div class="form-check form-switch mt-2">
            <input
                class="form-check-input"
                type="checkbox"
                value="1"
                id="featured_on_home"
                name="featured_on_home"
                @checked($currentFeatured)
                @disabled(! $canFeature)
            >
            <label class="form-check-label" for="featured_on_home">{{ __('Tampilkan layanan ini di beranda') }}</label>
        </div>
        @if(! $canFeature)
            <small class="text-danger d-block mt-1">
                {{ __('Kuota layanan di beranda sudah penuh. Nonaktifkan salah satunya terlebih dahulu.') }}
            </small>
        @else
            <small class="text-muted d-block mt-1">
                {{ __('Maksimal :max layanan ditampilkan di beranda.', ['max' => $featuredLimit]) }}
            </small>
        @endif
    </div>

    @if($isEdit)
        <div class="col-12 col-md-4">
            <label class="form-label">{{ __('Dipakai pada Our Work') }}</label>
            <div class="form-control-plaintext">
                <span class="badge bg-info">{{ $service->posts_count ?? $service->posts()->count() }}</span>
                <span class="text-muted small">{{ __('proyek') }}</span>
            </div>
        </div>
    @endif
</div>
