<?= $this->extend('backend/template/main_view'); ?> 

<?= $this->section('headerLeft'); ?>
	<h1 class="m-0">
		<i class="fas fa-eye"></i> <?= lang('backend/contacts.title.show'); ?>
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
										<a href="<?= base_url('admin/contacts'); ?>">
											<i class="fas fa-flag-checkered"></i> <?= lang('backend/contacts.title.main') ?>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="bar_item">
										<a href="<?= base_url('admin/contacts/showAll'); ?>">
											<i class="fas fa-th-list"></i> <?= lang('backend/contacts.title.list') ?>
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
							<?= $this->include('backend/contacts/partials/_show_view'); ?>
						</div>
					</div>
				</div>
			</div>

<?= $this->endSection(); ?>