<?php if($errors->any()): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p>
            <i class="fas fa-exclamation-triangle"></i>
            <?php echo app('translator')->get("Please fix the following errors & try again!"); ?>
        </p>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button class="btn-close" data-coreui-dismiss="alert" type="button" aria-label="Close"></button>
    </div>
    
<?php endif; ?>
<?php /**PATH /var/www/digioh/resources/views/backend/includes/errors.blade.php ENDPATH**/ ?>