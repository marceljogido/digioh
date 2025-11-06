@php
    use Illuminate\Support\Str;

    $founder = $founder ?? [];
    $indexAttr = $index ?? 0;
    $photoPath = $founder['photo'] ?? $founder['existing_photo'] ?? null;
    $photoUrl = $photoPath
        ? (Str::startsWith($photoPath, ['http://', 'https://', '//']) ? $photoPath : asset($photoPath))
        : null;
@endphp

<div class="card founder-item mb-3" data-index="{{ $indexAttr }}">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0" data-order data-label="{{ __('Founder') }}">{{ __('Founder') }}</h6>
            <button type="button" class="btn btn-outline-danger btn-sm" data-remove-founder>&times;</button>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">{{ __('Nama') }}</label>
                <input type="text" class="form-control" data-field="name" value="{{ $founder['name'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">{{ __('Jabatan') }}</label>
                <input type="text" class="form-control" data-field="title" value="{{ $founder['title'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">{{ __('LinkedIn URL') }}</label>
                <input type="text" class="form-control" data-field="linkedin" value="{{ $founder['linkedin'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">{{ __('Foto') }}</label>
                @if($photoUrl)
                    <div class="mb-2">
                        <img src="{{ $photoUrl }}" alt="{{ $founder['name'] ?? 'Founder' }}" class="img-fluid rounded border" style="max-height: 140px;">
                    </div>
                @endif
                <input type="file" class="form-control" data-field="photo" accept="image/*">
                <input type="hidden" data-field="existing_photo" value="{{ $photoPath }}">
            </div>
        </div>
    </div>
</div>
