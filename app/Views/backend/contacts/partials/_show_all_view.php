<div class="card">
	<?php if(count($data['records']->getResult())): ?>
		<div class="card-pagination">
			<?= $this->include('backend/template/pagination_view'); ?>
		</div>
		<div class="card-body table-responsive p-0">

			<?php $icon = ($posts['order'] == 'desc') ? '<i class="fas fa-arrow-circle-down"></i>' : '<i class="fas fa-arrow-circle-up"></i>'; ?>
			<!-- <div id="itemlastpage" data-itemlastpage=" esc($data['itemLastPage']) "></div> -->

			<table class="table text-nowrap">
				<thead>
					<tr class="sorting">
						<th style="width: 5%;">
							<a class="sort" 
							   href="#" 
							   data-column="contacts_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'contacts_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/contacts.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'contacts_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="contacts_firstname" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'contacts_firstname') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/contacts.showAll.firstnameColumn') ?>&nbsp;<?= (($posts['column'] == 'contacts_firstname') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="contacts_lastname" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'contacts_lastname') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/contacts.showAll.lastnameColumn') ?>&nbsp;<?= (($posts['column'] == 'contacts_lastname') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="contacts_email" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'contacts_email') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/contacts.showAll.emailColumn') ?>&nbsp;<?= (($posts['column'] == 'contacts_email') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 20%;">
							<a class="sort" 
							   href="#" 
							   data-column="contacts_phone" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'contacts_phone') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/contacts.showAll.phoneColumn') ?>&nbsp;<?= (($posts['column'] == 'contacts_phone') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 15%;" class="text-right">
							<a href="#" id="linkResetSorting" style="font-weight: normal;">
								<i class="fas fa-sync-alt"></i> 
								<?= lang('backend/global.links.resetSorting') ?>
							</a>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data['records']->getResult() as $contact): ?>
						<tr>
							<td class="text-left align-middle"><?= esc($contact->contacts_id); ?></td>
							<td class="text-left align-middle">
								<a href="<?= base_url('admin/contacts/show/' . esc($contact->contacts_id)); ?>">
									<?= esc($contact->contacts_firstname); ?>
								</a>
							</td>
							<td class="text-left align-middle">
								<a href="<?= base_url('admin/contacts/show/' . esc($contact->contacts_id)); ?>">
									<?= esc($contact->contacts_lastname); ?>
								</a>
							</td>
							<td class="text-left align-middle"><?= esc($contact->contacts_email); ?></td>
							<td class="text-left align-middle"><?= esc($contact->contacts_phone); ?></td>

							<?php if( ! is_null($contact->contacts_deleted_at)):
								$text_button = lang('backend/global.links.restore');
								$icon = 'fas fa-trash-restore';
								$messageType = 'restore';
								$color = 'color: #ff0000;';
							elseif(is_null($contact->contacts_deleted_at)):
								$text_button = lang('backend/global.links.delete');
								$icon = 'fas fa-trash';
								$messageType = 'delete';
								$color = '';
							endif; ?>

							<td class="text-right align-middle" style="width: 10%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/contacts.messages.' . $messageType . 'Confirm', [$contact->contacts_firstname . ' ' . $contact->contacts_lastname]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="contacts_id" value="<?= esc($contact->contacts_id); ?>">
									<button type="submit" class="btn btn-link" style="<?= $color; ?>">
										<i class="<?= $icon; ?>"></i>&nbsp;<?= $text_button; ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($contact->contacts_created_at); ?>
								<?php if( ! is_null($contact->contacts_deleted_at)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.deletedAt'); ?> : <?= esc($contact->contacts_deleted_at); ?>
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