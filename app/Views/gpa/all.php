<?php
$muadala = [];
$masomo = 0;
$point = 0;
$total = 0;
?>
<!DOCTYPE html>
<html class="loading" lang="<?= service('request')->getLocale() ?>" data-textdirection="<?= service('request')->getLocale() != 'ar' ? 'ltr' : 'rtl' ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?= getenv('APP_NAME') . ' | ' . getenv('LOCATION') ?>">
    <meta name="keywords" content="<?= getenv('APP_NAME') . ' | ' . getenv('LOCATION') ?>">
    <meta name="author" content="Abou Yaziyd">
    <link rel="manifest" href="./manifest.json" />
    <meta name="theme-color" content="#3367D6">
    <title><?= getenv('APP_NAME') . ' | ' . $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" href="<?= base_url('app-assets/images/logo/logo.png') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('app-assets/images/logo/logo.png') ?>">
    <style>
        /* --- General Page and Print Styles --- */
        body {
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 1cm;
            font-size: 10pt;
        }

        @page {
            margin: 0;
        }

        .next-page {
            break-after: always;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header-section {
            display: flex;
            flex-direction: column;
            text-align: left;
            flex: 1;
        }

        .header-section.right {
            text-align: right;
        }

        .school-logo {
            max-width: 100px;
            height: auto;
            margin: 0 20px;
            /* Provides space around the logo */
        }

        .school-info {
            font-size: 10pt;
        }

        /* --- Table Styling for Report Card --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: center;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 2px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <div class="next-page">
        <?php foreach ($gpa as $k => $dt) : ?>
            <div class="header">
                <div class="header-section">
                    <div class="school-info">
                        <span dir="rtl"><b><?= env('APP_NAME') ?></b></span><br>
                        <span dir="rtl"><b><?= env('LOCATION') ?></b></span><br>
                        <span dir="rtl">اسم الطالب: <b><?= $user['name_ar'] ?></b></span><br>
                        <span dir="rtl">رقم الطالب: <b><?= $user['malaf'] ?></b></span><br>
                        <span dir="rtl"><?= lang('app.position') ?>: <b><?= $user['role'] == 'graduate' ? lang('app.graduate') : lang('app.active') ?></b></span><br>
                    </div>
                </div>

                <img src="<?= base_url('app-assets/images/logo/logo.png') ?>" alt="logo" height="150" />

                <div class="header-section right">
                    <div class="school-info">
                        <span dir="rtl"><b><?= env('APP_NAME') ?></b></span><br>
                        <span dir="rtl"><b><?= env('LOCATION') ?></b></span><br>
                        <span dir="rtl">اسم الطالب: <b><?= $user['name_ar'] ?></b></span><br>
                        <span dir="rtl">رقم الطالب: <b><?= $user['malaf'] ?></b></span><br>
                        <span dir="rtl"><?= lang('app.position') ?>: <b><?= $user['role'] == 'graduate' ? lang('app.graduate') : lang('app.active') ?></b></span><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div style="text-align: center;"><img src="<?= base_url('app-assets/images/bismillah.png') ?>" alt="bismillah" height="80" /></div>
            </div>
            <div class="row" style="height: 100wh;">
                <div class="col-12">
                    <div class="card">
                        <?php $class = $g->class($dt['class_id']) ?>
                        <?php $results = $g->results($dt['student_id'], $dt['class_id']) ?>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="table table-striped table-bordered dataex-res-constructor">
                                    <thead>
                                        <tr>
                                            <th colspan="3" style="text-align: center;"><?= $g->year($dt['year_id'])['name'] ?></th>
                                            <th colspan="3" style="text-align: center;"><?= lang('app.acYear') ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" style="text-align: center;"><?= $class['name'] ?></th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: left;"><?= lang('app.taqdir') ?></th>
                                            <th><?= lang('app.points') ?></th>
                                            <th><?= lang('app.grade') ?></th>
                                            <th><?= lang('app.marks') ?></th>
                                            <th style="text-align: right;"><?= lang('app.subject') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($results as $key => $r) : ?>
                                            <?php $mark = $r['final'] + $r['course'] ?>
                                            <?php $grade = $g->grade($mark) ?>
                                            <?php $sub = $g->subject($r['subject_id']) ?>
                                            <td style="text-align: left;"><span <?= ($mark < 60 ? 'class="danger"' : '') ?>><?= $grade['name'] ?></span></td>
                                            <td><?= $grade['point'] ?></td>
                                            <td><?= $grade['ramz'] ?></td>
                                            <td><?= $r['final'] ?></td>
                                            <td style="text-align: right;"><?= $sub['name'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <?php $masar = $res->masar(intval($dt['marks'] / $dt['subjects'])) ?>
                                <table class="table table-striped table-bordered" style="text-align: center;">
                                    <thead>
                                        <th><?= lang('app.masarMuadala') ?></th>
                                        <th><?= lang('app.muadalaHuu') ?></th>
                                        <th><?= lang('app.points') ?></th>
                                        <th><?= lang('app.total') ?></th>
                                        <th><?= lang('app.subjects') ?></th>
                                        <th></th>
                                    </thead>
                                    <thead>
                                        <td><span style="color: <?= $masar['color'] ?>"><b><?= $masar['name'] ?></b></span></td>
                                        <td><?= round($dt['gpa'], 2) ?></td>
                                        <td><?= round($dt['point'], 2) ?></td>
                                        <td><?= round($dt['marks'], 2) ?></td>
                                        <td><?= $dt['subjects'] ?></td>
                                        <th><?= lang('app.fasliy') ?></th>
                                    </thead>
                                    <thead>
                                        <?php $print = $g->where(['student_id' => $user['id'], 'class_id' => $class['id']])->first() ?>
                                        <?php if ($print != null) : ?>
                                            <?php
                                            $muadala[] = $dt['gpa'];
                                            $count = 0;
                                            $sum = 0;

                                            foreach ($muadala as $value) {
                                                $sum = $sum + $value;
                                                $count = $count + 1;
                                            }

                                            if ($count > 0) {
                                                $average = round(($sum / $count), 2);
                                            } else {
                                                $average = round($dt['gpa'], 2);
                                            }
                                            ?>
                                            <?php $msr = $res->grade(intval($average * 20)) ?>
                                            <td><span style="color: <?= $msr['color'] ?>"><b><?= $msr['name'] ?></b></span></td>
                                            <td><b><?= $average ?></b></td>
                                            <td><b><?= $point = $dt['point'] + $point ?></b></td>
                                            <td><b><?= $total = $dt['marks'] + $total ?></b></td>
                                            <td><b><?= $masomo = $dt['subjects'] + $masomo ?></b></td>
                                        <?php else : ?>
                                            <td><b><?= lang('app.soon') ?></b></td>
                                            <td><b><?= lang('app.soon') ?></b></td>
                                            <td><b><?= lang('app.soon') ?></b></td>
                                            <td><b><?= lang('app.soon') ?></b></td>
                                            <td><b><?= lang('app.soon') ?></b></td>
                                        <?php endif ?>
                                        <th><?= lang('app.tarakum') ?></th>
                                    </thead>
                                </table>
                                <table class="table table-striped table-bordered" style="text-align: center;">
                                    <thead>
                                        <th colspan="3"><?= lang('app.hisposition') ?></th>
                                        <th colspan="3"><?= lang('app.studentCount') ?></th>
                                    </thead>
                                    <thead>
                                        <?php if ($print != null) : ?>
                                            <td colspan="3"><b><?= $g->position($user['id'], $class['id'], $dt['year_id']) ?></b></td>
                                        <?php else : ?>
                                            <td colspan="3"><b><?= lang('app.soon') ?></b></td>
                                        <?php endif ?>
                                        <td colspan="3"><b><?= $print['number_of_students'] ?? $c->stuCount($class['id']) ?></b></td>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="header">
                            <div class="header-section">
                                <div class="school-info">
                                    <?php if ($dt != null) : ?>
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode(base_url('gpa/search/' . $dt['link'])) ?>" title="<?= $user['malaf'] ?>" class="qr-code" />
                                    <?php else : ?>
                                        <img src="<?= base_url('app-assets/images/logo/logo.png') ?>" alt="logo" height="200" />
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="header-section right">
                                <div class="school-info" style="text-align: center;">
                                    <?php if (session('role') == 'admin') : ?>
                                        <div>
                                            <img src="<?= base_url($mudir['info']) ?>" alt="sign" style="height: 100px;" />
                                        </div><hr>
                                    <?php endif ?>
                                    <span>مدير: <b>الشيخ <?= $mudir['value'] ?></b></span><br>
                                    <span class="text-muted"><?= $mudir['extra'] ?></span><br>
                                    <span><?= $hjr->format('D _j _M _Yهـ') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="header-section">
                            <div class="header-section right">
                            </div>
                            <div class="header-section">
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
        <?php endforeach ?>
    </div>
</body>
<script>
    window.print()
</script>

</html>