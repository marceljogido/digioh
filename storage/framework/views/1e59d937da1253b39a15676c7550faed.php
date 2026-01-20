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

    <input
        type="<?php echo e($field["type"]); ?>"
        name="<?php echo e($field["name"]); ?>"
        value="<?php echo e(old($field["name"], setting($field["name"]))); ?>"
        class="form-control <?php echo e(Arr::get($field, "class")); ?> <?php echo e($errors->has($field["name"]) ? " is-invalid" : ""); ?>"
        id="<?php echo e($field["name"]); ?>"
        placeholder="<?php echo e($field["label"]); ?>"
        <?php echo e($required); ?>

    />

    <?php if($errors->has($field["name"])): ?>
        <small class="invalid-feedback"><?php echo e($errors->first($field["name"])); ?></small>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/settings/fields/email.blade.php ENDPATH**/ ?>