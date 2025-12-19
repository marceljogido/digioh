<?php
    $required = Str::contains($field["rules"], "required") ? "required" : "";
    $required_mark = $required != "" ? '<span class="text-danger"> <strong>*</strong> </span>' : "";
    $trueValue = \Illuminate\Support\Arr::get($field, 'value', '1');
    if (($field['data'] ?? null) === 'boolean') {
        $trueValue = '1';
    }
?>

<div class="form-group <?php echo e($errors->has($field["name"]) ? " has-error" : ""); ?> mt-3">
    <div class="checkbox">
        <label class="form-label" for="<?php echo e($field["name"]); ?>">
            <strong><?php echo e(__($field["label"])); ?></strong>
            (<?php echo e($field["name"]); ?>)
        </label>
        <?php echo $required_mark; ?>

        <br />

        <label>
            <input class="form-label" name="<?php echo e($field["name"]); ?>" type="hidden" value="0" />
            <input
                name="<?php echo e($field["name"]); ?>"
                type="checkbox"
                value="<?php echo e($trueValue); ?>"
                <?php if(old($field['name'], setting($field['name']))): ?> checked="checked" <?php endif; ?>
            />
            <?php echo e($field["label"]); ?>

        </label>
        <?php echo $required_mark; ?>


        <?php if($errors->has($field["name"])): ?>
            <small class="help-block"><?php echo e($errors->first($field["name"])); ?></small>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\resources\views/backend/settings/fields/checkbox.blade.php ENDPATH**/ ?>