							<div class="row">
								<div class="col-md-12">
									<form id="organizersRecovery" method="post">
										<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="organizers_email"><?= lang('frontend/organizers.form.email'); ?></label>
													<input type="text" name="organizers_email" id="organizers_email" placeholder="<?= lang('frontend/organizers.form.placeholderEmail'); ?>" class="form-control" autofocus>
													<div class="error_organizers_email text-danger font-weight-bold pt-1"></div>
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
									</form>
									<div class="text-center mt-5">
										<a href="<?= base_url('organizers/login'); ?>"><?= lang('frontend/global.links.login'); ?></a>
									</div>
								</div>
							</div>