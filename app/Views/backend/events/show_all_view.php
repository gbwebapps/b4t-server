<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i id="showAllIcon" class="fas fa-th-list"></i> <?= lang('backend/events.title.list'); ?>
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
										<a href="<?= base_url('admin/events'); ?>">
											<i class="fas fa-car"></i> <?= lang('backend/events.title.main'); ?>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="bar_item">
										<a href="<?= base_url('admin/events/add'); ?>">
											<i class="fas fa-plus-circle"></i> <?= lang('backend/events.title.add'); ?>
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
											<label for="events_id"><?= lang('backend/events.showAll.idLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="events_id" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/events.showAll.idPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_events_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="events_name"><?= lang('backend/events.showAll.eventLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="events_name" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/events.showAll.eventPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_events_name text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="events_organizer_id"><?= lang('backend/events.showAll.organizerIDLabel'); ?></label>
											<div class="input-group">
												<select name="events_organizer_id" id="events_organizer_id" class="form-control">
													<option value=""><?= lang('backend/events.showAll.organizersSelect'); ?></option>
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
											<div class="error_events_organizer_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="events_circuit_id"><?= lang('backend/events.showAll.circuitIDLabel'); ?></label>
											<div class="input-group">
												<select name="events_circuit_id" id="events_circuit_id" class="form-control">
													<option value=""><?= lang('backend/events.showAll.circuitsSelect'); ?></option>
													<?php foreach($circuitsDropdown as $circuit): ?>
														<option value="<?= esc($circuit->circuits_id); ?>">
															<?= esc($circuit->circuits_name); ?>
														</option>
													<?php endforeach; ?>
												</select>
											    <div class="input-group-append">
													<div class="input-group-text resetSearchIds"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_events_circuit_id text-danger font-weight-bold pt-1"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="events_type_id"><?= lang('backend/events.showAll.typeIDLabel'); ?></label>
											<div class="input-group">
												<select name="events_type_id" id="events_type_id" class="form-control">
													<option value=""><?= lang('backend/events.showAll.typesSelect'); ?></option>
													<?php foreach($typesDropdown as $type): ?>
														<option value="<?= esc($type->id); ?>">
															<?= esc($type->type); ?>
														</option>
													<?php endforeach; ?>
												</select>
											    <div class="input-group-append">
													<div class="input-group-text resetSearchIds"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_events_type_id text-danger font-weight-bold pt-1"></div>
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