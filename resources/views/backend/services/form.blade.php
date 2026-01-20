@php
    use App\Enums\ServiceStatus;
    $service = (isset($service) && is_object($service)) ? $service : ((isset($data) && is_object($data)) ? $data : null);
    $isEdit = isset($service) && $service->exists;
    $statusOptions = $statusOptions ?? ServiceStatus::options();
    $selectedStatus = old('status', $service->status ?? ServiceStatus::Draft->value);
    $currentFeatured = old('featured_on_home', $service->featured_on_home ?? false);
    $featuredLimit = $featuredLimit ?? 4;
    $featuredLimitReached = $featuredLimitReached ?? false;
    $canFeature = $currentFeatured || ! $featuredLimitReached;
@endphp

@php($locales = available_locales())
@php($sourceLocale = config('translatable.source_locale', 'id'))
<div class="row g-3">
    @foreach($locales as $locale)
        @php($label = strtoupper($locale))
        <div class="col-12 col-md-6">
            <label class="form-label" for="name_{{ $locale }}">
                {{ __('Name') }} ({{ $label }})
            </label>
            @if($locale === $sourceLocale)
                {!! field_required('required') !!}
            @endif
            <input
                type="text"
                name="name[{{ $locale }}]"
                id="name_{{ $locale }}"
                value="{{ old("name.$locale", $service?->getTranslation('name', $locale, false)) }}"
                class="form-control"
                @if($locale === $sourceLocale) required @endif
            >
        </div>
    @endforeach
    <div class="col-12 col-md-6">
        <label class="form-label" for="slug">{{ __('Slug') }}</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug ?? '') }}" class="form-control">
        <small class="text-muted">{{ __('Biarkan kosong untuk otomatis memakai nama.') }}</small>
    </div>

    @foreach($locales as $locale)
        @php($label = strtoupper($locale))
        <div class="col-12">
            <label class="form-label" for="description_{{ $locale }}">
                {{ __('Description') }} ({{ $label }})
            </label>
            <textarea
                class="form-control"
                name="description[{{ $locale }}]"
                id="description_{{ $locale }}"
                rows="4"
            >{{ old("description.$locale", $service?->getTranslation('description', $locale, false)) }}</textarea>
        </div>
    @endforeach

    {{-- Features List --}}
    <div class="col-12">
        <label class="form-label" for="features">{{ __('Features') }}</label>
        <?php
            $existingFeatures = old('features', $service?->features ?? []);
            $featuresText = is_array($existingFeatures) ? implode("\n", $existingFeatures) : ($existingFeatures ?? '');
        ?>
        <textarea
            class="form-control"
            name="features"
            id="features"
            rows="6"
            placeholder="Professional Equipment, On-site Setup & Support, 24/7 Technical Assistance"
        >{{ $featuresText }}</textarea>
        <small class="text-muted">{{ __('Masukkan satu fitur per baris. Fitur akan ditampilkan dengan icon checklist.') }}</small>
    </div>

    {{-- Price Fields --}}
    <div class="col-12 col-md-6">
        <label class="form-label" for="price">{{ __('Price') }}</label>
        <input 
            type="text" 
            name="price" 
            id="price" 
            value="{{ old('price', $service->price ?? '') }}" 
            class="form-control"
            placeholder="Starting at $1,800"
        >
        <small class="text-muted">{{ __('Contoh: "Starting at $1,800" atau "Custom Quote"') }}</small>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="price_note">{{ __('Price Note') }}</label>
        <input 
            type="text" 
            name="price_note" 
            id="price_note" 
            value="{{ old('price_note', $service->price_note ?? '') }}" 
            class="form-control"
            placeholder="Professional setup included"
        >
        <small class="text-muted">{{ __('Catatan tambahan di bawah harga') }}</small>
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

{{-- Auto Translate Button --}}
<div class="row mt-4">
    <div class="col-12">
        <button type="button" id="autoTranslateServiceBtn" class="btn btn-outline-primary">
            <i class="fas fa-language me-2"></i>{{ __('Auto Translate ID → EN') }}
        </button>
        <small class="text-muted ms-2">{{ __('Otomatis terjemahkan nama dan deskripsi Indonesia ke Inggris') }}</small>
    </div>
</div>

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate Slug
    const nameIdField = document.getElementById('name_id');
    const slugField = document.getElementById('slug');

    if (nameIdField && slugField) {
        let isSlugManuallyEdited = false;

        slugField.addEventListener('input', () => {
             if (slugField.value.trim() !== '') {
                isSlugManuallyEdited = true;
             }
        });

        nameIdField.addEventListener('input', function() {
            if (!isSlugManuallyEdited) {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

                slugField.value = slug;
            }
        });
    }

    const translateBtn = document.getElementById('autoTranslateServiceBtn');
    if (!translateBtn) return;

    translateBtn.addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Translating...';

        try {
            // Get values from ID fields
            const nameId = document.getElementById('name_id')?.value || '';
            const descriptionId = document.getElementById('description_id')?.value || '';

            if (!nameId && !descriptionId) {
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
                    texts: [nameId, descriptionId],
                    source: 'id',
                    target: 'en'
                })
            });

            const data = await response.json();

            if (data.success) {
                const [nameEn, descriptionEn] = data.translations;

                // Set Name EN
                const nameEnField = document.getElementById('name_en');
                if (nameEnField && nameEn) nameEnField.value = nameEn;

                // Set Description EN
                const descriptionEnField = document.getElementById('description_en');
                if (descriptionEnField && descriptionEn) descriptionEnField.value = descriptionEn;

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
