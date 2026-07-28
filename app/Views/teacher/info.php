<?php

use App\Models\Country;
use App\Models\User;

$usr = new User();
$dob = new DateTime(date('Y-m-d', strtotime($user['dob'])));
$now = new DateTime('today');
$nat = new Country();

$age = $dob->diff($now)->y;
$nationality = $nat->where('code', $user['nationality'])->first()['country_en'];

if (session('lang') != 'ar') {
    $name = $user['name'] . ' ' . $user['mname'] . ' ' . $user['lname'];
} else {
    $name = $user['name_ar'] . ' ' . $user['mname_ar'] . ' ' . $user['lname_ar'];
}

$ujumbe = htmlspecialchars('
السلام عليكم ورحمة الله وبركاته%0A%0A
مرحبا: ' . $user['name_ar'] . ' '  . $user['mname_ar'] . ' '  . $user['lname_ar'] . '، في موقعنا. 
%0A

اسم المستخدم: ' . $user['username'] . ' %0A
البريد الإلكتروني: ' . $user['email'] . ' %0A
كلمة المرور: ' . strtoupper($user['lname']) . ' %0A%0A

الرابط: https://ibnulqayyim.rf.gd %0A%0A
بارك الله فيكم!
%0A%0A
______________________________________%0A%0A
Assalaamu Alaikum warahmatullahi Wabarakaatuh! %0A%0A

Karibu Ndugu: ' . $user['name'] . ' '  . $user['mname'] . ' '  . $user['lname'] . ', Katika website yetu. %0A%0A
Namba ya Usajili: ' . $user['username'] . ' %0A
Email: ' . $user['email'] . ' %0A
Nenosiri: ' . strtoupper($user['lname']) . '%0A%0A
Wavuti: https://ibnulqayyim.rf.gd
%0A%0A
Baarakallahu Fiykum!');
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                <h2>
                    <b><a href="<?= base_url('user/profile/' . $user['id']) ?>"><?= $user['username'] ?></a></b>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm round float-right" id="logout"><i class="ft-power"></i> <?= lang('app.logout') ?></a>
                </h2>
            </div>
            <div class="card-content">
                <div class="content d-flex flex-wrap">
                    <div class="col-lg-4 text-center pb-3">
                        <img src="<?= base_url('app-assets/images/avatar/av' . ($user['sex'] != 'M' ? 'f' : '') . '.png') ?>" class="rounded-circle">
                        <h3 class="modal-title">
                            <b><?= $name ?></b> | <i data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?= $nationality ?>" class="flag-icon flag-icon-<?= strtolower($user['nationality']) ?>"></i>
                        </h3>
                        <p class="m-0"><?= $user['email'] ?></p>
                        <p class="m-0"><?= $user['phone'] ?></p>
                        <?php if (session('role') == 'admin') : ?>
                            <ul class="list-inline list-inline-pipe">
                                <?php if ($user['phone'] != null) : ?>
                                    <li>
                                        <a href="https://wa.me/<?= str_replace(' ', '', $user['phone']) ?>?text=<?= $ujumbe ?>" class="btn btn-success btn-sm round" target="_blank">
                                            <i class="la la-whatsapp"></i>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php if ($user['email'] != null) : ?>
                                    <li>
                                        <a href="mailto:<?= $user['email'] ?>?subject=<?= lang('app.appName') ?>&body=<?= $ujumbe ?>." class="btn btn-warning btn-sm round" target="_blank">
                                            <i class="icon-envelope"></i>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        <?php endif ?>
                    </div>
                    <div class="col-lg-8">
                        <table class="table table-striped text-center">
                            <tbody>
                                <tr>
                                    <td><?= lang('app.course') ?>: <b><?= $user['school'] ?? 'N/A' ?></b></td>
                                    <td><?= lang('app.age') ?>: <b><?= $age ?></b></td>
                                </tr>
                                <tr>
                                    <td><?= lang('app.class') ?>: <b><?= lang('app.' . $user['level']) ?? 'N/A' ?></b></td>
                                    <td><?= lang('app.sex') ?>: <b><?= $user['sex'] ?? 'N/A' ?></b></td>
                                </tr>
                                <tr>
                                    <td><?= lang('app.username') ?>: <b><?= $user['username'] ?></b></td>
                                    <td><?= lang('app.dob') ?>: <b><?= date('d-m-Y', strtotime($user['dob'])) ?></b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="<?= base_url('change/password') ?>" target="_blank" class="btn btn-outline-warning round btn-sm sure"><?= lang('app.passchange') ?></a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-teal btn-sm round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php if (session('lang') == 'ar') : ?>
                                                    <i class="flag-icon flag-icon-sa"></i> العربية
                                                <?php elseif (session('lang') == 'sw') : ?>
                                                    <i class="flag-icon flag-icon-tz"></i> Kiswahili
                                                <?php endif ?>
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 42px, 0px);">
                                                <a class="dropdown-item" href="<?= base_url('locale/sw') ?>" data-language="sw">
                                                    <i class="flag-icon flag-icon-tz"></i> Kiswahili
                                                </a>
                                                <a class="dropdown-item" href="<?= base_url('locale/ar') ?>" data-language="ar">
                                                    <i class="flag-icon flag-icon-sa"></i> العربية
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php if (session('role') == 'admin') : ?>
                                    <tr>
                                        <td><a href="<?= base_url('reset/' . $user['id']) ?>" class="btn btn-danger btn-sm round" id="reset"><?= lang('app.resetpassword') ?></a></b></td>
                                        <!-- <td><a href="<?= base_url('reset/' . $user['id']) ?>" class="btn btn-danger btn-sm round" id="reset"><?= lang('app.resetpassword') ?></a></b></td> -->
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<script>
    $('#reset').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.reset') ?>',
            text: '<?= lang('app.passchangeof') ?><?= $name ?>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            }
        })
    });
</script>
<script>
    $('#logout').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.sureLogout') ?>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            }
        })
    });
</script>