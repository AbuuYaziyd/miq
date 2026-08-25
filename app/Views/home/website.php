<!DOCTYPE html>
<html class="loading" lang="<?= session('lang') ?>" dir="<?= session('lang') != 'ar' ? 'ltr' : 'rtl' ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?>">
    <meta name="keywords" content="<?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?>">
    <meta name="author" content="Abou Yaziyd">
    <link rel="manifest" href="./manifest.json" />
    <meta name="theme-color" content="<?= $colour['value'] ?>">
    <title><?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?></title>
    <link rel="apple-touch-icon" href="<?= base_url($logo['link']) ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url($logo['link']) ?>">
    <link rel="stylesheet" href="assets/css/style-rtl.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <?= $this->renderSection('styles') ?>
    <script src="https://kit.fontawesome.com/ea9d69aa5c.js" crossorigin="anonymous"></script>
    <style>
        .bg-dark {
            background-color: <?= $colour['value'] ?>;
            color: #fff;
        }

        .main-header {
            background-color: <?= $colour['value'] ?>;
            color: #fff;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: box-shadow 0.3s ease;
        }

        .contact-info h3 {
            color: <?= $colour['value'] ?>;
            border-bottom: 2px solid <?= $colour['value'] ?>;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .value-box i {
            font-size: 2.5em;
            color: <?= $colour['value'] ?>;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <header class="main-header">
        <div class="container header-content">
            <div class="logo">
                <a href="<?= base_url() ?>"><?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?></a>
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
                    <li><a href="<?= base_url('login') ?>" class="cta-link"> <?= lang('app.login') ?> <i class="fa-solid fa-user"></i></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="hero" class="hero-section" style="background-image: url('<?= base_url($carousel['image']) ?>');">
        <div class="hero-overlay">
            <div class="container text-center">
                <?php if (session('lang') != 'ar') : ?>
                    <h1><span class="auto-typed"></span></h1>
                    <p class="lead"><?= $carousel['text'] ?></p>
                <?php else : ?>
                    <!-- <h1><?= $carousel['title_ar'] ?></h1> -->
                    <h1><span class="auto-typed"></span></h1>
                    <p class="lead"><?= $carousel['text_ar'] ?></p>
                <?php endif ?>
                <div class="hero-ctas">
                    <a href="#admissions" class="btn btn-primary btn-lg"><?= lang('app.applyNow') ?></a>
                    <a href="#programs" class="btn btn-secondary btn-lg"><?= lang('app.exploreCourses') ?></a>
                </div>
            </div>
        </div>
    </section>


    <?= $this->include('home/about') ?>
    <?= $this->include('home/impact') ?>

    <footer class="main-footer text-center">
        <div class="container grid-4">
            <div class="footer-col">
                <h4><?= lang('app.language') ?></h4>
                <?php if (session('lang') != 'ar') : ?>
                    <a href="<?= base_url('locale/ar') ?>" class="dropdown-toggle" aria-expanded="false" aria-haspopup="true">
                        AR <i class="fa-solid fa-language"></i>
                    </a>
                <?php else : ?>
                    <a href="<?= base_url('locale/sw') ?>" class="dropdown-toggle" aria-expanded="false" aria-haspopup="true">
                        SW <i class="fa-solid fa-language"></i>
                    </a>
                <?php endif ?>
            </div>
            <div class="footer-col">
                <h4><?= lang('app.links') ?></h4>
                <ul>
                    <li><a href="<?= base_url('login') ?>"><?= lang('app.login') ?></a></li>
                </ul>
            </div>
            <div class="footer-col-8 social-media">
                <h4><?= lang('app.contactUs') ?></h4>
                <a href="mailto:<?= $email['value'] ?>"><i class="fas fa-envelope"></i></a>
                <a href="tel:+<?= $phone['value'] ?>"><i class="fas fa-phone-alt"></i></a>
                <a href="tel:+<?= $phone['link'] ?>"><i class="fas fa-phone-alt"></i></a>
                <a href="https://wa.me/<?= $phone['link'] ?>"><i class="fa fa-whatsapp"></i></a>
                <a href="<?= $location['link'] ?>"><i class="fas fa-map-marker-alt"></i></a>
            </div>
        </div>
        <div class="container text-center copyright">
            <?= lang('app.allRightsReserved') ?> &copy; <?= date('Y') ?>
            <a href="<?= base_url() ?>"><?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?></a>
        </div>
    </footer>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <?= $this->renderSection('scripts') ?>
    <?php foreach ($hero as $hr) : ?>
        <?php if (session('lang') != 'ar') : ?>
            <?php $data[] = $hr['title']; ?>
        <?php else : ?>
            <?php $data[] = $hr['title_ar']; ?>
        <?php endif ?>
    <?php endforeach ?>

    <?= $this->section('scripts') ?>
    <script>
        var typed = new Typed(".auto-typed", {
            strings: <?= json_encode($data); ?>,
            tpyeSpeed: 150,
            backSpeed: 150,
            loop: true,
        })
    </script>

</body>

</html>