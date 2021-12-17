<div class="card">
	<?php if(count($data['records']->getResult())): ?>
		<div class="card-footer" style="border-bottom: 1px solid rgba(0,0,0,.125);">
			<?= $this->include('backend/template/pagination_view'); ?>
		</div>
		<div class="card-body table-responsive p-0">

			<?php $icon = ($posts['order'] == 'desc') ? '<i class="fas fa-arrow-circle-down"></i>' : '<i class="fas fa-arrow-circle-up"></i>'; ?>
			<div id="itemlastpage" data-itemlastpage="<?= esc($data['itemLastPage']) ?>"></div>

			<table class="table text-nowrap">
				<thead>
					<tr class="sorting">
						<th style="width: 10%;">
							<a class="sort" 
							   href="#" 
							   data-column="contacts_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'contacts_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/contacts.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'contacts_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 60%;">
							<a class="sort" 
							   href="#" 
							   data-column="contacts_name" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'contacts_name') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/contacts.showAll.transactionColumn') ?>&nbsp;<?= (($posts['column'] == 'contacts_name') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 30%;" colspan="3" class="text-right">
							<a href="#" id="linkResetSorting" style="font-weight: normal;">
								<i class="fas fa-sync-alt"></i> 
								<?= lang('backend/global.links.resetSorting') ?>
							</a>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data['records']->getResult() as $transaction): ?>
						<tr>
							<td class="text-left align-middle"><?= esc($transaction->contacts_id); ?></td>
							<td class="text-left align-middle"><?= esc($transaction->contacts_name); ?></td>
							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/contacts/show/' . esc($transaction->contacts_id)); ?>">
									<i class="fas fa-info-circle"></i>&nbsp;<?= lang('backend/global.links.show'); ?>
								</a>
							</td>
							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/contacts/edit/' . esc($transaction->contacts_id)); ?>">
									<i class="fas fa-edit"></i>&nbsp;<?= lang('backend/global.links.edit'); ?>
								</a>
							</td>
							<td class="text-center align-middle" style="width: 10%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/contacts.messages.deleteConfirm', [$transaction->contacts_name]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="contacts_id" value="<?= esc($transaction->contacts_id); ?>">
									<button type="submit" class="btn btn-link">
										<i class="fas fa-trash"></i>&nbsp;<?= lang('backend/global.links.delete'); ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="5">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($transaction->contacts_created_at); ?>
								&nbsp;&bull;&nbsp;
								<?= lang('backend/global.date.createdBy'); ?> : <?= esc($transaction->contacts_created_by); ?>
								<?php if( ! is_null($transaction->contacts_updated_at) &&  ! is_null($transaction->contacts_updated_by)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($transaction->contacts_updated_at); ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedBy'); ?> : <?= esc($transaction->contacts_updated_by); ?>
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