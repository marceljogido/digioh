<script>
    if (
        localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/components/selected-theme.blade.php ENDPATH**/ ?>