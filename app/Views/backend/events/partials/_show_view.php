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
						    <li class="list-group-item"><?= lang('backend/events.form.eventField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($event->events_name); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/events.form.organizerIdField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($event->organizer); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/events.form.circuitIdField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($event->circuit); ?></li>
						</ul>
					</div>
					<div class="col-md-6 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/events.form.typeIdField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($event->type); ?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/events.form.shortDescriptionField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($event->events_short_description); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/events.form.longDescriptionField'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($event->events_long_description); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-header">
				<h2 class="card-title"><?= lang('backend/events.panels.datesAndSlots'); ?></h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row font-weight-bold">
							<div class="col-md-3 text-center">Data</div>
							<div class="col-md-3 text-center">Slot</div>
							<div class="col-md-3 text-center">Quantità</div>
							<div class="col-md-3 text-center">Prezzo</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3 text-center text-success font-weight-bold">24/12/2012</div>
							<div class="col-md-3 text-center text-success font-weight-bold">Mezza giornata</div>
							<div class="col-md-3 text-center text-success font-weight-bold">20</div>
							<div class="col-md-3 text-center text-success font-weight-bold">190</div>
							<div class="col-md-10 offset-md-1">
								<div class="row mt-5">
									<div class="col-md-4 text-center font-weight-bold">Servizio</div>
									<div class="col-md-4 text-center font-weight-bold">Prezzo</div>
									<div class="col-md-4 text-center font-weight-bold">Obbligatorio</div>
								</div>
								<hr>
								<div class="row mt-1">
									<div class="col-md-4 text-center text-info font-weight-bold">Ingresso in pista</div>
									<div class="col-md-4 text-center text-info font-weight-bold">190</div>
									<div class="col-md-4 text-center text-info font-weight-bold">Si</div>
								</div>
								<div class="row mt-1">
									<div class="col-md-4 text-center text-info font-weight-bold">Affitto guanti</div>
									<div class="col-md-4 text-center text-info font-weight-bold">50</div>
									<div class="col-md-4 text-center text-info font-weight-bold">No</div>
								</div>
							</div>
						</div>
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
						    <li class="list-group-item font-weight-bold"><?= esc($event->meta_tags_slug); ?></li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.title'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($event->meta_tags_title); ?></li>
						</ul>
					</div>
					<div class="col-md-12 mt-3">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item"><?= lang('backend/global.form.description'); ?></li>
						    <li class="list-group-item font-weight-bold"><?= esc($event->meta_tags_description); ?></li>
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
						    <li class="list-group-item font-weight-bold"><?= esc($event->events_created_at); ?></li>
						</ul>
					</div>
					<?php if(isset($event->events_updated_at) && ! empty($event->events_updated_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.updatedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($event->events_updated_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
					<?php if(isset($event->events_deleted_at) && ! empty($event->events_deleted_at)): ?>
						<div class="col-md-6">
							<ul class="list-group list-group-flush">
							    <li class="list-group-item"><?= lang('backend/global.date.deletedAt'); ?></li>
							    <li class="list-group-item font-weight-bold"><?= esc($event->events_deleted_at); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="show_events_id" data-value="<?= esc($event->events_id); ?>">
