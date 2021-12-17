<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-home"></i> <?= lang('backend/home.title.main'); ?>
	</h1>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
	&nbsp;
<?= $this->endSection() ?>

<?= $this->section('content') ?>

			<div class="container mt-3">
				<div class="row">
					<div class="col-md-12">
						<div class="accordion" id="accordionHome">
							<div class="card">
							    <div class="card-header" id="headingHeader">
							        <h5 class="mb-0">
							            <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseHeader" aria-expanded="true" aria-controls="collapseHeader">
							                <i class="fas fa-heading"></i> <?= lang('backend/global.title.header'); ?>
							            </a>
							        </h5>
							    </div>
							    <div id="collapseHeader" class="collapse" aria-labelledby="headingHeader" data-parent="#accordionHome">
							        <div class="card-body">
							            <div id="Header">
							            	<?= $this->include('backend/template/sections/_header_view'); ?>
							            </div>
							        </div>
							    </div>
							</div>
						    <div class="card">
						        <div class="card-header" id="headingMetaTags">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseMetaTags" aria-expanded="true" aria-controls="collapseMetaTags">
						                    <i class="fas fa-globe"></i> <?= lang('backend/global.title.metaTags'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseMetaTags" class="collapse" aria-labelledby="headingMetaTags" data-parent="#accordionHome">
						            <div class="card-body">
						                <div id="MetaTags">
						                	<?= $this->include('backend/template/sections/_meta_tags_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>
					</div>
					<div class="col-md-12 text-right mt-2">
						<?= lang('backend/global.date.updatedAt'); ?> : <span id="sections_updated_at"><?= esc($section->sections_updated_at); ?></span>
					</div>
				</div>
			</div>

<?= $this->endSection() ?>