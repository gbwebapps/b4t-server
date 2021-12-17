<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-edit"></i> <?= lang('backend/orders.title.edit'); ?>
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
										<a href="<?= base_url('admin/orders/showAll'); ?>">
											<i class="fas fa-arrow-circle-left"></i> <?= lang('backend/orders.links.backToList') ?>
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
							<?= $this->include('backend/orders/partials/_edit_view'); ?>
						</div>
					</div>
				</div>
			</div>

<?= $this->endSection() ?>