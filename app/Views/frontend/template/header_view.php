<!doctype html>
<html lang="en">
    <head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php if(isset($section->sections_meta_description) && ! empty($section->sections_meta_description)): 
            echo '<meta name="description" value="' . esc($section->sections_meta_description) . '">';
        elseif(isset($items['record']->meta_tags_description) && ! empty($items['record']->meta_tags_description)):
            echo '<meta name="description" value="' . esc($items['record']->meta_tags_description) . '">';
        endif; ?>

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
        <link rel="stylesheet" href="<?= base_url('assets/css/frontend/style.css'); ?>">

        <?php if(isset($styles)):
            echo '<!-- External styles -->' . "\n\t\t";
            foreach($styles as $style):
                echo '<link rel="stylesheet" href="' . base_url('assets/css/frontend/' . htmlspecialchars($style) . '.css') . '">' . "\n\t\t";
            endforeach;
        endif; ?>

        <?php if(isset($section->sections_meta_title) && ! empty($section->sections_meta_title)):
            $title = $section->sections_meta_title;
        elseif(isset($items['record']->meta_tags_title) && ! empty($items['record']->meta_tags_title)):
            $title = $items['record']->meta_tags_title;
        endif; ?>

        <title><?= esc($title); ?></title>
    </head>
    <body>
        <?= $this->include('frontend/template/top_menu_view'); ?>
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
                        <?php if(session('members_frontend_session')) echo session('members_frontend_session'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->renderSection('content'); ?>
