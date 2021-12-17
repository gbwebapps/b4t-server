        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light shadow-sm">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="<?= base_url('assets/images/frontend/logo-xl-dark.png'); ?>" height="25" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <?php $actions = ['index', 'show']; ?>

                <ul class="navbar-nav">
                    <li class="nav-item<?= ((isset($controller) && $controller == 'home') && (isset($action) && in_array($action, $actions))) ? ' active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url(); ?>">Home</span></a>
                    </li>
                    <li class="nav-item<?= ((isset($controller) && $controller == 'circuits') && (isset($action) && in_array($action, $actions))) ? ' active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('circuits'); ?>">Circuits</a>
                    </li>
                    <li class="nav-item<?= ((isset($controller) && $controller == 'organizers') && (isset($action) && in_array($action, $actions))) ? ' active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('organizers'); ?>">Organizers</a>
                    </li>
                    <li class="nav-item<?= ((isset($controller) && $controller == 'events') && (isset($action) && in_array($action, $actions))) ? ' active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('events'); ?>">Events</a>
                    </li>
                    <li class="nav-item<?= ((isset($controller) && $controller == 'news') && (isset($action) && in_array($action, $actions))) ? ' active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('news'); ?>">News</a>
                    </li>
                    <li class="nav-item<?= ((isset($controller) && $controller == 'contacts') && (isset($action) && in_array($action, $actions))) ? ' active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('contacts'); ?>">Contacts</a>
                    </li>
                </ul>

                <?php $actions = ['login', 'recovery', 'register', 'set_password']; ?>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item<?= ((isset($controller) && $controller == 'members') && (isset($action) && in_array($action, $actions))) ? ' active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('members/login'); ?>">Members entrance</a>
                    </li>
                    <li class="nav-item<?= ((isset($controller) && $controller == 'organizers') && (isset($action) && in_array($action, $actions))) ? ' active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('organizers/login'); ?>">Organizers entrance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin'); ?>">Admin entrance</a>
                    </li>
                </ul>
            </div>
        </nav>