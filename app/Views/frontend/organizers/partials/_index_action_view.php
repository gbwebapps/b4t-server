<?php if(count($data['records']->getResult())): ?>
	<?= $this->include('frontend/template/pagination_view'); ?>
	<div class="row mt-2">
		<?php foreach($data['records']->getResult() as $organizer): ?>
			<?php $files_name = (isset($organizer->files_name) ? $organizer->files_name : 'nopic.jpg'); ?>
			<div class="col-md-4">
				<div class="card mb-4 shadow-sm">
					<div class="card-body">
						<h5 class="card-title"><?= esc($organizer->organizers_name); ?></h5>
						<img src="<?= base_url('files/organizers/medium/' . esc($files_name)); ?>" class="card-img-top pb-3" alt="...">
						<p class="card-text"><?= esc($organizer->organizers_short_description); ?></p>
						<small><?= esc($organizer->organizers_created_at); ?></small>
						<div class="text-center">
							<div class="btn-group">
								<a href="<?= base_url('organizers/' . $organizer->meta_tags_slug); ?>" class="btn btn-sm btn-outline-secondary">View detail</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?= $this->include('frontend/template/pagination_view'); ?>
<?php else: ?>
	<div class="card mt-2 mb-4">
		<div class="card-body">
			<div class="text-center">
				<?= lang('backend/global.messages.recordsNotFound') ?>
			</div>
		</div>
	</div>
<?php endif; ?>