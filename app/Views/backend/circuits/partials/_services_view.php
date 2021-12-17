<div class="row">
	<div class="col-md-6 offset-md-3">
		<label for="services_<?= esc($uniqid); ?>"><?= lang('backend/circuits.form.servicesField'); ?></label>
		<div class="row">
			<?php foreach($services as $service): ?>
				<div class="col-md-12">
					<div class="custom-control custom-checkbox">
						<input class="custom-control-input" 
							   type="checkbox" 
							   id="<?= esc($service->id); ?>" 
							   value="<?= esc($service->id); ?>_<?= esc($service->type_id); ?>" 
							   name="services_<?= esc($uniqid); ?>[]">
						<label for="<?= esc($service->id); ?>" class="custom-control-label"><?= esc($service->service); ?></label>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col-md-12 mt-3">
		<div class="error_services_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
	</div>
</div>