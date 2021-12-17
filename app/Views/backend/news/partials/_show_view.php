<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/news.form.newField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($news->news_name); ?></li>
						</ul>
					</div>

					<?php 
						$organizer = ( ! $news->news_organizer_id) ? 
						'<span style="color: #00cc33;">' . lang('backend/global.roles.admins') . '</span>' : esc($news->organizer);
					?>

					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/news.show.organizerLabel'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= $organizer; ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/news.form.shortContentField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($news->news_short_description); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/news.form.longContentField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($news->news_long_description); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.files'); ?></h2>
			</div>
			<div class="card-body">
				<div class="showAttachements"></div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.meta_tags'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.slug'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($news->meta_tags_slug); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.title'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($news->meta_tags_title); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.description'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($news->meta_tags_description); ?></li>
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
						    <li class="list-group-item font-weight-bold"><?= esc($news->news_created_at); ?></li>
						</ul>
					</div>
					<?php if(isset($news->news_updated_at) && ! empty($news->news_updated_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.updatedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($news->news_updated_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
					<?php if(isset($new->news_deleted_at) && ! empty($new->news_deleted_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.deletedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($new->news_deleted_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="show_news_id" data-value="<?= esc($news->news_id); ?>">
