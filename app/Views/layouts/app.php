<?php

use App\Models\Setting;

$set = new Setting();

$markaz = $set->where('name', 'name')->first();
$colour = $set->where('name', 'colour')->first();
$location = $set->where('name', 'location')->first();
$logo = $set->where('name', 'logo')->first();
?>
<!DOCTYPE html>
<html class="loading" lang="<?= session('lang') ?>" data-textdirection="<?= session('lang') != 'ar' ? 'ltr' : 'rtl' ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?>">
    <meta name="keywords" content="<?= lang('app.appName') ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?>">
    <meta name="author" content="Abou Yaziyd">
    <link rel="manifest" href="./manifest.json" />
    <meta name="theme-color" content="<?= $colour['value'] ?>">
    <title><?= $title ?> | <?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" href="<?= base_url($logo['link']) ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url($logo['link']) ?>">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/vendors' . (session('lang') != 'ar' ? '' : '-rtl') . '.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/bootstrap.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/bootstrap-extended.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/colors.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/components.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/custom' . (session('lang') != 'ar' ? '' : '-rtl') . '.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/core/menu/menu-types/vertical-overlay-menu.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/core/colors/palette-gradient.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/charts/morris.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/forms/selects/select2.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/fonts/simple-line-icons/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/core/colors/palette-gradient.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/forms/toggle/switchery.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/plugins/forms/switch.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/core/colors/palette-switch.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('styles') ?>
    <style>
        [data-menu='vertical-menu-modern'] .navbar-semi-dark .navbar-container .navbar-nav .nav-link {
            color: #806240;
        }

        [data-menu='vertical-menu-modern'] .navbar-light .navbar-header .navbar-nav .nav-link {
            color: #806240;
        }

        .navbar-dark {
            background: #806240;
        }

        .navbar-dark.navbar-horizontal {
            background: #806240;
        }

        .navbar-dark .nav-search .btn-secondary {
            color: #FFFFFF;
            background: #806240;
        }

        .navbar-semi-dark .navbar-header {
            background: #806240;
        }
    </style>
</head>

<body class="vertical-layout vertical-overlay-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">


    <?= $this->include('layouts/header') ?>

    <div class="app-content content center-layout mt-2">
        <div class="content-wrapper">
            <div class="content-body">
                <section class="users-view">
                    <div class="content-body">
                        <?= $this->renderSection('content') ?>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?= $this->include('layouts/footer') ?>

    <script src="<?= base_url('app-assets/vendors/js/vendors.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/charts/chart.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/charts/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/js/core/app-menu.js') ?>"></script>
    <script src="<?= base_url('app-assets/js/core/app.js') ?>"></script>
    <script src="<?= base_url('app-assets/js/scripts/pages/dashboard-crypto.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/forms/select/select2.full.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/js/scripts/forms/select/form-select2.js') ?>"></script>
    <script src="<?= base_url('app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/forms/toggle/switchery.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/js/scripts/forms/switch.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

    <script>
        <?php if (session()->getFlashdata('type')) : ?>
            $(document).ready(function() {
                Swal.fire({
                    title: "<?= session()->getFlashdata('title') ?>",
                    text: "<?= session()->getFlashdata('text') ?>",
                    icon: "<?= session()->getFlashdata('type') ?>",
                    timer: 3000,
                    showConfirmButton: false,
                });
            });
        <?php endif ?>
        <?php if (session()->getFlashdata('toast')) : ?>
            $(document).ready(function() {
                Swal.fire({
                    title: "<?= session()->getFlashdata('title') ?>",
                    text: "<?= session()->getFlashdata('text') ?>",
                    icon: "<?= session()->getFlashdata('toast') ?>",
                    showConfirmButton: true,
                    confirmButtonText: '<?= lang('app.ok') ?>',
                });
            });
        <?php endif ?>
    </script>

</body>
<!-- END: Body-->

</html>