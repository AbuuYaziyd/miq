<?php

use App\Models\Setting;

$set = new Setting();

$markaz = $set->where('name', 'name')->first();
$colour = $set->where('name', 'colour')->first();
$location = $set->where('name', 'location')->first();
$logo = $set->where('name', 'logo')->first();
$muadala = 0;
$masomo = 0;
$alama = 0;
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
        body {
            font-family: 'Tajawal', sans-serif;
            padding: 5px;
            color: #333;
            line-height: 1.6;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 3px solid #806240;
            /* Dark Green Border */
            padding-bottom: 10px;
        }

        .institution-details {
            text-align: right;
        }

        .logo-box {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #806240;
        }

        .student-info {
            margin-bottom: 5px;
            background-color: #f9efe5;
            /* Light Green Tint */
            padding: 15px;
            border-right: 5px solid #806240;
            border-left: 5px solid #806240;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 2px;
            text-align: center;
        }

        /* Dark Green Header Styling */
        th {
            background-color: #806240;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .fail {
            background-color: #ffebee;
            color: #c62828;
            font-weight: bold;
        }

        .summary-section {
            margin-top: 30px;
        }

        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .signature-line {
            margin-top: 10px;
            border-top: 1px solid #333;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <?php $student = $gpa->user($gpas['student_id']) ?>
    <?php $class = $gpa->class($gpas['course_id']) ?>
    <?php $results = $gpa->results($student['id'], $gpas['course_id']) ?>
    <div id="printArea" style="direction: <?= service('request')->getLocale() != 'ar' ? 'ltr' : 'rtl' ?>; width: 100%;">
        <div class="header-container">
            <div class="institution-details">
                <h3 style="color: #806240;">مركز ابن القيم
                    <br>
                    <span>ص. ب. 0000,</span>
                    <span>كغوما - تنزانيا</span>
                </h3>
            </div>
            <div class="logo-box">
                <img alt="apple-touch-icon" src="<?= base_url('app-assets/images/logo/logo.png') ?>" height="90px">
            </div>
            <div class="contact-info" dir="ltr">
                <h3 style="color: #806240;">Markaz Ibn Qayyim
                    <br>
                    <span>Po. Box 0000,</span>
                    <span>Kigoma - Tanzania</span>
                </h3>
            </div>
        </div>
        <div class="student-info" style="text-align: center;">
            <strong>
                <?php if (session('lang') != 'ar') : ?>
                    <?= $student['name'] ?> <?= $student['mname'] ?> <?= $student['lname'] ?>
                <?php else : ?>
                    <?= $student['name_ar'] ?> <?= $student['mname_ar'] ?> <?= $student['lname_ar'] ?>
                <?php endif ?> |
                <span style="color: #806240; text-align: right">
                    كشف الدرجات:
                    <?php if (session('lang') != 'ar') : ?>
                        <?= $class['name'] ?>
                    <?php else : ?>
                        <?= $class['name_ar'] ?>
                    <?php endif ?>
                </span>
            </strong>
        </div>

        <table>
            <thead>
                <tr>
                    <th>المقرر</th>
                    <th>النتائج</th>
                    <th>الدرجة</th>
                    <th>التقدير</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $key => $rs) : ?>
                    <?php $mark = $rs['course'] + $rs['final'] ?>
                    <?php $grade = $gpa->grade($mark) ?>
                    <tr>
                        <td>
                            <?php if (session('lang') != 'ar') : ?>
                                <?= $gpa->subject($rs['subject_id'])['name'] ?>
                            <?php else : ?>
                                <?= $gpa->subject($rs['subject_id'])['name_ar'] ?>
                            <?php endif ?>
                        </td>
                        <td><?= $mark ?></td>
                        <td><?= $grade['ramz'] ?></td>
                        <td><?= $grade['name'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="summary-section">
            <table>
                <thead>
                    <tr>
                        <th>مقررات</th>
                        <th>جملة النتائج</th>
                        <th><?= lang('app.hisposition') ?></th>
                        <th><?= lang('app.studentCount') ?></th>
                        <th>المعدل</th>
                        <th>التقدير العام</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b><?= $gpas['subjects'] ?></b></td>
                        <td><b><?= round($gpas['marks']) ?></b></td>
                        <?php if ($rs['final_status'] != 'gpa') : ?>
                            <td><b><?= lang('app.soon') ?></b></td>
                        <?php else : ?>
                            <td><b><?= $gpas['final_position'] ?></b></td>
                        <?php endif ?>
                        <td><b><?= $gpas['number_of_students'] ?? $c->stuCount($class['id']) ?></b></td>
                        <td><b><?= round($gpas['gpa']) ?></b></td>
                        <td><b><?= $gpa->grade(round($gpas['gpa']))['name'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <div>
                <p><?= $mudir['extra'] ?></p>
                <img src="<?= base_url($mudir['link']) ?>" height="50px" alt="sign" />
                <div class="signature-line"></div>
                <p><?= $mudir['value'] ?><br><?= date('d/m/Y') ?></p>
            </div>
            <div>
                <a href="<?= base_url('gpa/search/' . $gpas['link']) ?>">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode(base_url('gpa/search/' . $gpas['link'])) ?>" title="<?= $student['username'] ?>" class="float-right m-3" />
                </a>

            </div>
            <div>
                <p><?= $taalim['extra'] ?></p>
                <img src="<?= base_url($taalim['link']) ?>" height="50px" alt="sign" />
                <div class="signature-line"></div>
                <p><?= $taalim['value'] ?><br><?= date('d/m/Y') ?></p>
            </div>
        </div>
    </div>
</body>
<script>
    window.print()
</script>

</html>