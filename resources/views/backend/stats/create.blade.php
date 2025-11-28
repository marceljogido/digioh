@extends('backend.layouts.app')

@section('title', 'Tambah Statistik')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Statistik Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('backend.stats.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="value">Value <span class="text-danger">*</span></label>
                    <input type="text" name="value" id="value" class="form-control @error('value') is-invalid @enderror" 
                           value="{{ old('value') }}" required>
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
                            value="{{ old("label.$locale") }}"
                            @if($locale === $sourceLocale) required @endif
                        >
                        @error('label.'.$locale)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            {{ __('Contoh: Tahun pengalaman, Proyek berhasil diselesaikan, dll') }}
                        </small>
                    </div>
                @endforeach
                
                <div class="form-group">
                    <label for="sort_order">Urutan Tampil</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                           value="{{ old('sort_order') ?? 0 }}">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Angka yang lebih kecil akan muncul lebih dulu</small>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">Aktif</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('backend.stats.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
