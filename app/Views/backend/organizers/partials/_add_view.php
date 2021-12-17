<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card mt-2">
			<form id="addForm" method="post">
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
				</div>
				<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="organizers_name"><?= lang('backend/organizers.form.organizerField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="organizers_name" 
									   name="organizers_name" 
									   placeholder="<?= lang('backend/organizers.form.organizerPlaceholder'); ?>" 
									   autofocus>
								<div class="error_organizers_name text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="organizers_address"><?= lang('backend/organizers.form.addressField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="organizers_address" 
									   name="organizers_address" 
									   placeholder="<?= lang('backend/organizers.form.addressPlaceholder'); ?>">
								<div class="error_organizers_address text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="organizers_vat"><?= lang('backend/organizers.form.vatField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="organizers_vat" 
									   name="organizers_vat" 
									   placeholder="<?= lang('backend/organizers.form.vatPlaceholder'); ?>">
								<div class="error_organizers_vat text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="organizers_email"><?= lang('backend/organizers.form.emailField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="organizers_email" 
									   name="organizers_email" 
									   placeholder="<?= lang('backend/organizers.form.emailPlaceholder'); ?>">
								<div class="error_organizers_email text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="organizers_phone"><?= lang('backend/organizers.form.phoneField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="organizers_phone" 
									   name="organizers_phone" 
									   placeholder="<?= lang('backend/organizers.form.phonePlaceholder'); ?>">
								<div class="error_organizers_phone text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="organizers_coins"><?= lang('backend/organizers.form.coinsField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="organizers_coins" 
									   name="organizers_coins" 
									   placeholder="<?= lang('backend/organizers.form.coinsPlaceholder'); ?>">
								<div class="error_organizers_coins text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="organizers_short_description"><?= lang('backend/organizers.form.shortDescriptionField'); ?></label>
								<textarea class="form-control" id="organizers_short_description" name="organizers_short_description" placeholder="<?= lang('backend/organizers.form.shortDescriptionFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_organizers_short_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="organizers_long_description"><?= lang('backend/organizers.form.longDescriptionField'); ?></label>
								<textarea class="form-control" id="organizers_long_description" name="organizers_long_description" placeholder="<?= lang('backend/organizers.form.longDescriptionFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_organizers_long_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/organizers.panels.circuitsAndTypes'); ?></h2>
				</div>
				<div class="card-body">
				    <div class="row">
			    	    <div class="col-md-12 text-center">
			    			<button type="button" class="btn btn-link getCircuitsTypes"><i class="fas fa-plus-circle"></i> <?= lang('backend/organizers.buttons.addCircuitsTypes'); ?></button>
			    	     </div>
			    	     <div class="col-md-12">
			    	     	<hr>
			    	     </div>
			    		<div class="col-md-12">
			    			<div id="circuitsTypesCoinsRow"></div>
			    		</div>
		    		    <div class="col-md-12 text-center">
		    				<button type="button" class="btn btn-link getCircuitsTypes"><i class="fas fa-plus-circle"></i> <?= lang('backend/organizers.buttons.addCircuitsTypes'); ?></button>
		    		    </div>
		    		    <div class="col-md-12">
		    		    	<input type="hidden" name="circuits_types_coins">
		    		    	<div class="error_circuits_types_coins text-danger font-weight-bold text-center pt-1"></div>
		    		    </div>
				    </div>
				</div>
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/global.panels.files'); ?></h2>
				</div>
				<div class="card-body">
				    <div class="col-md-12">
				        <div class="form-group">
				            <label for="files"><?= lang('backend/organizers.form.filesField'); ?></label>
				            <input type="file" class="form-control-file" name="files[]" id="files" multiple>
				            <div class="error_files text-danger font-weight-bold pt-1"></div>
				        </div>
				    </div>
			    </div>
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/global.panels.meta_tags'); ?></h2>
				</div>
				<div class="card-body last-child">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="slug"><?= lang('backend/global.form.slug'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="slug" 
									   name="slug" 
									   placeholder="<?= lang('backend/global.form.slugPlaceholder'); ?>">
								<div class="error_slug text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="title"><?= lang('backend/global.form.title'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="title" 
									   name="title" 
									   placeholder="<?= lang('backend/global.form.titlePlaceholder'); ?>">
								<div class="error_title text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="description"><?= lang('backend/global.form.description'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="description" 
									   name="description" 
									   placeholder="<?= lang('backend/global.form.descriptionPlaceholder'); ?>">
								<div class="error_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
