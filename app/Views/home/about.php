<?php

use App\Models\Subject;
use App\Models\Website;

$web = new Website();
$sub = new Subject();

$study = $web->where('item', 'aboutStudy')->first();
$about_text = $web->where('item', 'aboutText')->findAll();
$subjects = $sub->orderBy('id', 'random')->findAll(5);

?>
<section id="about" class="mission-section section-padding bg-light text-center">
    <div class="container">
        <h2 class="section-title"><?= lang('app.aboutWeb') ?></h2>
        <div class="mission-text">
            <p><?= lang('app.aboutTextWeb') ?></p><br>
        </div>

        <div class="value-propositions grid-3">
            <?php foreach ($about_text as $ab) : ?>
                <div class="value-box">
                    <i class="<?= $ab['content'] ?>"></i>
                    <?php if (session('lang') != 'ar') : ?>
                        <h3><?= $ab['title'] ?></h3>
                        <p><?= $ab['text'] ?></p>
                    <?php else : ?>
                        <h3><?= $ab['title_ar'] ?></h3>
                        <p><?= $ab['text_ar'] ?></p>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<section id="programs" class="programs-section section-padding">
    <div class="container">
        <h2 class="section-title text-center">
            <?php if (session('lang') != 'ar') : ?>
                <?= $study['title'] ?>
            <?php else : ?>
                <?= $study['title_ar'] ?>
            <?php endif ?>
        </h2>

        <div class="program-grid grid-4 text-center">
            <?php foreach ($subjects as $sb) : ?>
                <div class="program-card">
                    <?php if (session('lang') != 'ar') : ?>
                        <span><b><?= $sb['name'] ?></b></span><br>
                    <?php else : ?>
                        <span><b><?= $sb['name_ar'] ?></b></span><br>
                    <?php endif ?>
                    <span><?= $sb['ramz'] ?></span>
                </div>
            <?php endforeach ?>
        </div>

        <!-- <div class="text-center pt-5">
            <a href="/all-programs" class="btn btn-tertiary">View All Programs (50+)</a>
        </div> -->
    </div>
</section>