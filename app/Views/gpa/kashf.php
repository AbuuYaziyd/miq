<?php
// Define arrays for Swahili month names and day names
$swahiliMonths = array(
    1 => 'Januari',
    'Februari',
    'Machi',
    'Aprili',
    'Mei',
    'Juni',
    'Julai',
    'Agosti',
    'Septemba',
    'Oktoba',
    'Novemba',
    'Desemba'
);

$swahiliDays = array(
    1 => 'Jumapili',
    'Jumatatu',
    'Jumanne',
    'Jumatano',
    'Alhamisi',
    'Ijumaa',
    'Jumamosi'
);

// Get the current day of the week (numeric, 0 for Sunday, 6 for Saturday)
$dayOfWeek = date('w');
// Get the current day of the month
$dayOfMonth = date('j');
// Get the current month (numeric, 1 for January, 12 for December)
$month = date('n');
// Get the current year
$year = date('Y');

// Construct the Swahili date string
$swahiliDate = $swahiliDays[$dayOfWeek + 1] . ', ' . $dayOfMonth . ' ' . $swahiliMonths[$month] . ' ' . $year;


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
    <meta name="description" content="<?= lang('app.appName') . ' | ' . lang('app.location') ?>">
    <meta name="keywords" content="<?= lang('app.appName') . ' | ' . lang('app.location') ?>">
    <meta name="author" content="Abou Yaziyd">
    <link rel="manifest" href="./manifest.json" />
    <meta name="theme-color" content="#3367D6">
    <title><?= lang('app.appName') . ' | ' . $title ?></title>
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
        <?php foreach ($student_gpa as $k => $dt) : ?>
            <?php if ($dt['course_id'] == $course_id) : ?>
                <?php $class = $gpa->class($dt['course_id']) ?>
                <?php $results = $gpa->results($dt['student_id'], $dt['course_id']) ?>
                <div class="header">
                    <div class="header-section">
                        <div class="school-info">
                            <span dir="rtl"><b><?= env('APP_NAME') ?></b></span><br>
                            <span dir="rtl"><b><?= env('LOCATION') ?></b></span><br>
                            <span dir="rtl">Jina Kamili : <b><?= $user['name'] ?> <?= $user['mname'] ?> <?= $user['lname'] ?></b></span><br>
                            <span dir="rtl">Namba ya Usajili: <b><?= $user['username'] ?></b></span><br>
                            <span dir="rtl">Hali: <b><?= $user['role'] == 'graduate' ? 'Mhitimu' : 'Mwanafunzi' ?></b></span><br>
                            <span dir="rtl">Darasa: <b><?= $class['name'] ?></b></span><br>
                            <span dir="rtl">Mwaka wa Masomo: <b><?= $gpa->year($dt['year_id'])['name'] ?></b></span><br>
                        </div>
                    </div>

                    <img src="<?= base_url('app-assets/images/logo/logo.png') ?>" alt="logo" height="150" />

                    <div class="header-section right">
                        <div class="school-info">
                            <span dir="rtl"><b><?= env('APP_NAME') ?></b></span><br>
                            <span dir="rtl"><b><?= env('LOCATION') ?></b></span><br>
                            <span dir="rtl">اسم الكامل: <b><?= $user['name_ar'] ?> <?= $user['mname_ar'] ?> <?= $user['lname_ar'] ?></b></span><br>
                            <span dir="rtl">رقم التسجيل: <b><?= $user['username'] ?></b></span><br>
                            <span dir="rtl">الوضع: <b><?= $user['role'] == 'graduate' ? 'خريج' : 'طالب' ?></b></span><br>
                            <span dir="rtl">المرحلة: <b><?= $class['name_ar'] ?></b></span><br>
                            <span dir="rtl">عام الدراسي: <b><?= $gpa->year($dt['year_id'])['name'] ?></b></span><br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style="text-align: center;"><img src="<?= base_url('app-assets/images/bismillah.png') ?>" alt="bismillah" height="80" /></div>
                </div>
                <div class="row" style="height: 100wh;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table table-striped table-bordered dataex-res-constructor">
                                        <thead>
                                            <tr>
                                                <th style="text-align: left;"><?= lang('app.taqdir') ?></th>
                                                <th><?= lang('app.grade') ?></th>
                                                <th><?= lang('app.marks') ?></th>
                                                <th style="text-align: right;"><?= lang('app.subject') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($results as $key => $r) : ?>
                                                <?php $mark = $r['final'] + $r['course'] ?>
                                                <?php $gparade = $gpa->grade(intval($mark)) ?>
                                                <?php $sub = $gpa->subject($r['subject_id']) ?>
                                                <td style="text-align: left;"><span <?= ($mark < 60 ? 'class="danger"' : '') ?>><?= $gparade['name_ar'] ?></span></td>
                                                <td><?= $gparade['ramz_ar'] ?></td>
                                                <td><?= $r['final'] ?></td>
                                                <td style="text-align: right;"><?= $sub['name_ar'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <?php $masar = $res->masar(intval($dt['course_gpa'] * 2)) ?>
                                    <table class="table table-striped table-bordered" style="text-align: center;">
                                        <thead>
                                            <th><?= lang('app.masarMuadala') ?></th>
                                            <th><?= lang('app.gpa') ?></th>
                                            <th><?= lang('app.total') ?></th>
                                            <th><?= lang('app.subjects') ?></th>
                                        </thead>
                                        <thead>
                                            <td><span style="color: <?= $masar['color'] ?>"><b><?= $masar['name_ar'] ?></b></span></td>
                                            <td><?= round($dt['course_gpa'], 2) ?></td>
                                            <td><?= round($dt['course_marks'], 2) ?></td>
                                            <td><?= $dt['subjects'] ?></td>
                                        </thead>
                                    </table>
                                    <table class="table table-striped table-bordered" style="text-align: center;">
                                        <thead>
                                            <th><?= lang('app.studentCount') ?></th>
                                            <th><?= lang('app.hisposition') ?></th>
                                        </thead>
                                        <thead>
                                            <?php $print = $gpa->where(['student_id' => $user['id'], 'course_id' => $class['id']])->first() ?>
                                            <td><b><?= $print['number_of_students'] ?? $c->stuCount($class['id']) ?></b></td>
                                            <?php if ($print != null) : ?>
                                                <td><b><?= $dt['course_position'] ?></b></td>
                                            <?php else : ?>
                                                <td><b><?= lang('app.soon') ?></b></td>
                                            <?php endif ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="header">
                                <div class="header-section">
                                    <div class="school-info">
                                        <?php if ($dt != null) : ?>
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode(base_url('gpa/search/' . $dt['link'])) ?>" title="<?= $user['username'] ?>" class="qr-code" />
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
                                            </div>
                                            <hr>
                                        <?php endif ?>
                                        <span>
                                            <b>الشيخ
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $mudir['value'] ?>
                                                <?php else : ?>
                                                    <?= $mudir['link'] ?>
                                                <?php endif ?>
                                            </b>
                                        </span><br>
                                        <span class="text-muted"><?= lang('app.mudir') ?> - <?= lang('app.appName') ?></span><br>
                                        <?php if (session('lang') != 'ar') : ?>
                                            <span><?= $swahiliDate ?></span><br>
                                        <?php else : ?>
                                            <span><?= $hjr->strToHijri(date('Y-m-d'), "l, d F Yهـ", session('lang')) ?></span><br>
                                        <?php endif ?>
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
            <?php endif ?>
        <?php endforeach ?>
    </div>
</body>
<script>
    window.print()
</script>

</html>