<?= $this->extend('frontend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
	if(is_null($section->sections_image)):
		$style = null;
		$class = null;
	else:
		$style = ' style = "background-image: url(' . base_url() . '/files/' . $controller . '/section/' . $section->sections_image . '"';
		$class = ' jumbotron-image';
	endif;
?>

			<main role="main">
				<div class="jumbotron jumbotron-fluid<?= $class; ?>"<?= $style; ?>>
					<div class="container pt-5">
						<h1 class="display-4 pt-3"><?= esc($section->sections_title); ?></h1>
						<p><?= esc($section->sections_description); ?></p>
					</div>
				</div>
				<div class="container mt-4">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Circuits</li>
						</ol>
					</nav>
					<div class="row mt-4">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" id="circuits_name" class="form-control" placeholder="Search by circuit name..." autocomplete="off">
								<div class="error_circuits_name text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-4 offset-md-4 text-md-right text-center">
							<div class="form-group">
								<button id="resetSearch" type="button" class="btn btn-link" disabled="true">
									Reset search
								</button>
							</div>
						</div>
					</div>
					<div id="showData"></div>
				</div>
			</main>

<?= $this->endSection() ?>