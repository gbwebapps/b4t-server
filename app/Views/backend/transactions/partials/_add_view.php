<div class="row">
	<div class="col-md-4 offset-md-4">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
			</div>
			<form id="addForm" method="post">
				<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="transactions_organizer_id"><?= lang('backend/transactions.form.organizerIdField'); ?></label>
								<select name="transactions_organizer_id" id="transactions_organizer_id" class="form-control">
									<option value=""><?= lang('backend/transactions.form.organizersSelect'); ?></option>
									<?php foreach($organizersDropdown as $organizer): ?>
										<option value="<?= esc($organizer->organizers_id); ?>">
											<?= esc($organizer->organizers_name); ?>
										</option>
									<?php endforeach; ?>
								</select>
								<div class="error_transactions_organizer_id text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="transactions_reason_code"><?= lang('backend/transactions.form.reasonCodeField'); ?></label>
								<select name="transactions_reason_code" id="transactions_reason_code" class="form-control">
									<option value=""><?= lang('backend/transactions.form.reasonCodeSelect'); ?></option>
									<option value="1"><?= lang('backend/transactions.form.reasonDeposit'); ?></option>
									<option value="2"><?= lang('backend/transactions.form.reasonWithdraw'); ?></option>
								</select>
								<div class="error_transactions_reason_code text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="transactions_amount"><?= lang('backend/transactions.form.amountField'); ?></label>
								<input type="text" id="transactions_amount" name="transactions_amount" class="form-control" placeholder="<?= lang('backend/transactions.form.amountPlaceholder'); ?>">
								<div class="error_transactions_amount text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>