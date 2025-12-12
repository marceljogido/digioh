@extends('backend.layouts.app')

@section('title', 'Edit Statistik')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Statistik</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('backend.stats.update', $stat) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="value">Value <span class="text-danger">*</span></label>
                    <input type="text" name="value" id="value" class="form-control @error('value') is-invalid @enderror" 
                           value="{{ old('value', $stat->value) }}" required>
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Contoh: 12+, 150+, 98%</small>
                </div>
                
                @php($locales = available_locales())
                @php($sourceLocale = config('translatable.source_locale', 'id'))
                @foreach($locales as $locale)
                    <div class="form-group">
                        <label for="label_{{ $locale }}">
                            {{ __('Label') }} ({{ strtoupper($locale) }}) @if($locale === $sourceLocale)<span class="text-danger">*</span>@endif
                        </label>
                        <input
                            type="text"
                            name="label[{{ $locale }}]"
                            id="label_{{ $locale }}"
                            class="form-control @error('label.'.$locale) is-invalid @enderror"
                            value="{{ old("label.$locale", $stat->getTranslation('label', $locale, false)) }}"
                            @if($locale === $sourceLocale) required @endif
                        >
                        @error('label.'.$locale)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Contoh: Tahun pengalaman, Proyek berhasil diselesaikan, dll</small>
                    </div>
                @endforeach

                {{-- Auto Translate Button --}}
                <div class="form-group">
                    <button type="button" id="autoTranslateStatBtn" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-language me-2"></i>{{ __('Auto Translate ID → EN') }}
                    </button>
                </div>
                
                <div class="form-group">
                    <label for="sort_order">Urutan Tampil</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                           value="{{ old('sort_order', $stat->sort_order) }}">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Angka yang lebih kecil akan muncul lebih dulu</small>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $stat->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">Aktif</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('backend.stats.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const translateBtn = document.getElementById('autoTranslateStatBtn');
    if (!translateBtn) return;

    translateBtn.addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Translating...';

        try {
            const labelId = document.getElementById('label_id')?.value || '';

            if (!labelId) {
                alert('{{ __("Tidak ada konten Indonesia untuk diterjemahkan") }}');
                return;
            }

            const response = await fetch('{{ route("backend.translate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    text: labelId,
                    source: 'id',
                    target: 'en'
                })
            });

            const data = await response.json();

            if (data.success) {
                const labelEnField = document.getElementById('label_en');
                if (labelEnField && data.translated) labelEnField.value = data.translated;

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
