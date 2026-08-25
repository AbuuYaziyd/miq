<?php

use App\Models\Setting;

$set = new Setting();

$markaz = $set->where('name', 'name')->first();
$logo = $set->where('name', 'logo')->first();
?>
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="<?= session('isLoggedIn') == true ? base_url('user') : base_url() ?>">
                        <img class="brand-logo" alt="logo" src="<?= base_url($logo['link']) ?> ">
                        <h3 class="brand-text"><?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?></h3>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>