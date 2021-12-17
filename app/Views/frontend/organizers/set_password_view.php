<?= $this->extend('frontend/template/main_view'); ?> 

<?= $this->section('headerLeft'); ?>
<?= $this->endSection(); ?>

<?= $this->section('headerRight'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

			<div class="container-fluid h-100">
				<div class="row align-items-center h-100">
					<div class="col-md-4 offset-md-4">
						<h2 class="text-center mb-5">
							<i class="fas fa-key"></i> <?= lang('frontend/organizers.title.setPassword'); ?>
						</h2>
						<?= $this->include('frontend/organizers/partials/_set_password_action_view'); ?>
					</div>
				</div>
			</div>

<?= $this->endSection(); ?>