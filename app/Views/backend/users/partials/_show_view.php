<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/users.form.firstnameField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($user->users_firstname); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/users.form.lastnameField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($user->users_lastname); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/users.form.emailField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($user->users_email); ?></li>
						</ul>
					</div>
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/users.form.phoneField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($user->users_phone); ?></li>
						</ul>
					</div>
				</div>
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

					<div class="col-md-6 mt-3">
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

					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/users.form.roleField'); ?></li>
						    <li class="list-group-item font-weight-bold<?= $class; ?>"><?= esc($role); ?></li>
						</ul>
					</div>
				</div>
				<?php if( ! is_null($user->users_image)): ?>
					<div class="row mt-4">
						<div class="col-md-2 offset-md-5">
							<div class="text-center mb-3"><?= lang('backend/users.show.avatar'); ?></div>
							<div class="form-group">
								<img src="<?= base_url('files/' . esc($controller) . '/section/' . esc($user->users_image)); ?>" alt="" width="100%" class="img-fluid img-thumbnail">
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
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
					<?php if(isset($user->users_deleted_at) && ! empty($user->users_deleted_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.deletedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($user->users_deleted_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="show_users_id" data-value="<?= esc($user->users_id); ?>">
