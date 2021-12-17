							<div class="row">
								<div class="col-md-12">
									<form id="membersRecovery" method="post">
										<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="members_email"><?= lang('frontend/members.form.email'); ?></label>
													<input type="text" name="members_email" id="members_email" placeholder="<?= lang('frontend/members.form.placeholderEmail'); ?>" class="form-control" autofocus>
													<div class="error_members_email text-danger font-weight-bold pt-1"></div>
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
										<a href="<?= base_url('members/login'); ?>"><?= lang('frontend/global.links.login'); ?></a> &bull; 
										<a href="<?= base_url('members/register'); ?>"><?= lang('frontend/global.links.register'); ?></a>
									</div>
								</div>
							</div>