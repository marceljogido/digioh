<div class="btn-group btn-group-sm" role="group">
    <a
        href="{{ route('backend.stats.show', $stat) }}"
        class="btn btn-outline-secondary"
        title="{{ __('Show') }}"
    >
        <i class="fas fa-eye"></i>
    </a>
    <a
        href="{{ route('backend.stats.edit', $stat) }}"
        class="btn btn-outline-primary"
        title="{{ __('Edit') }}"
    >
        <i class="fas fa-edit"></i>
    </a>
    <form
        action="{{ route('backend.stats.destroy', $stat) }}"
        method="POST"
        class="d-inline"
        onsubmit="return confirm('{{ __('Are you sure you want to delete this statistic?') }}')"
    >
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger" title="{{ __('Delete') }}">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
