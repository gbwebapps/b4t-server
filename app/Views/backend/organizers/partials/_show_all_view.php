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
							   data-column="organizers_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'organizers_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/organizers.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'organizers_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 5%;">
						    &nbsp;
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="organizers_name" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'organizers_name') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/organizers.showAll.organizerColumn') ?>&nbsp;<?= (($posts['column'] == 'organizers_name') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="organizers_email" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'organizers_email') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/organizers.showAll.emailColumn') ?>&nbsp;<?= (($posts['column'] == 'organizers_email') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 15%;">
							<a class="sort" 
							   href="#" 
							   data-column="organizers_phone" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'organizers_phone') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/organizers.showAll.phoneColumn') ?>&nbsp;<?= (($posts['column'] == 'organizers_phone') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 15%;" class="text-center">
							<a class="sort" 
							   href="#" 
							   data-column="balance" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'balance') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/organizers.showAll.balanceColumn') ?>&nbsp;<?= (($posts['column'] == 'balance') ? '&nbsp;' . $icon : ''); ?>
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
					<?php foreach($data['records']->getResult() as $organizer): ?>
						<?php $avatar = (isset($organizer->avatar) ? $organizer->avatar : 'nopic.jpg'); ?>
						<tr>
							<td class="text-left align-middle"><?= esc($organizer->organizers_id); ?></td>
							<td><img src="<?= base_url('files/organizers/small/' . esc($avatar)) ?>" height="75" width="75" class="img-thumbnail"></td>
							<td class="text-left align-middle">
								<a href="<?= base_url('admin/organizers/show/' . esc($organizer->organizers_id)); ?>">
									<?= esc($organizer->organizers_name); ?>
								</a>
							</td>
							<td class="text-left align-middle"><?= esc($organizer->organizers_email); ?></td>
							<td class="text-left align-middle"><?= esc($organizer->organizers_phone); ?></td>
							<td class="text-center align-middle font-weight-bold"><?= esc($organizer->balance); ?></td>

							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/organizers/edit/' . esc($organizer->organizers_id)); ?>">
									<i class="fas fa-edit"></i>&nbsp;<?= lang('backend/global.links.edit'); ?>
								</a>
							</td>

							<?php if( ! is_null($organizer->organizers_deleted_at)):
								$text_button = lang('backend/global.links.restore');
								$icon = 'fas fa-trash-restore';
								$messageType = 'restore';
								$color = 'color: #ff0000;';
							elseif(is_null($organizer->organizers_deleted_at)):
								$text_button = lang('backend/global.links.delete');
								$icon = 'fas fa-trash';
								$messageType = 'delete';
								$color = '';
							endif; ?>

							<td class="text-center align-middle" style="width: 10%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/organizers.messages.' . $messageType . 'Confirm', [$organizer->organizers_name]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="organizers_id" value="<?= esc($organizer->organizers_id); ?>">
									<button type="submit" class="btn btn-link" style="<?= $color; ?>">
										<i class="<?= $icon; ?>"></i>&nbsp;<?= $text_button; ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="8">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($organizer->organizers_created_at); ?>
								<?php if( ! is_null($organizer->organizers_updated_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($organizer->organizers_updated_at); ?>
								<?php endif; ?>
								<?php if( ! is_null($organizer->organizers_deleted_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.deletedAt'); ?> : <?= esc($organizer->organizers_deleted_at); ?>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer clearfix">
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