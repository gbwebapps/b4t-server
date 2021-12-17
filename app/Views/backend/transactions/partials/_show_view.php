<div class="row">
	<div class="col-md-4 offset-md-4">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/transactions.form.organizerIdField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($transaction->organizer); ?></li>
						</ul>
					</div>
					<div class="col-md-12">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/transactions.form.reasonCodeField'); ?></li>
						    <li class="list-group-item font-weight-bold">
						    	<?= esc($transaction->transactions_reason); ?>
						    	<?php if( ! is_null($transaction->events_name)): ?>
						    		&nbsp;&bull;&nbsp; <?= esc($transaction->events_name); ?>
						    	<?php endif; ?>
						    </li>
						</ul>
					</div>

					<?php $green = [1, 3]; ?>
					<?php $red = [2, 4]; ?>

					<?php if(in_array($transaction->transactions_reason_code, $green)):
						$class = ' text-success';
						$sign = '+ ';
					elseif(in_array($transaction->transactions_reason_code, $red)):
						$class = ' text-danger';
						$sign = '- ';
					endif; ?>
					
					<div class="col-md-12">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/transactions.form.amountField'); ?></li>
						    <li class="list-group-item font-weight-bold<?= $class; ?>"><?= esc($sign . $transaction->transactions_amount); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.meta_data'); ?></h2>
			</div>
			<div class="card-body last-child">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.date.createdAt'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($transaction->transactions_created_at); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>