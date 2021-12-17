<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
			</div>
			<form id="editForm" method="post">
				<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="orders_name"><?= lang('backend/orders.form.orderField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="orders_name" 
									   name="orders_name" 
									   placeholder="<?= lang('backend/orders.form.orderPlaceholder'); ?>" 
									   autofocus>
								<div class="error_orders_name text-danger text-sm text-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>