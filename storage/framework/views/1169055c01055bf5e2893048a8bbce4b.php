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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.breadcrumb-item','data' => ['route' => ''.e(route("backend.$module_name.index")).'','icon' => ''.e($module_icon).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.breadcrumb-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route("backend.$module_name.index")).'','icon' => ''.e($module_icon).'']); ?>
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
        <?php if (isset($component)) { $__componentOriginal5e5b40e973d9c7c18a583cb81079b74e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e5b40e973d9c7c18a583cb81079b74e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.breadcrumb-item','data' => ['type' => 'active']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.breadcrumb-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'active']); ?><?php echo e(__($module_action)); ?> <?php echo $__env->renderComponent(); ?>
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
    <?php if (isset($component)) { $__componentOriginal593cc07d57ff55114f4fd57c5b40afcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal593cc07d57ff55114f4fd57c5b40afcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.layouts.show','data' => ['data' => $$module_name_singular,'moduleName' => $module_name,'modulePath' => $module_path,'moduleTitle' => $module_title,'moduleIcon' => $module_icon,'moduleAction' => $module_action]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.layouts.show'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($$module_name_singular),'module_name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_name),'module_path' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_path),'module_title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_title),'module_icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_icon),'module_action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_action)]); ?>
        <?php if (isset($component)) { $__componentOriginal57a22d33ea7984d606412297cfe33b67 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57a22d33ea7984d606412297cfe33b67 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.section-header','data' => ['data' => $$module_name_singular,'moduleName' => $module_name,'moduleTitle' => $module_title,'moduleIcon' => $module_icon,'moduleAction' => $module_action]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($$module_name_singular),'module_name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_name),'module_title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_title),'module_icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_icon),'module_action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($module_action)]); ?>
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
            $post = $$module_name_singular;
        ?>
        <div class="row mt-4">
            <div class="col-12 col-sm-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <?php echo e(__('Our Work Details')); ?>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo e(__('Name')); ?></th>
                                    <td><?php echo e($post->name); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(__('Slug')); ?></th>
                                    <td><?php echo e($post->slug ?? 'N/A'); ?></td>
                                </tr>
                                <?php if(!empty($post->intro)): ?>
                                    <tr>
                                        <th scope="row"><?php echo e(__('Intro')); ?></th>
                                        <td><?php echo nl2br(e($post->intro)); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if(!empty($post->content)): ?>
                                    <tr>
                                        <th scope="row"><?php echo e(__('Content')); ?></th>
                                        <td class="small"><?php echo $post->content; ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th scope="row"><?php echo e(__('Status')); ?></th>
                                    <td class="text-capitalize"><?php echo e($post->status); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(__('Published At')); ?></th>
                                    <td><?php echo e(optional($post->published_at)->format('d M Y H:i') ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(__('Featured on Home')); ?></th>
                                    <td><?php echo e($post->is_featured ? __('Yes') : __('No')); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(__('Event Start')); ?></th>
                                    <td><?php echo e(optional($post->event_start_date)->format('d M Y H:i') ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(__('Event End')); ?></th>
                                    <td><?php echo e(optional($post->event_end_date)->format('d M Y H:i') ?? 'N/A'); ?></td>
                                </tr>
                                <?php if(!empty($post->event_location)): ?>
                                    <tr>
                                        <th scope="row"><?php echo e(__('Event Location')); ?></th>
                                        <td><?php echo e($post->event_location); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if(!empty($post->scope_of_work)): ?>
                                    <tr>
                                        <th scope="row"><?php echo e(__('Scope of Work')); ?></th>
                                        <td><?php echo e($post->scope_of_work); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th scope="row"><?php echo e(__('Created By')); ?></th>
                                    <td><?php echo e($post->created_by_name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(__('Created At')); ?></th>
                                    <td><?php echo e(optional($post->created_at)->format('d M Y H:i') ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(__('Updated At')); ?></th>
                                    <td><?php echo e(optional($post->updated_at)->format('d M Y H:i') ?? 'N/A'); ?></td>
                                </tr>
                                <?php if($post->image): ?>
                                    <?php
                                        $imageUrl = \Illuminate\Support\Str::startsWith($post->image, ['http://', 'https://'])
                                            ? $post->image
                                            : asset($post->image);
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo e(__('Cover Image')); ?></th>
                                        <td>
                                            <a href="<?php echo e($imageUrl); ?>" target="_blank" rel="noopener">
                                                <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($post->name); ?>" class="img-fluid rounded border" style="max-height: 160px;">
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if($post->services->count()): ?>
                    <div class="mt-4">
                        <h5 class="fw-semibold"><?php echo e(__('Services Involved')); ?></h5>
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = $post->services->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('backend.services.show', $service)); ?>" class="badge rounded-pill bg-info text-decoration-none">
                                    <?php echo e($service->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(is_array($post->gallery_images) && count($post->gallery_images)): ?>
                    <div class="mt-4">
                        <h5 class="fw-semibold"><?php echo e(__('Gallery Images')); ?></h5>
                        <div class="d-flex flex-wrap gap-3">
                            <?php $__currentLoopData = $post->gallery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galleryPath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isAbsolute = \Illuminate\Support\Str::startsWith($galleryPath, ['http://', 'https://']);
                                    $displayUrl = $isAbsolute
                                        ? $galleryPath
                                        : \Illuminate\Support\Facades\Storage::url($galleryPath);
                                ?>
                                <a href="<?php echo e($displayUrl); ?>" target="_blank" rel="noopener" class="d-block">
                                    <img src="<?php echo e($displayUrl); ?>" alt="Gallery Image" class="img-fluid rounded border" style="max-height: 140px;">
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-sm-4"></div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal593cc07d57ff55114f4fd57c5b40afcb)): ?>
<?php $attributes = $__attributesOriginal593cc07d57ff55114f4fd57c5b40afcb; ?>
<?php unset($__attributesOriginal593cc07d57ff55114f4fd57c5b40afcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal593cc07d57ff55114f4fd57c5b40afcb)): ?>
<?php $component = $__componentOriginal593cc07d57ff55114f4fd57c5b40afcb; ?>
<?php unset($__componentOriginal593cc07d57ff55114f4fd57c5b40afcb); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("backend.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/digioh/Modules/Post/Resources/views/backend/posts/show.blade.php ENDPATH**/ ?>