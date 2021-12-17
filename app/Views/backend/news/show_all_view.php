<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft'); ?>
	<h1 class="m-0">
		<i id="showAllIcon" class="fas fa-th-list"></i> <?= lang('backend/news.title.list'); ?>
	</h1>
<?= $this->endSection(); ?>

<?= $this->section('headerRight'); ?>
	&nbsp;
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

			<div class="container-fluid mt-3">
				<div class="row">
					<div class="col-md-12">
						<div class="card bar">
							<div class="row">
								<div class="col-md-2">
									<div class="bar_item_first">
										<a href="<?= base_url('admin/news'); ?>">
											<i class="fas fa-newspaper"></i> <?= lang('backend/news.title.main'); ?>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="bar_item">
										<a href="<?= base_url('admin/news/add'); ?>">
											<i class="fas fa-plus-circle"></i> <?= lang('backend/news.title.add'); ?>
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
											<label for="news_id"><?= lang('backend/news.showAll.idLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="news_id" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/news.showAll.idPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_news_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="news_name"><?= lang('backend/news.showAll.newLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="news_name" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/news.showAll.newPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_news_name text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="news_organizer_id"><?= lang('backend/news.showAll.organizerIDLabel'); ?></label>
											<div class="input-group">
												<select name="news_organizer_id" id="news_organizer_id" class="form-control">
													<option value=""><?= lang('backend/news.showAll.organizersSelect'); ?></option>
													<option value="0">Administrators</option>
													<?php foreach($organizersDropdown as $organizer): ?>
														<option value="<?= esc($organizer->organizers_id); ?>">
															<?= esc($organizer->organizers_name); ?>
														</option>
													<?php endforeach; ?>
												</select>
											    <div class="input-group-append">
													<div class="input-group-text resetSearchIds"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_news_organizer_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="news_in_home"><?= lang('backend/news.showAll.publishedIDLabel'); ?></label>
											<div class="input-group">
												<select name="news_in_home" id="news_in_home" class="form-control">
													<option value=""><?= lang('backend/news.showAll.publishedSelect'); ?></option>
													<option value="1"><?= lang('backend/global.form.yes'); ?></option>
													<option value="2"><?= lang('backend/global.form.no'); ?></option>
												</select>
											    <div class="input-group-append">
													<div class="input-group-text resetSearchIds"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_news_in_home text-danger font-weight-bold pt-1"></div>
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