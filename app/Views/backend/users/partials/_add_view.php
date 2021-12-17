<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card mt-2">
			<form id="addForm" method="post">
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
				</div>
				<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
				<div class="card-body last-child">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_firstname"><?= lang('backend/users.form.firstnameField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="users_firstname" 
									   name="users_firstname" 
									   placeholder="<?= lang('backend/users.form.firstnamePlaceholder'); ?>" 
									   autofocus>
								<div class="error_users_firstname text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_lastname"><?= lang('backend/users.form.lastnameField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="users_lastname" 
									   name="users_lastname" 
									   placeholder="<?= lang('backend/users.form.lastnamePlaceholder'); ?>">
								<div class="error_users_lastname text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_email"><?= lang('backend/users.form.emailField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="users_email" 
									   name="users_email" 
									   placeholder="<?= lang('backend/users.form.emailPlaceholder'); ?>">
								<div class="error_users_email text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_phone"><?= lang('backend/users.form.phoneField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="users_phone" 
									   name="users_phone" 
									   placeholder="<?= lang('backend/users.form.phonePlaceholder'); ?>">
								<div class="error_users_phone text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_role"><?= lang('backend/users.form.roleField'); ?></label>
								<select name="users_role" class="form-control">
									<option value=""><?= lang('backend/users.form.roleSelect'); ?></option>
									<option value="1"><?= lang('backend/users.form.roleAdmin'); ?></option>
									<option value="2"><?= lang('backend/users.form.roleEditor'); ?></option>
								</select>
								<div class="error_users_role text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_image"><?= lang('backend/global.form.image'); ?></label>
								<input type="file" name="users_image" id="users_image" class="form-control-file">
								<div class="error_users_image text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
