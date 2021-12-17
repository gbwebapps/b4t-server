<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-tachometer-alt"></i> <?= lang('backend/dashboard.title.main'); ?>
	</h1>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
	&nbsp;
<?= $this->endSection() ?>

<?= $this->section('content') ?>

				<div class="container-fluid mt-3">
					<div class="row">
						<div class="col-md-12">
							<div class="content" id="showGeneralStats"></div>
						</div>
						<div class="col-md-2 offset-md-5">
							<button class="btn btn-info btn-block getGeneralStats">Refresh</button>
						</div>
					</div>
				</div>

<?= $this->endSection() ?>