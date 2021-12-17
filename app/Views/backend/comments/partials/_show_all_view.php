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
							   data-column="comments_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'comments_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/comments.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'comments_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 22%;">
							<a class="sort" 
							   href="#" 
							   data-column="comments_title" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'comments_title') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/comments.showAll.titleColumn') ?>&nbsp;<?= (($posts['column'] == 'comments_title') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 21.5%;">
							<a class="sort" 
							   href="#" 
							   data-column="comments_member_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'comments_member_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/comments.showAll.memberColumn') ?>&nbsp;<?= (($posts['column'] == 'comments_member_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 21.5%;">
							<a class="sort" 
							   href="#" 
							   data-column="comments_event_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'comments_event_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/comments.showAll.eventColumn') ?>&nbsp;<?= (($posts['column'] == 'comments_event_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%;" class="text-center">
							<a class="sort" 
							   href="#" 
							   data-column="comments_status" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'comments_status') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/global.links.status') ?>&nbsp;<?= (($posts['column'] == 'comments_status') ? '&nbsp;' . $icon : ''); ?>
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
					<?php foreach($data['records']->getResult() as $comment): ?>
						<tr>
							<td class="text-left align-middle"><?= esc($comment->comments_id); ?></td>
							<td class="text-left align-middle">
								<a href="<?= base_url('admin/comments/show/' . esc($comment->comments_id)); ?>">
									<?= esc($comment->comments_title); ?>
								</a>
							</td>
							
							<?php 
								$member = ( ! $comment->comments_member_id) ? 
								'<span class="text-success font-weight-bold">' . lang('backend/global.roles.admins') . '</span>' : esc($comment->member);
							?>

							<td class="text-left align-middle"><?= $member; ?></td>

							<td class="text-left align-middle"><?= esc($comment->event); ?></td>

							<?php 
								if($comment->comments_status == '2'):
									$status = lang('backend/global.links.inactive');
									$class = ' text-danger';
									$messageType = 'Active';
								elseif($comment->comments_status == '1'):
									$status = lang('backend/global.links.active');
									$class = ' text-success';
									$messageType = 'Inactive';
								endif;
							?>

							<td class="text-center align-middle">
								<form class="statusForm" method="post" data-message="<?= lang('backend/comments.messages.status' . $messageType . 'Confirm', [$comment->comments_title]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="comments_id" value="<?= esc($comment->comments_id); ?>">
									<input type="hidden" name="comments_status" value="<?= esc($comment->comments_status); ?>">
									<button type="submit" class="btn btn-link font-weight-bold<?= $class; ?>">
										<?= esc($status); ?>
									</button>
								</form>
							</td>

							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/comments/edit/' . esc($comment->comments_id)); ?>">
									<i class="fas fa-edit"></i>&nbsp;<?= lang('backend/global.links.edit'); ?>
								</a>
							</td>

							<?php if( ! is_null($comment->comments_deleted_at)):
								$text_button = lang('backend/global.links.restore');
								$icon = 'fas fa-trash-restore';
								$messageType = 'restore';
								$color = 'color: #ff0000;';
							elseif(is_null($comment->comments_deleted_at)):
								$text_button = lang('backend/global.links.delete');
								$icon = 'fas fa-trash';
								$messageType = 'delete';
								$color = '';
							endif; ?>

							<td class="text-center align-middle" style="width: 10%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/comments.messages.' . $messageType . 'Confirm', [$comment->comments_title]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="comments_id" value="<?= esc($comment->comments_id); ?>">
									<button type="submit" class="btn btn-link" style="<?= $color; ?>">
										<i class="<?= $icon; ?>"></i>&nbsp;<?= $text_button; ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="7">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($comment->comments_created_at); ?>
								<?php if( ! is_null($comment->comments_updated_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($comment->comments_updated_at); ?>
								<?php endif; ?>
								<?php if( ! is_null($comment->comments_deleted_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.deletedAt'); ?> : <?= esc($comment->comments_deleted_at); ?>
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