							<form id="membersLogin" method="post">
								<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="members_email"><?= lang('frontend/members.form.email'); ?></label>
											<input type="text" name="members_email" placeholder="<?= lang('frontend/members.form.placeholderEmail'); ?>" class="form-control" autofocus>
											<div class="error_members_email text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="members_password"><?= lang('frontend/members.form.password'); ?></label>
											<input type="password" name="members_password" placeholder="<?= lang('frontend/members.form.placeholderPassword'); ?>" class="form-control">
											<div class="error_members_password text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 text-left pt-2">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="members_remember_me" name="members_remember_me">
											<label class="form-check-label" for="members_remember_me">
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
								<a href="<?= base_url('members/recovery'); ?>"><?= lang('frontend/global.links.recovery'); ?></a> &bull; 
								<a href="<?= base_url('members/register'); ?>"><?= lang('frontend/global.links.register'); ?></a>
							</div>