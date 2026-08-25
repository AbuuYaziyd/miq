<!DOCTYPE html>
<html class="loading" lang="<?= session('lang') ?>" dir="<?= session('lang') != 'ar' ? 'ltr' : 'rtl' ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?= lang('app.appName') ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?>">
    <meta name="keywords" content="<?= lang('app.appName') ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?>">
    <meta name="author" content="Abou Yaziyd">
    <link rel="manifest" href="./manifest.json" />
    <meta name="theme-color" content="#1b877a">
    <title><?= lang('app.appName') ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?></title>
    <link rel="apple-touch-icon" href="<?= base_url($logo['link']) ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url($logo['link']) ?>">
    <link rel="stylesheet" href="assets/css/style-rtl.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <?= $this->renderSection('styles') ?>
    <script src="https://kit.fontawesome.com/ea9d69aa5c.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="main-header">
        <div class="container header-content">
            <div class="logo">
                <a href="<?= base_url() ?>"><?= lang('app.appName') ?></a>
            </div>

            <button class="menu-toggle" aria-controls="main-nav-list" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>

            <nav class="main-nav">
                <ul id="main-nav-list">
                    <li>
                        <?php if (session('lang') != 'ar') : ?>
                            <a href="<?= base_url('locale/ar') ?>" class="dropdown-toggle" aria-expanded="false" aria-haspopup="true">
                                AR <i class="fa-solid fa-language"></i>
                            </a>
                        <?php else : ?>
                            <a href="<?= base_url('locale/sw') ?>" class="dropdown-toggle" aria-expanded="false" aria-haspopup="true">
                                SW <i class="fa-solid fa-language"></i>
                            </a>
                        <?php endif ?>
                    </li>
                    <li><a href="#programs"><?= lang('app.academic') ?></a></li>
                    <li><a href="#admissions"><?= lang('app.admission') ?></a></li>
                    <li><a href="#campus-life"><?= lang('app.academic') ?></a></li>
                    <li><a href="#about"><?= lang('app.about') ?></a></li>
                    <li><a href="#contact" class="cta-link"><?= lang('app.contactUs') ?></a></li>
                    <li><a href="<?= base_url('login') ?>" class="cta-link"> <i class="fa-solid fa-user"></i></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <?= $this->renderSection('content') ?>

    <footer class="main-footer text-center">
        <div class="container grid-4">
            <div class="footer-col">
                <h4><?= lang('app.contactUs') ?></h4>
                <?php if (session('lang') != 'ar') : ?>
                    <p><a href="<?= $location['link'] ?>" target="_blank"><?= $location['value'] ?></a></p>
                <?php else : ?>
                    <p><a href="<?= $location['link'] ?>" target="_blank"><?= $location['extra'] ?></a></p>
                <?php endif ?>
                <p><a href="#"><?= $email['value'] ?></a></p>
                <p><a href="tel:+<?= $phone['value'] ?>"><?= $phone['value'] ?></a></p>
                <p><a href="tel:+<?= $phone['link'] ?>"><?= $phone['link'] ?></a></p>
            </div>
            <div class="footer-col">
                <h4><?= lang('app.links') ?></h4>
                <ul>
                    <li><a href="<?= base_url('login') ?>"><?= lang('app.login') ?></a></li>
                </ul>
            </div>
            <div class="footer-col social-media">
                <h4><?= lang('app.followUs') ?></h4>
                <a href="https://wa.me/<?= $phone['value'] ?>" target="_blank" aria-label="Facebook"><i class="fab fa-whatsapp"></i></a>
                <a href="mailto:<?= $email['value'] ?>" aria-label="LinkedIn"><i class="fas fa-envelope"></i></a>
                <a href="tel:+<?= $phone['value'] ?>" aria-label="LinkedIn"><i class="fas fa-phone"></i></a>
            </div>
        </div>
        <div class="container text-center copyright">
            <?= lang('app.allRightsReserved') ?> &copy; <?= date('Y') ?> <?= lang('app.appName') ?>
        </div>
    </footer>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>