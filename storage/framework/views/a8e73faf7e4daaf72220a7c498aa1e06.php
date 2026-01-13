<?php $__env->startPush("after-styles"); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <?php if(language_direction() == "rtl"): ?>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css"
        />
    <?php else: ?>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        />
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush("after-scripts"); ?>
    <script type="module" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="module">
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Select an option --',
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/digioh/resources/views/components/library/select2.blade.php ENDPATH**/ ?>