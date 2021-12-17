<?= $this->extend('frontend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

			<main role="main">
				<div class="jumbotron jumbotron-fluid">
					<div class="container pt-5">
						<h1 class="display-4 pt-3"><?= esc($items['record']->circuits_name); ?></h1>
					</div>
				</div>
				<div class="container mt-4">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
							<li class="breadcrumb-item"><a href="<?= base_url('circuits'); ?>">Circuits</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?= esc($items['record']->circuits_name); ?></li>
						</ol>
					</nav>
					<div class="row">
						<div class="col-md-6">

							<?php $cover = (isset($files['cover']->files_name) ? $files['cover']->files_name : 'nopic.jpg'); ?>
							<img src="<?= base_url('files/' . $controller . '/medium/' . $cover); ?>" 
								 class="img-thumbnail" 
								 title="<?= esc($items['record']->circuits_name); ?>" 
								 alt="<?= esc($items['record']->circuits_name); ?>">

							<div class="row mt-3">
								<?php foreach($files['images'] as $file): ?>
									<div class="col-md-3 col-xs-6">
										<img src="<?= base_url('files/' . $controller . '/small/' . $file->files_name); ?>" 
											 class="img-thumbnail" 
											 title="<?= esc($items['record']->circuits_name); ?>" 
											 alt="<?= esc($items['record']->circuits_name); ?>">
									</div>
								<?php endforeach; ?>
							</div>
							
						</div>
						<div class="col-md-6">

							<h6 class="font-weight-bold">Descrizione</h6>
							<p><?= esc($items['record']->circuits_long_description); ?></p>

							<h6 class="font-weight-bold">Orari</h6>
							<p><?= esc($items['record']->circuits_opening_time); ?></p>

							<div class="text-center">
								<h6 class="font-weight-bold">Indirizzo</h6>
								<p><?= esc($items['record']->circuits_address); ?></p>
							</div>

							<div class="row">

								<div class="col-md-4 text-center">
									<h6 class="font-weight-bold">Telefono</h6>
									<p><?= esc($items['record']->circuits_phone); ?></p>
								</div>

								<div class="col-md-4 text-center">
									<h6 class="font-weight-bold">Email</h6>
									<p><?= esc($items['record']->circuits_email); ?></p>
								</div>

								<div class="col-md-4 text-center">
									<h6 class="font-weight-bold">Sito</h6>
									<p><a href="https://www.autodromovarano.it/" target="_blank">autodromovarano.it</a></p>
								</div>

							</div>	

						</div>
					</div>
					<div id="circuits_sub_id" data-id="<?= esc($items['record']->circuits_id); ?>"></div>
					<hr class="featurette-divider-2">
					<div class="row">
						<div class="col-md-12">
							<h1 class="mb-3">Events</h1>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" id="circuits_events_name" class="form-control" placeholder="Search by event name..." autocomplete="off">
								<div class="error_events_name text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-4 offset-md-4 text-md-right text-center">
							<div class="form-group">
								<button id="resetSubEventsSearch" type="button" class="btn btn-link" disabled="true">
									Reset search
								</button>
							</div>
						</div>
					</div>
					<div id="showEventsData"></div>
				</div>
			</main>

<?= $this->endSection() ?>