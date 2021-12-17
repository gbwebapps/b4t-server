<?= $this->extend('frontend/template/main_view'); ?> 

<?= $this->section('headerLeft'); ?>
	<div class="mt45rem">
		<h1 class="m-0">
			<i class="fas fa-id-card-alt"></i> <?= lang('frontend/organizers.title.account'); ?>
		</h1>
	</div>
<?= $this->endSection(); ?>

<?= $this->section('headerRight'); ?>
	<div class="text-right pt-2 mt45rem d-none d-md-block">
		&nbsp;
	</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2 mt-3">
						<?= $this->include('frontend/organizers/partials/_sidebar_account_view'); ?>
					</div>
					<div class="col-md-10 mt-3">
						<div class="row">
							<div class="col-md-6">
								<h3><?= lang('frontend/organizers.title.orders'); ?></h3>
							</div>
							<div class="col-md-6"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p>Qui devono andare le seguenti informazioni:</p>
								<p class="font-weight-bold">La lista di tutti gli ordini ricevuti da questo organizzatore</p>
								<p class="font-weight-bold">La possibilità di visualizzare il dettaglio dell'ordine, stampare e scaricare in pdf</p>
							</div>
						</div>
					</div>
				</div>
			</div>

<?= $this->endSection(); ?>