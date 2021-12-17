<div class="row mt-3" id="row_<?= esc($subUniqid); ?>">
	<?= esc($subUniqid); ?>
	<div class="col-md-8 offset-md-2">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="services_<?= esc($subUniqid); ?>"><?= lang('backend/events.form.servicesField'); ?></label>
					<select name="services_<?= esc($subUniqid); ?>[]" id="services_<?= esc($subUniqid); ?>" class="form-control" data-subuniqid="<?= esc($subUniqid); ?>">
						<option value=""><?= lang('backend/events.form.servicesSelect'); ?></option>
						<?php foreach($services as $service): ?>
							<option value="<?= $service->id; ?>"><?= $service->service; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="error_services_<?= esc($subUniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="services_prices_<?= esc($subUniqid); ?>"><?= lang('backend/events.form.servicesPricesField'); ?></label>
					<input type="text" name="services_prices_<?= esc($subUniqid); ?>[]" id="services_prices_<?= esc($subUniqid); ?>" class="form-control" 
					placeholder="<?= lang('backend/events.form.servicesPricesPlaceholder'); ?>" autocomplete="off" data-subuniqid="<?= esc($subUniqid); ?>">
				</div>
				<div class="error_services_prices_<?= esc($subUniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="mandatory_<?= esc($subUniqid); ?>"><?= lang('backend/events.form.mandatoryField'); ?></label>
					<select name="mandatory_<?= esc($subUniqid); ?>[]" id="mandatory_<?= esc($subUniqid); ?>" class="form-control" data-subuniqid="<?= esc($subUniqid); ?>">
						<option value="0" selected><?= lang('backend/events.form.mandatorySelectNo'); ?></option>
						<option value="1"><?= lang('backend/events.form.mandatorySelectYes'); ?></option>
					</select>
				</div>
				<div class="error_mandatory_<?= esc($subUniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="form-group text-center">
					<label>&nbsp;</label>
					<button type="button" class="btn btn-warning font-weight-bold removeServices" data-subuniqid="<?= esc($subUniqid); ?>"> 
						<?= lang('backend/events.buttons.removeService'); ?> <?= esc($subUniqid); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<hr>
	</div>
	<input type="hidden" name="subUniqid[]; ?>" value="<?= esc($subUniqid); ?>">
</div>