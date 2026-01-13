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
        <form
            action="{{ route('backend.'.$module_name.'.destroy', $data) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}')"
        >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger border-start-0" title="{{ __('Delete') }}">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
</div>
