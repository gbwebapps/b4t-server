<div class="card">
	<?php if(count($data['records']->getResult())): ?>
		<div class="card-pagination">
			<?= $this->include('backend/template/pagination_view'); ?>
		</div>
		<div class="card-body table-responsive p-0">

			<?php $icon = ($posts['order'] == 'desc') ? '<i class="fas fa-arrow-circle-down"></i>' : '<i class="fas fa-arrow-circle-up"></i>'; ?>
			<div id="itemlastpage" data-itemlastpage=" esc($data['itemLastPage']) "></div>

			<table class="table text-nowrap">
				<thead>
					<tr class="sorting">
						<th style="width: 5%;">
							<a class="sort" 
							   href="#" 
							   data-column="circuits_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'circuits_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/circuits.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'circuits_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 5%;">
						    &nbsp;
						</th>
						<th style="width: 25%;">
							<a class="sort" 
							   href="#" 
							   data-column="circuits_name" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'circuits_name') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/circuits.showAll.circuitColumn') ?>&nbsp;<?= (($posts['column'] == 'circuits_name') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 25%;">
							<a class="sort" 
							   href="#" 
							   data-column="circuits_email" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'circuits_email') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/circuits.showAll.emailColumn') ?>&nbsp;<?= (($posts['column'] == 'circuits_email') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="circuits_phone" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'circuits_phone') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/circuits.showAll.phoneColumn') ?>&nbsp;<?= (($posts['column'] == 'circuits_phone') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;" colspan="2" class="text-right">
							<a href="#" id="linkResetSorting" style="font-weight: normal;">
								<i class="fas fa-sync-alt"></i> 
								<?= lang('backend/global.links.resetSorting') ?>
							</a>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data['records']->getResult() as $circuit): ?>
						<?php $avatar = (isset($circuit->avatar) ? $circuit->avatar : 'nopic.jpg'); ?>
						<tr>
							<td class="text-left align-middle"><?= esc($circuit->circuits_id); ?></td>
							<td><img src="<?= base_url('files/circuits/small/' . esc($avatar)); ?>" height="75" width="75" class="img-thumbnail"></td>
							<td class="text-left align-middle">
								<a href="<?= base_url('admin/circuits/show/' . esc($circuit->circuits_id)); ?>">
									<?= esc($circuit->circuits_name); ?>
								</a>
							</td>
							<td class="text-left align-middle"><?= esc($circuit->circuits_email); ?></td>
							<td class="text-left align-middle"><?= esc($circuit->circuits_phone); ?></td>

							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/circuits/edit/' . esc($circuit->circuits_id)); ?>">
									<i class="fas fa-edit"></i>&nbsp;<?= lang('backend/global.links.edit'); ?>
								</a>
							</td>

							<?php if( ! is_null($circuit->circuits_deleted_at)):
								$text_button = lang('backend/global.links.restore');
								$icon = 'fas fa-trash-restore';
								$messageType = 'restore';
								$color = 'color: #ff0000;';
							elseif(is_null($circuit->circuits_deleted_at)):
								$text_button = lang('backend/global.links.delete');
								$icon = 'fas fa-trash';
								$messageType = 'delete';
								$color = '';
							endif; ?>

							<td class="text-center align-middle" style="width: 10%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/circuits.messages.' . $messageType . 'Confirm', [$circuit->circuits_name]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="circuits_id" value="<?= esc($circuit->circuits_id); ?>">
									<button type="submit" class="btn btn-link" style="<?= $color; ?>">
										<i class="<?= $icon; ?>"></i>&nbsp;<?= $text_button; ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="7">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($circuit->circuits_created_at); ?>
								<?php if( ! is_null($circuit->circuits_updated_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($circuit->circuits_updated_at); ?>
								<?php endif; ?>
								<?php if( ! is_null($circuit->circuits_deleted_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.deletedAt'); ?> : <?= esc($circuit->circuits_deleted_at); ?>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="card-pagination">
			<?= $this->include('backend/template/pagination_view'); ?>
		</div>
	<?php else: ?>
		<div class="card-body">
			<div class="text-center">
				<?= lang('backend/global.messages.recordsNotFound') ?>
			</div>
		</div>
	<?php endif; ?>
</div>