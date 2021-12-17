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
								<label for="news_name"><?= lang('backend/news.form.newField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="news_name" 
									   name="news_name" 
									   placeholder="<?= lang('backend/news.form.newPlaceholder'); ?>" 
									   autofocus>
								<div class="error_news_name text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="news_organizer_id"><?= lang('backend/news.form.organizerIdField'); ?></label>
								<select name="news_organizer_id" id="news_organizer_id" class="form-control">
									<option value="0"><?= lang('backend/news.form.organizersSelect'); ?></option>
									<?php foreach($organizersDropdown as $organizer): ?>
										<option value="<?= esc($organizer->organizers_id); ?>">
											<?= esc($organizer->organizers_name); ?>
										</option>
									<?php endforeach; ?>
								</select>
								<div class="error_news_organizer_id text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="news_short_description"><?= lang('backend/news.form.shortContentField'); ?></label>
								<textarea class="form-control" id="news_short_description" name="news_short_description" placeholder="<?= lang('backend/news.form.shortContentFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_news_short_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="news_long_description"><?= lang('backend/news.form.longContentField'); ?></label>
								<textarea class="form-control" id="news_long_description" name="news_long_description" placeholder="<?= lang('backend/news.form.longContentFieldPlaceholder'); ?>" rows="7"></textarea>
								<div class="error_news_long_description text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header">
					<h2 class="card-title"><?= lang('backend/global.panels.files'); ?></h2>
				</div>
				<div class="card-body">
				    <div class="col-md-12">
				        <div class="form-group">
				            <label for="files"><?= lang('backend/news.form.filesField'); ?></label>
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