<?php if(setting("google_analytics") !== ""): ?>
    <?php
        $google_analytics = setting("google_analytics");
    ?>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($google_analytics); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '<?php echo e($google_analytics); ?>');
    </script>
<?php endif; ?>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/google-analytics.blade.php ENDPATH**/ ?>