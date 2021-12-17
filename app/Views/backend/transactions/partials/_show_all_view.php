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
						<th style="width: 10%;">
							<a class="sort" 
							   href="#" 
							   data-column="transactions_id" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'transactions_id') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/transactions.showAll.idColumn') ?>&nbsp;<?= (($posts['column'] == 'transactions_id') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 30%;">
							<a class="sort" 
							   href="#" 
							   data-column="organizer" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'organizer') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/transactions.showAll.organizerColumn') ?>&nbsp;<?= (($posts['column'] == 'organizer') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 30%;">
							<a class="sort" 
							   href="#" 
							   data-column="transactions_reason_code" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'transactions_reason_code') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/transactions.showAll.reasonColumn') ?>&nbsp;<?= (($posts['column'] == 'transactions_reason_code') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%; text-align: center;">
							<a class="sort" 
							   href="#" 
							   data-column="transactions_amount" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'transactions_amount') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/transactions.showAll.amountColumn') ?>&nbsp;<?= (($posts['column'] == 'transactions_amount') ? '&nbsp;' . $icon : ''); ?>
							</a>
						</th>
						<th style="width: 10%; text-align: center;">
							<a class="sort" 
							   href="#" 
							   data-column="transactions_balance" 
							   data-order="<?= (($posts['order'] == 'desc' && $posts['column'] == 'transactions_balance') ? 'asc' : 'desc'); ?>">
							   <?= lang('backend/transactions.showAll.currentBalanceColumn') ?>&nbsp;<?= (($posts['column'] == 'transactions_balance') ? '&nbsp;' . $icon : ''); ?>
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
					<?php foreach($data['records']->getResult() as $transaction): ?>
						<tr>
							<td class="text-left align-middle"><?= esc($transaction->transactions_id); ?></td>
							<td class="text-left align-middle"><?= esc($transaction->organizer); ?></td>
							<td class="text-left align-middle">
								<a href="<?= base_url('admin/transactions/show/' . esc($transaction->transactions_id)); ?>">
									<?= esc($transaction->transactions_reason); ?>
								</a>
								<?php if( ! is_null($transaction->events_name)): ?>
									&nbsp;&bull;&nbsp; <?= esc($transaction->events_name); ?>
								<?php endif; ?>
							</td>

							<?php $green = [1, 3]; ?>
							<?php $red = [2, 4]; ?>

							<?php if(in_array($transaction->transactions_reason_code, $green)):
								$class = ' text-success';
								$sign = '+ ';
							elseif(in_array($transaction->transactions_reason_code, $red)):
								$class = ' text-danger';
								$sign = '- ';
							endif; ?>

							<td class="text-center align-middle font-weight-bold<?= $class; ?>"><?= esc($sign . $transaction->transactions_amount); ?></td>
							<td class="text-center align-middle font-weight-bold"><?= esc($transaction->transactions_balance); ?></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6">
								<?= lang('backend/global.date.createdAt'); ?> : <?= esc($transaction->transactions_created_at); ?>
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