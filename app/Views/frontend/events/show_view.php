<?= $this->extend('frontend/template/main_view'); ?> 

<?= $this->section('headerLeft'); ?>
<?= $this->endSection(); ?>

<?= $this->section('headerRight'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

			<main role="main">
				<div class="jumbotron jumbotron-fluid">
					<div class="container pt-5">
						<h1 class="display-4 pt-3"><?= esc($items['record']->events_name); ?></h1>
					</div>
				</div>
				<div class="container mt-4">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
							<li class="breadcrumb-item"><a href="<?= base_url('events'); ?>">Events</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?= esc($items['record']->events_name); ?></li>
						</ol>
					</nav>
					<div class="row">
						<div class="col-md-6">

							<?php $cover = (isset($files['cover']->files_name) ? $files['cover']->files_name : 'nopic.jpg'); ?>
							<img src="<?= base_url('files/' . $controller . '/medium/' . $cover); ?>" 
								 class="img-thumbnail" 
								 title="<?= esc($items['record']->events_name); ?>" 
								 alt="<?= esc($items['record']->events_name); ?>">

							<div class="row mt-3">
								<?php foreach($files['images'] as $file): ?>
									<div class="col-md-3 col-xs-6">
										<img src="<?= base_url('files/' . $controller . '/small/' . $file->files_name); ?>" 
											 class="img-thumbnail" 
											 title="<?= esc($items['record']->events_name); ?>" 
											 alt="<?= esc($items['record']->events_name); ?>">
									</div>
								<?php endforeach; ?>
							</div>
							
						</div>
						<div class="col-md-6">

							<h6 class="font-weight-bold">Descrizione</h6>
							<p><?= esc($items['record']->events_long_description); ?></p>

							<div class="row">

								

							</div>	

						</div>
					</div>
					<hr class="featurette-divider-2">
					<p class="text-center">qui potrebbe essere la sezione commenti</p>
					<hr class="featurette-divider-2">
				</div>
			</main>

<?= $this->endSection(); ?>