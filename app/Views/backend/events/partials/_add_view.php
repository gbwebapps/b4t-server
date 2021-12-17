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
								<label for="events_name"><?= lang('backend/events.form.eventField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="events_name" 
									   name="events_name" 
									   placeholder="<?= lang('backend/events.form.eventPlaceholder'); ?>" 
									   autofocus>
								<div class="error_events_name text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="x_events_organizer_id"><?= lang('backend/events.form.organizerIdField'); ?></label>
								<select name="events_organizer_id" id="x_events_organizer_id" class="form-control">
									<option value=""><?= lang('backend/events.form.organizersSelect'); ?></option>
									<?php foreach($organizersDropdown as $organizer): ?>
										<option value="<?= esc($organizer->organizers_id); ?>">
											<?= esc($organizer->organizers_name); ?>
										</option>
									<?php endforeach; ?>
								</select>
								<div class="error_events_organizer_id text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="x_events_circuit_id"><?= lang('backend/events.form.circuitIdField'); ?></label>
								<select name="events_circuit_id" id="x_events_circuit_id" class="form-control" disabled>
									<option value=""><?= lang('backend/events.form.circuitsSelect'); ?></option>
								</select>
								<div class="error_events_circuit_id text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="x_events_type_id"><?= lang('backend/events.form.typeIdField'); ?></label>
								<select name="events_type_id" id="x_events_type_id" class="form-control" disabled>
									<option value=""><?= lang('backend/events.form.typesSelect'); ?></option>
								</select>
								<div class="error_events_type_id text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="events_short_description"><?= lang('backend/events.form.shortDescriptionField'); ?></label>
								<textarea class="form-control" id="events_short_description" name="events_short_description" placeholder="<?= lang('backend/events.form.shortDescriptionFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_events_short_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="events_long_description"><?= lang('backend/events.form.longDescriptionField'); ?></label>
								<textarea class="form-control" id="events_long_description" name="events_long_description" placeholder="<?= lang('backend/events.form.longDescriptionFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_events_long_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/events.panels.datesAndSlots'); ?></h2>
				</div>
				<div class="card-body">
				    <div class="row">
			    	    <div class="col-md-12 text-center">
			    			<button type="button" class="btn btn-link getDatesSlots"><i class="fas fa-plus-circle"></i> <?= lang('backend/events.buttons.addDatesSlots'); ?></button>
			    	     </div>
			    	     <div class="col-md-12">
			    	     	<hr>
			    	     </div>
			    		<div class="col-md-12">
			    			<div id="datesSlotsRow"></div>
			    		</div>
		    		    <div class="col-md-12 text-center">
		    				<button type="button" class="btn btn-link getDatesSlots"><i class="fas fa-plus-circle"></i> <?= lang('backend/events.buttons.addDatesSlots'); ?></button>
		    		    </div>
		    		    <div class="col-md-12">
		    		    	<input type="hidden" name="dates_slots">
		    		    	<div class="error_dates_slots text-danger font-weight-bold text-center pt-1"></div>
		    		    </div>
				    </div>
				</div>
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/global.panels.files'); ?></h2>
				</div>
				<div class="card-body">
				    <div class="col-md-12">
				        <div class="form-group">
				            <label for="files"><?= lang('backend/events.form.filesField'); ?></label>
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
