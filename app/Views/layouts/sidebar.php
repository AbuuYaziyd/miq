<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="<?= ($title == lang('app.dashboard') ? 'active' : '') ?> nav-item">
                <a href="<?= base_url('user') ?>">
                    <i class="la la-home"></i>
                    <span class="menu-title"><?= lang('app.dashboard') ?></span>
                    <span class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            </li>
            <?php if (session('role')  == 'admin') : ?>
                <li class="<?= ($title == lang('app.website') ? 'active' : '') ?> nav-item">
                    <a href="<?= base_url('web') ?>">
                        <i class="la la-globe"></i>
                        <span class="menu-title"><?= lang('app.website') ?></span>
                        <span class="badge badge badge-info badge-pill float-right mr-2"></span>
                    </a>
                </li>
                <li class="nav-item"><a href="#"><i class="la la-cog spinner"></i><span class="menu-title" data-i18n="Dashboard"><?= lang('app.settings') ?></span></a>
                    <ul class="menu-content">
                        <li class="<?= $title == lang('app.periods') ? 'active' : ($title == lang('app.timetable') ? 'active' : '') ?>">
                            <a class="menu-item" href="<?= base_url('period') ?>">
                                <span data-i18n="Crypto"><?= lang('app.periods') ?></span>
                            </a>
                        </li>
                        <li class="<?= ($title == lang('app.grades') ? 'active' : '') ?>">
                            <a class="menu-item" href="<?= base_url('grade') ?>">
                                <span data-i18n="Crypto"><?= lang('app.grades') ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#"><i class="la la-bank"></i><span class="menu-title" data-i18n="Dashboard"><?= lang('app.academic') ?></span></a>
                    <ul class="menu-content">
                        <li class="<?= ($title == lang('app.schools') ? 'active' : ($title == lang('app.subject') ? 'active' : '')) ?>">
                            <a class="menu-item" href="<?= base_url('school') ?>">
                                <span data-i18n="eCommerce"><?= lang('app.schools') ?></span>
                            </a>
                        </li>
                        <li class="<?= ($title == lang('app.acYear') ? 'active' : '') ?>">
                                <a class="menu-item" href="<?= base_url('year') ?>">
                                <span data-i18n="Crypto"><?= lang('app.acYear') ?></span></a>
                        </li>
                    </ul>
                </li>
                <li class="<?= ($title == lang('app.teachers') ? 'active' : '') ?> nav-item"><a href="<?= base_url('teacher') ?>"><i class="la la-stethoscope"></i><span class="menu-title"><?= lang('app.teachers') ?></span></a>
                </li>
                <!-- <li class="<?= ($title == lang('app.graduates') ? 'active' : '') ?> nav-item"><a href="<?= base_url('khirrij') ?>"><i class="la la-graduation-cap"></i><span class="menu-title"><?= lang('app.graduates') ?></span></a>
                </li> -->
                <!-- <li class="<?= ($title == lang('app.mafsuls') ? 'active' : '') ?> nav-item"><a href="<?= base_url('mafsul') ?>"><i class="icon-fire"></i><span class="menu-title"><?= lang('app.mafsuls') ?></span></a>
                </li> -->
            <?php endif ?>
            <!-- <li class="<?= ($title == lang('app.results') ? 'active' : '') ?> nav-item"><a href="<?= base_url('result') ?>"><i class="la la-check-circle"></i><span class="menu-title"><?= lang('app.results') ?></span></a>
            </li> -->
            <?php if (session('role') != 'student') : ?>
                <li class="<?= ($title == lang('app.students') ? 'active' : '') ?> nav-item"><a href="<?= base_url('student') ?>"><i class="icon-users"></i><span class="menu-title"><?= lang('app.students') ?></span></a>
                </li>
            <?php endif ?>
            <!-- <li class=" nav-item"><a href="#"><i class="la la-cog"></i><span class="menu-title" data-i18n="Templates"><?= lang('app.settings') ?></span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#"><i></i><span data-i18n="Vertical">Vertical</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="../vertical-menu-template"><i></i><span data-i18n="Classic Menu">Classic Menu</span></a>
                            </li>
                            <li><a class="menu-item" href="../vertical-modern-menu-template"><i></i><span data-i18n="Modern Menu">Modern Menu</span></a>
                            </li>
                            <li><a class="menu-item" href="../vertical-collapsed-menu-template"><i></i><span data-i18n="Collapsed Menu">Collapsed Menu</span></a>
                            </li>
                            <li><a class="menu-item" href="../vertical-compact-menu-template"><i></i><span data-i18n="Compact Menu">Compact Menu</span></a>
                            </li>
                            <li><a class="menu-item" href="../vertical-content-menu-template"><i></i><span data-i18n="Content Menu">Content Menu</span></a>
                            </li>
                            <li><a class="menu-item" href="../vertical-overlay-menu-template"><i></i><span data-i18n="Overlay Menu">Overlay Menu</span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="menu-item" href="#"><i></i><span data-i18n="Horizontal">Horizontal</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="../horizontal-menu-template"><i></i><span data-i18n="Classic">Classic</span></a>
                            </li>
                            <li><a class="menu-item" href="../horizontal-menu-template-nav"><i></i><span data-i18n="Full Width">Full Width</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>
<!-- END: Main Menu-->