        <footer>
            <?= $this->include('backend/template/bottom_menu_view'); ?>
            <a href="#" class="scrollup">
                <i class="fas fa-arrow-circle-up"></i> Back To Top
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
        <script src="<?= base_url('assets/js/backend/app.js'); ?>"></script>
        <!-- Controller JS -->
        <?= isset($controller) ? '<script src="' . base_url('assets/js/backend/' . htmlspecialchars($controller) . '.js') . '"></script>' . "\n" . '' : null; ?>
        <?php if(isset($scripts)):
            echo '<!-- External scripts -->' . "\n\t\t";
            foreach($scripts as $script):
                echo '<script src="' . base_url('assets/js/backend/' . htmlspecialchars($script) . '.js') . '"></script>' . "\n\t\t";
            endforeach;
        endif; ?>
    </body>
</html>