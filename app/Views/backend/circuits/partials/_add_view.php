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
								<label for="circuits_name"><?= lang('backend/circuits.form.circuitField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="circuits_name" 
									   name="circuits_name" 
									   placeholder="<?= lang('backend/circuits.form.circuitPlaceholder'); ?>" 
									   autofocus>
								<div class="error_circuits_name text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="circuits_address"><?= lang('backend/circuits.form.addressField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="circuits_address" 
									   name="circuits_address" 
									   placeholder="<?= lang('backend/circuits.form.addressPlaceholder'); ?>">
								<div class="error_circuits_address text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="circuits_email"><?= lang('backend/circuits.form.emailField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="circuits_email" 
									   name="circuits_email" 
									   placeholder="<?= lang('backend/circuits.form.emailPlaceholder'); ?>">
								<div class="error_circuits_email text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="circuits_phone"><?= lang('backend/circuits.form.phoneField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="circuits_phone" 
									   name="circuits_phone" 
									   placeholder="<?= lang('backend/circuits.form.phonePlaceholder'); ?>">
								<div class="error_circuits_phone text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="circuits_opening_time"><?= lang('backend/circuits.form.openingTimeField'); ?></label>
								<textarea class="form-control" id="circuits_opening_time" name="circuits_opening_time" placeholder="<?= lang('backend/circuits.form.openingTimeFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_circuits_opening_time text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="circuits_short_description"><?= lang('backend/circuits.form.shortDescriptionField'); ?></label>
								<textarea class="form-control" id="circuits_short_description" name="circuits_short_description" placeholder="<?= lang('backend/circuits.form.shortDescriptionFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_circuits_short_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="circuits_long_description"><?= lang('backend/circuits.form.longDescriptionField'); ?></label>
								<textarea class="form-control" id="circuits_long_description" name="circuits_long_description" placeholder="<?= lang('backend/circuits.form.longDescriptionFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_circuits_long_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/circuits.panels.typesAndServices'); ?></h2>
				</div>
				<div class="card-body">
				    <div class="row">
			    	    <div class="col-md-12 text-center">
			    			<button type="button" class="btn btn-link getTypesServices"><i class="fas fa-plus-circle"></i> <?= lang('backend/circuits.buttons.addTypesServices'); ?></button>
			    	     </div>
			    	     <div class="col-md-12">
			    	     	<hr>
			    	     </div>
			    		<div class="col-md-12">
			    			<div id="typesServicesRow"></div>
			    		</div>
		    		    <div class="col-md-12 text-center">
		    				<button type="button" class="btn btn-link getTypesServices"><i class="fas fa-plus-circle"></i> <?= lang('backend/circuits.buttons.addTypesServices'); ?></button>
		    		    </div>
		    		    <div class="col-md-12">
		    		    	<input type="hidden" name="types_services">
		    		    	<div class="error_types_services text-danger font-weight-bold text-center pt-1"></div>
		    		    </div>
				    </div>
				</div>
				
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/global.panels.files'); ?></h2>
				</div>
				<div class="card-body">
				    <div class="col-md-12">
				        <div class="form-group">
				            <label for="files"><?= lang('backend/circuits.form.filesField'); ?></label>
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
