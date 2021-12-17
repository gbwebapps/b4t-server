<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-th-list"></i> <?= lang('backend/transactions.title.list'); ?>
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
										<a href="<?= base_url('admin/transactions/add'); ?>">
											<i class="fas fa-plus-circle"></i> <?= lang('backend/transactions.title.add') ?>
										</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="bar_item">
										<a href="#" id="linkAdvancedSearch"> 
											<i class="fas fa-search"></i> <?= lang('backend/global.links.advancedSearch') ?>
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
											<label for="transactions_id"><?= lang('backend/transactions.showAll.idLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="transactions_id" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/transactions.showAll.idPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_transactions_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="transactions_organizer_id"><?= lang('backend/transactions.showAll.organizerIdLabel'); ?></label>
											<div class="input-group">
												<select name="transactions_organizer_id" id="transactions_organizer_id" class="form-control">
													<option value=""><?= lang('backend/transactions.showAll.organizerIdSelect'); ?></option>
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
											<div class="error_transactions_organizer_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="transactions_reason_code"><?= lang('backend/transactions.showAll.reasonCodeLabel'); ?></label>
											<div class="input-group">
												<select name="transactions_reason_code" id="transactions_reason_code" class="form-control">
													<option value=""><?= lang('backend/transactions.showAll.reasonCodeSelect'); ?></option>
													<option value="1"><?= lang('backend/transactions.form.reasonDeposit'); ?></option>
													<option value="2"><?= lang('backend/transactions.form.reasonWithdraw'); ?></option>
													<option value="3"><?= lang('backend/transactions.form.reasonFirstDeposit'); ?></option>
													<option value="4"><?= lang('backend/transactions.form.eventWithdraw'); ?></option>
												</select>
											    <div class="input-group-append">
													<div class="input-group-text resetSearchIds"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_transactions_reason_code text-danger font-weight-bold pt-1"></div>
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