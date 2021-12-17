<?= $this->extend('frontend/template/main_view'); ?> 

<?= $this->section('headerLeft'); ?>
<?= $this->endSection(); ?>

<?= $this->section('headerRight'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

			<div class="container-fluid h-100">
				<div class="row align-items-center h-100">
					<div class="col-md-6 offset-md-3">
						<h2 class="text-center mb-5">
							<i class="fas fa-file-signature"></i> <?= lang('frontend/members.title.register'); ?>
						</h2>
						<?= $this->include('frontend/members/partials/_register_action_view'); ?>
					</div>
				</div>
			</div>

<?= $this->endSection(); ?>