<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-edit"></i> <?= lang('backend/organizers.title.edit'); ?>
	</h1>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
	&nbsp;
<?= $this->endSection() ?>

<?= $this->section('content') ?>

			<div class="container-fluid mt-3">
				<div class="row">
					<div class="col-md-12">
						<div class="card bar">
							<div class="row">
								<div class="col-md-3">
									<div class="bar_item_first">
										<a href="<?= base_url('admin/organizers'); ?>">
											<i class="fas fa-store"></i> <?= lang('backend/organizers.title.main') ?>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="bar_item">
										<a href="<?= base_url('admin/organizers/showAll'); ?>">
											<i class="fas fa-th-list"></i> <?= lang('backend/organizers.title.list') ?>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="bar_item">
										<a href="<?= base_url('admin/organizers/show/' . $organizer->organizers_id); ?>">
											<i class="fas fa-eye"></i> <?= lang('backend/organizers.title.show') ?>
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
							<?= $this->include('backend/organizers/partials/_edit_view'); ?>
						</div>
					</div>
				</div>
			</div>

<?= $this->endSection() ?>