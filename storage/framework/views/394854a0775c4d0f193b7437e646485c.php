<?php
    $required = Str::contains($field["rules"], "required") ? "required" : "";
    $required_mark = $required != "" ? '<span class="text-danger"> <strong>*</strong> </span>' : "";
?>

<div class="form-group <?php echo e($errors->has($field["name"]) ? " has-error" : ""); ?> mt-3">
    <label for="<?php echo e($field["name"]); ?>" class="form-label">
        <strong><?php echo e(__($field["label"])); ?></strong>
        (<?php echo e($field["name"]); ?>)
    </label>
    <?php echo $required_mark; ?>

    <textarea
        type="<?php echo e($field["type"]); ?>"
        name="<?php echo e($field["name"]); ?>"
        class="form-control <?php echo e(Arr::get($field, "class")); ?> <?php echo e($errors->has($field["name"]) ? " is-invalid" : ""); ?>"
        id="<?php echo e($field["name"]); ?>"
        placeholder="<?php echo e($field["label"]); ?>"
        rows="4"
        style="min-height: 100px"
        <?php echo e($required); ?>

><?php if(isset($field["display"])): ?><?php if($field["display"] == "raw"): ?><?php echo old($field["name"], setting($field["name"])); ?><?php else: ?><?php echo e(old($field["name"], setting($field["name"]))); ?><?php endif; ?> <?php else: ?><?php echo e(old($field["name"], setting($field["name"]))); ?><?php endif; ?></textarea>

    <?php if($errors->has($field["name"])): ?>
        <small class="invalid-feedback"><?php echo e($errors->first($field["name"])); ?></small>
    <?php endif; ?>

    <?php if(isset($field["help"])): ?>
        <small id="email-<?php echo e($field["name"]); ?>" class="form-text text-muted"><?php echo e($field["help"]); ?></small>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/digioh/resources/views/backend/settings/fields/textarea.blade.php ENDPATH**/ ?>