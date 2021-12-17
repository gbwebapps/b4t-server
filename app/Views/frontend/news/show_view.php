<?= $this->extend('frontend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

			<main role="main">
				<div class="jumbotron jumbotron-fluid">
					<div class="container pt-5">
						<h1 class="display-4 pt-3">VALENTINO LASCIA LE CORSE</h1>
					</div>
				</div>
				<div class="container mt-4">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
							<li class="breadcrumb-item"><a href="<?= base_url('news'); ?>">News</a></li>
							<li class="breadcrumb-item active" aria-current="page">Valentino lascia le corse</li>
						</ol>
					</nav>
					<div class="row">
						<div class="col-md-6">
							<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
							<div class="row mt-3">
								<div class="col-md-3 col-xs-6">
									<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
								</div>
								<div class="col-md-3 col-xs-6">
									<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
								</div>
								<div class="col-md-3">
									<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
								</div>
								<div class="col-md-3">
									<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-3">
									<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
								</div>
								<div class="col-md-3">
									<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
								</div>
								<div class="col-md-3">
									<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
								</div>
								<div class="col-md-3">
									<img src="<?= base_url('images/1.jpg'); ?>" class="img-thumbnail" title="Valentino lascia le corse" alt="Valentino lascia le corse">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<h6 class="font-weight-bold">Lignano Sabbiadoro - 23 Ottobre 2018 - Scritto da: Admin</h6><br>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Maiores, ducimus aperiam dolor aspernatur iusto fugit expedita quaerat voluptatibus hic ullam voluptatem quisquam fugiat iste ratione deleniti ab quibusdam totam obcaecati? Lorem ipsum dolor sit amet consectetur adipisicing, elit.<br><br>Commodi sed, ducimus magnam vel perspiciatis voluptatem molestias a reiciendis perferendis cumque placeat aliquid suscipit impedit voluptatum nisi ut, at cupiditate minima. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, nam totam optio quo quae omnis, consequatur, consequuntur sapiente dolorem voluptatibus aliquam dicta repellat iusto libero suscipit perspiciatis itaque mollitia voluptate? Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><br>Quam, ipsum? Blanditiis deserunt ipsum sapiente delectus quia officiis sunt incidunt velit. Veritatis nulla assumenda nam perferendis commodi nisi officiis, debitis aut.</p>
						</div>
					</div>
					<hr class="featurette-divider-2">
					<p class="text-center">qui potrebbe essere la sezione commenti</p>
					<hr class="featurette-divider-2">
				</div>
			</main>

<?= $this->endSection() ?>