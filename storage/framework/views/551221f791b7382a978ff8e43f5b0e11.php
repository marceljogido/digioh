<?php $__env->startSection("title"); ?>
    <?php echo e(__($module_action)); ?> <?php echo e(__($module_title)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("breadcrumbs"); ?>
    <?php if (isset($component)) { $__componentOriginal73d065ab05177f56255c078a05ab5686 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73d065ab05177f56255c078a05ab5686 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.breadcrumbs','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginal5e5b40e973d9c7c18a583cb81079b74e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.breadcrumb-item','data' => ['type' => 'active','icon' => ''.e($module_icon).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.breadcrumb-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'active','icon' => ''.e($module_icon).'']); ?>
            <?php echo e(__($module_title)); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e)): ?>
<?php $attributes = $__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e; ?>
<?php unset($__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e5b40e973d9c7c18a583cb81079b74e)): ?>
<?php $component = $__componentOriginal5e5b40e973d9c7c18a583cb81079b74e; ?>
<?php unset($__componentOriginal5e5b40e973d9c7c18a583cb81079b74e); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73d065ab05177f56255c078a05ab5686)): ?>
<?php $attributes = $__attributesOriginal73d065ab05177f56255c078a05ab5686; ?>
<?php unset($__attributesOriginal73d065ab05177f56255c078a05ab5686); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73d065ab05177f56255c078a05ab5686)): ?>
<?php $component = $__componentOriginal73d065ab05177f56255c078a05ab5686; ?>
<?php unset($__componentOriginal73d065ab05177f56255c078a05ab5686); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="card">
        <div class="card-body">
            <?php if (isset($component)) { $__componentOriginal57a22d33ea7984d606412297cfe33b67 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57a22d33ea7984d606412297cfe33b67 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.section-header','data' => ['moduleName' => $module_name,'moduleTitle' => $module_title,'moduleIcon' => $module_icon,'moduleAction' => $module_action]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['module_name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_name),'module_title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_title),'module_icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_icon),'module_action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_action)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57a22d33ea7984d606412297cfe33b67)): ?>
<?php $attributes = $__attributesOriginal57a22d33ea7984d606412297cfe33b67; ?>
<?php unset($__attributesOriginal57a22d33ea7984d606412297cfe33b67); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57a22d33ea7984d606412297cfe33b67)): ?>
<?php $component = $__componentOriginal57a22d33ea7984d606412297cfe33b67; ?>
<?php unset($__componentOriginal57a22d33ea7984d606412297cfe33b67); ?>
<?php endif; ?>

            <div class="row mt-4">
                <div class="col">
                    <?php echo e(html()->form("POST", route("backend.$module_name.store"))->open()); ?>


                    <?php
                        $settingSections = $settingSections ?? [];
                        $currentSection = $selectedSection ?? (count($settingSections) ? array_key_first($settingSections) : null);
                    ?>

                    <?php if(count($settingSections)): ?>
                        <?php echo e(html()->hidden('active_section', $currentSection)->id('active_section_input')); ?>


                        <div class="mb-4">
                            <label for="setting-section-select" class="form-label"><b>Select Setting Section</b></label>
                            <select id="setting-section-select" class="form-select">
                                <?php $__currentLoopData = $settingSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($section); ?>" <?php if($section === $currentSection): echo 'selected'; endif; ?>><?php echo e($fields['title']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <?php $__currentLoopData = $settingSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div id="setting-section-<?php echo e($section); ?>" class="setting-section-content card card-accent-primary mb-4" <?php if($section !== $currentSection): ?> style="display:none" <?php endif; ?>>
                                <div class="card-header">
                                    <i class="<?php echo e(Arr::get($fields, "icon", "glyphicon glyphicon-flash")); ?>"></i>
                                    &nbsp;<?php echo e($fields["title"]); ?>

                                </div>
                                <div class="card-body">
                                    <p class="text-muted"><?php echo e($fields["desc"]); ?></p>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <?php $__currentLoopData = $fields["elements"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if ($__env->exists("backend.settings.fields." . $field["type"])) echo $__env->make("backend.settings.fields." . $field["type"], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <div class="row m-b-md">
                        <div class="col-md-12">
                            <?php if (isset($component)) { $__componentOriginal01f50869d947699da362d3a7b41e6d66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01f50869d947699da362d3a7b41e6d66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.buttons.save','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.buttons.save'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01f50869d947699da362d3a7b41e6d66)): ?>
<?php $attributes = $__attributesOriginal01f50869d947699da362d3a7b41e6d66; ?>
<?php unset($__attributesOriginal01f50869d947699da362d3a7b41e6d66); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01f50869d947699da362d3a7b41e6d66)): ?>
<?php $component = $__componentOriginal01f50869d947699da362d3a7b41e6d66; ?>
<?php unset($__componentOriginal01f50869d947699da362d3a7b41e6d66); ?>
<?php endif; ?>
                        </div>
                    </div>

                    <?php echo e(html()->form()->close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('setting-section-select');
        const sections = document.querySelectorAll('.setting-section-content');
        const activeSectionInput = document.getElementById('active_section_input');
        const defaultSection = '<?php echo e($currentSection); ?>';

        if (!select) {
            return;
        }

        function toggleSections() {
            const selectedValue = select.value;
            sections.forEach(section => {
                if (section.id === 'setting-section-' + selectedValue) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });

            if (activeSectionInput) {
                activeSectionInput.value = selectedValue;
            }
        }

        // Initial toggle
        if (select && defaultSection) {
            select.value = defaultSection;
        }
        toggleSections();

        // Add event listener
        select.addEventListener('change', toggleSections);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const editors = document.querySelectorAll('textarea.richtext');
        if (editors.length && typeof ClassicEditor !== 'undefined') {
            editors.forEach((textarea) => {
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
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            textarea.value = editor.getData();
                        });
                    })
                    .catch(error => console.error(error));
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("backend.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/digioh/resources/views/backend/settings/index.blade.php ENDPATH**/ ?>