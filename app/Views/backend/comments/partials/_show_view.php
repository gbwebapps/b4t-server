<div class="row">
	<div class="col-md-4 offset-md-4">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/comments.form.eventField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($comment->event); ?></li>
						</ul>
					</div>
					<div class="col-md-12">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/comments.form.titleField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($comment->comments_title); ?></li>
						</ul>
					</div>

					<?php 
						$member = ( ! $comment->comments_member_id) ? 
						'<span style="color: #00cc33;">' . lang('backend/global.roles.admins') . '</span>' : esc($comment->member);
					?>

					<div class="col-md-12">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/comments.form.memberField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= $member; ?></li>
						</ul>
					</div>
					<div class="col-md-12">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/comments.form.contentField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($comment->comments_content); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.meta_data'); ?></h2>
			</div>
			<div class="card-body last-child">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.date.createdAt'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($comment->comments_created_at); ?></li>
						</ul>
					</div>
					<?php if(isset($comment->comments_updated_at) && ! empty($comment->comments_updated_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.updatedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($comment->comments_updated_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
					<?php if(isset($comment->comments_deleted_at) && ! empty($comment->comments_deleted_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.deletedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($comment->comments_deleted_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>