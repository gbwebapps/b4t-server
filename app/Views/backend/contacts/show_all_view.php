<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i id="showAllIcon" class="fas fa-th-list"></i> <?= lang('backend/contacts.title.list'); ?>
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
										<a href="<?= base_url('admin/contacts'); ?>">
											<i class="fas fa-phone"></i> <?= lang('backend/contacts.title.main') ?>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="bar_item">
										<a href="#" id="linkAdvancedSearch"> 
											<i class="fas fa-search"></i> <?= lang('backend/global.links.advancedSearch') ?>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="bar_item">
										<a href="#" id="linkWhichRecords" data-whichrecords="trashed"> 
											<i id="whichIcon" class="fas fa-trash"></i> 
											<span id="whichText"></span>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="bar_item_right">
										<a href="#" id="linkRefresh">
											<i class="fas fa-sync-alt"></i> <?= lang('backend/global.links.refresh') ?>
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
											<label for="contacts_id"><?= lang('backend/contacts.showAll.idLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="contacts_id" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/contacts.showAll.idPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_contacts_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="contacts_firstname"><?= lang('backend/contacts.showAll.firstnameLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="contacts_firstname" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/contacts.showAll.firstnamePlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_contacts_firstname text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="contacts_lastname"><?= lang('backend/contacts.showAll.lastnameLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="contacts_lastname" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/contacts.showAll.lastnamePlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_contacts_lastname text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="contacts_email"><?= lang('backend/contacts.showAll.emailLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="contacts_email" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/contacts.showAll.emailPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_contacts_email text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="contacts_phone"><?= lang('backend/contacts.showAll.phoneLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="contacts_phone" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/contacts.showAll.phonePlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_contacts_phone text-danger font-weight-bold pt-1"></div>
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