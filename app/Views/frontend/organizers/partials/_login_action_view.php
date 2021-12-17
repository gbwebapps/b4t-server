							<form id="organizersLogin" method="post">
								<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="organizers_email"><?= lang('frontend/organizers.form.email'); ?></label>
											<input type="text" name="organizers_email" placeholder="<?= lang('frontend/organizers.form.placeholderEmail'); ?>" class="form-control" autofocus>
											<div class="error_organizers_email text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="organizers_password"><?= lang('frontend/organizers.form.password'); ?></label>
											<input type="password" name="organizers_password" placeholder="<?= lang('frontend/organizers.form.placeholderPassword'); ?>" class="form-control">
											<div class="error_organizers_password text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 text-left pt-2">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="organizers_remember_me" name="organizers_remember_me">
											<label class="form-check-label" for="organizers_remember_me">
												<?= lang('frontend/global.labels.remeberMeCheckBox'); ?>
											</label>
										</div>
									</div>
									<div class="col-md-6 text-right">
										<div class="form-group">
											<button class="btn btn-success" type="submit"><?= lang('frontend/global.buttons.sendData'); ?></button>
										</div>
									</div>
								</div>
							</form>
							<div class="text-center mt-5">
								<a href="<?= base_url('organizers/recovery'); ?>"><?= lang('frontend/global.links.recovery'); ?></a>
							</div>