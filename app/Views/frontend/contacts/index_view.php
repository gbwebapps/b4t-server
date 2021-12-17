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
				<div class="container">
					<div class="row mt-4">
						<div class="col-md-12">
							<div class="content" id="showData">
								<?= $this->include('frontend/contacts/partials/_index_action_view'); ?>
							</div>
						</div>
					</div>
				</div>
			</main>

<?= $this->endSection() ?>