							<div class="row">
								<div class="col-md-12">
									<form id="organizersSetPassword" method="post">
										<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="organizers_password"><?= lang('frontend/organizers.form.newPasswordField'); ?></label>
													<input type="password" name="organizers_password" placeholder="<?= lang('frontend/organizers.form.newPasswordPlaceholder'); ?>" class="form-control" autofocus>
													<div class="error_organizers_password text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="organizers_confirmation_password"><?= lang('frontend/organizers.form.confirmationPasswordField'); ?></label>
													<input type="password" name="organizers_confirmation_password" placeholder="<?= lang('frontend/organizers.form.confirmationPasswordPlaceholder'); ?>" class="form-control">
													<div class="error_organizers_confirmation_password text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
										</div>
										<div class="row mt-5">
											<div class="col-md-12">
												<div class="form-group text-center">
													<button class="btn btn-success"><?= lang('frontend/global.buttons.sendData'); ?></button>
												</div>
											</div>
										</div>
										<input type="hidden" name="organizers_code" value="<?= esc($token); ?>">
										<div class="error_organizers_code text-danger font-weight-bold pt-1"></div>
									</form>
									<div class="text-center mt-5">
										<a href="<?= base_url('organizers/login'); ?>"><?= lang('frontend/global.links.login'); ?></a> &bull; 
										<a href="<?= base_url('organizers/recovery'); ?>"><?= lang('frontend/global.links.recovery'); ?></a>
									</div>
								</div>
							</div>