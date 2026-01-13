<?php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    use Modules\Post\Models\Post;

    $postEntity = ($data instanceof Post) ? $data : null;
    $serviceOptions = \App\Models\Service::sorted()->pluck('name','id');
    $selectedServices = old('service_ids', $postEntity ? $postEntity->services->pluck('id')->toArray() : []);
    $existingGallery = $postEntity && is_array($postEntity->gallery_images) ? $postEntity->gallery_images : [];
    $removeGalleryOld = old('remove_gallery', []);
    $featuredLimit = 3;
    $currentIsFeatured = $postEntity ? (bool) $postEntity->is_featured : false;
    $oldIsFeatured = (bool) old('is_featured', $currentIsFeatured);
    $featuredCount = \Modules\Post\Models\Post::query()
        ->where('is_featured', true)
        ->when($postEntity, function ($query) use ($postEntity) {
            $query->where('id', '!=', $postEntity->id);
        })
        ->count();
    $featuredLimitReached = $featuredCount >= $featuredLimit;
    $disableFeaturedToggle = $featuredLimitReached && ! $oldIsFeatured;

    // Bilingual support
    $locales = available_locales();
    $sourceLocale = config('translatable.source_locale', 'id');
?>

<div class="row">
    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="name_<?php echo e($locale); ?>">
                    <?php echo e(__('Name')); ?> (<?php echo e(strtoupper($locale)); ?>)
                    <?php if($locale === $sourceLocale): ?> <span class="text-danger">*</span> <?php endif; ?>
                </label>
                <input
                    type="text"
                    name="name[<?php echo e($locale); ?>]"
                    id="name_<?php echo e($locale); ?>"
                    value="<?php echo e(old("name.$locale", $postEntity?->getTranslation('name', $locale, false))); ?>"
                    class="form-control"
                    placeholder="<?php echo e(__('Name')); ?>"
                    <?php if($locale === $sourceLocale): ?> required <?php endif; ?>
                >
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "slug";
            $field_lable = __("Slug");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            <?php echo e(html()->label($field_lable, $field_name)->class("form-label")->for($field_name)); ?>

            <?php echo field_required($required); ?>

            <?php echo e(html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"])); ?>

        </div>
    </div>
</div>
<div class="row">
    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 mb-3">
            <div class="form-group">
                <label class="form-label" for="intro_<?php echo e($locale); ?>">
                    <?php echo e(__('Intro')); ?> (<?php echo e(strtoupper($locale)); ?>)
                    <?php if($locale === $sourceLocale): ?> <span class="text-danger">*</span> <?php endif; ?>
                </label>
                <textarea
                    name="intro[<?php echo e($locale); ?>]"
                    id="intro_<?php echo e($locale); ?>"
                    class="form-control richtext"
                    placeholder="<?php echo e(__('Intro')); ?>"
                    <?php if($locale === $sourceLocale): ?> required <?php endif; ?>
                ><?php echo e(old("intro.$locale", $postEntity?->getTranslation('intro', $locale, false))); ?></textarea>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="row">
    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 mb-3">
            <div class="form-group">
                <label class="form-label" for="content_<?php echo e($locale); ?>">
                    <?php echo e(__('Content')); ?> (<?php echo e(strtoupper($locale)); ?>)
                    <?php if($locale === $sourceLocale): ?> <span class="text-danger">*</span> <?php endif; ?>
                </label>
                <textarea
                    name="content[<?php echo e($locale); ?>]"
                    id="content_<?php echo e($locale); ?>"
                    class="form-control richtext"
                    placeholder="<?php echo e(__('Content')); ?>"
                    <?php if($locale === $sourceLocale): ?> required <?php endif; ?>
                ><?php echo e(old("content.$locale", $postEntity?->getTranslation('content', $locale, false))); ?></textarea>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "image";
            $field_lable = __("Cover Image");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            <?php echo e(html()->label($field_lable, $field_name)->class("form-label")->for($field_name)); ?>

            <?php echo field_required($required); ?>

            <input
                type="file"
                name="<?php echo e($field_name); ?>"
                id="<?php echo e($field_name); ?>"
                class="form-control"
                accept=".jpg,.jpeg,.png,.gif,.webp"
            >
            <small class="text-muted d-block mt-1">
                <?php echo e(__('Unggah gambar JPG, PNG, GIF, atau WEBP maksimal 2 MB.')); ?>

                <?php if(optional($postEntity)->image): ?>
                    <br><?php echo e(__('Biarkan kosong jika tidak ingin mengganti gambar yang ada.')); ?>

                <?php endif; ?>
            </small>
            <?php if(optional($postEntity)->image): ?>
                <div class="mt-3">
                    <p class="text-muted mb-2"><?php echo e(__('Gambar saat ini')); ?>:</p>
                    <img src="<?php echo e(asset($postEntity->image)); ?>"
                         alt="<?php echo e($postEntity->name); ?>"
                         style="max-height: 160px"
                         class="rounded border">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="service_ids"><?php echo e(__('Services')); ?></label>
            <select name="service_ids[]" id="service_ids" class="form-select select2" multiple>
                <?php $__currentLoopData = $serviceOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php if(in_array($id, $selectedServices)): echo 'selected'; endif; ?>><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <small class="text-muted"><?php echo e(__('Pilih satu atau lebih layanan yang terlibat dalam proyek ini.')); ?></small>
        </div>
    </div>
    <div class="col-12 col-md-3 mb-3">
        <div class="form-group">
            <label class="form-label d-block" for="is_featured"><?php echo e(__('Show on Home')); ?></label>
            <input type="hidden" name="is_featured" value="0">
            <div class="form-check form-switch mt-2">
                <input
                    class="form-check-input"
                    type="checkbox"
                    value="1"
                    id="is_featured"
                    name="is_featured"
                    <?php if($oldIsFeatured): echo 'checked'; endif; ?>
                    <?php if($disableFeaturedToggle): echo 'disabled'; endif; ?>
                >
                <label class="form-check-label" for="is_featured"><?php echo e(__('Tampilkan di home blog')); ?></label>
            </div>
            <?php if($disableFeaturedToggle): ?>
                <small class="text-danger d-block mt-2">
                    <?php echo e(__('Batas :max konten di beranda sudah terpenuhi. Nonaktifkan salah satu konten lain terlebih dahulu.', ['max' => $featuredLimit])); ?>

                </small>
            <?php else: ?>
                <small class="text-muted d-block mt-2">
                    <?php echo e(__('Tandai untuk menampilkan artikel di beranda (maksimal :max konten).', ['max' => $featuredLimit])); ?>

                </small>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "status";
            $field_lable = __("Status");
            $field_placeholder = __("Select an option");
            $required = "required";
            $select_options = \Modules\Post\Enums\PostStatus::toArray();
            ?>
            <?php echo e(html()->label($field_lable, $field_name)->class("form-label")->for($field_name)); ?>

            <?php echo field_required($required); ?>

            <?php echo e(html()->select($field_name, $select_options)->placeholder($field_placeholder)->class("form-select")->attributes(["$required"])); ?>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = "published_at";
            $field_lable = __("Published At");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            <?php echo e(html()->label($field_lable, $field_name)->class("form-label")->for($field_name)); ?>

            <?php echo field_required($required); ?>

            <?php echo e(html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"])); ?>

        </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <label class="form-label" for="gallery_images"><?php echo e(__('Gallery Images')); ?></label>
            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp" multiple>
            <small class="text-muted d-block mt-1"><?php echo e(__('Unggah beberapa gambar (maksimal 2 MB per file).')); ?></small>
        </div>
    </div>
</div>

<?php if(count($existingGallery)): ?>
    <div class="row mb-3">
        <div class="col-12">
            <label class="form-label d-block"><?php echo e(__('Galeri Saat Ini')); ?></label>
            <div class="d-flex flex-wrap gap-3">
                <?php $__currentLoopData = $existingGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galleryPath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $displayUrl = Str::startsWith($galleryPath, ['http://', 'https://'])
                            ? $galleryPath
                            : Storage::url($galleryPath);
                    ?>
                    <div class="border rounded p-2 text-center" style="width: 140px;">
                        <img src="<?php echo e($displayUrl); ?>" alt="Gallery Image" class="img-fluid rounded mb-2" style="max-height: 100px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_gallery[]" value="<?php echo e($galleryPath); ?>" id="remove_gallery_<?php echo e(md5($galleryPath)); ?>" <?php if(in_array($galleryPath, (array)$removeGalleryOld)): echo 'checked'; endif; ?>>
                            <label class="form-check-label small" for="remove_gallery_<?php echo e(md5($galleryPath)); ?>"><?php echo e(__('Hapus')); ?></label>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_start_date";
            $field_lable = __("Event Start");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            <?php echo e(html()->label($field_lable, $field_name)->class("form-label")->for($field_name)); ?>

            <?php echo field_required($required); ?>

            <?php echo e(html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"])); ?>

        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_end_date";
            $field_lable = __("Event End");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            <?php echo e(html()->label($field_lable, $field_name)->class("form-label")->for($field_name)); ?>

            <?php echo field_required($required); ?>

            <?php echo e(html()->datetime($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"])); ?>

        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "event_location";
            $field_lable = __("Event Location");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            <?php echo e(html()->label($field_lable, $field_name)->class("form-label")->for($field_name)); ?>

            <?php echo field_required($required); ?>

            <?php echo e(html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"])); ?>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "scope_of_work";
            $field_lable = __("Scope of Work");
            $field_placeholder = __("Contoh: Stage design, Broadcast control, Talent handling");
            $required = "";
            ?>
            <?php echo e(html()->label($field_lable, $field_name)->class("form-label")->for($field_name)); ?>

            <?php echo field_required($required); ?>

            <?php echo e(html()->textarea($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(['rows' => 2, "$required"])); ?>

            <small class="text-muted d-block mt-1"><?php echo e(__('Pisahkan beberapa scope dengan koma (,) agar mudah difilter.')); ?></small>
        </div>
    </div>
</div>

<?php if (isset($component)) { $__componentOriginal0ffec7df51857b2f80a6919b7e1f1451 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0ffec7df51857b2f80a6919b7e1f1451 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.library.select2','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('library.select2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0ffec7df51857b2f80a6919b7e1f1451)): ?>
<?php $attributes = $__attributesOriginal0ffec7df51857b2f80a6919b7e1f1451; ?>
<?php unset($__attributesOriginal0ffec7df51857b2f80a6919b7e1f1451); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0ffec7df51857b2f80a6919b7e1f1451)): ?>
<?php $component = $__componentOriginal0ffec7df51857b2f80a6919b7e1f1451; ?>
<?php unset($__componentOriginal0ffec7df51857b2f80a6919b7e1f1451); ?>
<?php endif; ?>

<?php if (! $__env->hasRenderedOnce('74167052-3e44-4fa5-9853-b34183e24f7c')): $__env->markAsRenderedOnce('74167052-3e44-4fa5-9853-b34183e24f7c'); ?>
    <?php $__env->startPush('after-scripts'); ?>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof ClassicEditor === 'undefined') {
                    return;
                }

                document.querySelectorAll('textarea.richtext').forEach(function (textarea) {
                    if (textarea.dataset.editorInitialized === 'true') {
                        return;
                    }

                    ClassicEditor
                        .create(textarea, {
                            toolbar: [
                                'heading', '|',
                                'bold', 'italic', 'underline', '|',
                                'bulletedList', 'numberedList', '|',
                                'link', 'insertTable', '|',
                                'undo', 'redo'
                            ],
                            heading: {
                                options: [
                                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                                ]
                            },
                            table: {
                                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                            }
                        })
                        .then(function (editor) {
                            textarea.dataset.editorInitialized = 'true';
                            textarea.editorInstance = editor;
                            editor.model.document.on('change:data', function () {
                                textarea.value = editor.getData();
                            });
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>


<div class="row mb-4">
    <div class="col-12">
        <button type="button" id="autoTranslateBtn" class="btn btn-outline-primary">
            <i class="fas fa-language me-2"></i><?php echo e(__('Auto Translate ID → EN')); ?>

        </button>
        <small class="text-muted ms-2"><?php echo e(__('Otomatis terjemahkan konten Indonesia ke Inggris')); ?></small>
    </div>
</div>

<?php $__env->startPush('after-scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const translateBtn = document.getElementById('autoTranslateBtn');
    if (!translateBtn) return;

    translateBtn.addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Translating...';

        try {
            // Get values from ID fields
            const nameId = document.getElementById('name_id')?.value || '';
            const introTextarea = document.getElementById('intro_id');
            const contentTextarea = document.getElementById('content_id');

            // Get CKEditor content if available
            let introId = introTextarea?.editorInstance?.getData() || introTextarea?.value || '';
            let contentId = contentTextarea?.editorInstance?.getData() || contentTextarea?.value || '';

            if (!nameId && !introId && !contentId) {
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
                    texts: [nameId, introId, contentId],
                    source: 'id',
                    target: 'en'
                })
            });

            const data = await response.json();

            if (data.success) {
                const [nameEn, introEn, contentEn] = data.translations;

                // Set Name EN
                const nameEnField = document.getElementById('name_en');
                if (nameEnField && nameEn) nameEnField.value = nameEn;

                // Set Intro EN (handle CKEditor)
                const introEnTextarea = document.getElementById('intro_en');
                if (introEnTextarea && introEn) {
                    if (introEnTextarea.editorInstance) {
                        introEnTextarea.editorInstance.setData(introEn);
                    } else {
                        introEnTextarea.value = introEn;
                    }
                }

                // Set Content EN (handle CKEditor)
                const contentEnTextarea = document.getElementById('content_en');
                if (contentEnTextarea && contentEn) {
                    if (contentEnTextarea.editorInstance) {
                        contentEnTextarea.editorInstance.setData(contentEn);
                    } else {
                        contentEnTextarea.value = contentEn;
                    }
                }

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
<?php /**PATH C:\Users\Marcel\Music\3.digioh\Modules/Post/Resources/views/backend/posts/form.blade.php ENDPATH**/ ?>