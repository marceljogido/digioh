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
			$field_lable = __('Logo Image');
			$required = isset($clientlogo) ? "" : "required";
			$entity = (isset($clientlogo) && is_object($clientlogo)) ? $clientlogo : ((isset($data) && is_object($data)) ? $data : null);
			?>
			{{ html()->label($field_lable, $field_name)->class('form-label') }} {!! field_required($required) !!}
			<input
				type="file"
				name="{{ $field_name }}"
				id="{{ $field_name }}"
				class="form-control"
				accept=".jpg,.jpeg,.png,.gif,.webp,.svg"
				@if(empty($entity)) required @endif
			>
			<small class="text-muted d-block mt-1">
				{{ __('Unggah logo (JPG, PNG, GIF, SVG, atau WEBP) maksimal 2 MB.') }}
				@if(optional($entity)->logo)
					<br>{{ __('Biarkan kosong jika tidak ingin mengganti logo.') }}
				@endif
			</small>
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
			$currentLogo = optional($entity)->logo;
			?>
			@if($currentLogo)
				<label class="form-label">{{ __('Preview') }}</label>
				<div>
					<img src="{{ asset($currentLogo) }}" alt="{{ old('client_name', optional($entity)->client_name ?? '') }}" style="max-height:64px">
				</div>
			@endif
		</div>
	</div>
</div>

<x-library.select2 />
