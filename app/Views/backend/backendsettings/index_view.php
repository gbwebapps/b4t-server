<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-cogs"></i> <?= lang('backend/backendsettings.title.main'); ?>
	</h1>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
	&nbsp;
<?= $this->endSection() ?>

<?= $this->section('content') ?>

			<div class="container mt-3">
				<div class="row">
					<div class="col-md-12">
						<div class="accordion" id="accordionBackend">
						    <div class="card">
						        <div class="card-header" id="headingApplication">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseApplication" aria-expanded="true" aria-controls="collapseApplication">
						                    <i class="fas fa-chalkboard-teacher"></i> <?= lang('backend/backendsettings.title.application'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseApplication" class="collapse" aria-labelledby="headingApplication" data-parent="#accordionBackend">
						            <div class="card-body">
						                <div id="application">
						                	<?= $this->include('backend/backendsettings/partials/_application_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="card">
						        <div class="card-header" id="headingLocalization">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseLocalization" aria-expanded="true" aria-controls="collapseLocalization">
						                    <i class="fas fa-language"></i> <?= lang('backend/backendsettings.title.localization'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseLocalization" class="collapse" aria-labelledby="headingLocalization" data-parent="#accordionBackend">
						            <div class="card-body">
						                <div id="localization">
						                	<?= $this->include('backend/backendsettings/partials/_localization_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="card">
						        <div class="card-header" id="headingDisplaying">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseDisplaying" aria-expanded="true" aria-controls="collapseDisplaying">
						                    <i class="fas fa-tv"></i> <?= lang('backend/backendsettings.title.displaying'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseDisplaying" class="collapse" aria-labelledby="headingDisplaying" data-parent="#accordionBackend">
						            <div class="card-body">
						                <div id="displaying">
						                	<?= $this->include('backend/backendsettings/partials/_displaying_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="card">
						        <div class="card-header" id="headingSecurity">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseSecurity" aria-expanded="true" aria-controls="collapseSecurity">
						                    <i class="fas fa-shield-alt"></i> <?= lang('backend/backendsettings.title.security'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseSecurity" class="collapse" aria-labelledby="headingSecurity" data-parent="#accordionBackend">
						            <div class="card-body">
						                <div id="security">
						                	<?= $this->include('backend/backendsettings/partials/_security_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="card">
						        <div class="card-header" id="headingDebug">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseDebug" aria-expanded="true" aria-controls="collapseDebug">
						                    <i class="fas fa-bug"></i> <?= lang('backend/backendsettings.title.debug'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseDebug" class="collapse" aria-labelledby="headingDebug" data-parent="#accordionBackend">
						            <div class="card-body">
						                <div id="debug">
						                	<?= $this->include('backend/backendsettings/partials/_debug_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>
					</div>
				</div>
			</div>

<?= $this->endSection() ?>