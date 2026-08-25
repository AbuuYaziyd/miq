<?php

use App\Models\Setting;

$set = new Setting();

$markaz = $set->where('name', 'name')->first();
$colour = $set->where('name', 'colour')->first();
$location = $set->where('name', 'location')->first();
$logo = $set->where('name', 'logo')->first();
?>
<!DOCTYPE html>
<html class="loading" lang="<?= session('lang') ?>" data-textdirection="<?= session('lang') != 'ar' ? 'ltr' : 'rtl' ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?>">
    <meta name="keywords" content="<?= lang('app.appName') ?> | <?= session('lang') != 'ar' ? $location['value'] : $location['value_ar'] ?>">
    <meta name="author" content="Abou Yaziyd">
    <link rel="manifest" href="./manifest.json" />
    <meta name="theme-color" content="<?= $colour['value'] ?>">
    <title><?= $title ?> | <?= session('lang') != 'ar' ? $markaz['value'] : $markaz['value_ar'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" href="<?= base_url($logo['link']) ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url($logo['link']) ?>">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <style>
        /* --- General Page and Print Styles --- */
        body {
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 1cm;
            font-size: 12pt;
        }

        @page {
            margin: 5px;
        }

        .next-page {
            break-after: always;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2px;
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
            font-size: 14pt;
        }

        /* --- Table Styling for Report Card --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1px;
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
        <div class="row">
            <div style="text-align: center;"><img src="<?= base_url('app-assets/images/bismillah.png') ?>" alt="bismillah" height="80" /></div>
        </div>
        <div class="row" style="height: 100wh;">
            <div class="col-12">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered mt-3">
                                <thead class="mt-3">
                                    <div class="header">
                                        <div class="header-section">
                                            <div class="school-info">
                                                <span dir="rtl"><b><?= $name['value'] ?></b></span><br>
                                                <span dir="rtl"><b><?= $location['value'] ?></b></span><br>
                                                <span dir="rtl">Jina la Darasa: <b><?= $course['name'] ?></b></span><br>
                                                <span dir="rtl">Idadi ya Wanafunzi: <b><?= count($class_gpa) ?></b></span><br>
                                            </div>
                                        </div>

                                        <img src="<?= base_url('app-assets/images/logo/logo.png') ?>" alt="logo" height="150" />

                                        <div class="header-section right">
                                            <div class="school-info">
                                                <span dir="rtl"><b><?= $name['extra'] ?></b></span><br>
                                                <span dir="rtl"><b><?= $location['extra'] ?></b></span><br>
                                                <span dir="rtl">اسم الفصل: <b><?= $course['name_ar'] ?></b></span><br>
                                                <span dir="rtl">عدد الطلاب: <b><?= count($class_gpa) ?></b></span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <th><?= lang('app.position') ?></th>
                                        <th><?= lang('app.gpa') ?></th>
                                        <th><?= lang('app.results') ?></th>
                                        <th><?= lang('app.fullname') ?></th>
                                        <th><?= lang('app.malaf') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($class_gpa as $key => $dt) : ?>
                                        <?php $student = $gpa->user($dt['student_id']) ?>
                                        <?php $this_gpa = $gpa->gpa($dt['student_id'], $dt['course_id']) ?>
                                        <tr>
                                            <td><?= $dt['position'] ?></td>
                                            <td><?= $dt['gpa'] ?></td>
                                            <td><?= $dt['marks'] ?></td>
                                            <td>
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $student['name'] ?> <?= $student['name'] ?> <?= $student['lname'] ?>
                                                <?php else : ?>
                                                    <?= $student['name_ar'] ?> <?= $student['mname_ar'] ?> <?= $student['lname_ar'] ?>
                                                <?php endif ?>
                                            </td>
                                            <td><span><?= $dt['username'] ?></span></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
    </div>
</body>
<script>
    window.print()
</script>

</html>