        <footer class="footer py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mt-3">
                            <h5 class="font-weight-bold">Features</h5>
                            <ul class="list-unstyled text-small">
                                <li><a class="text-muted" href="#">Cool stuff</a></li>
                                <li><a class="text-muted" href="#">Random feature</a></li>
                                <li><a class="text-muted" href="#">Team feature</a></li>
                                <li><a class="text-muted" href="#">Stuff for developers</a></li>
                                <li><a class="text-muted" href="#">Another one</a></li>
                                <li><a class="text-muted" href="#">Last time</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mt-3">
                            <h5 class="font-weight-bold">Features</h5>
                            <ul class="list-unstyled text-small">
                                <li><a class="text-muted" href="#">Cool stuff</a></li>
                                <li><a class="text-muted" href="#">Random feature</a></li>
                                <li><a class="text-muted" href="#">Team feature</a></li>
                                <li><a class="text-muted" href="#">Stuff for developers</a></li>
                                <li><a class="text-muted" href="#">Another one</a></li>
                                <li><a class="text-muted" href="#">Last time</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mt-3">
                            <h5 class="font-weight-bold">Features</h5>
                            <ul class="list-unstyled text-small">
                                <li><a class="text-muted" href="#">Cool stuff</a></li>
                                <li><a class="text-muted" href="#">Random feature</a></li>
                                <li><a class="text-muted" href="#">Team feature</a></li>
                                <li><a class="text-muted" href="#">Stuff for developers</a></li>
                                <li><a class="text-muted" href="#">Another one</a></li>
                                <li><a class="text-muted" href="#">Last time</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mt-3">
                            <h5 class="font-weight-bold">Features</h5>
                            <ul class="list-unstyled text-small">
                                <li><a class="text-muted" href="#">Cool stuff</a></li>
                                <li><a class="text-muted" href="#">Random feature</a></li>
                                <li><a class="text-muted" href="#">Team feature</a></li>
                                <li><a class="text-muted" href="#">Stuff for developers</a></li>
                                <li><a class="text-muted" href="#">Another one</a></li>
                                <li><a class="text-muted" href="#">Last time</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center py-3">
                        <span class="font-weight-bold">Book4Track Inc. 00195 Trastevere - Monza e Brianza</span>
                    </div>
                </div>
            </div>
            <a href="" class="scrollup">
                Back To Top
            </a>
        </footer>
        <!-- Show loader -->
        <div id="showLoader"></div>

        <!-- References for JS variables -->
        <?= isset($controller) ? '<div id="controller" data-controller="' . htmlspecialchars($controller) . '"></div>' . "\n" : null; ?>
        <?= isset($action) ? '<div id="action" data-action="' . htmlspecialchars($action) . '"></div>' . "\n" : null; ?>
        <div id="urlbase" data-urlbase="<?= config('App')->baseURL; ?>"></div>

        <!-- Js Scripts -->
        <!-- jQuery -->
        <script src="<?= base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>
        <!-- jQuery UI JS -->
        <script src="<?= base_url('assets/js/jquery-ui.min.js'); ?>"></script>
        <!-- jQuery UI DateTimePicker Add On JS -->
        <script src="<?= base_url('assets/js/jquery-ui-timepicker-addon.js'); ?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
        <!-- Toastr -->
        <script src="<?= base_url('assets/js/toastr.min.js'); ?>"></script>
        <!-- Our own JS -->
        <script src="<?= base_url('assets/js/frontend/app.js'); ?>"></script>
        <!-- Controller JS -->
        <?= isset($controller) ? '<script src="' . base_url('assets/js/frontend/' . htmlspecialchars($controller) . '.js') . '"></script>' . "\n" . '' : null; ?>
        <?php if(isset($scripts)):
            echo '<!-- External scripts -->' . "\n\t\t";
            foreach($scripts as $script):
                echo '<script src="' . base_url('assets/js/frontend/' . htmlspecialchars($script) . '.js') . '"></script>' . "\n\t\t";
            endforeach;
        endif; ?>
    </body>
</html>