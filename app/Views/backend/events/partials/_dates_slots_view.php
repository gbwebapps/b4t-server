<script>
	$("#dates_<?= esc($uniqid); ?>").datetimepicker({
	    defaultDate: "+1w",
	    changeMonth: false,
	    numberOfMonths: 1, 
	    dateFormat: "yy-mm-dd", 
	    timeFormat: 'HH:mm', 
	});
</script>

<div class="row mt-3" id="row_<?= esc($uniqid); ?>">
	<div class="col-md-12">
		<?= esc($uniqid); ?>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="dates_<?= esc($uniqid); ?>"><?= lang('backend/events.form.dateField'); ?></label>
					<input type="text" name="dates_<?= esc($uniqid); ?>[]" id="dates_<?= esc($uniqid); ?>" class="form-control" 
					placeholder="<?= lang('backend/events.form.datePlaceholder'); ?>" autocomplete="off" data-uniqid="<?= esc($uniqid); ?>">
				</div>
				<div class="error_dates_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="slots_<?= esc($uniqid); ?>"><?= lang('backend/events.form.slotField'); ?></label>
					<select name="slots_<?= esc($uniqid); ?>[]" id="slots_<?= esc($uniqid); ?>" class="form-control" data-uniqid="<?= esc($uniqid); ?>">
						<option value=""><?= lang('backend/events.form.slotSelect'); ?></option>
						<?php foreach($slots as $slot): ?>
							<option value="<?= $slot->id; ?>"><?= $slot->slot; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="error_slots_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="qty_<?= esc($uniqid); ?>"><?= lang('backend/events.form.quantityField'); ?></label>
					<input type="text" name="qty_<?= esc($uniqid); ?>[]" id="qty_<?= esc($uniqid); ?>" class="form-control" 
					placeholder="<?= lang('backend/events.form.quantityPlaceholder'); ?>" data-uniqid="<?= esc($uniqid); ?>">
				</div>
				<div class="error_qty_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="prices_<?= esc($uniqid); ?>"><?= lang('backend/events.form.priceField'); ?></label>
					<input type="text" name="prices_<?= esc($uniqid); ?>[]" id="prices_<?= esc($uniqid); ?>" class="form-control" 
					placeholder="<?= lang('backend/events.form.pricePlaceholder'); ?>" data-uniqid="<?= esc($uniqid); ?>">
				</div>
				<div class="error_prices_<?= esc($uniqid); ?> text-danger font-weight-bold text-center pt-1"></div>
			</div>
		</div>
	    <div class="row">
    	    <div class="col-md-12 text-center">
    			<button type="button" class="btn btn-link getServices" data-uniqid="<?= esc($uniqid); ?>">
    				<i class="fas fa-plus-circle"></i> <?= lang('backend/events.buttons.addServices'); ?>
    			</button>
    	     </div>
    	     <div class="col-md-12">
    	     	<hr>
    	     </div>
    		<div class="col-md-12">
    			<div class="selectServices"></div>
    		</div>
		    <div class="col-md-12 text-center">
				<button type="button" class="btn btn-link getServices" data-uniqid="<?= esc($uniqid); ?>">
					<i class="fas fa-plus-circle"></i> <?= lang('backend/events.buttons.addServices'); ?>
				</button>
		    </div>
		    <div class="col-md-12">
		    	<input type="hidden" name="services">
		    	<div class="error_services text-danger font-weight-bold text-center pt-1"></div>
		    </div>
	    </div>
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="form-group">
					<label>&nbsp;</label>
					<button type="button" class="btn btn-danger btn-block font-weight-bold removeDatesSlots" data-uniqid="<?= esc($uniqid); ?>"> 
						<?= lang('backend/events.buttons.removeDatesSlots'); ?> <?= esc($uniqid); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<hr>
	</div>
	<input type="hidden" name="uniqid[]; ?>" value="<?= esc($uniqid); ?>">
</div>