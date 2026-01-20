<?php $__env->startSection("title"); ?>
    <?php echo e($$module_name_singular->name); ?> - <?php echo e($$module_name_singular->username); ?> - <?php echo e(__($module_action)); ?>

    <?php echo e(__($module_title)); ?>

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
            <?php echo e($$module_name_singular->name); ?>

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
<?php $component->withAttributes(['type' => 'active']); ?>
            <?php echo e(__($module_title)); ?>

            <?php echo e(__($module_action)); ?>

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
    <?php if (isset($component)) { $__componentOriginal593cc07d57ff55114f4fd57c5b40afcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal593cc07d57ff55114f4fd57c5b40afcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.layouts.show','data' => ['data' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.layouts.show'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
        <?php if (isset($component)) { $__componentOriginal57a22d33ea7984d606412297cfe33b67 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57a22d33ea7984d606412297cfe33b67 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.section-header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <i class="<?php echo e($module_icon); ?>"></i>
            <?php echo e($$module_name_singular->name); ?>

            <small class="text-muted"><?php echo e(__($module_title)); ?> <?php echo e(__($module_action)); ?></small>

             <?php $__env->slot('toolbar', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginal03c0e80d38d2a15cf58878ae679803f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03c0e80d38d2a15cf58878ae679803f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.buttons.return-back','data' => ['small' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.buttons.return-back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['small' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03c0e80d38d2a15cf58878ae679803f0)): ?>
<?php $attributes = $__attributesOriginal03c0e80d38d2a15cf58878ae679803f0; ?>
<?php unset($__attributesOriginal03c0e80d38d2a15cf58878ae679803f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03c0e80d38d2a15cf58878ae679803f0)): ?>
<?php $component = $__componentOriginal03c0e80d38d2a15cf58878ae679803f0; ?>
<?php unset($__componentOriginal03c0e80d38d2a15cf58878ae679803f0); ?>
<?php endif; ?>
                <a
                    class="btn btn-primary btn-sm m-1"
                    data-toggle="tooltip"
                    href="<?php echo e(route("backend.users.index")); ?>"
                    title="List"
                >
                    <i class="fas fa-list"></i>
                    List
                </a>
                <?php if (isset($component)) { $__componentOriginal3fb88f3c798c2fbfcf9069ea6a28e03f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fb88f3c798c2fbfcf9069ea6a28e03f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.buttons.edit','data' => ['title' => ''.e(__('Edit')).' '.e(ucwords(Str::singular($module_name))).'','route' => ''.route("backend.$module_name.edit", $$module_name_singular).'','small' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('buttons.edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Edit')).' '.e(ucwords(Str::singular($module_name))).'','route' => ''.route("backend.$module_name.edit", $$module_name_singular).'','small' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fb88f3c798c2fbfcf9069ea6a28e03f)): ?>
<?php $attributes = $__attributesOriginal3fb88f3c798c2fbfcf9069ea6a28e03f; ?>
<?php unset($__attributesOriginal3fb88f3c798c2fbfcf9069ea6a28e03f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fb88f3c798c2fbfcf9069ea6a28e03f)): ?>
<?php $component = $__componentOriginal3fb88f3c798c2fbfcf9069ea6a28e03f; ?>
<?php unset($__componentOriginal3fb88f3c798c2fbfcf9069ea6a28e03f); ?>
<?php endif; ?>
             <?php $__env->endSlot(); ?>
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

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table-bordered table-hover table">
                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.avatar")); ?></th>
                            <td>
                                <img
                                    class="user-profile-image img-fluid img-thumbnail"
                                    src="<?php echo e(asset($$module_name_singular->avatar)); ?>"
                                    style="max-height: 200px; max-width: 200px"
                                />
                            </td>
                        </tr>

                        <?php
                            $fields_array = [
                                ["name" => "username", "type" => "text"],
                                ["name" => "name", "type" => "text"],
                                ["name" => "email", "type" => "text"],
                                ["name" => "mobile", "type" => "text"],
                                ["name" => "gender", "type" => "text"],
                                ["name" => "date_of_birth", "type" => "date"],
                                ["name" => "address", "type" => "text"],
                                ["name" => "bio", "type" => "text"],
                                ["name" => "last_ip", "type" => "text"],
                                ["name" => "login_count", "type" => "text"],
                                ["name" => "last_login", "type" => "datetime"],
                            ];
                        ?>

                        <?php $__currentLoopData = $fields_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $field_name = $item["name"];
                            ?>

                            <tr>
                                <th><?php echo e(__(label_case($field_name))); ?></th>
                                <td><?php echo e($user->$field_name); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.password")); ?></th>
                            <td>
                                <a
                                    class="btn btn-outline-primary btn-sm"
                                    href="<?php echo e(route("backend.users.changePassword", $user->id)); ?>"
                                >
                                    Change password
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.social")); ?></th>
                            <td>
                                <ul class="list-unstyled">
                                    <?php $__currentLoopData = $user->providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <i class="fab fa-<?php echo e($provider->provider); ?>"></i>
                                            <?php echo e(label_case($provider->provider)); ?>

                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.status")); ?></th>
                            <td><?php echo $user->status_label; ?></td>
                        </tr>

                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.confirmed")); ?></th>
                            <td>
                                <?php echo $user->confirmed_label; ?>

                                <?php if($user->email_verified_at == null): ?>
                                        <a
                                            class="btn btn-primary btn-sm mt-1"
                                            data-toggle="tooltip"
                                            href="<?php echo e(route("backend.users.emailConfirmationResend", $user->id)); ?>"
                                            title="Send Confirmation Email"
                                        >
                                            <i class="fas fa-envelope"></i>
                                            Send Confirmation Reminder
                                        </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.roles")); ?></th>
                            <td>
                                <?php if($user->getRoleNames()->count() > 0): ?>
                                    <ul>
                                        <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e(ucwords($role)); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.permissions")); ?></th>
                            <td>
                                <?php if($user->getAllPermissions()->count() > 0): ?>
                                    <ul>
                                        <?php $__currentLoopData = $user->getAllPermissions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($permission->name); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.created_at")); ?></th>
                            <td>
                                <?php echo e($user->created_at); ?> by User:<?php echo e($user->created_by); ?>

                                <br />
                                <small>(<?php echo e($user->created_at->diffForHumans()); ?>)</small>
                            </td>
                        </tr>

                        <tr>
                            <th><?php echo e(__("labels.backend.users.fields.updated_at")); ?></th>
                            <td>
                                <?php echo e($user->updated_at); ?> by User:<?php echo e($user->updated_by); ?>

                                <br />
                                <small>(<?php echo e($user->updated_at->diffForHumans()); ?>)</small>
                            </td>
                        </tr>

                        <tr>
                            <th><?php echo e(__("Deleted At")); ?></th>
                            <td>
                                <?php if($user->deleted_at != null): ?>
                                        <?php echo e($user->deleted_at); ?> by User:<?php echo e($user->deleted_by); ?>

                                        <br />
                                        <small>(<?php echo e($user->deleted_at->diffForHumans()); ?>)</small>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="py-4 text-end">
                    <?php if($user->status != 2): ?>
                        <a
                            class="btn btn-danger mt-1"
                            data-method="PATCH"
                            data-token="<?php echo e(csrf_token()); ?>"
                            data-toggle="tooltip"
                            data-confirm="Are you sure?"
                            href="<?php echo e(route("backend.users.block", $user)); ?>"
                            title="<?php echo e(__("labels.backend.block")); ?>"
                        >
                            <i class="fas fa-ban"></i>
                            <?php echo app('translator')->get("Block"); ?>
                        </a>
                    <?php endif; ?>

                    <?php if($user->status == 2): ?>
                        <a
                            class="btn btn-info mt-1"
                            data-method="PATCH"
                            data-token="<?php echo e(csrf_token()); ?>"
                            data-toggle="tooltip"
                            data-confirm="Are you sure?"
                            href="<?php echo e(route("backend.users.unblock", $user)); ?>"
                            title="<?php echo e(__("labels.backend.unblock")); ?>"
                        >
                            <i class="fas fa-check"></i>
                            <?php echo app('translator')->get("Unblock"); ?>
                        </a>
                    <?php endif; ?>

                    <a
                        class="btn btn-danger mt-1"
                        data-method="DELETE"
                        data-token="<?php echo e(csrf_token()); ?>"
                        data-toggle="tooltip"
                        data-confirm="Are you sure?"
                        href="<?php echo e(route("backend.users.destroy", $user)); ?>"
                        title="<?php echo e(__("labels.backend.delete")); ?>"
                    >
                        <i class="fas fa-trash-alt"></i>
                        <?php echo app('translator')->get("Delete"); ?>
                    </a>
                    <?php if($user->email_verified_at == null): ?>
                        <a
                            class="btn btn-primary mt-1"
                            data-toggle="tooltip"
                            href="<?php echo e(route("backend.users.emailConfirmationResend", $user->id)); ?>"
                            title="Send Confirmation Email"
                        >
                            <i class="fas fa-envelope"></i>
                            <?php echo app('translator')->get("Email Confirmation"); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
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

<?php echo $__env->make("backend.layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/users/show.blade.php ENDPATH**/ ?>