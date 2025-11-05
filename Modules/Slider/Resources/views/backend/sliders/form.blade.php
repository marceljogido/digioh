@php
    $slider = $slider ?? $data ?? null;
    $imageUrl = null;
    if ($slider && $slider->image) {
        $imageUrl = \Illuminate\Support\Str::startsWith($slider->image, ['http://', 'https://'])
            ? $slider->image
            : asset($slider->image);
    }
@endphp

<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="title">{{ __('Judul') }}</label>
            {!! field_required('required') !!}
            <input
                type="text"
                name="title"
                id="title"
                class="form-control"
                value="{{ old('title', optional($slider)->title) }}"
                maxlength="191"
                required
            >
        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="subtitle">{{ __('Subjudul') }}</label>
            <input
                type="text"
                name="subtitle"
                id="subtitle"
                class="form-control"
                value="{{ old('subtitle', optional($slider)->subtitle) }}"
                maxlength="191"
            >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="button_text">{{ __('Teks Tombol') }}</label>
            <input
                type="text"
                name="button_text"
                id="button_text"
                class="form-control"
                value="{{ old('button_text', optional($slider)->button_text) }}"
                maxlength="191"
            >
        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="button_link">{{ __('Link Tombol') }}</label>
            <input
                type="text"
                name="button_link"
                id="button_link"
                class="form-control"
                value="{{ old('button_link', optional($slider)->button_link) }}"
                maxlength="255"
                placeholder="https:// atau /halaman"
            >
            <small class="text-muted">{{ __('Gunakan URL penuh atau path internal (misal: /layanan).') }}</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="image">{{ __('Gambar Slider') }}</label>
            {!! field_required($slider ? '' : 'required') !!}
            <input
                type="file"
                name="image"
                id="image"
                class="form-control"
                accept=".jpg,.jpeg,.png,.gif,.webp"
                @if(empty($slider)) required @endif
            >
            <small class="text-muted d-block mt-1">
                {{ __('Unggah gambar landscape (JPG/PNG/GIF/WEBP) maksimal 2 MB.') }}
                @if($slider && $slider->image)
                    <br>{{ __('Biarkan kosong jika tidak ingin mengganti gambar yang ada.') }}
                @endif
            </small>

            @if($imageUrl)
                <div class="mt-3">
                    <p class="text-muted mb-2">{{ __('Pratinjau saat ini') }}</p>
                    <img src="{{ $imageUrl }}" alt="{{ $slider->title }}" style="max-height: 220px" class="rounded border">
                </div>
            @endif
        </div>
    </div>
    <div class="col-12 col-sm-3 mb-3">
        <div class="form-group">
            <label class="form-label" for="is_active">{{ __('Status') }}</label>
            {!! field_required('required') !!}
            @php($selectedStatus = (string) old('is_active', optional($slider)->is_active ?? 1))
            <select name="is_active" id="is_active" class="form-select" required>
                <option value="1" @selected($selectedStatus === '1')>{{ __('Published') }}</option>
                <option value="0" @selected($selectedStatus === '0')>{{ __('Unpublished') }}</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-3 mb-3">
        <div class="form-group">
            <label class="form-label" for="sort_order">{{ __('Urutan Tampil') }}</label>
            <input
                type="number"
                min="0"
                name="sort_order"
                id="sort_order"
                class="form-control"
                value="{{ old('sort_order', optional($slider)->sort_order ?? 0) }}"
            >
            <small class="text-muted">{{ __('Angka lebih kecil akan tampil lebih awal.') }}</small>
        </div>
    </div>
</div>
