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
        <div class="row">
            <div style="text-align: center;"><img src="<?= base_url('app-assets/images/bismillah.png') ?>" alt="bismillah" height="80" /></div>
        </div>
        <div class="header">
            <div class="header-section">
                <div class="school-info">
                    <span dir="rtl"><b><?= lang('app.appName') ?></b></span><br>
                    <span dir="rtl"><b><?= lang('app.location') ?></b></span><br>
                    <span dir="rtl">Jina la Mtihani: <b><?= $subject['name'] ?></b></span><br>
                    <span dir="rtl">Idadi ya Wanafunzi: <b><?= count($students) ?></b></span><br>
                </div>
            </div>

            <img src="<?= base_url('app-assets/images/logo/logo.png') ?>" alt="logo" height="150" />

            <div class="header-section right">
                <div class="school-info">
                    <span dir="rtl"><b><?= lang('app.appName') ?></b></span><br>
                    <span dir="rtl"><b><?= lang('app.location') ?></b></span><br>
                    <span dir="rtl">اسم الاختبار: <b><?= $subject['name_ar'] ?></b></span><br>
                    <span dir="rtl">عدد الطلاب: <b><?= count($students) ?></b></span><br>
                </div>
            </div>
        </div>
        <div class="row" style="height: 100wh;">
            <div class="col-12">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered dataex-res-constructor">
                                <thead>
                                    <tr>
                                        <th><?= lang('app.sign') ?></th>
                                        <th><?= lang('app.marks') ?></th>
                                        <th><?= lang('app.fullname') ?></th>
                                        <th><?= lang('app.malaf') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($students as $key => $dt) : ?>
                                        <?php $mark = $res->markThisYear($subject['course_id'], $dt['id'], $subject['id']) ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $dt['name'] ?> <?= $dt['mname'] ?> <?= $dt['lname'] ?>
                                                <?php else : ?>
                                                    <?= $dt['name_ar'] ?> <?= $dt['mname_ar'] ?> <?= $dt['lname_ar'] ?>
                                                <?php endif ?>
                                            <td><?= $dt['username'] ?></td>
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