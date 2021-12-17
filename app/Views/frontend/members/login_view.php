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
							<i class="fas fa-sign-in-alt"></i> <?= lang('frontend/members.title.login'); ?>
						</h2>
						<?= $this->include('frontend/members/partials/_login_action_view'); ?>
					</div>
				</div>
			</div>

<?= $this->endSection(); ?>