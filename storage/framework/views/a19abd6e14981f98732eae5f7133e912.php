<?php
    if (! isset($meta_page_type)) {
        $meta_page_type = "website";
    }
?>

<?php switch($meta_page_type):
    case ("website"): ?>
        <meta property="og:type" content="website" />

        <?php break; ?>
    <?php case ("article"): ?>
        
        <meta property="og:type" content="article" />
        <meta property="article:published_time" content="<?php echo e($$module_name_singular->published_at); ?>" />
        <meta property="article:modified_time" content="<?php echo e($$module_name_singular->updated_at); ?>" />
        <meta
            property="article:author"
            content="<?php echo e(isset($$module_name_singular->created_by_alias) ? $$module_name_singular->created_by_alias : $$module_name_singular->created_by_name); ?>"
        />
        <meta property="article:section" content="<?php echo e($$module_name_singular->category_name); ?>" />
        <?php $__currentLoopData = $$module_name_singular->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <meta property="article:tag" content="<?php echo e($tag->name); ?>" />
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php break; ?>
    <?php case ("profile"): ?>
        <meta property="og:type" content="profile" />
        <meta property="profile:first_name" content="<?php echo e($$module_name_singular->first_name); ?>" />
        <meta property="profile:last_name" content="<?php echo e($$module_name_singular->last_name); ?>" />
        <meta property="profile:username" content="<?php echo e($$module_name_singular->email); ?>" />
        <meta property="profile:gender" content="<?php echo e($$module_name_singular->gender); ?>" />

        <?php break; ?>
    <?php default: ?>
<?php endswitch; ?>

<!-- Facebook Meta -->
<meta property="og:url" content="<?php echo e(url()->full()); ?>" />
<meta property="og:title" content="<?php echo $__env->yieldContent("title"); ?> | <?php echo e(config("app.name")); ?>" />
<meta property="og:site_name" content="<?php echo e(setting("meta_site_name")); ?>" />
<meta property="og:description" content="<?php echo e(setting("meta_description")); ?>" />
<meta property="og:image" content="<?php echo e(asset(setting("meta_image"))); ?>" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

<!-- Twitter Meta -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="<?php echo e(setting("meta_twitter_site")); ?>" />
<meta name="twitter:url" content="<?php echo e(url()->full()); ?>" />
<meta name="twitter:creator" content="<?php echo e(setting("meta_twitter_creator")); ?>" />
<meta name="twitter:title" content="<?php echo $__env->yieldContent("title"); ?> | <?php echo e(config("app.name")); ?>" />
<meta name="twitter:description" content="<?php echo e(setting("meta_description")); ?>" />
<meta name="twitter:image" content="<?php echo e(asset(setting("meta_image"))); ?>" />

<!--canonical link-->
<link type="text/plain" rel="author" href="<?php echo e(asset("humans.txt")); ?>" />
<meta name="generator" content="DigiOH - Digital Studio Indonesia" />
<link rel="canonical" href="<?php echo e(url()->full()); ?>" />
<?php /**PATH /var/www/digioh/resources/views/frontend/includes/meta.blade.php ENDPATH**/ ?>