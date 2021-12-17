<div class="row">
	<?php foreach($files as $file): ?>
		<div class="col-md-3 mb-3">

			<?php if($view === 'show'): ?>

				<a href="<?= base_url('files/' . $controller . '/large/' . esc($file->files_name)); ?>" target="_blank">
					<img src="<?= base_url('files/' . $controller . '/medium/' . esc($file->files_name)); ?>" height="auto" width="100%" class="img-thumbnail">
				</a>
				
			<?php elseif($view === 'edit'): ?>

				<div class="container-image">
					<img src="<?= base_url('files/' . $controller . '/medium/' . esc($file->files_name)); ?>" height="auto" width="100%" class="img-thumbnail overAttachement">
					<?php if($file->files_is_cover == 1): ?>
						<div class="checked">
							<i class="fas fa-check-circle fa-2x"></i>
						</div>
						<?php $class = 'removeCoverAttachement'; ?>
						<?php $subClass = ' remove'; ?>
						<?php $text = lang('backend/global.links.remove'); ?>
					<?php else: ?>
						<?php $class = 'setCoverAttachement'; ?>
						<?php $subClass = ' cover'; ?>
						<?php $text = lang('backend/global.links.cover'); ?>
					<?php endif; ?>
					<div class="middle">
						<a href="#" class="<?= $class; ?>" data-id="<?= esc($file->files_id); ?>" data-sectorid="<?= esc($id); ?>">
							<div class="text<?= $subClass; ?>"><?= $text; ?></div>
						</a>
					</div>
				</div>
				<div class="text-center mt-1">
					<a href="#" class="deleteAttachement" data-id="<?= esc($file->files_id); ?>" data-sectorid="<?= esc($id); ?>">
						<i class="fas fa-times"></i>&nbsp;<?= lang('backend/global.links.delete'); ?>
					</a>
				</div>

			<?php endif; ?>

		</div>
	<?php endforeach; ?>
</div>