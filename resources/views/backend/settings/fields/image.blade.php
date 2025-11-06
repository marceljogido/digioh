@php
    use Illuminate\Support\Str;

    $required = Str::contains($field['rules'], 'required') ? 'required' : '';
    $required_mark = $required !== '' ? '<span class="text-danger"> <strong>*</strong> </span>' : '';
    $currentValue = old($field['name']) ?: setting($field['name']);

    $displayUrl = null;
    if (! empty($currentValue)) {
        $displayUrl = Str::startsWith($currentValue, ['http://', 'https://', '//'])
            ? $currentValue
            : asset($currentValue);
    }
@endphp

<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }} mt-3">
    <label for="{{ $field['name'] }}" class="form-label">
        <strong>{{ __($field['label']) }}</strong>
        ({{ $field['name'] }})
    </label>
    {!! $required_mark !!}

    @if($displayUrl)
        <div class="mb-2">
            <a href="{{ $displayUrl }}" target="_blank" rel="noopener" class="d-inline-block">
                <img src="{{ $displayUrl }}" alt="{{ $field['label'] }}" style="max-height: 140px" class="rounded border">
            </a>
        </div>
    @endif

    <input
        type="file"
        name="{{ $field['name'] }}"
        class="form-control {{ Arr::get($field, 'class') }} {{ $errors->has($field['name']) ? ' is-invalid' : '' }}"
        id="{{ $field['name'] }}"
        accept="image/*"
        {{ $required }}
    >

    @if ($errors->has($field['name']))
        <small class="invalid-feedback">{{ $errors->first($field['name']) }}</small>
    @endif

    @if (isset($field['help']))
        <small class="form-text text-muted">{{ $field['help'] }}</small>
    @endif
</div>
