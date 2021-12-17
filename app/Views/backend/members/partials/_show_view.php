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
						    <li class="list-group-item"><?= lang('backend/members.show.firstname'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($member->members_firstname); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/members.show.lastname'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($member->members_lastname); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/members.show.email'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($member->members_email); ?></li>
						</ul>
					</div>
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/members.show.phone'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($member->members_phone); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">

					<?php 
						if($member->members_status == '2'):
							$status = lang('backend/global.links.inactive');
							$class = ' text-danger';
							// $messageType = 'Active';
						elseif($member->members_status == '1'):
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
				</div>
				<?php if( ! is_null($member->members_image)): ?>
					<div class="row mt-4">
						<div class="col-md-2 offset-md-5">
							<div class="text-center mb-3"><?= lang('backend/members.show.avatar'); ?></div>
							<div class="form-group">
								<img src="<?= base_url('files/' . esc($controller) . '/section/' . esc($member->members_image)); ?>" alt="" width="100%" class="img-fluid img-thumbnail">
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
						    <li class="list-group-item font-weight-bold"><?= esc($member->members_created_at); ?></li>
						</ul>
					</div>
					<?php if(isset($member->members_updated_at) && ! empty($member->members_updated_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.updatedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($member->members_updated_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
					<?php if(isset($member->members_deleted_at) && ! empty($member->members_deleted_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.deletedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($member->members_deleted_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="show_members_id" data-value="<?= esc($member->members_id); ?>">
