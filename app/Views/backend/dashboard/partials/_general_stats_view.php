<div class="row">
	<div class="col-md-6 col-lg-3">
		<!-- small card -->
		<div class="small-box bg-info">
			<div class="inner">
				<h4>
					<?= lang('backend/dashboard.labels.general.active'); ?> <?= ($circuits); ?> 
				</h4>
				<p>Circuits</p>
			</div>
			<div class="icon"><i class="nav-icon fas fa-flag-checkered"></i></div>
			<a href="<?= base_url('admin/circuits/showAll'); ?>" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-md-6 col-lg-3">
		<!-- small card -->
		<div class="small-box bg-success">
			<div class="inner">
				<h4>
					<?= lang('backend/dashboard.labels.general.active'); ?> <?= ($organizers); ?> 
				</h4>
				<p>Organizers</p>
			</div>
			<div class="icon"><i class="nav-icon fas fa-store"></i></div>
			<a href="<?= base_url('admin/organizers/showAll'); ?>" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-md-6 col-lg-3">
		<!-- small card -->
		<div class="small-box bg-warning">
			<div class="inner">
				<h4>
					<?= lang('backend/dashboard.labels.general.active'); ?> <?= ($events - $events_inactivated); ?> 
					&bull; <?= lang('backend/dashboard.labels.general.inactivated'); ?> <?= $events_inactivated; ?>
				</h4>
				<p>Events</p>
			</div>
			<div class="icon"><i class="fas fa-car"></i></div>
			<a href="<?= base_url('admin/events/showAll'); ?>" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-md-6 col-lg-3">
		<!-- small card -->
		<div class="small-box bg-danger">
			<div class="inner">
				<h4>
					<?= lang('backend/dashboard.labels.general.active'); ?> <?= ($members - $members_inactivated); ?> 
					&bull; <?= lang('backend/dashboard.labels.general.inactivated'); ?> <?= $members_inactivated; ?>
				</h4>
				<p>Members</p>
			</div>
			<div class="icon"><i class="fas fa-walking"></i></div>
			<a href="<?= base_url('admin/members/showAll'); ?>" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-md-6 col-lg-3">
		<!-- small card -->
		<div class="small-box bg-danger">
			<div class="inner">
				<h4>
					<?= lang('backend/dashboard.labels.general.active'); ?> <?= ($transactions); ?> 
				</h4>
				<p>Transactions</p>
			</div>
			<div class="icon"><i class="fas fa-coins"></i></div>
			<a href="<?= base_url('admin/transactions/showAll'); ?>" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-md-6 col-lg-3">
		<!-- small card -->
		<div class="small-box bg-warning">
			<div class="inner">
				<h4>
					<?= lang('backend/dashboard.labels.general.active'); ?> <?= $news; ?> 
					&bull; <?= lang('backend/dashboard.labels.general.inactivated'); ?> <?= $news_inactivated; ?>
				</h4>
				<p>News</p>
			</div>
			<div class="icon"><i class="fas fa-newspaper"></i></div>
			<a href="<?= base_url('admin/news/showAll'); ?>" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<div class="col-md-6 col-lg-3">
		<!-- small card -->
		<div class="small-box bg-success">
			<div class="inner">
				<h4>
					<?= lang('backend/dashboard.labels.general.active'); ?> <?= $orders; ?>
				</h4>
				<p>Orders</p>
			</div>
			<div class="icon"><i class="fas fa-file-signature"></i></div>
			<a href="<?= base_url('admin/orders/showAll'); ?>" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<?php if($currentUser->users_role == 1): ?>
		<div class="col-md-6 col-lg-3">
			<!-- small card -->
			<div class="small-box bg-info">
				<div class="inner">
					<h4>
						<?= lang('backend/dashboard.labels.general.active'); ?> <?= $users; ?> &bull; <?= lang('backend/dashboard.labels.general.inactivated'); ?> <?= $users_inactivated; ?>
					</h4>
					<p>Users</p>
				</div>
				<div class="icon"><i class="fas fa-users"></i></div>
				<a href="<?= base_url('admin/users/showAll'); ?>" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
	<?php endif; ?>
</div>