<!doctype html>
<html lang="en">
    <head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome Icons CSS -->
        <link rel="stylesheet" href="<?= base_url('assets/css/all.min.css'); ?>">
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="<?= base_url('assets/css/toastr.min.css'); ?>">
        <!-- jQuery UI CSS -->
        <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.min.css'); ?>">
        <!-- jQuery UI DateTimePicker Add On -->
        <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui-timepicker-addon.css'); ?>">
        <!-- Our own style -->
        <link rel="stylesheet" href="<?= base_url('assets/css/backend/style.css'); ?>">
        <?php if(isset($styles)):
            echo '<!-- External styles -->' . "\n\t\t";
            foreach($styles as $style):
                echo '<link rel="stylesheet" href="' . base_url('assets/css/backend/' . htmlspecialchars($style) . '.css') . '">' . "\n\t\t";
            endforeach;
        endif; ?>
        <title>Book4track</title>
    </head>
    <body>
        <?= $this->include('backend/template/top_menu_view'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="header_left">
                        <?= $this->renderSection('headerLeft'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="header_right">
                        <?= $this->renderSection('headerRight'); ?>
                        <?php if(session('users_backend_session')) echo session('users_backend_session'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->renderSection('content'); ?>
