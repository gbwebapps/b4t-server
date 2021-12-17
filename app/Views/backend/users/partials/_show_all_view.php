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
							   data-column="users_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'users_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/users.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'users_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 5%;">
						    &nbsp;
						</th>
						<th style="width: 15%;">
							<a class="sort" 
							   href="#" 
							   data-column="users_firstname" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'users_firstname') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/users.showAll.firstnameColumn') ?>&nbsp;<?= (($posts['column'] == 'users_firstname') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 15%;">
							<a class="sort" 
							   href="#" 
							   data-column="users_lastname" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'users_lastname') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/users.showAll.lastnameColumn') ?>&nbsp;<?= (($posts['column'] == 'users_lastname') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 15%;">
							<a class="sort" 
							   href="#" 
							   data-column="users_email" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'users_email') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/users.showAll.emailColumn') ?>&nbsp;<?= (($posts['column'] == 'users_email') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%;">
							<a class="sort" 
							   href="#" 
							   data-column="users_phone" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'users_phone') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/users.showAll.phoneColumn') ?>&nbsp;<?= (($posts['column'] == 'users_phone') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 7.5%;" class="text-center">
							<a class="sort" 
							   href="#" 
							   data-column="users_status" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'users_status') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/global.links.status') ?>&nbsp;<?= (($posts['column'] == 'users_status') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 7.5%;" class="text-center">
							<a class="sort" 
							   href="#" 
							   data-column="users_role" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'users_role') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/users.showAll.roleColumn') ?>&nbsp;<?= (($posts['column'] == 'users_role') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;" colspan="3" class="text-right">
							<a href="#" id="linkResetSorting" style="font-weight: normal;">
								<i class="fas fa-sync-alt"></i> 
								<?= lang('backend/global.links.resetSorting') ?>
							</a>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data['records']->getResult() as $user): ?>
						<?php $avatar = (isset($user->users_image) ? $user->users_image : 'nopic.jpg'); ?>
						<tr>
							<td class="text-left align-middle"><?= esc($user->users_id); ?></td>
							<td><img src="<?= base_url('files/users/section/' . esc($avatar)); ?>" height="75" width="75" class="img-thumbnail"></td>

							<?php if($user->users_master == 1): ?>
								<td class="text-left align-middle">
									<div class="font-weight-bold">
										<?= esc($user->users_firstname); ?>
									</div>
								</td>
							<?php else: ?>
								<td class="text-left align-middle">
									<a href="<?= base_url('admin/users/show/' . esc($user->users_id)); ?>">
										<?= esc($user->users_firstname); ?>
									</a>
								</td>
							<?php endif; ?>
							
							<?php if($user->users_master == 1): ?>
								<td class="text-left align-middle">
									<div class="font-weight-bold">
										<?= esc($user->users_lastname); ?>
									</div>
								</td>
							<?php else: ?>
								<td class="text-left align-middle">
									<a href="<?= base_url('admin/users/show/' . esc($user->users_id)); ?>">
										<?= esc($user->users_lastname); ?>
									</a>
								</td>
							<?php endif; ?>

							<td class="text-left align-middle"><?= esc($user->users_email); ?></td>
							<td class="text-left align-middle"><?= esc($user->users_phone); ?></td>

							<?php 
								if($user->users_status == '2'):
									$status = lang('backend/global.links.inactive');
									$class = ' text-danger';
									$messageType = 'Active';
								elseif($user->users_status == '1'):
									$status = lang('backend/global.links.active');
									$class = ' text-success';
									$messageType = 'Inactive';
								endif;
							?>

							<?php if($user->users_master == 1): ?>
								<td class="text-center align-middle">
									<div class="font-weight-bold">
										<?= esc($status); ?>
									</div>
								</td>
							<?php else: ?>
								<td class="text-center align-middle">
									<form class="statusForm" method="post" 
										data-message="<?= lang('backend/users.messages.status' . $messageType . 'Confirm', [$user->users_firstname . ' ' . $user->users_lastname]) ?>">
										<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
										<input type="hidden" name="users_id" value="<?= esc($user->users_id); ?>">
										<input type="hidden" name="users_status" value="<?= esc($user->users_status); ?>">
										<button type="submit" class="btn btn-link font-weight-bold<?= $class; ?>">
											<?= esc($status); ?>
										</button>
									</form>
								</td>
							<?php endif; ?>

							<?php 
								if($user->users_role == '2'):
									$role = lang('backend/users.links.editor');
									$class = ' text-danger';
									$messageType = 'Admin';
								elseif($user->users_role == '1'):
									$role = lang('backend/users.links.admin');
									$class = ' text-success';
									$messageType = 'Editor';
								endif;
							?>

							<?php if($user->users_master == 1): ?>
								<td class="text-center align-middle">
									<div class="font-weight-bold">
										<?= esc($role); ?>
									</div>
								</td>
							<?php else: ?>
								<td class="text-center align-middle">
									<form class="roleForm" method="post" 
										data-message="<?= lang('backend/users.messages.role' . $messageType . 'Confirm', [$user->users_firstname . ' ' . $user->users_lastname]) ?>">
										<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
										<input type="hidden" name="users_id" value="<?= esc($user->users_id); ?>">
										<input type="hidden" name="users_role" value="<?= esc($user->users_role); ?>">
										<button type="submit" class="btn btn-link font-weight-bold<?= $class; ?>">
											<?= esc($role); ?>
										</button>
									</form>
								</td>
							<?php endif; ?>

							<?php if($user->users_master == 1): ?>
								<td class="text-center align-middle" style="width: 8%;">
									<div class="font-weight-bold">
										<?= lang('backend/users.links.noEditable'); ?>
									</div>
								</td>
							<?php else: ?>
								<td class="text-center align-middle" style="width: 8%;">
									<a href="<?= base_url('admin/users/edit/' . esc($user->users_id)); ?>">
										<i class="fas fa-edit"></i>&nbsp;<?= lang('backend/global.links.edit'); ?>
									</a>
								</td>
							<?php endif; ?>

							<?php if($user->users_master == 1): ?>
								<td class="text-center align-middle" style="width: 8%;">
									<div class="font-weight-bold">
										<?= lang('backend/users.links.noDeleteble'); ?>
									</div>
								</td>
							<?php else: ?>
								<?php if( ! is_null($user->users_deleted_at)):
									$text_button = lang('backend/global.links.restore');
									$icon = 'fas fa-trash-restore';
									$messageType = 'restore';
									$color = 'color: #ff0000;';
								elseif(is_null($user->users_deleted_at)):
									$text_button = lang('backend/global.links.delete');
									$icon = 'fas fa-trash';
									$messageType = 'delete';
									$color = '';
								endif; ?>

								<td class="text-center align-middle" style="width: 8%;">
									<form class="deleteForm" method="post" data-message="<?= lang('backend/users.messages.' . $messageType . 'Confirm', [$user->users_firstname . ' ' . $user->users_lastname]) ?>">
										<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
										<input type="hidden" name="users_id" value="<?= esc($user->users_id); ?>">
										<button type="submit" class="btn btn-link" style="<?= $color; ?>">
											<i class="<?= $icon; ?>"></i>&nbsp;<?= $text_button; ?>
										</button>
									</form>
								</td>
							<?php endif; ?>

							<?php if($user->users_master == 1): ?>
								<td class="text-center align-middle" style="width: 9%;">
									<div class="font-weight-bold">
										<?= lang('backend/users.links.noResettable'); ?>
									</div>
								</td>
							<?php else: ?>
								<td class="text-center align-middle" style="width: 9%;">
									<form class="resetPassword" method="post" data-view="show_all" 
										  data-message="<?= lang('backend/users.messages.resetConfirm', [$user->users_firstname . ' ' . $user->users_lastname]); ?>">
										  <input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
										  <input type="hidden" name="users_id" value="<?= esc($user->users_id); ?>">
										  <button type="submit" class="btn btn-danger btn-sm">
										  	<?= lang('backend/users.links.reset'); ?>
										  </button>
									</form>
								</td>
							<?php endif; ?>
						</tr>
						<tr>
							<td colspan="11">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($user->users_created_at); ?>
								<?php if( ! is_null($user->users_updated_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($user->users_updated_at); ?>
								<?php endif; ?>
								<?php if( ! is_null($user->users_deleted_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.deletedAt'); ?> : <?= esc($user->users_deleted_at); ?>
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