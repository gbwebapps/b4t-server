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
						    <li class="list-group-item"><?= lang('backend/organizers.form.organizerField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_name); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/organizers.form.addressField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_address); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/organizers.form.vatField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_vat); ?></li>
						</ul>
					</div>
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/organizers.form.emailField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_email); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/organizers.form.phoneField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_phone); ?></li>
						</ul>
					</div>
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/organizers.showAll.balanceColumn'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->balance); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/organizers.form.shortDescriptionField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_short_description); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/organizers.form.longDescriptionField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_long_description); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/organizers.panels.circuitsAndTypes'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th style="text-align: center;">Circuito</th>
									<th style="text-align: center;">Tipo</th>
									<th style="text-align: center;">Coins</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: center;">Monza</td>
									<td style="text-align: center;">Auto</td>
									<td style="text-align: center;">10</td>
								</tr>
								<tr>
									<td style="text-align: center;">Monza</td>
									<td style="text-align: center;">Moto</td>
									<td style="text-align: center;">8</td>
								</tr>
							</tbody>
						</table>
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
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->meta_tags_slug); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.title'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->meta_tags_title); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.description'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->meta_tags_description); ?></li>
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
						    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_created_at); ?></li>
						</ul>
					</div>
					<?php if(isset($organizer->organizers_updated_at) && ! empty($organizer->organizers_updated_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.updatedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_updated_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
					<?php if(isset($organizer->organizers_deleted_at) && ! empty($organizer->organizers_deleted_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.deletedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($organizer->organizers_deleted_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="show_organizers_id" data-value="<?= esc($organizer->organizers_id); ?>">
