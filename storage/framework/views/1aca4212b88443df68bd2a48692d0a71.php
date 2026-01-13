<?php $__env->startSection("title"); ?>
    <?php echo app('translator')->get("Dashboard"); ?>
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
    
    <div class="card mb-4 border-0" style="background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8b 50%, #3a7ab8 100%);">
        <div class="card-body py-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1 d-flex align-items-center" style="color: #ffffff;">
                        <i class="fa-solid fa-hand-wave me-2" style="font-size: 1.2rem;"></i>
                        <span>Selamat Datang, <?php echo e(Auth::user()->name); ?>!</span>
                    </h3>
                    <p class="mb-0 ps-4" style="color: rgba(255,255,255,0.85); margin-left: 0.5rem;"><?php echo e(now()->isoFormat('dddd, D MMMM Y')); ?></p>
                </div>
                <div class="d-none d-md-block">
                    <img src="<?php echo e(asset('img/DIGIOH_Main Logo_Flat Color White.svg')); ?>" alt="digiOH" style="height: 50px; opacity: 0.9;">
                </div>
            </div>
        </div>
    </div>

    
    <div class="row mb-4">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-4 col-xl-2 mb-3">
                <?php
                    $statRoute = Route::has($stat['route']) ? route($stat['route']) : '#';
                ?>
                <a href="<?php echo e($statRoute); ?>" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-shadow" style="transition: all 0.3s ease;">
                        <div class="card-body text-center py-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 50px; height: 50px; background: var(--cui-<?php echo e($stat['color']); ?>-bg-subtle, #f0f0f0);">
                                <i class="<?php echo e($stat['icon']); ?> fa-lg text-<?php echo e($stat['color']); ?>"></i>
                            </div>
                            <?php if(isset($stat['is_icon']) && $stat['is_icon']): ?>
                                <h3 class="mb-1 fw-bold"><?php echo e($stat['count']); ?></h3>
                            <?php else: ?>
                                <h2 class="mb-1 fw-bold text-<?php echo e($stat['color']); ?>"><?php echo e($stat['count']); ?></h2>
                            <?php endif; ?>
                            <p class="text-muted small mb-0"><?php echo e($stat['label']); ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fa-solid fa-bolt me-2 text-warning"></i>
                Quick Actions
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <?php $__currentLoopData = $quickActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Route::has($action['route'])): ?>
                        <div class="col-6 col-md-3">
                            <a href="<?php echo e(route($action['route'])); ?>" class="btn btn-<?php echo e($action['color']); ?> w-100 py-3">
                                <i class="<?php echo e($action['icon']); ?> me-2"></i>
                                <?php echo e($action['label']); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="row">
        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-clock-rotate-left me-2 text-info"></i>
                        Recent Updates
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if(count($recentUpdates) > 0): ?>
                        <div class="list-group list-group-flush">
                            <?php $__currentLoopData = $recentUpdates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($update['route']); ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 36px; height: 36px; background: var(--cui-<?php echo e($update['color']); ?>-bg-subtle, #f0f0f0);">
                                            <i class="<?php echo e($update['icon']); ?> text-<?php echo e($update['color']); ?>"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong><?php echo e($update['name']); ?></strong>
                                                <span class="badge bg-<?php echo e($update['color']); ?>"><?php echo e($update['type']); ?></span>
                                            </div>
                                            <small class="text-muted"><?php echo e($update['time']->diffForHumans()); ?></small>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fa-solid fa-inbox fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No recent updates</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-link me-2 text-primary"></i>
                        Quick Links
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo e(route('frontend.index')); ?>" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-globe me-2 text-success"></i> View Website</span>
                            <i class="fa-solid fa-external-link-alt text-muted"></i>
                        </a>
                        <a href="<?php echo e(route('backend.settings.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-cog me-2 text-secondary"></i> Settings</span>
                            <i class="fa-solid fa-chevron-right text-muted"></i>
                        </a>
                        <a href="<?php echo e(route('backend.backups.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-database me-2 text-info"></i> Backups</span>
                            <i class="fa-solid fa-chevron-right text-muted"></i>
                        </a>
                        <a href="<?php echo e(route('backend.users.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-users me-2 text-primary"></i> Manage Users</span>
                            <i class="fa-solid fa-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<style>
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>

<?php echo $__env->make("backend.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/digioh/resources/views/backend/index.blade.php ENDPATH**/ ?>