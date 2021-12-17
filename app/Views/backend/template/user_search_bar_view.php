<div class="row">
	<div class="col-md-6 col-lg-3">
		<div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label><?= lang('backend/global.date.createdAt'); ?></label>
			        <div class="input-group">
		                <input style="cursor: pointer;" type="text" class="form-control" autocomplete="off" id="created_at_from" 
		                	   placeholder="<?= lang('backend/global.advancedSearch.searchFrom'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text resetSearchDate"><i class="fa fa-times"></i></div>
                        </div>
		            </div>
                    <div class="error_created_at_from text-danger text-sm text-bold pt-1"></div>
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label class="d-none d-md-block">&nbsp;</label>
		            <div class="input-group">
		                <input style="cursor: pointer;" type="text" class="form-control" autocomplete="off" id="created_at_to" 
		                	   placeholder="<?= lang('backend/global.advancedSearch.searchTo'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text resetSearchDate"><i class="fa fa-times"></i></div>
                        </div>
		            </div>
                    <div class="error_created_at_to text-danger text-sm text-bold pt-1"></div>
		        </div>
		    </div>
		</div>
	</div>
	<?php $controllers = ['transactions', 'contacts']; ?>
	<?php if( ! in_array($controller, $controllers)): ?>
		<div class="col-md-6 col-lg-3">
		    <div class="row">
		        <div class="col-md-6">
		            <div class="form-group">
		                <label><?= lang('backend/global.date.updatedAt'); ?></label>
		                <div class="input-group">
		                    <input style="cursor: pointer;" type="text" class="form-control" id="updated_at_from" autocomplete="off" 
		                    	   placeholder="<?= lang('backend/global.advancedSearch.searchFrom'); ?>">
	                        <div class="input-group-append">
	                            <div class="input-group-text resetSearchDate"><i class="fa fa-times"></i></div>
	                        </div>
		                </div>
	                    <div class="error_updated_at_from text-danger text-sm text-bold pt-1"></div>
		            </div>
		        </div>
		        <div class="col-md-6">
		            <div class="form-group">
		                <label class="d-none d-md-block">&nbsp;</label>
		                <div class="input-group">
		                    <input style="cursor: pointer;" type="text" class="form-control" id="updated_at_to" autocomplete="off" 
		                    	   placeholder="<?= lang('backend/global.advancedSearch.searchTo'); ?>">
	                        <div class="input-group-append">
	                            <div class="input-group-text resetSearchDate"><i class="fa fa-times"></i></div>
	                        </div>
		                </div>
	                    <div class="error_updated_at_to text-danger text-sm text-bold pt-1"></div>
		            </div>
		        </div>
		    </div>
		</div>
		<!--
		<div class="col-md-6 col-lg-3">
			<div class="row">
			    <div class="col-md-6">
			        <div class="form-group">
			            <label><?= lang('backend/global.date.deletedAt'); ?></label>
				        <div class="input-group">
			                <input style="cursor: pointer;" type="text" class="form-control" autocomplete="off" id="deleted_at_from" 
			                	   placeholder="<?= lang('backend/global.advancedSearch.searchFrom'); ?>">
	                        <div class="input-group-append">
	                            <div class="input-group-text resetSearchDate"><i class="fa fa-times"></i></div>
	                        </div>
			            </div>
	                    <div class="error_deleted_at_from text-danger text-sm text-bold pt-1"></div>
			        </div>
			    </div>
			    <div class="col-md-6">
			        <div class="form-group">
			            <label class="d-none d-md-block">&nbsp;</label>
			            <div class="input-group">
			                <input style="cursor: pointer;" type="text" class="form-control" autocomplete="off" id="deleted_at_to" 
			                	   placeholder="<?= lang('backend/global.advancedSearch.searchTo'); ?>">
	                        <div class="input-group-append">
	                            <div class="input-group-text resetSearchDate"><i class="fa fa-times"></i></div>
	                        </div>
			            </div>
	                    <div class="error_deleted_at_to text-danger text-sm text-bold pt-1"></div>
			        </div>
			    </div>
			</div>
		</div>
		-->
	<?php endif; ?>
</div>
