<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-th-list"></i> <?= lang('backend/comments.title.list'); ?>
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
										<a href="<?= base_url('admin/comments/add'); ?>">
											<i class="fas fa-plus-circle"></i> <?= lang('backend/comments.title.add') ?>
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
											<label for="comments_id"><?= lang('backend/comments.showAll.idLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="comments_id" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/comments.showAll.idPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_comments_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="comments_title"><?= lang('backend/comments.showAll.titleLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="comments_title" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/comments.showAll.titlePlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_comments_title text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="comments_member_id"><?= lang('backend/comments.showAll.memberIdLabel'); ?></label>
											<div class="input-group">
												<select name="comments_member_id" id="comments_member_id" class="form-control">
													<option value=""><?= lang('backend/comments.showAll.memberIdSelect'); ?></option>
													<?php foreach($membersDropdown as $member): ?>
														<option value="<?= esc($member->members_id); ?>">
															<?= esc($member->members_firstname . ' ' . $member->members_lastname); ?>
														</option>
													<?php endforeach; ?>
												</select>
											    <div class="input-group-append">
													<div class="input-group-text resetSearchIds"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_comments_member_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="event_id"><?= lang('backend/transactions.showAll.eventIdLabel'); ?></label>
											<div class="input-group">
												<select name="event_id" id="event_id" class="form-control">
													<option value=""><?= lang('backend/transactions.showAll.eventIdSelect'); ?></option>
													<?php foreach($eventsDropdown as $event): ?>
														<option value="<?= esc($event->events_id); ?>">
															<?= esc($event->events_name); ?>
														</option>
													<?php endforeach; ?>
												</select>
											    <div class="input-group-append">
													<div class="input-group-text resetSearchIds"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_event_id text-danger font-weight-bold pt-1"></div>
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