<div class="row">
	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'client_name';
			$field_lable = __('Client Name');
			$field_placeholder = $field_lable;
			$required = "";
			?>
			{{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
			{{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
		</div>
	</div>

	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'logo';
			$field_lable = __('Logo Path / URL');
			$field_placeholder = 'img/clients/acme.png';
			$required = "required";
			?>
			{{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
			<div class="input-group mb-3">
				{{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", "aria-label" => "Logo", "aria-describedby" => "button-logo"]) }}
				<button class="btn btn-outline-info" id="button-logo" data-input="{{ $field_name }}" type="button">
					<i class="fas fa-folder-open"></i>
					&nbsp;@lang('Browse')
				</button>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'website_url';
			$field_lable = __('Website URL (optional)');
			$field_placeholder = 'https://company.com';
			$required = "";
			?>
			{{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
			{{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["type" => "url", "$required"]) }}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'is_active';
			$field_lable = __('Status');
			$required = "required";
			$select_options = ['1' => 'Published', '0' => 'Unpublished'];
			?>
			{{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
			{{ html()->select($field_name, $select_options)->class('form-select')->attributes(["$required"]) }}
		</div>
	</div>

	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'sort_order';
			$field_lable = __('Sort Order');
			$field_placeholder = '0';
			$required = "";
			?>
			{{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
			{{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["min" => 0, "$required"]) }}
		</div>
	</div>

	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			// Preview sederhana (opsional, saat edit)
			?>
			@if(old('logo', $clientlogo->logo ?? null))
				<label class="form-label">{{ __('Preview') }}</label>
				<div>
					<img src="{{ asset(old('logo', $clientlogo->logo ?? '')) }}" alt="{{ old('client_name', $clientlogo->client_name ?? '') }}" style="max-height:48px">
				</div>
			@endif
		</div>
	</div>
</div>

<x-library.select2 />

@push('after-scripts')
    <script type="module" src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script type="module">
        $('#button-logo').filemanager('image');
    </script>
@endpush
