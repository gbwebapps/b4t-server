<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-tools"></i> <?= lang('backend/tools.title.main'); ?>
	</h1>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
	&nbsp;
<?= $this->endSection() ?>

<?= $this->section('content') ?>

			<div class="container mt-3">
				<div class="row">
					<div class="col-md-12">
						<div class="accordion" id="accordionTools">
						    <div class="card">
						        <div class="card-header" id="headingRepairTable">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseRepairTable" aria-expanded="true" aria-controls="collapseRepairTable">
						                    <i class="fas fa-table"></i> <?= lang('backend/tools.title.repairTable'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseRepairTable" class="collapse" aria-labelledby="headingRepairTable" data-parent="#accordionTools">
						            <div class="card-body">
						                <div id="repairTable">
						                	<?= $this->include('backend/tools/partials/_repair_table_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="card">
						        <div class="card-header" id="headingOptimizeTable">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseOptimizeTable" aria-expanded="true" aria-controls="collapseOptimizeTable">
						                    <i class="fas fa-table"></i> <?= lang('backend/tools.title.optimizeTable'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseOptimizeTable" class="collapse" aria-labelledby="headingOptimizeTable" data-parent="#accordionTools">
						            <div class="card-body">
						                <div id="optimizeTable">
						                	<?= $this->include('backend/tools/partials/_optimize_table_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="card">
						        <div class="card-header" id="headingOptimizeDatabase">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseOptimizeDatabase" aria-expanded="true" aria-controls="collapseOptimizeDatabase">
						                    <i class="fas fa-database"></i> <?= lang('backend/tools.title.optimizeDatabase'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseOptimizeDatabase" class="collapse" aria-labelledby="headingOptimizeDatabase" data-parent="#accordionTools">
						            <div class="card-body">
						                <div id="optimizeDatabase">
						                	<?= $this->include('backend/tools/partials/_optimize_database_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="card">
						        <div class="card-header" id="headingBackup">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseBackup" aria-expanded="true" aria-controls="collapseBackup">
						                    <i class="fas fa-download"></i> <?= lang('backend/tools.title.backup'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseBackup" class="collapse" aria-labelledby="headingBackup" data-parent="#accordionTools">
						            <div class="card-body">
						                <div id="backup">
						                	<?= $this->include('backend/tools/partials/_backup_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="card">
						        <div class="card-header" id="headingManageBackups">
						            <h5 class="mb-0">
						                <a class="text-left" href="#" data-toggle="collapse" data-target="#collapseManageBackups" aria-expanded="true" aria-controls="collapseManageBackups">
						                    <i class="fas fa-th-list"></i> <?= lang('backend/tools.title.manageBackups'); ?>
						                </a>
						            </h5>
						        </div>
						        <div id="collapseManageBackups" class="collapse" aria-labelledby="headingManageBackups" data-parent="#accordionTools">
						            <div class="card-body">
						                <div id="manageBackups">
						                	<?= $this->include('backend/tools/partials/_manage_backups_view'); ?>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>
					</div>
				</div>
			</div>

<?= $this->endSection() ?>