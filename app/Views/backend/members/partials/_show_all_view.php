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
							   data-column="members_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'members_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/members.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'members_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 5%;">
						    &nbsp;
						</th>
						<th style="width: 15%;">
							<a class="sort" 
							   href="#" 
							   data-column="members_firstname" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'members_firstname') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/members.showAll.firstnameColumn') ?>&nbsp;<?= (($posts['column'] == 'members_firstname') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 15%;">
							<a class="sort" 
							   href="#" 
							   data-column="members_lastname" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'members_lastname') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/members.showAll.lastnameColumn') ?>&nbsp;<?= (($posts['column'] == 'members_lastname') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="members_email" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'members_email') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/members.showAll.emailColumn') ?>&nbsp;<?= (($posts['column'] == 'members_email') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%;">
							<a class="sort" 
							   href="#" 
							   data-column="members_phone" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'members_phone') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/members.showAll.phoneColumn') ?>&nbsp;<?= (($posts['column'] == 'members_phone') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%;" class="text-center">
							<a class="sort" 
							   href="#" 
							   data-column="members_status" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'members_status') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/global.links.status') ?>&nbsp;<?= (($posts['column'] == 'members_status') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%;" colspan="1" class="text-right">
							<a href="#" id="linkResetSorting" style="font-weight: normal;">
								<i class="fas fa-sync-alt"></i> 
								<?= lang('backend/global.links.resetSorting') ?>
							</a>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data['records']->getResult() as $member): ?>
						<?php $avatar = (isset($member->members_image) ? $member->members_image : 'nopic.jpg'); ?>
						<tr>
							<td class="text-left align-middle"><?= esc($member->members_id); ?></td>
							<td><img src="<?= base_url('files/members/section/' . esc($avatar)); ?>" height="75" width="75" class="img-thumbnail"></td>

							<td class="text-left align-middle">
								<a href="<?= base_url('admin/members/show/' . esc($member->members_id)); ?>">
									<?= esc($member->members_firstname); ?>
								</a>
							</td>
							
							<td class="text-left align-middle">
								<a href="<?= base_url('admin/members/show/' . esc($member->members_id)); ?>">
									<?= esc($member->members_lastname); ?>
								</a>
							</td>

							<td class="text-left align-middle"><?= esc($member->members_email); ?></td>
							<td class="text-left align-middle"><?= esc($member->members_phone); ?></td>

							<?php 
								if($member->members_status == '2'):
									$status = lang('backend/global.links.inactive');
									$class = ' text-danger';
									$messageType = 'Active';
								elseif($member->members_status == '1'):
									$status = lang('backend/global.links.active');
									$class = ' text-success';
									$messageType = 'Inactive';
								endif;
							?>

							<td class="text-center align-middle">
								<form class="statusForm" method="post" 
									data-message="<?= lang('backend/members.messages.status' . $messageType . 'Confirm', [$member->members_firstname . ' ' . $member->members_lastname]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="members_id" value="<?= esc($member->members_id); ?>">
									<input type="hidden" name="members_status" value="<?= esc($member->members_status); ?>">
									<button type="submit" class="btn btn-link font-weight-bold<?= $class; ?>">
										<?= esc($status); ?>
									</button>
								</form>
							</td>

							<?php if( ! is_null($member->members_deleted_at)):
								$text_button = lang('backend/global.links.restore');
								$icon = 'fas fa-trash-restore';
								$messageType = 'restore';
								$color = 'color: #ff0000;';
							elseif(is_null($member->members_deleted_at)):
								$text_button = lang('backend/global.links.delete');
								$icon = 'fas fa-trash';
								$messageType = 'delete';
								$color = '';
							endif; ?>

							<td class="text-center align-middle" style="width: 8%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/members.messages.' . $messageType . 'Confirm', [$member->members_firstname . ' ' . $member->members_lastname]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="members_id" value="<?= esc($member->members_id); ?>">
									<button type="submit" class="btn btn-link" style="<?= $color; ?>">
										<i class="<?= $icon; ?>"></i>&nbsp;<?= $text_button; ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="9">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($member->members_created_at); ?>
								<?php if( ! is_null($member->members_updated_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($member->members_updated_at); ?>
								<?php endif; ?>
								<?php if( ! is_null($member->members_deleted_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.deletedAt'); ?> : <?= esc($member->members_deleted_at); ?>
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