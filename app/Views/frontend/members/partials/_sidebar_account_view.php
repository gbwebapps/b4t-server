<div class="list-group">
	<a href="<?= base_url('members/account/dashboard'); ?>" class="list-group-item list-group-item-action
		<?= ((isset($controller) && $controller == 'members') && (isset($action) && $action == 'dashboard')) ? ' active' : ''; ?>">
			<i class="fas fa-tachometer-alt"></i> <?= lang('frontend/members.menu.dashboard'); ?>
		</a>
	<a href="<?= base_url('members/account/profile'); ?>" class="list-group-item list-group-item-action
		<?= ((isset($controller) && $controller == 'members') && (isset($action) && $action == 'profile')) ? ' active' : ''; ?>">
			<i class="fas fa-user-cog"></i> <?= lang('frontend/members.menu.profile'); ?>
		</a>
	<a href="<?= base_url('members/account/orders'); ?>" class="list-group-item list-group-item-action
		<?= ((isset($controller) && $controller == 'members') && (isset($action) && $action == 'orders')) ? ' active' : ''; ?>">
			<i class="fas fa-file-signature"></i> <?= lang('frontend/members.menu.orders'); ?>
		</a>
	<a href="<?= base_url('members/logout'); ?>" class="list-group-item list-group-item-action">
		<i class="fas fa-sign-out-alt"></i> <?= lang('frontend/members.menu.logout'); ?>
	</a>
</div>