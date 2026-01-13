<div class="btn-group btn-group-sm" role="group">
    <a
        href="<?php echo e(route('backend.'.$module_name.'.show', $data)); ?>"
        class="btn btn-outline-secondary"
        title="<?php echo e(__('Show')); ?>"
    >
        <i class="fas fa-eye"></i>
    </a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("edit_" . $module_name)): ?>
        <a
            href="<?php echo e(route('backend.'.$module_name.'.edit', $data)); ?>"
            class="btn btn-outline-primary"
            title="<?php echo e(__('Edit')); ?>"
        >
            <i class="fas fa-edit"></i>
        </a>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("delete_" . $module_name)): ?>
        <form
            action="<?php echo e(route('backend.'.$module_name.'.destroy', $data)); ?>"
            method="POST"
            class="d-inline"
            onsubmit="return confirm('<?php echo e(__('Are you sure you want to delete this item?')); ?>')"
        >
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-outline-danger border-start-0" title="<?php echo e(__('Delete')); ?>">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/includes/action_column.blade.php ENDPATH**/ ?>