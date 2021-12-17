<?= $this->extend('frontend/template/main_view') ?> 

<?= $this->section('headerLeft') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

			<!-- Top content -->
			<div class="top-content">
			    <!-- Carousel -->
			    <div id="carousel-example" class="carousel slide" data-ride="carousel">
			 
			        <ol class="carousel-indicators">
			            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
			            <li data-target="#carousel-example" data-slide-to="1"></li>
			            <li data-target="#carousel-example" data-slide-to="2"></li>
			        </ol>
			 
			        <div class="carousel-inner">
			            <div class="carousel-item active" data-interval="2500">
			                <img src="<?= base_url('images/1.jpg'); ?>" class="d-block w-100" alt="slide-img-1">
			                <div class="carousel-caption">
			                    <h1>Carousel Fullscreen Template</h1>
			                    <div class="carousel-caption-description">
			                        <p>This is a free Fullscreen Carousel template made with the Bootstrap 4 framework.</p>
			                    </div>
			                </div>
			            </div>
			            <div class="carousel-item" data-interval="2500">
			                <img src="<?= base_url('images/2.jpg'); ?>" class="d-block w-100" alt="slide-img-2">
			                <div class="carousel-caption">
			                    <h3>Caption for Image 2</h3>
			                    <div class="carousel-caption-description">
			                        <p>This is the caption description text for image 2.</p>
			                    </div>
			                </div>
			            </div>
			            <div class="carousel-item" data-interval="2500">
			                <img src="<?= base_url('images/3.jpg'); ?>" class="d-block w-100" alt="slide-img-3">
			                <div class="carousel-caption">
			                    <h3>Caption for Image 3</h3>
			                    <div class="carousel-caption-description">
			                        <p>This is the caption description text for image 3.</p>
			                    </div>
			                </div>
			            </div>
			        </div>
			 
			        <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
			            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			            <span class="sr-only">Previous</span>
			        </a>
			        <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
			            <span class="carousel-control-next-icon" aria-hidden="true"></span>
			            <span class="sr-only">Next</span>
			        </a>
			    </div>
			    <!-- End carousel -->
			</div>

			<div class="container mt-5">
				<div class="row">
					<div class="col-md-12 mt-3 text-center">
						<h1><?= esc($section->sections_title); ?></h1>
						<p class="lead-4"><?= esc($section->sections_description); ?></p>
					</div>
				</div>
				<hr class="featurette-divider">
				<div class="row">
					<div class="col-md-12">
						<div id="circuits">
							<div class="row">
								<div class="col-md-12">
									<h1 class="mb-3">Circuits</h1>
								</div>
							</div>
							<?php if(count($circuits)): ?>
								<div class="row">
									<?php foreach($circuits as $circuit): ?>
										<?php $files_name = (isset($circuit->files_name) ? $circuit->files_name : 'nopic.jpg'); ?>
										<div class="col-md-4">
											<div class="card mb-4 shadow-sm">
												<div class="card-body">
													<h5 class="card-title"><?= esc($circuit->circuits_name); ?></h5>
													<img src="<?= base_url('files/circuits/medium/' . esc($files_name)); ?>" class="card-img-top pb-3" alt="...">
													<p class="card-text"><?= esc($circuit->circuits_short_description); ?></p>
													<small><?= esc($circuit->circuits_created_at); ?></small>
													<div class="text-center">
														<div class="btn-group">
															<a href="<?= base_url('circuits/' . $circuit->meta_tags_slug); ?>" class="btn btn-sm btn-outline-secondary">View detail</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="row mt-3">
									<div class="col-md-12 text-center">
										<a href="<?= base_url('circuits'); ?>" class="btn btn-primary">View more</a>
									</div>
								</div>
							<?php else: ?>
								<div class="row">
									<div class="col-md-12">
										<div class="card mt-2 mb-4">
											<div class="card-body">
												<div class="text-center">
													<?= lang('backend/global.messages.recordsNotFound') ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<hr class="featurette-divider">
							<div class="row featurette align-items-center">
							    <div class="col-md-7">
							        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
							        <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
							    </div>
							    <div class="col-md-5">
							        <img src="<?= base_url('images/1.jpg'); ?>" class="card-img-top" alt="...">
							    </div>
							</div>
							<hr class="featurette-divider">
						</div>
						<div id="organizers">
							<div class="row">
								<div class="col-md-12">
									<h1 class="mb-3">Organizers</h1>
								</div>
							</div>
							<?php if(count($organizers)): ?>
								<div class="row">
									<?php foreach($organizers as $organizer): ?>
										<?php $files_name = (isset($organizer->files_name) ? $organizer->files_name : 'nopic.jpg'); ?>
										<div class="col-md-4">
											<div class="card mb-4 shadow-sm">
												<div class="card-body">
													<h5 class="card-title"><?= esc($organizer->organizers_name); ?></h5>
													<img src="<?= base_url('files/organizers/medium/' . esc($files_name)); ?>" class="card-img-top pb-3" alt="...">
													<p class="card-text"><?= esc($organizer->organizers_short_description); ?></p>
													<small><?= esc($organizer->organizers_created_at); ?></small>
													<div class="text-center">
														<div class="btn-group">
															<a href="<?= base_url('organizers/' . $organizer->meta_tags_slug); ?>" class="btn btn-sm btn-outline-secondary">View detail</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="row mt-3">
									<div class="col-md-12 text-center">
										<a href="<?= base_url('organizers'); ?>" class="btn btn-primary">View more</a>
									</div>
								</div>
							<?php else: ?>
								<div class="row">
									<div class="col-md-12">
										<div class="card mt-2 mb-4">
											<div class="card-body">
												<div class="text-center">
													<?= lang('backend/global.messages.recordsNotFound') ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<hr class="featurette-divider">
							<div class="row featurette align-items-center">
								<div class="col-md-5">
								    <img src="<?= base_url('images/2.jpg'); ?>" class="card-img-top" alt="...">
								</div>
							    <div class="col-md-7">
							        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
							        <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
							    </div>
							</div>
							<hr class="featurette-divider">
						</div>
						<div id="events">
							<div class="row">
								<div class="col-md-12">
									<h1 class="mb-3">Events</h1>
								</div>
							</div>
							<?php if(count($events)): ?>
								<div class="row">
									<?php foreach($events as $event): ?>
										<?php $files_name = (isset($event->files_name) ? $event->files_name : 'nopic.jpg'); ?>
										<div class="col-md-4">
											<div class="card mb-4 shadow-sm">
												<div class="card-body">
													<h5 class="card-title"><?= esc($event->events_name); ?></h5>
													<img src="<?= base_url('files/events/medium/' . esc($files_name)); ?>" class="card-img-top pb-3" alt="...">
													<p class="card-text"><?= esc($event->events_short_description); ?></p>
													<small><?= esc($event->events_created_at); ?></small>
													<div class="text-center">
														<div class="btn-group">
															<a href="<?= base_url('events/' . $event->meta_tags_slug); ?>" class="btn btn-sm btn-outline-secondary">View detail</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="row mt-3">
									<div class="col-md-12 text-center">
										<a href="<?= base_url('events'); ?>" class="btn btn-primary">View more</a>
									</div>
								</div>
							<?php else: ?>
								<div class="row">
									<div class="col-md-12">
										<div class="card mt-2 mb-4">
											<div class="card-body">
												<div class="text-center">
													<?= lang('backend/global.messages.recordsNotFound') ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<hr class="featurette-divider">
							<div class="row featurette align-items-center">
								<div class="col-md-5">
								    <img src="<?= base_url('images/3.jpg'); ?>" class="card-img-top" alt="...">
								</div>
							    <div class="col-md-7">
							        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
							        <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
							    </div>
							</div>
							<hr class="featurette-divider">
						</div>
						<div id="news">
							<div class="row">
								<div class="col-md-12">
									<h1 class="mb-3">News</h1>
								</div>
							</div>
							<?php if(count($news)): ?>
								<div class="row">
									<?php foreach($news as $new): ?>
										<?php $files_name = (isset($new->files_name) ? $new->files_name : 'nopic.jpg'); ?>
										<div class="col-md-4">
											<div class="card mb-4 shadow-sm">
												<div class="card-body">
													<h5 class="card-title"><?= esc($new->news_name); ?></h5>
													<img src="<?= base_url('files/news/medium/' . esc($files_name)); ?>" class="card-img-top pb-3" alt="...">
													<p class="card-text"><?= esc($new->news_short_description); ?></p>
													<small><?= esc($new->news_created_at); ?></small>
													<div class="text-center">
														<div class="btn-group">
															<a href="<?= base_url('news/' . $new->meta_tags_slug); ?>" class="btn btn-sm btn-outline-secondary">View detail</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="row mt-3">
									<div class="col-md-12 text-center">
										<a href="<?= base_url('news'); ?>" class="btn btn-primary">View more</a>
									</div>
								</div>
							<?php else: ?>
								<div class="row">
									<div class="col-md-12">
										<div class="card mt-2 mb-4">
											<div class="card-body">
												<div class="text-center">
													<?= lang('backend/global.messages.recordsNotFound') ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<hr class="featurette-divider">
							<div class="row featurette align-items-center">
								<div class="col-md-5">
								    <img src="<?= base_url('images/3.jpg'); ?>" class="card-img-top" alt="...">
								</div>
							    <div class="col-md-7">
							        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
							        <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
							    </div>
							</div>
							<hr class="featurette-divider">
						</div>
					</div>
				</div>
			</div>

<?= $this->endSection() ?>