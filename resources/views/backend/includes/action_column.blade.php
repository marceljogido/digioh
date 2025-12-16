<div class="btn-group btn-group-sm" role="group">
    <a
        href="{{ route('backend.'.$module_name.'.show', $data) }}"
        class="btn btn-outline-secondary"
        title="{{ __('Show') }}"
    >
        <i class="fas fa-eye"></i>
    </a>
    @can("edit_" . $module_name)
        <a
            href="{{ route('backend.'.$module_name.'.edit', $data) }}"
            class="btn btn-outline-primary"
            title="{{ __('Edit') }}"
        >
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can("delete_" . $module_name)
        <a
            href="{{ route('backend.'.$module_name.'.destroy', $data) }}"
            class="btn btn-outline-danger"
            data-method="DELETE"
            data-token="{{ csrf_token() }}"
            data-confirm="{{ __('Are you sure you want to delete this item?') }}"
            title="{{ __('Delete') }}"
        >
            <i class="fas fa-trash"></i>
        </a>
    @endcan
</div>
