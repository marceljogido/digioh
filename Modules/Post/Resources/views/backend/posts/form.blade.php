<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "name";
            $field_lable = __("Name");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "slug";
            $field_lable = __("Slug");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "intro";
            $field_lable = __("Intro");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "content";
            $field_lable = __("Content");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "image";
            $field_lable = __("Cover Image");
            $field_placeholder = $field_lable;
            $required = "";
            $postEntity = $data ?? null;
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            <input
                type="file"
                name="{{ $field_name }}"
                id="{{ $field_name }}"
                class="form-control"
                accept=".jpg,.jpeg,.png,.gif,.webp"
            >
            <small class="text-muted d-block mt-1">
                {{ __('Unggah gambar JPG, PNG, GIF, atau WEBP maksimal 2 MB.') }}
                @if(optional($postEntity)->image)
                    <br>{{ __('Biarkan kosong jika tidak ingin mengganti gambar yang ada.') }}
                @endif
            </small>
            @if(optional($postEntity)->image)
                <div class="mt-3">
                    <p class="text-muted mb-2">{{ __('Gambar saat ini') }}:</p>
                    <img src="{{ asset($postEntity->image) }}"
                         alt="{{ $postEntity->name }}"
                         style="max-height: 160px"
                         class="rounded border">
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "service_id";
            $field_lable = "Service";
            $field_options = \App\Models\Service::sorted()->pluck('name','id');
            $selected = old('service_id', optional($data)->service_id);
            $field_placeholder = __("Select an option");
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->select($field_name, $field_options, $selected)->placeholder($field_placeholder)->class("form-select") }}
        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "is_featured";
            $field_lable = __("Show on Home");
            ?>
            <input type="hidden" name="{{ $field_name }}" value="0">
            <div class="form-check form-switch mt-4">
                <input
                    class="form-check-input"
                    type="checkbox"
                    value="1"
                    id="{{ $field_name }}"
                    name="{{ $field_name }}"
                    @checked(old('is_featured', optional($data)->is_featured))
                >
                <label class="form-check-label" for="{{ $field_name }}">{{ $field_lable }}</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "status";
            $field_lable = __("Status");
            $field_placeholder = __("Select an option");
            $required = "required";
            $select_options = \Modules\Post\Enums\PostStatus::toArray();
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class("form-select")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "published_at";
            $field_lable = __("Published At");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_start_date";
            $field_lable = __("Event Start");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_end_date";
            $field_lable = __("Event End");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_location";
            $field_lable = __("Event Location");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name)->class("form-label")->for($field_name) }}
            {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>
