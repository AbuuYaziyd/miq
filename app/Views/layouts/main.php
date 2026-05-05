<!DOCTYPE html>
<html class="loading" lang="<?= session('lang') ?>" data-textdirection="<?= session('lang') != 'ar' ? 'ltr' : 'rtl' ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?= lang('app.appName') . ' | ' . lang('location') ?>">
    <meta name="keywords" content="<?= lang('app.appName') . ' | ' . lang('location') ?>">
    <meta name="author" content="Abou Yaziyd">
    <link rel="manifest" href="./manifest.json" />
    <meta name="theme-color" content="#1b877a">
    <title><?= lang('app.appName') ?> | <?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" href="<?= base_url('app-assets/images/logo/logo.png') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('app-assets/images/logo/logo.png') ?>">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/vendors' . (session('lang') != 'ar' ? '' : '-rtl') . '.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/bootstrap.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/bootstrap-extended.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/colors.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/components.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/custom' . (session('lang') != 'ar' ? '' : '-rtl') . '.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/core/menu/menu-types/vertical-menu-modern.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/core/colors/palette-gradient.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/charts/morris.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/fonts/simple-line-icons/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css' . (session('lang') != 'ar' ? '' : '-rtl') . '/core/colors/palette-gradient.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('styles') ?>
</head>

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <?= $this->include('layouts/header') ?>

    <?= $this->include('layouts/sidebar') ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section class="users-view">
                    <div class="row">
                        <div class="col-12 col-sm-7">
                            <div class="media mb-2">
                                <a class="mr-1" href="#">
                                    <img src="<?= session('avatar') != null ? base_url(session('avatar')) : base_url('app-assets/images/avatar.png') ?>" alt="avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                </a>
                                <div class="media-body pt-25">
                                    <h4 class="media-heading"><span class="users-view-name"><?= session('lang') != 'ar' ?  session('kun_yah') : session('kun_yah_ar') ?> <?= session('lang') != 'ar' ?  session('name') : session('name_ar') ?> </span><span class="text-muted font-medium-1"> @</span><span class="users-view-username text-muted font-medium-1 "><?= lang('app.appName') . ' - ' . lang('app.location') ?></span></h4>
                                    <span><?= lang('app.username') ?>:</span>
                                    <span class="users-view-id"> <b><?= session('username') ?></b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->renderSection('content') ?>
                </section>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?= $this->include('layouts/footer') ?>
    <!-- END: Footer-->

    <script src="<?= base_url('app-assets/vendors/js/vendors.min.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

    <script src="<?= base_url('app-assets/vendors/js/charts/chart.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/charts/raphael-min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/charts/morris.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') ?>"></script>
    <script src="<?= base_url('app-assets/data/jvector/visitor-data.js') ?>"></script>

    <script src="<?= base_url('app-assets/js/core/app-menu.js') ?>"></script>
    <script src="<?= base_url('app-assets/js/core/app.js') ?>"></script>

    <script src="<?= base_url('app-assets/js/scripts/pages/dashboard-sales.js') ?>"></script>

    <script>
        // $(document).ready(function() {
        //     Swal.fire({
        //         title: "kjgkdlfd",
        //         text: "dsfnkjnklfd",
        //         icon: "success",
        //         timer: 3000,
        //         showConfirmButton: false,
        //     });
        // });
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

</html>