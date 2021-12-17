<div class="row mt-3" id="row_<?= esc($uniqid); ?>">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="circuits_<?= esc($uniqid); ?>"><?= lang('backend/organizers.form.circuitsField'); ?></label>
					<select name="circuits_<?= esc($uniqid); ?>[]" id="circuits_<?= esc($uniqid); ?>" class="form-control circuit_id" data-uniqid="<?= esc($uniqid); ?>">
						<option value=""><?= lang('backend/organizers.form.circuitsSelect'); ?></option>
						<?php foreach($circuitsDropdown as $circuit): ?>
							<option value="<?= esc($circuit->circuits_id); ?>"><?= esc($circuit->circuits_name); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="error_circuits_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="selectTypes_<?= esc($uniqid); ?>"><?= lang('backend/organizers.form.typesField'); ?></label>
					<select name="types_<?= esc($uniqid); ?>[]" id="selectTypes_<?= esc($uniqid); ?>" class="form-control type_id" data-uniqid="<?= esc($uniqid); ?>" disabled>
						<option value=""><?= lang('backend/organizers.form.typesSelect'); ?></option>
					</select>
				</div>
				<div class="error_types_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="coins_<?= esc($uniqid); ?>"><?= lang('backend/organizers.form.coinsField'); ?></label>
					<input type="text" name="coins_<?= esc($uniqid); ?>[]" id="coins_<?= esc($uniqid); ?>" placeholder="<?= lang('backend/organizers.form.coinsPlaceholder'); ?>" class="form-control" data-uniqid="<?= esc($uniqid); ?>" disabled>
				</div>
				<div class="error_coins_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="form-group">
					<label>&nbsp;</label>
					<button type="button" class="btn btn-danger btn-block font-weight-bold removeCircuitsTypes" data-id="<?= esc($uniqid); ?>"> x </button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<hr>
	</div>
	<input type="hidden" name="uniqid[]; ?>" value="<?= esc($uniqid); ?>">
</div>