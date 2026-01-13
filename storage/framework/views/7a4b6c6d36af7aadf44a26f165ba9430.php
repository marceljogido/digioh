<?php ($faq = (isset($faq) && is_object($faq)) ? $faq : ((isset($data) && is_object($data)) ? $data : null)); ?>
<?php ($isEdit = isset($faq) && $faq->exists); ?>
<?php ($locales = available_locales()); ?>
<?php ($sourceLocale = config('translatable.source_locale', 'id')); ?>
<div class="row">
    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="question_<?php echo e($locale); ?>">
                <?php echo e(__('Question')); ?> (<?php echo e(strtoupper($locale)); ?>)
            </label>
            <?php if($locale === $sourceLocale): ?>
                <?php echo field_required('required'); ?>

            <?php endif; ?>
            <input
                type="text"
                name="question[<?php echo e($locale); ?>]"
                id="question_<?php echo e($locale); ?>"
                value="<?php echo e(old("question.$locale", $faq?->getTranslation('question', $locale, false))); ?>"
                class="form-control"
                <?php if($locale === $sourceLocale): ?> required <?php endif; ?>
            >
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 mb-3">
            <label class="form-label" for="answer_<?php echo e($locale); ?>">
                <?php echo e(__('Answer')); ?> (<?php echo e(strtoupper($locale)); ?>)
            </label>
            <textarea
                class="form-control"
                name="answer[<?php echo e($locale); ?>]"
                id="answer_<?php echo e($locale); ?>"
                rows="4"
            ><?php echo e(old("answer.$locale", $faq?->getTranslation('answer', $locale, false))); ?></textarea>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="row">
    <div class="col-6 col-md-3 mb-3">
        <label class="form-label" for="sort_order"><?php echo e(__('Sort Order')); ?></label>
        <input type="number" min="0" name="sort_order" id="sort_order" value="<?php echo e(old('sort_order', $faq->sort_order ?? 0)); ?>" class="form-control">
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="form-check mt-4">
            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if(old('is_active', $faq->is_active ?? true)): echo 'checked'; endif; ?>>
            <label class="form-check-label" for="is_active"><?php echo e(__('Active')); ?></label>
        </div>
    </div>
</div>


<div class="row mb-3">
    <div class="col-12">
        <button type="button" id="autoTranslateFaqBtn" class="btn btn-outline-primary">
            <i class="fas fa-language me-2"></i><?php echo e(__('Auto Translate ID → EN')); ?>

        </button>
        <small class="text-muted ms-2"><?php echo e(__('Otomatis terjemahkan pertanyaan dan jawaban Indonesia ke Inggris')); ?></small>
    </div>
</div>

<?php $__env->startPush('after-scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const translateBtn = document.getElementById('autoTranslateFaqBtn');
    if (!translateBtn) return;

    translateBtn.addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Translating...';

        try {
            const questionId = document.getElementById('question_id')?.value || '';
            const answerId = document.getElementById('answer_id')?.value || '';

            if (!questionId && !answerId) {
                alert('<?php echo e(__("Tidak ada konten Indonesia untuk diterjemahkan")); ?>');
                return;
            }

            const response = await fetch('<?php echo e(route("backend.translate.batch")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    texts: [questionId, answerId],
                    source: 'id',
                    target: 'en'
                })
            });

            const data = await response.json();

            if (data.success) {
                const [questionEn, answerEn] = data.translations;

                const questionEnField = document.getElementById('question_en');
                if (questionEnField && questionEn) questionEnField.value = questionEn;

                const answerEnField = document.getElementById('answer_en');
                if (answerEnField && answerEn) answerEnField.value = answerEn;

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
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/faq/form.blade.php ENDPATH**/ ?>