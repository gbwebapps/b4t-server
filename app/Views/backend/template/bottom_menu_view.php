            <?php if($currentUser): ?>

                <nav class="navbar navbar-light fixed-bottom bg-light">
                    <div class="mr-auto">
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= lang('backend/global.modules.modules'); ?>
                            </button>
                            <div class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'dashboard')) ? ' active' : ''; ?>" href="<?= base_url('admin/dashboard'); ?>">
                                    <i class="fas fa-tachometer-alt"></i> <?= lang('backend/global.modules.dashboard'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'home')) ? ' active' : ''; ?>" href="<?= base_url('admin/home'); ?>">
                                    <i class="fas fa-home"></i> <?= lang('backend/global.modules.home'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'circuits')) ? ' active' : ''; ?>" href="<?= base_url('admin/circuits/showAll'); ?>">
                                    <i class="fas fa-flag-checkered"></i> <?= lang('backend/global.modules.circuits'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'organizers')) ? ' active' : ''; ?>" href="<?= base_url('admin/organizers/showAll'); ?>">
                                    <i class="fas fa-store"></i> <?= lang('backend/global.modules.organizers'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'events')) ? ' active' : ''; ?>" href="<?= base_url('admin/events/showAll'); ?>">
                                    <i class="fas fa-car"></i> <?= lang('backend/global.modules.events'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'transactions')) ? ' active' : ''; ?>" href="<?= base_url('admin/transactions/showAll'); ?>">
                                    <i class="fas fa-coins"></i> <?= lang('backend/global.modules.transactions'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'members')) ? ' active' : ''; ?>" href="<?= base_url('admin/members/showAll'); ?>">
                                    <i class="fas fa-walking"></i> <?= lang('backend/global.modules.members'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'comments')) ? ' active' : ''; ?>" href="<?= base_url('admin/comments/showAll'); ?>">
                                    <i class="fas fa-comments"></i> <?= lang('backend/global.modules.comments'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'orders')) ? ' active' : ''; ?>" href="<?= base_url('admin/orders/showAll'); ?>">
                                    <i class="fas fa-file-signature"></i> <?= lang('backend/global.modules.orders'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'news')) ? ' active' : ''; ?>" href="<?= base_url('admin/news/showAll'); ?>">
                                    <i class="fas fa-newspaper"></i> <?= lang('backend/global.modules.news'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item
                                    <?= ((isset($controller) && $controller == 'contacts')) ? ' active' : ''; ?>" href="<?= base_url('admin/contacts/showAll'); ?>">
                                    <i class="fas fa-phone"></i> <?= lang('backend/global.modules.contacts'); ?>
                                    </a>
                                </li>
                                <?php if($currentUser->users_role == 1): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item
                                        <?= ((isset($controller) && $controller == 'users')) ? ' active' : ''; ?>" href="<?= base_url('admin/users/showAll'); ?>">
                                        <i class="fas fa-users-cog"></i> <?= lang('backend/global.modules.users'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if(isset($action) && in_array($action, ['add', 'edit', 'account'])): ?>
                        <div class="mx-auto">

                            <?php $act = ($action == 'add') ? 'reset' : 'refresh'; ?>

                            <button type="button" class="btn btn-info" id="<?= $action; ?>Output" form="<?= $action; ?>Form">
                                <?= lang('backend/global.form.' . $act . 'Button'); ?>
                            </button>
                            <button type="submit" class="btn btn-success" form="<?= $action; ?>Form">
                                <?= lang('backend/global.form.sendButton'); ?>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if($currentUser->users_role == 1): ?>
                        <div class="ml-auto">
                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= lang('backend/global.settings.settings'); ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-item<?= ((isset($controller) && $controller == 'frontendsettings') && (isset($action) && $action == 'index')) ? ' active' : ''; ?>" href="<?= base_url('admin/frontendsettings'); ?>">
                                            <i class="fas fa-home"></i> <?= lang('backend/global.settings.frontendSettings'); ?>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item<?= ((isset($controller) && $controller == 'backendsettings') && (isset($action) && $action == 'index')) ? ' active' : ''; ?>" href="<?= base_url('admin/backendsettings'); ?>">
                                            <i class="fas fa-cogs"></i> <?= lang('backend/global.settings.backendSettings'); ?>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item<?= ((isset($controller) && $controller == 'tools')) ? ' active' : ''; ?>" href="<?= base_url('admin/tools'); ?>">
                                            <i class="fas fa-tools"></i> <?= lang('backend/global.settings.tools'); ?>
                                        </a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </nav>

            <?php endif; ?>