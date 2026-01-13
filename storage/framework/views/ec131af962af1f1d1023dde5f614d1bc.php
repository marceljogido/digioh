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

            <?php
                $currentYear = now()->year;
                $years = range($currentYear, $currentYear - 9);
                $months = [
                    1 => __('Januari'),
                    2 => __('Februari'),
                    3 => __('Maret'),
                    4 => __('April'),
                    5 => __('Mei'),
                    6 => __('Juni'),
                    7 => __('Juli'),
                    8 => __('Agustus'),
                    9 => __('September'),
                    10 => __('Oktober'),
                    11 => __('November'),
                    12 => __('Desember'),
                ];
            ?>

            <div class="row mt-4">
                <div class="col">
                    <div class="row mb-3 g-2">
                        <div class="col-12 col-md-3">
                            <label for="filter-year" class="form-label small text-muted"><?php echo e(__('Filter Tahun')); ?></label>
                            <select id="filter-year" class="form-select">
                                <option value=""><?php echo e(__('Semua Tahun')); ?></option>
                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="filter-month" class="form-label small text-muted"><?php echo e(__('Filter Bulan')); ?></label>
                            <select id="filter-month" class="form-select">
                                <option value=""><?php echo e(__('Semua Bulan')); ?></option>
                                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($num); ?>"><?php echo e($label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-auto align-self-end">
                            <button type="button" id="filter-reset" class="btn btn-outline-secondary btn-sm">
                                <?php echo e(__('Reset Filter')); ?>

                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-bordered table-hover table" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <?php echo app('translator')->get("post::text.name"); ?>
                                    </th>
                                    <th><?php echo e(__('Event Date')); ?></th>
                                    <th>
                                        <?php echo app('translator')->get("post::text.updated_at"); ?>
                                    </th>
                                    <th class="text-end">
                                        <?php echo app('translator')->get("post::text.action"); ?>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-7">
                    <div class="float-left"></div>
                </div>
                <div class="col-5">
                    <div class="float-end"></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush("after-styles"); ?>
    <!-- DataTables Core and Extensions -->
    <link href="<?php echo e(asset("vendor/datatable/datatables.min.css")); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush("after-scripts"); ?>
    <!-- DataTables Core and Extensions -->
    <script type="module" src="<?php echo e(asset("vendor/datatable/datatables.min.js")); ?>"></script>

    <script type="module">
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '<?php echo e(route("backend.$module_name.index_data")); ?>',
                data: function (d) {
                    d.year = $('#filter-year').val();
                    d.month = $('#filter-month').val();
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'event_period',
                    name: 'event_period',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ],
        });

        $('#filter-year, #filter-month').on('change', function () {
            $('#datatable').DataTable().draw();
        });

        $('#filter-reset').on('click', function () {
            $('#filter-year').val('');
            $('#filter-month').val('');
            $('#datatable').DataTable().draw();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("backend.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\Modules/Post/Resources/views/backend/posts/index_datatable.blade.php ENDPATH**/ ?>