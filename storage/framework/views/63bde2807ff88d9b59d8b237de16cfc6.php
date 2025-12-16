<?php
$notifications = optional(auth()->user())->unreadNotifications;
$notifications_count = optional($notifications)->count();
$notifications_latest = optional($notifications)->take(5);
?>

<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand d-sm-flex justify-content-center">
            <a href="/">
                <img
                    class="sidebar-brand-full"
                    src="<?php echo e(asset("img/logo-with-text.jpg")); ?>"
                    alt="<?php echo e(app_name()); ?>"
                    height="46"
                />
                <img
                    class="sidebar-brand-narrow"
                    src="<?php echo e(asset("img/logo-square.jpg")); ?>"
                    alt="<?php echo e(app_name()); ?>"
                    height="46"
                />
            </a>
        </div>
        <button
            class="btn-close d-lg-none"
            data-coreui-dismiss="offcanvas"
            data-coreui-theme="dark"
            type="button"
            aria-label="Close"
            onclick='coreui.Sidebar.getInstance(document.querySelector("#sidebar")).toggle()'
        ></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route("backend.dashboard")); ?>">
                <i class="nav-icon fa-solid fa-cubes"></i>
                &nbsp;
                <?php echo app('translator')->get("Dashboard"); ?>
            </a>
        </li>

        <?php
            $module_name = "sliders";
            $text = __("Sliders");
            $icon = "fa-solid fa-images";
            $permission = "view_" . $module_name;
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "settings";
            $text = __("About Us");
            $icon = "fa-solid fa-address-card";
            $permission = "edit_" . $module_name;
            $url = route("backend." . $module_name . ".about");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "posts";
            $text = __("Our Work");
            $icon = "fa-regular fa-file-lines";
            $permission = "view_" . $module_name;
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "services";
            $text = __("Services");
            $icon = "fa-solid fa-briefcase";
            $permission = "view_backend";
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "stats";
            $text = __("Statistics");
            $icon = "fa-solid fa-chart-simple";
            $permission = "view_backend";
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "clientlogos";
            $text = __("Client Logos");
            $icon = "fa-regular fa-handshake";
            $permission = "view_" . $module_name;
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "faq";
            $text = __("FAQ");
            $icon = "fa-regular fa-circle-question";
            $permission = "view_backend";
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "settings";
            $text = __("Settings");
            $icon = "fa-solid fa-gears";
            $permission = "edit_" . $module_name;
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route("backend.notifications.index")); ?>">
                <i class="nav-icon fa-regular fa-bell"></i>
                &nbsp;
                <?php echo app('translator')->get("Notifications"); ?>
                <?php if($notifications_count): ?>
                    &nbsp;
                    <span class="badge badge-sm bg-info ms-auto"><?php echo e($notifications_count); ?></span>
                <?php endif; ?>
            </a>
        </li>

        <?php
            $module_name = "backups";
            $text = __("Backups");
            $icon = "fa-solid fa-box-archive";
            $permission = "view_" . $module_name;
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "users";
            $text = __("Users");
            $icon = "fa-solid fa-user-group";
            $permission = "view_" . $module_name;
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

        <?php
            $module_name = "roles";
            $text = __("Roles");
            $icon = "fa-solid fa-user-shield";
            $permission = "view_" . $module_name;
            $url = route("backend." . $module_name . ".index");
        ?>

        <?php if (isset($component)) { $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.sidebar-nav-item','data' => ['permission' => $permission,'url' => $url,'icon' => $icon,'text' => $text]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['permission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($permission),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($text)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $attributes = $__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__attributesOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b)): ?>
<?php $component = $__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b; ?>
<?php unset($__componentOriginal690e7c357d12ebee0eab45ff08b5ee6b); ?>
<?php endif; ?>

    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" data-coreui-toggle="unfoldable" type="button"></button>
    </div>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/includes/sidebar.blade.php ENDPATH**/ ?>