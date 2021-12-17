<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i id="showAllIcon" class="fas fa-th-list"></i> <?= lang('backend/organizers.title.list'); ?>
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
								<div class="col-md-2">
									<div class="bar_item_first">
										<a href="<?= base_url('admin/organizers'); ?>">
											<i class="fas fa-store"></i> <?= lang('backend/organizers.title.main'); ?>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="bar_item">
										<a href="<?= base_url('admin/organizers/add'); ?>">
											<i class="fas fa-plus-circle"></i> <?= lang('backend/organizers.title.add'); ?>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="bar_item">
										<a href="#" id="linkAdvancedSearch"> 
											<i class="fas fa-search"></i> <?= lang('backend/global.links.advancedSearch'); ?>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="bar_item">
										<a href="#" id="linkWhichRecords" data-whichrecords="trashed"> 
											<i id="whichIcon" class="fas fa-trash"></i> 
											<span id="whichText"></span>
										</a>
									</div>
								</div>
								<div class="col-md-2"></div>
								<div class="col-md-2">
									<div class="bar_item_right">
										<a href="#" id="linkRefresh">
											<i class="fas fa-sync-alt"></i> <?= lang('backend/global.links.refresh'); ?>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="advancedSearch">
					<div class="card advancedSearch mb-3">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="organizers_id"><?= lang('backend/organizers.showAll.idLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="organizers_id" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/organizers.showAll.idPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_organizers_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="organizers_name"><?= lang('backend/organizers.showAll.organizerLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="organizers_name" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/organizers.showAll.organizerPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_organizers_name text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="organizers_id"><?= lang('backend/organizers.showAll.emailLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="organizers_email" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/organizers.showAll.emailPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_organizers_email text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="organizers_phone"><?= lang('backend/organizers.showAll.phoneLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="organizers_phone" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/organizers.showAll.phonePlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_organizers_phone text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?= $this->include('backend/template/user_search_bar_view'); ?>
						<div class="row">
						    <div class="col-md-3 offset-md-9 text-right pt-2 pt-md-0">
						        <a href="#" id="linkResetSearch">
						            <i class="fas fa-sync-alt"></i>&nbsp;<?= lang('backend/global.links.resetAdvancedSearch'); ?>
						        </a>
						    </div>  
						</div>
					</div>
                </div>

                <div class="row">
                	<div class="col-md-12">
                		<div class="content" id="showData"></div>
                	</div>
                </div>
			</div>

<?= $this->endSection() ?>