@php
    $slider = (isset($slider) && is_object($slider)) ? $slider : ((isset($data) && is_object($data)) ? $data : null);
    $imageUrl = null;
    if ($slider && $slider->image) {
        $imageUrl = \Illuminate\Support\Str::startsWith($slider->image, ['http://', 'https://'])
            ? $slider->image
            : asset($slider->image);
    }
    $locales = config('app.available_locales', ['id' => 'Indonesia', 'en' => 'English']);
    $sourceLocale = config('translatable.source_locale', 'id');
@endphp

<!-- Auto Translate Button -->
<div class="row mb-3">
    <div class="col-12">
        <button type="button" id="btn-auto-translate-slider" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-language me-1"></i> Auto Translate ID → EN
        </button>
        <small class="text-muted ms-2">Terjemahkan otomatis dari Indonesia ke English</small>
    </div>
</div>

<!-- Title -->
<div class="row">
    <div class="col-12 mb-3">
        <label class="form-label fw-bold">{{ __('Judul') }}</label>
        {!! field_required('required') !!}
        <div class="row">
            @foreach($locales as $localeCode => $localeName)
                <div class="col-md-6 mb-2">
                    <label class="form-label small text-muted" for="title_{{ $localeCode }}">
                        {{ $localeName }} {{ $localeCode === $sourceLocale ? '(Sumber)' : '' }}
                    </label>
                    <input
                        type="text"
                        name="title[{{ $localeCode }}]"
                        id="title_{{ $localeCode }}"
                        class="form-control"
                        value="{{ old('title.'.$localeCode, $slider?->getTranslation('title', $localeCode, false) ?? '') }}"
                        maxlength="191"
                        {{ $localeCode === $sourceLocale ? 'required' : '' }}
                    >
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Subtitle -->
<div class="row">
    <div class="col-12 mb-3">
        <label class="form-label fw-bold">{{ __('Subjudul') }}</label>
        <div class="row">
            @foreach($locales as $localeCode => $localeName)
                <div class="col-md-6 mb-2">
                    <label class="form-label small text-muted" for="subtitle_{{ $localeCode }}">{{ $localeName }}</label>
                    <input
                        type="text"
                        name="subtitle[{{ $localeCode }}]"
                        id="subtitle_{{ $localeCode }}"
                        class="form-control"
                        value="{{ old('subtitle.'.$localeCode, $slider?->getTranslation('subtitle', $localeCode, false) ?? '') }}"
                        maxlength="191"
                    >
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Button Text -->
<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <label class="form-label fw-bold">{{ __('Teks Tombol') }}</label>
        <div class="row">
            @foreach($locales as $localeCode => $localeName)
                <div class="col-12 mb-2">
                    <label class="form-label small text-muted" for="button_text_{{ $localeCode }}">{{ $localeName }}</label>
                    <input
                        type="text"
                        name="button_text[{{ $localeCode }}]"
                        id="button_text_{{ $localeCode }}"
                        class="form-control"
                        value="{{ old('button_text.'.$localeCode, $slider?->getTranslation('button_text', $localeCode, false) ?? '') }}"
                        maxlength="191"
                    >
                </div>
            @endforeach
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

<!-- Auto Translate Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('btn-auto-translate-slider');
    if (!btn) return;
    
    btn.addEventListener('click', async function() {
        const fields = ['title', 'subtitle', 'button_text'];
        const texts = [];
        
        fields.forEach(field => {
            const input = document.getElementById(field + '_id');
            texts.push(input ? input.value : '');
        });
        
        if (texts.every(t => !t.trim())) {
            alert('Isi field Indonesia terlebih dahulu.');
            return;
        }
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Translating...';
        
        try {
            const response = await fetch('{{ route("backend.translate.batch") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    texts: texts,
                    source: 'id',
                    target: 'en'
                })
            });
            
            const data = await response.json();
            
            if (data.translations) {
                fields.forEach((field, index) => {
                    const enInput = document.getElementById(field + '_en');
                    if (enInput && data.translations[index]) {
                        enInput.value = data.translations[index];
                    }
                });
            }
        } catch (error) {
            alert('Translation failed: ' + error.message);
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-language me-1"></i> Auto Translate ID → EN';
        }
    });
});
</script>


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
            @php
                $currentStatus = old('is_active', $slider?->is_active ?? 1);
                $isActive = filter_var($currentStatus, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? (bool) $currentStatus;
            @endphp
            <select name="is_active" id="is_active" class="form-select" required>
                <option value="1" @selected($isActive === true)>{{ __('Published') }}</option>
                <option value="0" @selected($isActive === false)>{{ __('Unpublished') }}</option>
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
