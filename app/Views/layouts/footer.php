<?php

use App\Models\Setting;

$set = new Setting();

$markaz = $set->where('name', 'name')->first();
$logo = $set->where('name', 'logo')->first();
?>
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block"><?= lang('app.allRightsReserved') ?> &copy; <?= date('Y') ?> <a class="text-bold-800 grey darken-2" href="<?= base_url() ?>" target="_blank"><?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?></a></span>
        <span class="float-md-right d-none d-lg-block"><?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?>
            <i class="ft-sun pink"></i>
            <span id="scroll-top"></span>
        </span>
    </p>
</footer>