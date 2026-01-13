<?php
    use Illuminate\Support\Str;

    $required = Str::contains($field['rules'], 'required') ? 'required' : '';
    $required_mark = $required !== '' ? '<span class="text-danger"> <strong>*</strong> </span>' : '';
    $currentValue = old($field['name']) ?: setting($field['name']);

    $displayUrl = null;
    if (! empty($currentValue)) {
        $displayUrl = Str::startsWith($currentValue, ['http://', 'https://', '//'])
            ? $currentValue
            : asset($currentValue);
    }
?>

<div class="form-group <?php echo e($errors->has($field['name']) ? ' has-error' : ''); ?> mt-3">
    <label for="<?php echo e($field['name']); ?>" class="form-label">
        <strong><?php echo e(__($field['label'])); ?></strong>
        (<?php echo e($field['name']); ?>)
    </label>
    <?php echo $required_mark; ?>


    <?php if($displayUrl): ?>
        <div class="mb-2">
            <a href="<?php echo e($displayUrl); ?>" target="_blank" rel="noopener" class="d-inline-block">
                <img src="<?php echo e($displayUrl); ?>" alt="<?php echo e($field['label']); ?>" style="max-height: 140px" class="rounded border">
            </a>
        </div>
    <?php endif; ?>

    <input
        type="file"
        name="<?php echo e($field['name']); ?>"
        class="form-control <?php echo e(Arr::get($field, 'class')); ?> <?php echo e($errors->has($field['name']) ? ' is-invalid' : ''); ?>"
        id="<?php echo e($field['name']); ?>"
        accept="image/*"
        <?php echo e($required); ?>

    >

    <?php if($errors->has($field['name'])): ?>
        <small class="invalid-feedback"><?php echo e($errors->first($field['name'])); ?></small>
    <?php endif; ?>

    <?php if(isset($field['help'])): ?>
        <small class="form-text text-muted"><?php echo e($field['help']); ?></small>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/digioh/resources/views/backend/settings/fields/image.blade.php ENDPATH**/ ?>