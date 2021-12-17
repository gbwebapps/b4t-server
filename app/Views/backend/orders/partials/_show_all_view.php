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
							   data-column="orders_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'orders_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/orders.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'orders_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 60%;">
							<a class="sort" 
							   href="#" 
							   data-column="orders_name" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'orders_name') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/orders.showAll.orderColumn') ?>&nbsp;<?= (($posts['column'] == 'orders_name') ? '&nbsp;' . $icon : ''); ?>
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
					<?php foreach($data['records']->getResult() as $order): ?>
						<tr>
							<td class="text-left align-middle"><?= esc($order->orders_id); ?></td>
							<td class="text-left align-middle"><?= esc($order->orders_name); ?></td>
							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/orders/show/' . esc($order->orders_id)); ?>">
									<i class="fas fa-info-circle"></i>&nbsp;<?= lang('backend/global.links.show'); ?>
								</a>
							</td>
							<td class="text-center align-middle" style="width: 10%;">
								<a href="<?= base_url('admin/orders/edit/' . esc($order->orders_id)); ?>">
									<i class="fas fa-edit"></i>&nbsp;<?= lang('backend/global.links.edit'); ?>
								</a>
							</td>
							<td class="text-center align-middle" style="width: 10%;">
								<form class="deleteForm" method="post" data-message="<?= lang('backend/orders.messages.deleteConfirm', [$order->orders_name]) ?>">
									<input type="hidden" class="csrfname" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<input type="hidden" name="orders_id" value="<?= esc($order->orders_id); ?>">
									<button type="submit" class="btn btn-link">
										<i class="fas fa-trash"></i>&nbsp;<?= lang('backend/global.links.delete'); ?>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="5">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($order->orders_created_at); ?>
								&nbsp;&bull;&nbsp;
								<?= lang('backend/global.date.createdBy'); ?> : <?= esc($order->orders_created_by); ?>
								<?php if( ! is_null($order->orders_updated_at) &&  ! is_null($order->orders_updated_by)): ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedAt'); ?> : <?= esc($order->orders_updated_at); ?>
									&nbsp;&bull;&nbsp;
									<?= lang('backend/global.date.updatedBy'); ?> : <?= esc($order->orders_updated_by); ?>
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