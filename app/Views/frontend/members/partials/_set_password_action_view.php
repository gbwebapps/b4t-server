							<div class="row">
								<div class="col-md-12">
									<form id="membersSetPassword" method="post">
										<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="members_password"><?= lang('frontend/members.form.newPasswordField'); ?></label>
													<input type="password" name="members_password" placeholder="<?= lang('frontend/members.form.newPasswordPlaceholder'); ?>" class="form-control" autofocus>
													<div class="error_members_password text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="members_confirmation_password"><?= lang('frontend/members.form.confirmationPasswordField'); ?></label>
													<input type="password" name="members_confirmation_password" placeholder="<?= lang('frontend/members.form.confirmationPasswordPlaceholder'); ?>" class="form-control">
													<div class="error_members_confirmation_password text-danger font-weight-bold pt-1"></div>
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
										<input type="hidden" name="members_code" value="<?= esc($token); ?>">
										<div class="error_members_code text-danger font-weight-bold pt-1"></div>
									</form>
									<div class="text-center mt-5">
										<a href="<?= base_url('members/login'); ?>"><?= lang('frontend/global.links.login'); ?></a> &bull; 
										<a href="<?= base_url('members/recovery'); ?>"><?= lang('frontend/global.links.recovery'); ?></a> &bull; 
										<a href="<?= base_url('members/register'); ?>"><?= lang('frontend/global.links.register'); ?></a>
									</div>
								</div>
							</div>