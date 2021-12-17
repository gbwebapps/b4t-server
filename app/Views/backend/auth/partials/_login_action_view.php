							<form id="authLogin" method="post">
								<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="users_email"><?= lang('backend/auth.form.emailField'); ?></label>
											<input type="text" name="users_email" id="users_email" placeholder="<?= lang('backend/auth.form.emailPlaceholder'); ?>" class="form-control" autofocus>
											<div class="error_users_email text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="users_password"><?= lang('backend/auth.form.passwordField'); ?></label>
											<input type="password" name="users_password" id="users_password" placeholder="<?= lang('backend/auth.form.passwordPlaceholder'); ?>" class="form-control">
											<div class="error_users_password text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 text-left pt-2">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="users_remember_me" name="users_remember_me">
											<label class="form-check-label" for="users_remember_me">
												<?= lang('backend/auth.form.remeberMeCheckBox'); ?>
											</label>
										</div>
									</div>
									<div class="col-md-6 text-right">
										<div class="form-group">
											<button class="btn btn-success" type="submit"><?= lang('backend/global.form.sendButton'); ?></button>
										</div>
									</div>
								</div>
							</form>
							<div class="text-center mt-5">
								<a href="<?= base_url('admin/auth/recovery'); ?>"><?= lang('backend/auth.links.recovery'); ?></a>
							</div>