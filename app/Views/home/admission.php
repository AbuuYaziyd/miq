<?php

use App\Libraries\Hijri;
use App\Models\Setting;

$hjr = new Hijri();
$set = new Setting();

$admission = $set->where('name', 'registration')->first();
// dd($hjr->strToHijri(date('d-m-Y', strtotime($admission['extra'])), 'l, d F Y', session('lang')), $hjr);

?>
<section id="admissions" class="admissions-cta section-padding">
    <div class="container text-center">
        <h2 class="section-title">
            <?php if (session('lang') != 'ar') : ?>
                <?= $admission['value'] ?>
            <?php else : ?>
                <?= $admission['link'] ?>
            <?php endif ?>
        </h2>

        <div class="admissions-info-box">
            <div class="date-badge">
                <i class="fas fa-calendar-alt"></i><br>
                <b><?= lang('app.appDeadline') ?>: </b><br>
                <?php if (session('lang') != 'ar') : ?>
                    <?= $hjr->strToHijri(date('j-m-Y', strtotime($admission['extra'])), 'l, d F Y', session('lang')) ?>H <br> <?= date('j-m-Y', strtotime($admission['extra'])) ?>M
                <?php else : ?>
                    <?= $hjr->strToHijri(date('j-m-Y', strtotime($admission['extra'])), "l, d F Yهـ", session('lang')) ?> <br> <?= date('j-m-Y', strtotime($admission['extra'])) ?>م
                <?php endif ?>
            </div>
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary btn-xl"><?= lang('app.applyNow') ?></a>
                <a href="#" class="btn btn-secondary btn-xl" target="_blank"><?= lang('app.admissionGuide') ?></a>
            </div>
        </div>
    </div>
</section>