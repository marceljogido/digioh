<?php
    $slider = $slider ?? $data ?? null;
    $imageUrl = null;
    if ($slider && $slider->image) {
        $imageUrl = \Illuminate\Support\Str::startsWith($slider->image, ['http://', 'https://'])
            ? $slider->image
            : asset($slider->image);
    }
    $locales = config('app.available_locales', ['id' => 'Indonesia', 'en' => 'English']);
    $sourceLocale = config('translatable.source_locale', 'id');
?>

<!-- Auto Translate Button -->
<div class="row mb-3">
    <div class="col-12">
        <button type="button" id="btn-auto-translate-slider" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-language me-1"></i> Auto Translate ID → EN
        </button>
        <small class="text-muted ms-2">Terjemahkan otomatis dari Indonesia ke English</small>
    </div>
</div>

<!-- Title -->
<div class="row">
    <div class="col-12 mb-3">
        <label class="form-label fw-bold"><?php echo e(__('Judul')); ?></label>
        <?php echo field_required('required'); ?>

        <div class="row">
            <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $localeName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-2">
                    <label class="form-label small text-muted" for="title_<?php echo e($localeCode); ?>">
                        <?php echo e($localeName); ?> <?php echo e($localeCode === $sourceLocale ? '(Sumber)' : ''); ?>

                    </label>
                    <input
                        type="text"
                        name="title[<?php echo e($localeCode); ?>]"
                        id="title_<?php echo e($localeCode); ?>"
                        class="form-control"
                        value="<?php echo e(old('title.'.$localeCode, $slider?->getTranslation('title', $localeCode, false) ?? '')); ?>"
                        maxlength="191"
                        <?php echo e($localeCode === $sourceLocale ? 'required' : ''); ?>

                    >
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<!-- Subtitle -->
<div class="row">
    <div class="col-12 mb-3">
        <label class="form-label fw-bold"><?php echo e(__('Subjudul')); ?></label>
        <div class="row">
            <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $localeName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-2">
                    <label class="form-label small text-muted" for="subtitle_<?php echo e($localeCode); ?>"><?php echo e($localeName); ?></label>
                    <input
                        type="text"
                        name="subtitle[<?php echo e($localeCode); ?>]"
                        id="subtitle_<?php echo e($localeCode); ?>"
                        class="form-control"
                        value="<?php echo e(old('subtitle.'.$localeCode, $slider?->getTranslation('subtitle', $localeCode, false) ?? '')); ?>"
                        maxlength="191"
                    >
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<!-- Button Text -->
<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <label class="form-label fw-bold"><?php echo e(__('Teks Tombol')); ?></label>
        <div class="row">
            <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $localeName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 mb-2">
                    <label class="form-label small text-muted" for="button_text_<?php echo e($localeCode); ?>"><?php echo e($localeName); ?></label>
                    <input
                        type="text"
                        name="button_text[<?php echo e($localeCode); ?>]"
                        id="button_text_<?php echo e($localeCode); ?>"
                        class="form-control"
                        value="<?php echo e(old('button_text.'.$localeCode, $slider?->getTranslation('button_text', $localeCode, false) ?? '')); ?>"
                        maxlength="191"
                    >
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="button_link"><?php echo e(__('Link Tombol')); ?></label>
            <input
                type="text"
                name="button_link"
                id="button_link"
                class="form-control"
                value="<?php echo e(old('button_link', optional($slider)->button_link)); ?>"
                maxlength="255"
                placeholder="https:// atau /halaman"
            >
            <small class="text-muted"><?php echo e(__('Gunakan URL penuh atau path internal (misal: /layanan).')); ?></small>
        </div>
    </div>
</div>

<!-- Auto Translate Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('btn-auto-translate-slider');
    if (!btn) return;
    
    btn.addEventListener('click', async function() {
        const fields = ['title', 'subtitle', 'button_text'];
        const texts = [];
        
        fields.forEach(field => {
            const input = document.getElementById(field + '_id');
            texts.push(input ? input.value : '');
        });
        
        if (texts.every(t => !t.trim())) {
            alert('Isi field Indonesia terlebih dahulu.');
            return;
        }
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Translating...';
        
        try {
            const response = await fetch('<?php echo e(route("backend.translate.batch")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    texts: texts,
                    source: 'id',
                    target: 'en'
                })
            });
            
            const data = await response.json();
            
            if (data.translations) {
                fields.forEach((field, index) => {
                    const enInput = document.getElementById(field + '_en');
                    if (enInput && data.translations[index]) {
                        enInput.value = data.translations[index];
                    }
                });
            }
        } catch (error) {
            alert('Translation failed: ' + error.message);
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-language me-1"></i> Auto Translate ID → EN';
        }
    });
});
</script>


<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="image"><?php echo e(__('Gambar Slider')); ?></label>
            <?php echo field_required($slider ? '' : 'required'); ?>

            <input
                type="file"
                name="image"
                id="image"
                class="form-control"
                accept=".jpg,.jpeg,.png,.gif,.webp"
                <?php if(empty($slider)): ?> required <?php endif; ?>
            >
            <small class="text-muted d-block mt-1">
                <?php echo e(__('Unggah gambar landscape (JPG/PNG/GIF/WEBP) maksimal 2 MB.')); ?>

                <?php if($slider && $slider->image): ?>
                    <br><?php echo e(__('Biarkan kosong jika tidak ingin mengganti gambar yang ada.')); ?>

                <?php endif; ?>
            </small>

            <?php if($imageUrl): ?>
                <div class="mt-3">
                    <p class="text-muted mb-2"><?php echo e(__('Pratinjau saat ini')); ?></p>
                    <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($slider->title); ?>" style="max-height: 220px" class="rounded border">
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-12 col-sm-3 mb-3">
        <div class="form-group">
            <label class="form-label" for="is_active"><?php echo e(__('Status')); ?></label>
            <?php echo field_required('required'); ?>

            <?php ($selectedStatus = (string) old('is_active', optional($slider)->is_active ?? 1)); ?>
            <select name="is_active" id="is_active" class="form-select" required>
                <option value="1" <?php if($selectedStatus === '1'): echo 'selected'; endif; ?>><?php echo e(__('Published')); ?></option>
                <option value="0" <?php if($selectedStatus === '0'): echo 'selected'; endif; ?>><?php echo e(__('Unpublished')); ?></option>
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-3 mb-3">
        <div class="form-group">
            <label class="form-label" for="sort_order"><?php echo e(__('Urutan Tampil')); ?></label>
            <input
                type="number"
                min="0"
                name="sort_order"
                id="sort_order"
                class="form-control"
                value="<?php echo e(old('sort_order', optional($slider)->sort_order ?? 0)); ?>"
            >
            <small class="text-muted"><?php echo e(__('Angka lebih kecil akan tampil lebih awal.')); ?></small>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\Modules/Slider/Resources/views/backend/sliders/form.blade.php ENDPATH**/ ?>