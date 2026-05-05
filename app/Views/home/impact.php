<?php

use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;

$set = new Setting();
$usr = new User();
$tmn = new Testimonial();

$mujtama = $set->where('name', 'mujtama')->findAll();
$tm = $tmn->where('web', 1)->orderBy('id', 'random')->first();
$icons = ['mosque', 'users', 'book-open'];

?>
<section id="impact" class="impact-section section-padding bg-dark">
    <div class="container">
        <h2 class="section-title text-center text-white"><?= lang('app.peopleVoice') ?></h2>

        <div class="stats-grid grid-4">
            <div class="stat-box">
                <span class="stat-number counter" data-target="95">0</span>
                <p class="stat-label"><?= lang('app.graduateRatio') ?></p>
            </div>
            <div class="stat-box">
                <span class="stat-number counter" data-target="20">0</span>
                <p class="stat-label"><?= lang('app.teacherCount') ?></p>
            </div>
            <div class="stat-box">
                <span class="stat-number counter" data-target="1999">0</span>
                <p class="stat-label"><?= lang('app.established') ?></p>
            </div>
            <div class="stat-box">
                <span class="stat-number counter" data-target="15">0</span>
                <p class="stat-label"><?= lang('app.studentClassRatio') ?></p>
            </div>
        </div>

        <div class="testimonials-container">
            <div class="testimonials-slider">
                <?php $user = $usr->find($tm['user_id']) ?>
                <blockquote class="testimonial">
                    <?php if (session('lang') != 'ar') : ?>
                        <p>"<?= $tm['content'] ?>"</p>
                        <cite><?= $user['name'] ?> <?= $user['mname'] ?> <?= $user['lname'] ?></cite>
                    <?php else : ?>
                        <p>"<?= $tm['content_ar'] ?>"</p>
                        <cite><?= $user['name_ar'] ?> <?= $user['mname_ar'] ?> <?= $user['lname_ar'] ?></cite>
                    <?php endif ?>
                </blockquote>
            </div>
        </div>

    </div>
</section>

<section id="campus-life" class="campus-section section-padding bg-light">
    <div class="container">
        <h2 class="section-title text-center"><?= lang('app.mujtamaa') ?></h2>

        <div class="feature-grid grid-3 text-center">
            <?php foreach ($mujtama as $key => $mj) : ?>
                <div class="feature-item">
                    <i class="fas fa-<?= $icons[$key] ?>"></i>
                    <?php if (session('lang') != 'ar') : ?>
                        <h4><?= $mj['value'] ?></h4>
                        <p><?= $mj['info'] ?></p>
                    <?php else : ?>
                        <h4><?= $mj['link'] ?></h4>
                        <p><?= $mj['extra'] ?></p>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>