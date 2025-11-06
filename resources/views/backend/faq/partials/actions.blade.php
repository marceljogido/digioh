<div class="btn-group btn-group-sm" role="group">
    <a
        href="{{ route('backend.faq.show', $faq) }}"
        class="btn btn-outline-secondary"
        title="{{ __('Show') }}"
    >
        <i class="fas fa-eye"></i>
    </a>
    <a
        href="{{ route('backend.faq.edit', $faq) }}"
        class="btn btn-outline-primary"
        title="{{ __('Edit') }}"
    >
        <i class="fas fa-edit"></i>
    </a>
    <a
        href="{{ route('backend.faq.destroy', $faq) }}"
        class="btn btn-outline-danger"
        data-method="DELETE"
        data-token="{{ csrf_token() }}"
        data-confirm="{{ __('Are you sure you want to delete this FAQ?') }}"
        title="{{ __('Delete') }}"
    >
        <i class="fas fa-trash"></i>
    </a>
</div>
