<?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
    $variable = $message['level'];
    
    switch ($variable) {
        case 'primary':
            $icon = '<i class="fa-solid fa-circle-info fa-fw"></i>';
            break;
        case 'secondary':
            $icon = '<i class="fa-solid fa-circle-info fa-fw"></i>';
            break;
        case 'success':
            $icon = '<i class="fa-solid fa-circle-check fa-fw"></i>';
            break;
        case 'danger':
            $icon = '<i class="fa-solid fa-triangle-exclamation fa-fw"></i>';
            break;
        case 'warning':
            $icon = '<i class="fa-solid fa-triangle-exclamation fa-fw"></i>';
            break;
        case 'info':
            $icon = '<i class="fa-solid fa-circle-info fa-fw"></i>';
            break;
        case 'light':
            $icon = '<i class="fa-solid fa-bullhorn fa-fw"></i>';
            break;
        case 'dark':
            $icon = '<i class="fa-solid fa-circle-question fa-fw"></i>';
            break;
        default:
            $icon = '<i class="fa-solid fa-bullhorn fa-fw"></i>';
            break;
    }
    ?>

    <?php if($message['overlay']): ?>
        <?php echo $__env->make('flash::modal', [
            'modalClass' => 'flash-modal',
            'title' => $message['title'],
            'body' => $message['message'],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php else: ?>
        <div class="alert alert-<?php echo e($message['level']); ?> <?php echo e($message['important'] ? 'alert-dismissible' : ''); ?>"
            role="alert" fade show>

            <?php echo $icon; ?>&nbsp;<?php echo $message['message']; ?>


            <?php if($message['important']): ?>
                <button class="btn-close" data-coreui-dismiss="alert" type="button" aria-label="Close"></button>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e(session()->forget('flash_notification')); ?>

<?php /**PATH /var/www/digioh/resources/views/vendor/flash/message.blade.php ENDPATH**/ ?>