<div class="row">
	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'client_name';
			$field_lable = __('Client Name');
			$field_placeholder = $field_lable;
			$required = "";
			?>
			<?php echo e(html()->label($field_lable, $field_name)->class('form-label')); ?> <?php echo field_required($required); ?>

			<?php echo e(html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])); ?>

		</div>
	</div>

	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'logo';
			$field_lable = __('Logo Image');
			$required = isset($clientlogo) ? "" : "required";
			$entity = (isset($clientlogo) && is_object($clientlogo)) ? $clientlogo : ((isset($data) && is_object($data)) ? $data : null);
			?>
			<?php echo e(html()->label($field_lable, $field_name)->class('form-label')); ?> <?php echo field_required($required); ?>

			<input
				type="file"
				name="<?php echo e($field_name); ?>"
				id="<?php echo e($field_name); ?>"
				class="form-control"
				accept=".jpg,.jpeg,.png,.gif,.webp,.svg"
				<?php if(empty($entity)): ?> required <?php endif; ?>
			>
			<small class="text-muted d-block mt-1">
				<?php echo e(__('Unggah logo (JPG, PNG, GIF, SVG, atau WEBP) maksimal 2 MB.')); ?>

				<?php if(optional($entity)->logo): ?>
					<br><?php echo e(__('Biarkan kosong jika tidak ingin mengganti logo.')); ?>

				<?php endif; ?>
			</small>
		</div>
	</div>

	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'website_url';
			$field_lable = __('Website URL (optional)');
			$field_placeholder = 'https://company.com';
			$required = "";
			?>
			<?php echo e(html()->label($field_lable, $field_name)->class('form-label')); ?> <?php echo field_required($required); ?>

			<?php echo e(html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["type" => "url", "$required"])); ?>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'is_active';
			$field_lable = __('Status');
			$required = "required";
			$select_options = ['1' => 'Published', '0' => 'Unpublished'];
			?>
			<?php echo e(html()->label($field_lable, $field_name)->class('form-label')); ?> <?php echo field_required($required); ?>

			<?php echo e(html()->select($field_name, $select_options)->class('form-select')->attributes(["$required"])); ?>

		</div>
	</div>

	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$field_name = 'sort_order';
			$field_lable = __('Sort Order');
			$field_placeholder = '0';
			$required = "";
			?>
			<?php echo e(html()->label($field_lable, $field_name)->class('form-label')); ?> <?php echo field_required($required); ?>

			<?php echo e(html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["min" => 0, "$required"])); ?>

		</div>
	</div>

	<div class="col-12 col-sm-4 mb-3">
		<div class="form-group">
			<?php
			$currentLogo = optional($entity)->logo;
			?>
			<?php if($currentLogo): ?>
				<label class="form-label"><?php echo e(__('Preview')); ?></label>
				<div>
					<img src="<?php echo e(asset($currentLogo)); ?>" alt="<?php echo e(old('client_name', optional($entity)->client_name ?? '')); ?>" style="max-height:64px">
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php if (isset($component)) { $__componentOriginal0ffec7df51857b2f80a6919b7e1f1451 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0ffec7df51857b2f80a6919b7e1f1451 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.library.select2','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('library.select2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0ffec7df51857b2f80a6919b7e1f1451)): ?>
<?php $attributes = $__attributesOriginal0ffec7df51857b2f80a6919b7e1f1451; ?>
<?php unset($__attributesOriginal0ffec7df51857b2f80a6919b7e1f1451); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0ffec7df51857b2f80a6919b7e1f1451)): ?>
<?php $component = $__componentOriginal0ffec7df51857b2f80a6919b7e1f1451; ?>
<?php unset($__componentOriginal0ffec7df51857b2f80a6919b7e1f1451); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Marcel\Music\3.digioh\Modules/ClientLogo/Resources/views/backend/clientlogos/form.blade.php ENDPATH**/ ?>