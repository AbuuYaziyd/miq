<?php

use App\Models\Setting;

$set = new Setting();

$email = $set->where('name', 'email')->first();
$phone = $set->where('name', 'phone')->first();
$location = $set->where('name', 'location')->first();

?>
<section id="contact" class="contact-section section-padding">
    <div class="container text-center">
        <h2 class="section-title"><?= lang('app.contactNow') ?></h2>
        <div class="contact-grid grid-2">
            <div class="contact-info">
                <h3><?= lang('app.directContact') ?></h3>
                <p>
                    <i class="fas fa-phone-alt"></i><br>
                    <b><?= lang('app.phone') ?>:</b><br>
                    <a href="tel:+<?= $phone['value'] ?>"><?= $phone['value'] ?></a><br>
                    <a href="tel:+<?= $phone['link'] ?>"><?= $phone['link'] ?></a>
                </p>
                <br><hr><br>
                <p>
                    <i class="fas fa-envelope"></i><br>
                    <b><?= lang('app.email') ?>:</b><br>
                    <a href="mailto:<?= $email['value'] ?>"><?= $email['value'] ?></a>
                </p>
                <br><hr><br>
                <p>
                    <i class="fas fa-map-marker-alt"></i><br>
                    <b><?= lang('app.location') ?>: </b><br>
                    <a href="<?= $location['link'] ?>" target="_blank">
                        <?php if (session('lang') != 'ar') : ?>
                            <p><?= $location['value'] ?></p>
                        <?php else : ?>
                            <p><?= $location['extra'] ?></p>
                        <?php endif ?>
                    </a>
                </p>
                </div>
            </div>

        </div>
    </div>
</section>