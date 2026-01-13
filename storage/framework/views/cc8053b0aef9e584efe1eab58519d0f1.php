<?php $__env->startSection('title', 'Tambah Statistik'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Statistik Baru</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('backend.stats.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="value">Value <span class="text-danger">*</span></label>
                    <input type="text" name="value" id="value" class="form-control <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           value="<?php echo e(old('value')); ?>" required>
                    <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Contoh: 12+, 150+, 98%</small>
                </div>
                
                <?php ($locales = available_locales()); ?>
                <?php ($sourceLocale = config('translatable.source_locale', 'id')); ?>
                <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <label for="label_<?php echo e($locale); ?>">
                            <?php echo e(__('Label')); ?> (<?php echo e(strtoupper($locale)); ?>) <?php if($locale === $sourceLocale): ?><span class="text-danger">*</span><?php endif; ?>
                        </label>
                        <input
                            type="text"
                            name="label[<?php echo e($locale); ?>]"
                            id="label_<?php echo e($locale); ?>"
                            class="form-control <?php $__errorArgs = ['label.'.$locale];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old("label.$locale")); ?>"
                            <?php if($locale === $sourceLocale): ?> required <?php endif; ?>
                        >
                        <?php $__errorArgs = ['label.'.$locale];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="form-text text-muted">
                            <?php echo e(__('Contoh: Tahun pengalaman, Proyek berhasil diselesaikan, dll')); ?>

                        </small>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <div class="form-group">
                    <button type="button" id="autoTranslateStatBtn" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-language me-2"></i><?php echo e(__('Auto Translate ID → EN')); ?>

                    </button>
                </div>
                
                <div class="form-group">
                    <label for="sort_order">Urutan Tampil</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           value="<?php echo e(old('sort_order') ?? 0); ?>">
                    <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Angka yang lebih kecil akan muncul lebih dulu</small>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" <?php echo e(old('is_active') ? 'checked' : ''); ?>>
                        <label for="is_active" class="form-check-label">Aktif</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo e(route('backend.stats.index')); ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const translateBtn = document.getElementById('autoTranslateStatBtn');
    if (!translateBtn) return;

    translateBtn.addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Translating...';

        try {
            const labelId = document.getElementById('label_id')?.value || '';

            if (!labelId) {
                alert('<?php echo e(__("Tidak ada konten Indonesia untuk diterjemahkan")); ?>');
                return;
            }

            const response = await fetch('<?php echo e(route("backend.translate")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    text: labelId,
                    source: 'id',
                    target: 'en'
                })
            });

            const data = await response.json();

            if (data.success) {
                const labelEnField = document.getElementById('label_en');
                if (labelEnField && data.translated) labelEnField.value = data.translated;

                btn.innerHTML = '<i class="fas fa-check me-2"></i>Translated!';
                setTimeout(() => { btn.innerHTML = originalText; }, 2000);
            } else {
                throw new Error(data.message || 'Translation failed');
            }
        } catch (error) {
            console.error('Translation error:', error);
            alert('<?php echo e(__("Gagal menerjemahkan: ")); ?>' + error.message);
            btn.innerHTML = originalText;
        } finally {
            btn.disabled = false;
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/stats/create.blade.php ENDPATH**/ ?>