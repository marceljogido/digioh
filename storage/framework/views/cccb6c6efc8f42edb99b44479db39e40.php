<div class="btn-group btn-group-sm" role="group">
    <a
        href="<?php echo e(route('backend.faq.show', $faq)); ?>"
        class="btn btn-outline-secondary"
        title="<?php echo e(__('Show')); ?>"
    >
        <i class="fas fa-eye"></i>
    </a>
    <a
        href="<?php echo e(route('backend.faq.edit', $faq)); ?>"
        class="btn btn-outline-primary"
        title="<?php echo e(__('Edit')); ?>"
    >
        <i class="fas fa-edit"></i>
    </a>
    <form
        action="<?php echo e(route('backend.faq.destroy', $faq)); ?>"
        method="POST"
        class="d-inline"
        onsubmit="return confirm('<?php echo e(__('Are you sure you want to delete this FAQ?')); ?>')"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-outline-danger" title="<?php echo e(__('Delete')); ?>">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/faq/partials/actions.blade.php ENDPATH**/ ?>