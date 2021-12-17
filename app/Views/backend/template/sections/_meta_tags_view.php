<form id="metaTagsForm" method="post">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="sections_meta_slug"><?= lang('backend/global.form.slug'); ?></label>
				<input type="text" name="sections_meta_slug" value="<?= esc($section->sections_meta_slug); ?>" id="sections_meta_slug" 
					placeholder="<?= lang('backend/global.form.slugPlaceholder'); ?>" class="form-control">
				<div class="error_sections_meta_slug text-danger font-weight-bold pt-1"></div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="sections_meta_title"><?= lang('backend/global.form.title'); ?></label>
				<input type="text" name="sections_meta_title" value="<?= esc($section->sections_meta_title); ?>" id="sections_meta_title" 
					placeholder="<?= lang('backend/global.form.titlePlaceholder'); ?>" class="form-control">
				<div class="error_sections_meta_title text-danger font-weight-bold pt-1"></div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="sections_meta_description"><?= lang('backend/global.form.description'); ?></label>
				<input type="text" name="sections_meta_description" value="<?= esc($section->sections_meta_description); ?>" id="sections_meta_description" 
					placeholder="<?= lang('backend/global.form.descriptionPlaceholder'); ?>" class="form-control">
				<div class="error_sections_meta_description text-danger font-weight-bold pt-1"></div>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<div class="form-group">
				<button type="submit" class="btn btn-success"><?= lang('backend/global.form.sendButton'); ?></button>
			</div>
		</div>
	</div>
	<input type="hidden" name="sections_id" value="<?= esc($section->sections_id); ?>">
	<input type="hidden" name="action" value="MetaTags">
	<input type="hidden" name="view" value="_meta_tags_view">
	<input type="hidden" name="controller" value="<?= esc($controller); ?>">
	<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
</form>