							<form id="authSetPassword" method="post">
								<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="users_password"><?= lang('backend/auth.form.newPasswordField'); ?></label>
											<input type="password" name="users_password" id="users_password" 
												placeholder="<?= lang('backend/auth.form.newPasswordPlaceholder'); ?>" class="form-control" autofocus>
											<div class="error_users_password text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="users_confirmation_password"><?= lang('backend/auth.form.confirmationPasswordField'); ?></label>
											<input type="password" name="users_confirmation_password" id="users_confirmation_password" placeholder="<?= lang('backend/auth.form.confirmationPasswordPlaceholder'); ?>" class="form-control">
											<div class="error_users_confirmation_password text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group text-center">
											<button class="btn btn-success" type="submit"><?= lang('backend/global.form.sendButton'); ?></button>
										</div>
										<input type="hidden" name="users_code" value="<?= esc($token); ?>">
										<div class="error_users_code text-danger font-weight-bold pt-1"></div>
									</div>
								</div>
							</form>
							<div class="text-center mt-5">
								<a href="<?= base_url('admin/auth/login'); ?>"><?= lang('backend/auth.links.login'); ?></a> &bull; 
								<a href="<?= base_url('admin/auth/recovery'); ?>"><?= lang('backend/auth.links.recovery'); ?></a>
							</div>