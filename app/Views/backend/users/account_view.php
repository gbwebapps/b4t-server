<?= $this->extend('backend/template/main_view'); ?> 

<?= $this->section('headerLeft'); ?>
	<h1 class="m-0">
		<i class="fas fa-user"></i> <?= lang('backend/users.title.account'); ?>
	</h1>
<?= $this->endSection(); ?>

<?= $this->section('headerRight'); ?>
	&nbsp;
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

			<div class="container-fluid mt-3">

				<?php if($currentUser->users_role == 1): ?>

					<div class="row">
						<div class="col-md-12">
							<div class="card bar">
								<div class="row">
									<div class="col-md-3">
										<div class="bar_item_first">
											<a href="<?= base_url('admin/users/showAll'); ?>">
												<i class="fas fa-th-list"></i> <?= lang('backend/users.title.list') ?>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php endif; ?>

				<div class="row">
					<div class="col-md-12">
						<div class="content" id="showData">
							<?= $this->include('backend/users/partials/_account_view'); ?>
						</div>
					</div>
				</div>

			</div>

<?= $this->endSection(); ?>