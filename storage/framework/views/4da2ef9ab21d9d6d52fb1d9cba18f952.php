<div>
    <div class="row mt-4">
        <div class="col">
            <div class="mb-3">
                <input class="form-control" type="text" placeholder="🔍 Search users..." wire:model.live="searchTerm" />
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" wire:loading.class="table-secondary">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px">#</th>
                            <th><?php echo e(__("Name")); ?></th>
                            <th><?php echo e(__("Email")); ?></th>
                            <th style="width: 100px" class="text-center"><?php echo e(__("Status")); ?></th>
                            <th style="width: 150px"><?php echo e(__("Roles")); ?></th>
                            <th style="width: 120px" class="text-center"><?php echo e(__("Updated")); ?></th>
                            <th style="width: 200px" class="text-end"><?php echo e(__("Action")); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-muted"><?php echo e($users->firstItem() + $index); ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?php echo e(asset($user->avatar)); ?>" alt="<?php echo e($user->name); ?>" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                        <div>
                                            <a href="<?php echo e(route('backend.users.show', $user->id)); ?>" class="fw-semibold text-decoration-none">
                                                <?php echo e($user->name); ?>

                                            </a>
                                            <!--[if BLOCK]><![endif]--><?php if($user->getRoleNames()->count() > 0): ?>
                                                <div class="small text-muted"><?php echo e($user->getRoleNames()->implode(', ')); ?></div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted"><?php echo e($user->email); ?></span>
                                    <!--[if BLOCK]><![endif]--><?php if($user->email_verified_at): ?>
                                        <i class="fas fa-check-circle text-success ms-1" title="Verified"></i>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td class="text-center">
                                    <!--[if BLOCK]><![endif]--><?php if($user->status == 1): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php elseif($user->status == 2): ?>
                                        <span class="badge bg-danger">Blocked</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactive</span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-primary"><?php echo e(ucwords($role)); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td class="text-center text-muted small">
                                    <?php echo e($user->updated_at ? $user->updated_at->diffForHumans() : '-'); ?>

                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a
                                            href="<?php echo e(route('backend.users.show', $user)); ?>"
                                            class="btn btn-outline-secondary"
                                            title="<?php echo e(__('Show')); ?>"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("edit_users")): ?>
                                            <a
                                                href="<?php echo e(route('backend.users.edit', $user)); ?>"
                                                class="btn btn-outline-primary"
                                                title="<?php echo e(__('Edit')); ?>"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a
                                                href="<?php echo e(route('backend.users.changePassword', $user)); ?>"
                                                class="btn btn-outline-info"
                                                title="<?php echo e(__('Change Password')); ?>"
                                            >
                                                <i class="fas fa-key"></i>
                                            </a>
                                            <!--[if BLOCK]><![endif]--><?php if($user->status != 2): ?>
                                                <a
                                                    href="<?php echo e(route('backend.users.block', $user)); ?>"
                                                    class="btn btn-outline-warning"
                                                    data-method="PATCH"
                                                    data-token="<?php echo e(csrf_token()); ?>"
                                                    data-confirm="Are you sure you want to block this user?"
                                                    title="<?php echo e(__('Block')); ?>"
                                                >
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            <?php else: ?>
                                                <a
                                                    href="<?php echo e(route('backend.users.unblock', $user)); ?>"
                                                    class="btn btn-outline-success"
                                                    data-method="PATCH"
                                                    data-token="<?php echo e(csrf_token()); ?>"
                                                    data-confirm="Are you sure you want to unblock this user?"
                                                    title="<?php echo e(__('Unblock')); ?>"
                                                >
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <a
                                                href="<?php echo e(route('backend.users.destroy', $user)); ?>"
                                                class="btn btn-outline-danger"
                                                data-method="DELETE"
                                                data-token="<?php echo e(csrf_token()); ?>"
                                                data-confirm="Are you sure you want to delete this user?"
                                                title="<?php echo e(__('Delete')); ?>"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-users fa-2x mb-2 d-block"></i>
                                    <?php echo e(__('No users found.')); ?>

                                </td>
                            </tr>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-7">
            <div class="text-muted small">
                Showing <?php echo e($users->firstItem() ?? 0); ?> to <?php echo e($users->lastItem() ?? 0); ?> of <?php echo e($users->total()); ?> users
            </div>
        </div>
        <div class="col-5">
            <div class="float-end">
                <?php echo $users->links(); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/livewire/users-index.blade.php ENDPATH**/ ?>