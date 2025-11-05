@php($recordVar = \Illuminate\Support\Str::singular($module_name))
@php($record = ${$recordVar} ?? null)

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'name';
            $field_label = label_case($field_name);
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required('required') !!}
            {{ html()->text($field_name)->placeholder($field_label)->class('form-control')->attributes(['required', 'maxlength' => 191]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'slug';
            $field_label = label_case($field_name);
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }}
            {{ html()->text($field_name)->placeholder($field_label)->class('form-control')->attributes(['maxlength' => 191]) }}
            <small class="form-text text-muted">{{ __('Biarkan kosong untuk otomatis mengikuti nama.') }}</small>
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'icon_class';
            $field_label = __('Icon Class');
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }}
            {{ html()->text($field_name)->placeholder('fa-solid fa-star')->class('form-control')->attributes(['maxlength' => 191]) }}
            <small class="form-text text-muted">{{ __('Opsional: class ikon FontAwesome atau utilitas lainnya.') }}</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'excerpt';
            $field_label = __('Ringkasan');
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }}
            {{ html()->textarea($field_name)->placeholder($field_label)->class('form-control')->attributes(['rows' => 3]) }}
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'description';
            $field_label = __('Deskripsi');
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }}
            {{ html()->textarea($field_name)->placeholder($field_label)->class('form-control')->attributes(['rows' => 5]) }}
        </div>
    </div>
</div>

@php($featured = old('featured_on_home', optional($record)->featured_on_home))
@php($active = old('is_active', optional($record)->is_active))
@php($sortOrder = old('sort_order', optional($record)->sort_order ?? 0))

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'sort_order';
            $field_label = __('Sort Order');
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }}
            <input type="number" min="0" name="sort_order" id="sort_order" value="{{ $sortOrder }}" class="form-control">
            <small class="form-text text-muted">{{ __('Urutan tampil (angka lebih kecil tampil lebih awal).') }}</small>
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <label class="form-label d-block" for="featured_on_home">{{ __('Tampilkan di Beranda') }}</label>
            <input type="hidden" name="featured_on_home" value="0">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="featured_on_home" name="featured_on_home" value="1" {{ $featured ? 'checked' : '' }}>
                <label class="form-check-label" for="featured_on_home">{{ __('Aktifkan untuk menampilkan Our Work ini di beranda.') }}</label>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <label class="form-label d-block" for="is_active">{{ __('Status Publikasi') }}</label>
            <input type="hidden" name="is_active" value="0">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ $active ?? true ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">{{ __('Nonaktifkan untuk menyembunyikan dari public site.') }}</label>
            </div>
        </div>
    </div>
</div>
