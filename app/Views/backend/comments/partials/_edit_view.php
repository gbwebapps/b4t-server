<div class="row">
	<div class="col-md-4 offset-md-4">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
			</div>
			<form id="editForm" method="post">
				<input type="hidden" class="csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="comments_event_id"><?= lang('backend/comments.form.eventField'); ?></label>
								<select name="comments_event_id" id="comments_event_id" class="form-control">
									<option value=""><?= lang('backend/comments.form.eventIdSelect'); ?></option>
									<?php foreach($eventsDropdown as $event): ?>
										<option value="<?= esc($event->events_id); ?>"<?= ($event->events_id == $comment->comments_event_id) ? ' selected' : null; ?>>
											<?= esc($event->events_name); ?>
										</option>
									<?php endforeach; ?>
								</select>
								<div class="error_comments_event_id text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="comments_title"><?= lang('backend/comments.form.titleField'); ?></label>
								<input type="text" 
									   class="form-control" 
									   id="comments_title" 
									   name="comments_title" 
									   value="<?= esc($comment->comments_title); ?>" 
									   placeholder="<?= lang('backend/comments.form.titlePlaceholder'); ?>">
								<div class="error_comments_title text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="comments_content"><?= lang('backend/comments.form.contentField'); ?></label>
								<textarea class="form-control" id="comments_content" name="comments_content" placeholder="<?= lang('backend/comments.form.contentPlaceholder'); ?>" rows="7"><?= esc($comment->comments_content); ?></textarea>
								<div class="error_comments_content text-danger font-weight-bold pt-1"></div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="comments_id" value="<?= esc($comment->comments_id); ?>">
			</form>
		</div>
	</div>
</div>