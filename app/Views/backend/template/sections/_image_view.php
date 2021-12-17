<form id="imageForm" method="post">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="sections_image"><?= lang('backend/global.form.image'); ?></label>
				<input type="file" name="sections_image" value="<?= esc($section->sections_image); ?>" id="sections_image" class="form-control-file">
				<div class="error_sections_image text-danger font-weight-bold pt-1"></div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group container-image">
				<?php if( ! is_null($section->sections_image)): ?>
					<img src="<?= base_url('files/' . esc($controller) . '/section/' . esc($section->sections_image)); ?>" alt="" class="img-fluid img-thumbnail overAttachement">
					<div class="middle">
						<a href="#" class="removeSectionAttachement" data-id="<?= esc($section->sections_id); ?>" 
							data-message="<?= lang('backend/global.messages.coverHeroYouSure', [$controller]); ?>">
							<div class="text remove"><?= lang('backend/global.links.remove'); ?></div>
						</a>
					</div>
				<?php else: ?>
					<div class="preview">
						<?= lang('backend/global.form.imagePlaceholder'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<div class="form-group">
				<button type="submit" class="btn btn-success"><?= lang('backend/global.form.sendButton'); ?></button>
			</div>
		</div>
	</div>
	<input type="hidden" name="sections_id" value="<?= esc($section->sections_id); ?>">
	<input type="hidden" name="action" value="Image">
	<input type="hidden" name="view" value="_image_view">
	<input type="hidden" name="controller" value="<?= esc($controller); ?>">
	<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
</form>