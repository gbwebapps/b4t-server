        <?php if($currentUser): ?>

            <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="<?= base_url('admin'); ?>">
                    <img src="<?= base_url('assets/images/backend/logo-xl-dark.png'); ?>" height="25" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown<?= ((isset($controller) && $controller == 'users')) ? ' active' : ''; ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">

                                <?php if(is_null($currentUser->users_image)): ?>
                                    <span id="avatarCurrentUser">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                <?php else: ?>
                                    <span id="avatarCurrentUser">
                                        <img src="<?= base_url('files/users/section/' . esc($currentUser->users_image)); ?>" width="25" height="25" class="img-thumbnail">
                                    </span>
                                <?php endif; ?>

                                <span id="showcurrentUser"><?= esc($currentUser->users_firstname . ' ' . $currentUser->users_lastname); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item<?= ((isset($controller) && $controller == 'users') && (isset($action) && $action == 'account')) ? ' active' : ''; ?>" 
                                        href="<?= base_url('admin/users/account/' . esc($currentUser->users_id)); ?>">
                                        <i class="fas fa-user-cog"></i> <?= lang('backend/global.menu.account'); ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('admin/auth/logout'); ?>">
                                        <i class="fas fa-sign-out-alt"></i> <?= lang('backend/global.menu.logout'); ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

        <?php endif; ?>