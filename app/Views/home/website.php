<?= $this->extend('layouts/web') ?>

<?= $this->section('content') ?>

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
<?= $this->endSection() ?>
<?php
foreach ($hero as $hr) {
    if (session('lang') != 'ar') {
        $data[] = $hr['title'];
    } else {
        $data[] = $hr['title_ar'];
    }
}
// dd($data);
?>
<?= $this->section('scripts') ?>
<script>
    var typed = new Typed(".auto-typed", {
        strings: <?= json_encode($data); ?>,
        tpyeSpeed: 150,
        backSpeed: 150,
        loop: true,
    })
</script>
<?= $this->endSection() ?>