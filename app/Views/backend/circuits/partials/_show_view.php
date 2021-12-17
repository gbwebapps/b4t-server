<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card mt-2">
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.general'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/circuits.form.circuitField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_name); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/circuits.form.addressField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_address); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/circuits.form.emailField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_email); ?></li>
						</ul>
					</div>
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/circuits.form.phoneField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_phone); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/circuits.form.openingTimeField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_opening_time); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/circuits.form.shortDescriptionField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_short_description); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/circuits.form.longDescriptionField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_long_description); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/circuits.panels.typesAndServices'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<div class="text-center font-weight-bold text-success">Auto</div>
						<div class="text-center font-weight-bold text-info">Box auto</div>
						<div class="text-center font-weight-bold text-info">Drone auto</div>
						<div class="text-center font-weight-bold text-info">Telemetria auto</div>
						<hr>
						<div class="text-center font-weight-bold text-success">Moto</div>
						<div class="text-center font-weight-bold text-info">Box moto</div>
						<div class="text-center font-weight-bold text-info">Drone moto</div>
						<div class="text-center font-weight-bold text-info">Telemetria moto</div>
					</div>
				</div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.files'); ?></h2>
			</div>
			<div class="card-body">
				<div class="showAttachements"></div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/global.panels.meta_tags'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.slug'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->meta_tags_slug); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.title'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->meta_tags_title); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.description'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->meta_tags_description); ?></li>
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
						    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_created_at); ?></li>
						</ul>
					</div>
					<?php if(isset($circuit->circuits_updated_at) && ! empty($circuit->circuits_updated_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.updatedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_updated_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
					<?php if(isset($circuit->circuits_deleted_at) && ! empty($circuit->circuits_deleted_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.deletedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($circuit->circuits_deleted_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="show_circuits_id" data-value="<?= esc($circuit->circuits_id); ?>">
