<?php
    use Illuminate\Support\Str;

    $founder = $founder ?? [];
    $indexAttr = $index ?? 0;
    $photoPath = $founder['photo'] ?? $founder['existing_photo'] ?? null;
    $photoUrl = $photoPath
        ? (Str::startsWith($photoPath, ['http://', 'https://', '//']) ? $photoPath : asset($photoPath))
        : null;
?>

<div class="card founder-item mb-3" data-index="<?php echo e($indexAttr); ?>">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0" data-order data-label="<?php echo e(__('Founder')); ?>"><?php echo e(__('Founder')); ?></h6>
            <button type="button" class="btn btn-outline-danger btn-sm" data-remove-founder>&times;</button>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('Nama')); ?></label>
                <input type="text" class="form-control" data-field="name" value="<?php echo e($founder['name'] ?? ''); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('Jabatan')); ?></label>
                <input type="text" class="form-control" data-field="title" value="<?php echo e($founder['title'] ?? ''); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('LinkedIn URL')); ?></label>
                <input type="text" class="form-control" data-field="linkedin" value="<?php echo e($founder['linkedin'] ?? ''); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('Foto')); ?></label>
                <?php if($photoUrl): ?>
                    <div class="mb-2">
                        <img src="<?php echo e($photoUrl); ?>" alt="<?php echo e($founder['name'] ?? 'Founder'); ?>" class="img-fluid rounded border" style="max-height: 140px;">
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" data-field="photo" accept="image/*">
                <input type="hidden" data-field="existing_photo" value="<?php echo e($photoPath); ?>">
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/settings/partials/founder-card.blade.php ENDPATH**/ ?>