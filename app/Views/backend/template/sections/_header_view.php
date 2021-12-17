<form id="headerForm" method="post">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="sections_title"><?= lang('backend/global.form.title'); ?></label>
				<input type="text" name="sections_title" value="<?= esc($section->sections_title); ?>" id="sections_title" 
					placeholder="<?= lang('backend/global.form.titlePlaceholder'); ?>" class="form-control">
				<div class="error_sections_title text-danger font-weight-bold pt-1"></div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="sections_description"><?= lang('backend/global.form.description'); ?></label>
				<textarea name="sections_description" id="sections_description" placeholder="<?= lang('backend/global.form.descriptionPlaceholder'); ?>" class="form-control" rows="7"><?= esc($section->sections_description); ?></textarea>
				<div class="error_sections_description text-danger font-weight-bold pt-1"></div>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<div class="form-group">
				<button type="submit" class="btn btn-success"><?= lang('backend/global.form.sendButton'); ?></button>
			</div>
		</div>
	</div>
	<input type="hidden" name="sections_id" value="<?= esc($section->sections_id); ?>">
	<input type="hidden" name="action" value="Header">
	<input type="hidden" name="view" value="_header_view">
	<input type="hidden" name="controller" value="<?= esc($controller); ?>">
	<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
</form>