<?= $this->extend('backend/template/main_view'); ?> 

<?= $this->section('headerLeft'); ?>
<?= $this->endSection(); ?>

<?= $this->section('headerRight'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

			<div class="container-fluid h-100">
				<div class="row align-items-center h-100">
					<div class="col-md-4 offset-md-4">
						<h2 class="text-center mb-3">
							<i class="fas fa-lock"></i> <?= lang('backend/auth.title.recovery'); ?>
						</h2>
						<?= $this->include('backend/auth/partials/_recovery_action_view'); ?>
					</div>
				</div>
			</div>

<?= $this->endSection(); ?>