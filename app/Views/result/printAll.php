<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<?php $muadala = 0;
$masomo = 0;
$points = 0 ?>
<?php for ($i = 0; $i < 4; $i++) : ?>
<?php if (!$res[$i]['res'] == 0) : ?>
    <div class="row">
        <div class="col-12">
            <div class="card"><br>
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <img src="<?= base_url('app-assets/images/logo/logo.svg') ?>" alt="signature" height="200" />
                        </div>
                        <h1 class="page-header" style="text-align: center;">
                            <b><?= env('APP_NAME') ?></b><br>
                            <b><?= env('LOCATION') ?></b><br>
                        </h1>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-header" style="text-align: center;">
                            <b><?= lang('app.stuName') ?>:</b> <?= $user['name_ar'] ?><br>
                            <b><?= lang('app.username') ?>:</b> <?= $user['malaf'] ?><br>
                        </h3>
                    </div>
                </div>
                <!-- /.row -->
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dataex-res-constructor">
                            <thead>
                                <tr>
                                    <th colspan="6" style="text-align: center;">
                                        <?= lang('app.' . ($_SESSION['role'] == 'admin' ? 'results' : 'myRes') . '') ?> <?= $res[$i]['class']['name'] ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.subject') ?></th>
                                    <th><?= lang('app.final') ?></th>
                                    <th><?= lang('app.points') ?></th>
                                    <th><?= lang('app.grade') ?></th>
                                    <th><?= lang('app.taqdir') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $point = 0;
                                $total = 0 ?>
                                <?php foreach ($res[$i]['res'] as $key => $data) : ?>
                                    <?php if ($data['marks'] >= 95) {
                                        $grade = 'ممتاز مرتفع';
                                        $point = 5;
                                        $alama = 'أ+';
                                    } elseif ($data['marks'] >= 90) {
                                        $grade = 'ممتاز';
                                        $point = 4.75;
                                        $alama = 'أ';
                                    } elseif ($data['marks'] >= 85) {
                                        $grade = 'جيد جدا مرتفع';
                                        $point = 4.5;
                                        $alama = 'ب+';
                                    } elseif ($data['marks'] >= 80) {
                                        $grade = 'جيد جدا';
                                        $point = 4;
                                        $alama = 'ب';
                                    } elseif ($data['marks'] >= 75) {
                                        $grade = 'جيد مرتفع';
                                        $point = 3.5;
                                        $alama = 'ج+';
                                    } elseif ($data['marks'] >= 70) {
                                        $grade = 'جيد';
                                        $point = 3;
                                        $alama = 'ج';
                                    } elseif ($data['marks'] >= 65) {
                                        $grade = 'مقبول مرتفع';
                                        $point = 2.5;
                                        $alama = 'د+';
                                    } elseif ($data['marks'] >= 60) {
                                        $grade = 'مقبول';
                                        $point = 2;
                                        $alama = 'د';
                                    } else {
                                        $grade = 'راســـــــــب';
                                        $point = 1;
                                        $alama = 'هـ';
                                    } ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $data['name'] ?></span>
                                        </td>
                                        <td><?= $data['marks']  ?></td>
                                        <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $point ?></span>
                                        </td>
                                        <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $alama ?></span>
                                        </td>
                                        <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $grade ?></span>
                                        </td>
                                    </tr>
                                    <?php $total = $total + $data['marks'] ?>
                                    <?php $points += $point ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered" style="text-align: center;">
                            <thead>
                                <th><?= lang('app.purpose') ?></th>
                                <th><?= lang('app.subject') ?></th>
                                <th><?= lang('app.muadalaHuu') ?></th>
                                <th><?= lang('app.masarMuadala') ?></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><?= lang('app.fasliy') ?></th>
                                    <td><?= $sub[$i] ?></td>
                                    <td><?= round($masar = (($total / (($key + 1) * 100)) * 5), 2) ?></td>
                                    <?php if ($masar >= 4.75) {
                                        $color = '#D79334';
                                        $grade = 'التمييز';
                                    } elseif ($masar >= 3.75) {
                                        $color = '#228B22';
                                        $grade = 'الاجتهاد';
                                    } elseif ($masar >= 2.75) {
                                        $color = '#0096FF';
                                        $grade = 'الإصرار';
                                    } else {
                                        $color = 'red';
                                        $grade = 'التعثر';
                                    } ?>
                                    <td><b><span style="color:<?= $color ?>"><?= $grade ?></span></b></td>
                                </tr>
                                <tr>
                                    <?php $muadala += $masar ?>
                                    <?php $masomo += $sub[$i] ?>
                                    <th><?= lang('app.tarakum') ?></th>
                                    <td> <?= $masomo ?></td>
                                    <!-- <td><?= round(($muadala / ($i + 1)), 2) ?></td> -->
                                    <td><?= $mudl = round(($muadala / ($i + 1)), 2) ?></td>
                                    <?php if ($masar >= 4.75) {
                                        $color = '#D79334';
                                        $grade = 'التمييز';
                                    } elseif ($masar >= 3.75) {
                                        $color = '#228B22';
                                        $grade = 'الاجتهاد';
                                    } elseif ($masar >= 2.75) {
                                        $color = '#0096FF';
                                        $grade = 'الإصرار';
                                    } else {
                                        $color = 'red';
                                        $grade = 'التعثر';
                                    } ?>
                                    <td><b><span style="color:<?= $color ?>"><?= $grade ?></span></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row ml-2 mt-2">
                    <div class="text-center">
                        <img src="<?= base_url('app-assets/images/pages/signature-scan.png') ?>" alt="signature" class="height-100" />
                        <h6>شيخ: محمد علي جاروفو</h6>
                        <p class="text-muted">مدير مركز أمام البخاري</p>
                        <h6><?= date('d/m/Y') ?></h6>
                    </div>
                    <!-- <div class="text-center">
                        <img src="<?= base_url('app-assets/images/logo/logo.svg') ?>" alt="signature" height="200" /><br>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<div style="page-break-after: always;"></div>
<?php endfor ?>
<script>
    document.addEventListener("load", window.print());
</script>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>