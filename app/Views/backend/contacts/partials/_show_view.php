<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?>
					<div class="float-right text-success"><?= esc($contact->contacts_created_at); ?></div>
				</h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/contacts.show.labelFirstname'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($contact->contacts_firstname); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/contacts.show.labelLastname'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($contact->contacts_lastname); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/contacts.show.labelEmail'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($contact->contacts_email); ?></li>
						</ul>
					</div>
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/contacts.show.labelPhone'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($contact->contacts_phone); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/contacts.show.labelMessage'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($contact->contacts_message); ?></li>
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
						    <li class="list-group-item font-weight-bold"><?= esc($contact->contacts_created_at); ?></li>
						</ul>
					</div>
					<?php if(isset($contact->contacts_deleted_at) && ! empty($contact->contacts_deleted_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.deletedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($contact->contacts_deleted_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="show_contacts_id" data-value="<?= esc($contact->contacts_id); ?>">
