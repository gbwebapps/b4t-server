<div class="list-group">
	<a href="<?= base_url('organizers/account/dashboard'); ?>" class="list-group-item list-group-item-action
		<?= ((isset($controller) && $controller == 'organizers') && (isset($action) && $action == 'dashboard')) ? ' active' : ''; ?>">
			<i class="fas fa-tachometer-alt"></i> <?= lang('frontend/organizers.menu.dashboard'); ?>
		</a>
	<a href="<?= base_url('organizers/account/profile'); ?>" class="list-group-item list-group-item-action
		<?= ((isset($controller) && $controller == 'organizers') && (isset($action) && $action == 'profile')) ? ' active' : ''; ?>">
			<i class="fas fa-user-cog"></i> <?= lang('frontend/organizers.menu.profile'); ?>
		</a>
	<a href="<?= base_url('organizers/account/events'); ?>" class="list-group-item list-group-item-action
		<?= ((isset($controller) && $controller == 'organizers') && (isset($action) && $action == 'events')) ? ' active' : ''; ?>">
			<i class="fas fa-car"></i> <?= lang('frontend/organizers.menu.events'); ?>
		</a>
	<a href="<?= base_url('organizers/account/news'); ?>" class="list-group-item list-group-item-action
		<?= ((isset($controller) && $controller == 'organizers') && (isset($action) && $action == 'news')) ? ' active' : ''; ?>">
			<i class="fas fa-newspaper"></i> <?= lang('frontend/organizers.menu.news'); ?>
		</a>
	<a href="<?= base_url('organizers/account/orders'); ?>" class="list-group-item list-group-item-action
		<?= ((isset($controller) && $controller == 'organizers') && (isset($action) && $action == 'orders')) ? ' active' : ''; ?>">
			<i class="fas fa-file-signature"></i> <?= lang('frontend/organizers.menu.orders'); ?>
		</a>
	<a href="<?= base_url('organizers/logout'); ?>" class="list-group-item list-group-item-action">
		<i class="fas fa-sign-out-alt"></i> <?= lang('frontend/organizers.menu.logout'); ?>
	</a>
</div>