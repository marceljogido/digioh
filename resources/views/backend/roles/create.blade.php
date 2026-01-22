@extends("backend.layouts.app")

@section("title")
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section("breadcrumbs")
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item route='{{ route("backend.$module_name.index") }}' icon="{{ $module_icon }}">
            {{ __($module_title) }}
        </x-backend.breadcrumb-item>
        <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section("content")
    <x-backend.layouts.create>
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i>
            {{ __($module_title) }}
            <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="toolbar">
                <x-backend.buttons.return-back :small="true" />
            </x-slot>
        </x-backend.section-header>

        <div class="row">
            <div class="col">
                {{ html()->form("POST", route("backend.roles.store"))->class("form-horizontal")->open() }}

                <div class="row mb-3">
                    <?php
                    $field_name = "name";
                    $field_lable = __("labels.backend.roles.fields.name");
                    $field_placeholder = $field_lable;
                    $required = "required";
                    ?>

                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_lable, $field_name)->class("form-label") }}
                            {!! field_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                    $field_name = "name";
                    $field_lable = __("Abilities");
                    $field_placeholder = $field_lable;
                    $required = "";
                    ?>

                    <div class="col-12 col-sm-2">
                        <div class="form-group">
                            {{ html()->label($field_lable, $field_name)->class("form-label") }}
                            {!! field_required($required) !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="form-group">
                            {{ __("Select permissions from the list:") }}

                                    @php
                                        $groupedPermissions = $permissions->groupBy(function($item) {
                                            $parts = explode('_', $item->name);
                                            $suffix = end($parts);
                                            
                                            // Special cases
                                            if ($item->name === 'view_backend') return 'Dashboard';
                                            if ($item->name === 'edit_settings') return 'Settings';
                                            if ($item->name === 'edit_users_permissions') return 'Users';
                                            
                                            // Renaming
                                            if ($suffix === 'posts') return 'Our Work';
                                            if ($suffix === 'clientlogos') return 'Client Logos';
                                            
                                            // Standard CRUD
                                            return ucfirst($suffix);
                                        })->sortKeys();
                                    @endphp

                                    @foreach ($groupedPermissions as $group => $items)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center border-bottom pb-1 mb-2">
                                                <div class="form-check mb-0">
                                                    <input type="checkbox" class="form-check-input group-select-all" id="group-{{ Str::slug($group) }}" data-group="{{ Str::slug($group) }}">
                                                    <label class="form-check-label fw-bold" for="group-{{ Str::slug($group) }}">
                                                        {{ $group }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row group-container-{{ Str::slug($group) }}">
                                                @foreach ($items as $permission)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            {{ html()->label($permission->name)->for("permission-" . $permission->id)->class("form-check-label") }}
                                                            {{ html()->checkbox("permissions[]", old("permissions") && in_array($permission->name, old("permissions")) ? true : false, $permission->name)->id("permission-" . $permission->id)->class("form-check-input permission-item") }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <x-buttons.create title="{{ __('Create') }} {{ ucwords(Str::singular($module_name)) }}">
                                    {{ __("Create") }}
                                </x-buttons.create>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="float-end">
                                <div class="form-group">
                                    <x-buttons.cancel />
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </x-backend.layouts.create>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Handle "Select All" click
                document.querySelectorAll('.group-select-all').forEach(function(headerCheckbox) {
                    headerCheckbox.addEventListener('change', function() {
                        const groupId = this.dataset.group;
                        const container = document.querySelector('.group-container-' + groupId);
                        const checkboxes = container.querySelectorAll('.permission-item');
                        
                        checkboxes.forEach(function(cb) {
                            cb.checked = headerCheckbox.checked;
                        });
                    });
                });

                // Handle individual checkbox change to update "Select All" state
                document.querySelectorAll('.permission-item').forEach(function(itemCheckbox) {
                    itemCheckbox.addEventListener('change', function() {
                        // Find parent group
                        const container = this.closest('.row');
                        // Find mapped header checkbox - this is tricky without ID, let's reverse look up by class or structure
                        // Actually easier: finding the header requires knowing the group slug.
                        // Let's rely on the DOM structure: container is sibling of header div
                        const headerDiv = container.previousElementSibling;
                        const headerCheckbox = headerDiv.querySelector('.group-select-all');
                        
                        // Check if all siblings are checked
                        const allCheckboxes = container.querySelectorAll('.permission-item');
                        const allChecked = Array.from(allCheckboxes).every(c => c.checked);
                        const someChecked = Array.from(allCheckboxes).some(c => c.checked);
                        
                        headerCheckbox.checked = allChecked;
                        headerCheckbox.indeterminate = someChecked && !allChecked;
                    });
                });
            });
        </script>
