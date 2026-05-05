<?php

use App\Models\Country;
use App\Models\User;

$usr = new User();
$dob = new DateTime(date('Y-m-d', strtotime($stu['dob'])));
$now = new DateTime('today');
$nat = new Country();

$age = $dob->diff($now)->y;
$nationality = $nat->where('code', $stu['nationality'])->first()['country_en'];

if (session('lang') != 'ar') {
    $name = $stu['name'] . ' ' . $stu['mname'] . ' ' . $stu['lname'];
} else {
    $name = $stu['name_ar'] . ' ' . $stu['mname_ar'] . ' ' . $stu['lname_ar'];
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                <h2>
                    <b><a href="<?= base_url('user/profile/' . $stu['id']) ?>"><?= $stu['username'] ?></a></b>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm round float-right" id="logout"><i class="ft-power"></i> <?= lang('app.logout') ?></a>
                </h2>
            </div>
            <div class="card-content">
                <div class="content d-flex flex-wrap">
                    <div class="col-lg-4 text-center pb-3">
                        <img src="<?= base_url('app-assets/images/avatar/av' . ($stu['sex'] != 'M' ? 'f' : '') . '.png') ?>" class="rounded-circle">
                        <h3 class="modal-title">
                            <b><?= $name ?></b> | <i data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?= $nationality ?>" class="flag-icon flag-icon-<?= strtolower($stu['nationality']) ?>"></i>
                        </h3>
                        <p class="m-0"><?= $stu['email'] ?></p>
                        <p class="m-0"><?= $stu['phone'] ?></p>
                    </div>
                    <div class="col-lg-8">
                        <?php if ($stu['role'] != 'mafsul') : ?>
                            <table class="table table-striped text-center">
                                <tbody>
                                    <tr>
                                        <td><?= lang('app.course') ?>: <b><?= $school['name'] ?? 'N/A' ?></b></td>
                                        <td><?= lang('app.age') ?>: <b><?= $age ?></b></td>
                                    </tr>
                                    <tr>
                                        <td><?= lang('app.class') ?>: <b><?= $class['name'] ?? 'N/A' ?></b></td>
                                        <td><?= lang('app.sex') ?>: <b><?= $stu['sex'] ?? 'N/A' ?></b></td>
                                    </tr>
                                    <tr>
                                        <td><?= lang('app.username') ?>: <b><?= $stu['username'] ?></b></td>
                                        <td><?= lang('app.dob') ?>: <b><?= date('d-m-Y', strtotime($stu['dob'])) ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="<?= base_url('change/password') ?>" target="_blank" class="btn btn-outline-warning round btn-sm <?= session('id') != $stu['id'] ? 'disabled' : '' ?>"><?= lang('app.resetpassword') ?></a>
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
                                            <td><a href="<?= base_url('reset/' . $stu['id']) ?>" class="btn btn-danger btn-sm round" id="reset"><?= lang('app.passchange') ?></a></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-info btn-sm round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $class['name'] ?? 'N/A' ?></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 42px, 0px);">
                                                        <?php foreach ($classes as $cl) : ?>
                                                            <a class="dropdown-item" href="<?= base_url('student/class-change/' . $stu['id'] . '/' . $cl['id']) ?>"><?= $cl['name'] ?></a>
                                                        <?php endforeach ?>
                                                        <a class="dropdown-item" href="<?= base_url('student/change-class/' . $stu['id'] . '/mafsul') ?>"><?= lang('app.mafsul') ?> - <?= lang('app.fee') ?></a>
                                                        <!-- <a class="dropdown-item" href="<?= base_url('student/change-class/' . $stu['id'] . '/mafsul') ?>"><?= lang('app.mafsul') ?></a> -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <table class="table table-striped text-center">
                                <tbody>
                                    <tr>
                                        <td><?= lang('app.status') ?>: <b><?= lang('app.mafsul') ?></b></td>
                                        <td><?= lang('app.reason') ?>: <b><?= lang('app.' . $stu['info']) ?></b></td>
                                    </tr>
                                    <?php if (session('role') == 'admin') : ?>
                                        <tr>
                                            <td colspan="2">
                                                <a class="btn btn-lg btn-block btn-primary back" href="<?= base_url('student/back/' . $stu['id']) ?>"><?= lang('app.paid') ?></a>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        <?php endif ?>
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
<script>
    $('.back').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.sure') ?>',
            text: '<?= lang('app.backToClass') ?>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>!',
            cancelButtonText: '<?= lang('app.no') ?>!',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            }
        })
    });
</script>