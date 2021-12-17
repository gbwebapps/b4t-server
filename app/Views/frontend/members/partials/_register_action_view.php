							<div class="row">
								<div class="col-md-12">
									<form id="membersRegister" method="post">
										<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="members_firstname"><?= lang('frontend/members.form.firstname'); ?></label>
													<input type="text" name="members_firstname" id="members_firstname" placeholder="<?= lang('frontend/members.form.placeholderFirstname'); ?>" class="form-control" autofocus>
													<div class="error_members_firstname text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="members_lastname"><?= lang('frontend/members.form.lastname'); ?></label>
													<input type="text" name="members_lastname" id="members_lastname" placeholder="<?= lang('frontend/members.form.placeholderLastname'); ?>" class="form-control">
													<div class="error_members_lastname text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="members_address"><?= lang('frontend/members.form.address'); ?></label>
													<input type="text" name="members_address" id="members_address" placeholder="<?= lang('frontend/members.form.placeholderAddress'); ?>" class="form-control">
													<div class="error_members_address text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="members_tax_code"><?= lang('frontend/members.form.tax_code'); ?></label>
													<input type="text" name="members_tax_code" id="members_tax_code" placeholder="<?= lang('frontend/members.form.placeholderTaxCode'); ?>" class="form-control">
													<div class="error_members_tax_code text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="members_email"><?= lang('frontend/members.form.email'); ?></label>
													<input type="text" name="members_email" id="members_email" placeholder="<?= lang('frontend/members.form.placeholderEmail'); ?>" class="form-control">
													<div class="error_members_email text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="members_phone"><?= lang('frontend/members.form.phone'); ?></label>
													<input type="text" name="members_phone" id="members_phone" placeholder="<?= lang('frontend/members.form.placeholderPhone'); ?>" class="form-control">
													<div class="error_members_phone text-danger font-weight-bold pt-1"></div>
												</div>
											</div>
										</div>
										<div class="row mt-5">
											<div class="col-md-12">
												<div class="form-group text-center">
													<button type="submit" class="btn btn-success"><?= lang('frontend/global.buttons.sendData'); ?></button>
												</div>
											</div>
										</div>
									</form>
									<div class="text-center mt-5">
										<a href="<?= base_url('members/login'); ?>"><?= lang('frontend/global.links.login'); ?></a> &bull; 
										<a href="<?= base_url('members/recovery'); ?>"><?= lang('frontend/global.links.recovery'); ?></a>
									</div>
								</div>
							</div>