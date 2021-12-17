<?= $this->extend('backend/template/main_view'); ?> 

<?= $this->section('headerLeft'); ?>
	<h1 class="m-0">
		<i class="fas fa-eye"></i> <?= lang('backend/users.title.show'); ?>
	</h1>
<?= $this->endSection(); ?>

<?= $this->section('headerRight'); ?>
	&nbsp;
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

			<div class="container-fluid mt-3">
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
								<div class="col-md-3">
									<div class="bar_item">
										<a href="<?= base_url('admin/users/edit/' . $user->users_id); ?>">
											<i class="fas fa-edit"></i> <?= lang('backend/users.title.edit') ?>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="content" id="showData">
							<?= $this->include('backend/users/partials/_show_view'); ?>
						</div>
					</div>
				</div>
			</div>

<?= $this->endSection(); ?>