<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-store"></i> <?= lang('backend/organizers.title.main'); ?>
	</h1>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
	&nbsp;
<?= $this->endSection() ?>

<?= $this->section('content') ?>

			<div class="container-fluid mt-3">
				<div class="row">
					<div class="col-md-12">
						<div class="card bar">
							<div class="row">
								<div class="col-md-3">
									<div class="bar_item_first">
										<a href="<?= base_url('admin/organizers/showAll'); ?>">
											<i class="fas fa-th-list"></i> <?= lang('backend/organizers.title.list') ?>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="bar_item">
										<a href="<?= base_url('admin/organizers/add'); ?>">
											<i class="fas fa-plus-circle"></i> <?= lang('backend/organizers.title.add') ?>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container mt-3">
				<div class="row">
					<div class="col-md-12">
						<div class="accordion" id="accordionOrganizers">
							<div class="card">
							    <div class="card-header" id="headingHeader">
							        <h5 class="mb-0">
							            <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseHeader" aria-expanded="true" aria-controls="collapseHeader">
							                <i class="fas fa-heading"></i> <?= lang('backend/global.title.header'); ?>
							            </a>
							        </h5>
							    </div>
							    <div id="collapseHeader" class="collapse" aria-labelledby="headingHeader" data-parent="#accordionOrganizers">
							        <div class="card-body">
							            <div id="Header">
							            	<?= $this->include('backend/template/sections/_header_view'); ?>
							            </div>
							        </div>
							    </div>
							</div>
							<div class="card">
							    <div class="card-header" id="headingImage">
							        <h5 class="mb-0">
							            <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseImage" aria-expanded="true" aria-controls="collapseImage">
							                <i class="fas fa-image"></i> <?= lang('backend/global.title.image'); ?>
							            </a>
							        </h5>
							    </div>
							    <div id="collapseImage" class="collapse" aria-labelledby="headingImage" data-parent="#accordionOrganizers">
							        <div class="card-body">
							            <div id="Image">
							            	<?= $this->include('backend/template/sections/_image_view'); ?>
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
						        <div id="collapseMetaTags" class="collapse" aria-labelledby="headingMetaTags" data-parent="#accordionOrganizers">
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