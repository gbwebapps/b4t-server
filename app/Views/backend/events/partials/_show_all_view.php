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
							   data-column="events_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'events_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/events.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'events_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 5%;">
						    &nbsp;
						</th>
						<th style="width: 17%;">
							<a class="sort" 
							   href="#" 
							   data-column="events_name" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'events_name') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/events.showAll.eventColumn') ?>&nbsp;<?= (($posts['column'] == 'events_name') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 17%;">
							<a class="sort" 
							   href="#" 
							   data-column="events_organizer_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'events_organizer_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/events.showAll.organizerIDColumn') ?>&nbsp;<?= (($posts['column'] == 'events_organizer_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 17%;">
							<a class="sort" 
							   href="#" 
							   data-column="events_circuit_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'events_circuit_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/events.showAll.circuitIDColumn') ?>&nbsp;<?= (($posts['column'] == 'events_circuit_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 9%;">
							<a class="sort" 
							   href="#" 
							   data-column="events_type_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'events_type_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/events.showAll.typeIDColumn') ?>&nbsp;<?= (($posts['column'] == 'events_type_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%;" class="text-center">
							<a class="sort" 
							   href="#" 
							   data-column="events_status" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'events_status') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/global.links.status') ?>&nbsp;<?= (($posts['column'] == 'events_status') ? '&nbsp;' . $icon : ''); ?>
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
					<?php foreach($data['records']->getResult() as $event): ?>
						<?php $avatar = (isset($event->avatar) ? $event->avatar : 'nopic.jpg'); ?>
						<tr>
							<td class="text-left align-middle"><?= esc($event->events_id); ?></td>
							<td class="text-center align-middle"><img src="<?= base_url('files/events/small/' . esc($avatar)) ?>" height="75" width="75" class="img-thumbnail"></td>
							<td class="text-left align-middle">
								<a href="<?= base_url('admin/events/show/' . esc($event->events_id)); ?>">
									<?= esc($event->events_name); ?>
								</a>
							</td>
							<td class="text-left align-middle"><?= esc($event->organizer); ?></td>
							<td class="text-left align-middle"><?= esc($event->circuit); ?></td>
							<td class="text-left align-middle"><?= esc($event->type); ?></td>

							<?php 
								if($event->events_status == '2'):
									$status = lang('backend/global.links.inactive');
									$class = ' text-danger';
									$messageType = 'Active';
								elseif($event->events_status == '1'):
									$status = lang('backend/global.links.active');
									$class = ' text-success';
									$messageType = 'Inactive';
								endif;
							?>

							<td class="text-center align-middle">
								<form class="statusForm" method="post" data-message="<?= lang('backend/events.messages.status' . $messageType . 'Confirm', [$event->events_name]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="events_id" value="<?= esc($event->events_id); ?>">
									<input type="hidden" name="events_status" value="<?= esc($event->events_status); ?>">
									<button type="submit" class="btn btn-link font-weight-bold<?= $class; ?>">
										<?= esc($status); ?>
									</button>
								</form>
							</td>

							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/events/edit/' . esc($event->events_id)); ?>">
									<i class="fas fa-edit"></i>&nbsp;<?= lang('backend/global.links.edit'); ?>
								</a>
							</td>

							<?php if( ! is_null($event->events_deleted_at)):
								$text_button = lang('backend/global.links.restore');
								$icon = 'fas fa-trash-restore';
								$messageType = 'restore';
								$color = 'color: #ff0000;';
							elseif(is_null($event->events_deleted_at)):
								$text_button = lang('backend/global.links.delete');
								$icon = 'fas fa-trash';
								$messageType = 'delete';
								$color = '';
							endif; ?>
							
							<td class="text-center align-middle" style="width: 10%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/events.messages.' . $messageType . 'Confirm', [$event->events_name]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="events_id" value="<?= esc($event->events_id); ?>">
									<button type="submit" class="btn btn-link" style="<?= $color; ?>">
										<i class="<?= $icon; ?>"></i>&nbsp;<?= $text_button; ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="9">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($event->events_created_at); ?>
								<?php if( ! is_null($event->events_updated_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($event->events_updated_at); ?>
								<?php endif; ?>
								<?php if( ! is_null($event->events_deleted_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.deletedAt'); ?> : <?= esc($event->events_deleted_at); ?>
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