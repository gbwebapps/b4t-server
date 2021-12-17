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
							   data-column="news_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'news_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/news.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'news_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 5%;">
						    &nbsp;
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="news_name" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'news_name') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/news.showAll.newsColumn') ?>&nbsp;<?= (($posts['column'] == 'news_name') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="organizer" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'organizer') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/news.showAll.organizerColumn') ?>&nbsp;<?= (($posts['column'] == 'organizer') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%;" class="text-center">
							<a class="sort" 
							   href="#" 
							   data-column="news_in_home" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'news_in_home') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/news.showAll.inHomeColumn') ?>&nbsp;<?= (($posts['column'] == 'news_in_home') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;" class="text-center">
							<a class="sort" 
							   href="#" 
							   data-column="news_status" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'news_status') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/global.links.status') ?>&nbsp;<?= (($posts['column'] == 'news_status') ? '&nbsp;' . $icon : ''); ?>
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
					<?php foreach($data['records']->getResult() as $news): ?>
						<?php $avatar = (isset($news->avatar) ? $news->avatar : 'nopic.jpg'); ?>
						<tr>
							<td class="text-left align-middle"><?= esc($news->news_id); ?></td>
							<td><img src="<?= base_url('files/news/small/' . esc($avatar)); ?>" height="75" width="75" class="img-thumbnail"></td>

							<td class="text-left align-middle">
								<a href="<?= base_url('admin/news/show/' . esc($news->news_id)); ?>">
									<?= esc($news->news_name); ?>
								</a>
							</td>

							<?php 
								$organizer = ( ! $news->news_organizer_id) ? 
								'<span class="text-success font-weight-bold">' . lang('backend/global.roles.admins') . '</span>' : esc($news->organizer);
							?>

							<td class="text-left align-middle"><?= $organizer; ?></td>

							<?php 
								if($news->news_in_home == '2'):
									$in_home = lang('backend/global.form.no');
									$class = ' text-danger';
									$messageType = 'Add';
								elseif($news->news_in_home == '1'):
									$in_home = lang('backend/global.form.yes');
									$class = ' text-success';
									$messageType = 'Remove';
								endif;
							?>

							<td class="text-center align-middle">
								<?php if($news->news_organizer_id != '-1'): ?>
									<form class="inHomeForm" method="post" data-message="<?= lang('backend/news.messages.inHome' . $messageType . 'Confirm', [$news->news_name]) ?>">
										<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
										<input type="hidden" name="news_id" value="<?= esc($news->news_id); ?>">
										<input type="hidden" name="in_home" value="<?= esc($news->news_in_home); ?>">
										<button type="submit" class="btn btn-link font-weight-bold<?= $class; ?>">
											<?= esc($in_home); ?>
										</button>
									</form>
								<?php else: ?>
									<button type="button" class="btn btn-link font-weight-bold<?= $class; ?>" style="cursor: default;">
										<?= esc($in_home); ?>
									</button>
								<?php endif; ?>
							</td>

							<?php 
								if($news->news_status == '2'):
									$status = lang('backend/global.links.inactive');
									$class = ' text-danger';
									$messageType = 'Active';
								elseif($news->news_status == '1'):
									$status = lang('backend/global.links.active');
									$class = ' text-success';
									$messageType = 'Inactive';
								endif;
							?>

							<td class="text-center align-middle">
								<form class="statusForm" method="post" data-message="<?= lang('backend/news.messages.status' . $messageType . 'Confirm', [$news->news_name]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="news_id" value="<?= esc($news->news_id); ?>">
									<input type="hidden" name="news_status" value="<?= esc($news->news_status); ?>">
									<button type="submit" class="btn btn-link font-weight-bold<?= $class; ?>">
										<?= esc($status); ?>
									</button>
								</form>
							</td>

							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/news/edit/' . esc($news->news_id)); ?>">
									<i class="fas fa-edit"></i>&nbsp;<?= lang('backend/global.links.edit'); ?>
								</a>
							</td>

							<?php if( ! is_null($news->news_deleted_at)):
								$text_button = lang('backend/global.links.restore');
								$icon = 'fas fa-trash-restore';
								$messageType = 'restore';
								$color = 'color: #ff0000;';
							elseif(is_null($news->news_deleted_at)):
								$text_button = lang('backend/global.links.delete');
								$icon = 'fas fa-trash';
								$messageType = 'delete';
								$color = '';
							endif; ?>

							<td class="text-center align-middle" style="width: 10%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/news.messages.' . $messageType . 'Confirm', [$news->news_name]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="news_id" value="<?= esc($news->news_id); ?>">
									<button type="submit" class="btn btn-link" style="<?= $color; ?>">
										<i class="<?= $icon; ?>"></i>&nbsp;<?= $text_button; ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="8">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($news->news_created_at); ?>
								<?php if( ! is_null($news->news_updated_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($news->news_updated_at); ?>
								<?php endif; ?>
								<?php if( ! is_null($news->news_deleted_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.deletedAt'); ?> : <?= esc($news->news_deleted_at); ?>
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