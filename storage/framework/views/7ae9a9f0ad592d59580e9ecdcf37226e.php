<!--[if BLOCK]><![endif]--><?php $__currentLoopData = session("flash_notification", collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!--[if BLOCK]><![endif]--><?php if($message["level"] == "success"): ?>
        <div
            class="my-4 rounded-lg border border-green-800 bg-green-50 p-4 text-sm font-semibold text-green-800 dark:bg-gray-800 dark:text-green-400"
            role="alert"
        >
            <?php echo $message["message"]; ?>

        </div>
    <?php elseif($message["level"] == "danger"): ?>
        <div
            class="my-4 rounded-lg border border-red-800 bg-red-50 p-4 text-sm font-semibold text-red-800 dark:bg-gray-800 dark:text-red-400"
            role="alert"
        >
            <?php echo $message["message"]; ?>

        </div>
    <?php elseif($message["level"] == "warning"): ?>
        <div
            class="my-4 rounded-lg border border-yellow-800 bg-yellow-50 p-4 text-sm font-semibold text-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
            role="alert"
        >
            <?php echo $message["message"]; ?>

        </div>
    <?php elseif($message["level"] == "info"): ?>
        <div
            class="my-4 rounded-lg border border-blue-800 bg-blue-50 p-4 text-sm font-semibold text-blue-800 dark:bg-gray-800 dark:text-blue-400"
            role="alert"
        >
            <?php echo $message["message"]; ?>

        </div>
    <?php else: ?>
        <div
            class="my-4 rounded-lg border border-gray-800 bg-gray-50 p-4 text-sm font-semibold text-gray-800 dark:bg-gray-800 dark:text-gray-300"
            role="alert"
        >
            <?php echo $message["message"]; ?>


            <?php echo e($message["level"]); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

<?php echo e(session()->forget("flash_notification")); ?>

<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/frontend/flash-message.blade.php ENDPATH**/ ?>