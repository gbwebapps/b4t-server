							<form id="authRecovery" method="post">
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
										<div class="form-group text-center">
											<button class="btn btn-success" type="submit"><?= lang('backend/global.form.sendButton'); ?></button>
										</div>
									</div>
								</div>
							</form>
							<div class="text-center mt-5">
								<a href="<?= base_url('admin/auth/login'); ?>"><?= lang('backend/auth.links.login'); ?></a>
							</div>