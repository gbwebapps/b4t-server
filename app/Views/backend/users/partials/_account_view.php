<form id="resetPassword" class="resetPassword" method="post" data-view="show_all" 
	  data-message="<?= lang('backend/users.messages.resetConfirm', [$user->users_firstname . ' ' . $user->users_lastname]); ?>">
	  <input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
	  <input type="hidden" name="users_id" value="<?= esc($user->users_id); ?>">
</form>

<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card mt-2">
			<form id="accountForm" method="post">
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/global.panels.general'); ?>
						<button type="submit" class="btn btn-danger btn-sm float-right" form="resetPassword">
							<?= lang('backend/users.links.reset'); ?>
						</button>
					</h2>
				</div>
				<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_firstname"><?= lang('backend/users.form.firstnameField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="users_firstname" 
									   name="users_firstname" 
									   value="<?= esc($user->users_firstname); ?>" 
									   placeholder="<?= lang('backend/users.form.firstnamePlaceholder'); ?>">
								<div class="error_users_firstname text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_lastname"><?= lang('backend/users.form.lastnameField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="users_lastname" 
									   name="users_lastname" 
									   value="<?= esc($user->users_lastname); ?>" 
									   placeholder="<?= lang('backend/users.form.lastnamePlaceholder'); ?>">
								<div class="error_users_lastname text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_email"><?= lang('backend/users.form.emailField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="users_email" 
									   name="users_email" 
									   value="<?= esc($user->users_email); ?>" 
									   placeholder="<?= lang('backend/users.form.emailPlaceholder'); ?>">
								<div class="error_users_email text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_phone"><?= lang('backend/users.form.phoneField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="users_phone" 
									   name="users_phone" 
									   value="<?= esc($user->users_phone); ?>" 
									   placeholder="<?= lang('backend/users.form.phonePlaceholder'); ?>">
								<div class="error_users_phone text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="users_image"><?= lang('backend/global.form.image'); ?></label>
								<input type="file" name="users_image" id="users_image" class="form-control-file">
								<div class="error_users_image text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>

					<?php if( ! is_null($user->users_image)): ?>
						<div class="row">
							<div class="col-md-2 offset-md-5">
								<div class="text-center mb-3"><?= lang('backend/users.show.avatar'); ?></div>
								<div class="form-group container-image">
									<img src="<?= base_url('files/' . esc($controller) . '/section/' . esc($user->users_image)); ?>" alt="" class="img-fluid img-thumbnail overAttachement">
									<div class="middle">
										<a href="#" class="removeAvatar" data-id="<?= esc($user->users_id); ?>" 
											data-message="<?= lang('backend/users.messages.avatarYouSure', [$user->users_firstname . ' ' . $user->users_lastname]); ?>" 
											data-view="account">
											<div class="text remove"><?= lang('backend/global.links.remove'); ?></div>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<div class="row">

						<?php 
							if($user->users_status == '2'):
								$status = lang('backend/global.links.inactive');
								$class = ' text-danger';
								// $messageType = 'Active';
							elseif($user->users_status == '1'):
								$status = lang('backend/global.links.active');
								$class = ' text-success';
								// $messageType = 'Inactive';
							endif;
						?>

						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.links.status'); ?></li>
							    <li class="list-group-item font-weight-bold<?= $class; ?>"><?= esc($status); ?></li>
							</ul>
						</div>

						<?php 
							if($user->users_role == '2'):
								$role = lang('backend/users.links.editor');
								$class = ' text-primary';
								// $messageType = 'Active';
							elseif($user->users_role == '1'):
								$role = lang('backend/users.links.admin');
								$class = ' text-info';
								// $messageType = 'Inactive';
							endif;
						?>

						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/users.form.roleField'); ?></li>
							    <li class="list-group-item font-weight-bold<?= $class; ?>"><?= esc($role); ?></li>
							</ul>
						</div>
					</div>
				</div>
				<input type="hidden" name="users_id" value="<?= esc($user->users_id); ?>">
			</form>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.meta_data'); ?></h2>
			</div>
			<div class="card-body last-child">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.date.createdAt'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($user->users_created_at); ?></li>
						</ul>
					</div>
					<?php if(isset($user->users_updated_at) && ! empty($user->users_updated_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.updatedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($user->users_updated_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
