<?= $this->extend('backend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
	<h1 class="m-0">
		<i class="fas fa-th-list"></i> <?= lang('backend/orders.title.list'); ?>
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
										<a href="<?= base_url('admin/orders/add'); ?>">
											<i class="fas fa-plus-circle"></i> <?= lang('backend/orders.title.add') ?>
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
											<label for="orders_id"><?= lang('backend/orders.showAll.idLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="orders_id" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/orders.showAll.idPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_orders_id text-danger text-sm text-bold pt-1"></div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label for="orders_name"><?= lang('backend/orders.showAll.orderLabel'); ?></label>
											<div class="input-group">
												<input type="text" 
													   class="form-control" 
													   id="orders_name" 
													   autocomplete="off" 
													   placeholder="<?= lang('backend/orders.showAll.orderPlaceholder'); ?>">
											    <div class="input-group-append">
													<div class="input-group-text resetSearchFields"><i class="fa fa-times"></i></div>
											    </div>
											</div>
											<div class="error_orders_name text-danger text-sm text-bold pt-1"></div>
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