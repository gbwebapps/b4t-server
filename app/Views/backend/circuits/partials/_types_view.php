<div class="row mt-3" id="row_<?= esc($uniqid); ?>">
	<div class="col-md-6 offset-md-3">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="types_<?= esc($uniqid); ?>"><?= lang('backend/circuits.form.typesField'); ?></label>
					<select name="types_<?= esc($uniqid); ?>[]" id="types_<?= esc($uniqid); ?>" class="form-control type_id" data-uniqid="<?= esc($uniqid); ?>">
						<option value=""><?= lang('backend/circuits.form.typesSelect'); ?></option>
						<?php foreach($typesDropdown as $type): ?>
							<option value="<?= esc($type->id); ?>"><?= esc($type->type); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-12 mt-3">
				<div class="error_types_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
		</div>
		<div class="selectServices_<?= esc($uniqid); ?>"></div>
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="form-group">
					<label>&nbsp;</label>
					<button type="button" class="btn btn-danger btn-block font-weight-bold removeTypesServices" data-id="<?= esc($uniqid); ?>"> x </button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<hr>
	</div>
	<input type="hidden" name="uniqid[]; ?>" value="<?= esc($uniqid); ?>">
</div>