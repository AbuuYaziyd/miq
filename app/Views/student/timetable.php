<?php

use App\Models\Course;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;

$tmt = new Timetable();
$sub = new Subject();
$crs = new Course();
$prd = new Period();
$usr = new User();

$subjects = $sub->where('course_id', $stu['level'])->findAll();
$course = $crs->find($stu['level']);
$period = $prd->findAll();

// dd($subjects, $course, $period);

?>
<h2><b><?= lang('app.todaySubjects') ?>:</b></h2>
<div class="row">
    <?php foreach ($subjects as $dt) : ?>
        <?php foreach ($sub->orderBy('start', 'desc')->stuTimetable($dt['id'], $stu['level']) as $dj) : ?>
            <div class="col-xs-3 col-md-4">
                <a href="<?= $dt['link'] ?>" target="_blank">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">
                                            <?= $prd->period($dj['period_id'])['start'] ?> - <?= $prd->period($dj['period_id'])['end'] ?><br>
                                            <?= $sub->class($dj['course_id'])['name'] ?>
                                        </h6>
                                        <h4><b><?= $dt['name'] ?></b></h4>
                                    </div>
                                    <div>
                                        <i class="ft ft-link-2 secondary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>
                    <b>
                        <?= lang('app.timetable') ?>:
                        <?php if (session('lang') != 'ar') : ?>
                            <?= $course['name'] ?>
                        <?php else : ?>
                            <?= $course['name_ar'] ?>
                        <?php endif ?>
                    </b>
                </h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body p-0">
                    <div class="table-responsive text-center timetable">
                        <table class="table mb-0">
                            <thead>
                                <th>
                                    <?= lang('app.day') ?><br>
                                    (<?= lang('app.week') ?>)
                                </th>
                                <?php foreach ($period as $key => $p) : ?>
                                    <th>
                                        <?= lang('app.period') ?> #<?= $p['id'] ?><br>
                                        <?= $p['start'] ?> - <?= $p['end'] ?>
                                    </th>
                                <?php endforeach ?>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 7; $i++) : ?>
                                    <tr>
                                        <th scope="row" class="border-top-0"><?= lang('app.siku' . $i) ?></th>
                                        <?php foreach ($period as $pd) : ?>
                                            <?php $data = $tmt->where(['day' => $i, 'period_id' => $pd['id'], 'course_id' => $stu['level']])->findAll() ?>
                                            <td class="border-top-0 text-right">
                                                <?php if ($data) : ?>
                                                    <?php foreach ($data as $sb) : ?>
                                                        <?php if ($sb['subject_id'] != null) : ?>
                                                            <?php $subject = $sub->subject($sb['subject_id']) ?>
                                                            <span class="btn btn-sm btn-<?= $sb['day'] == date('w') ? 'success' : 'primary' ?> round">
                                                                <?= $subject['name'] ?>
                                                            </span>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <span class="btn btn-sm btn-danger round"><?= 'N/A' ?></span>
                                                <?php endif ?>
                                            </td>
                                        <?php endforeach ?>
                                    </tr>
                                <?php endfor ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b>
                        <?= lang('app.allSubjects') ?>:
                        <?php if (session('lang') != 'ar') : ?>
                            <?= $course['name'] ?>
                        <?php else : ?>
                            <?= $course['name_ar'] ?>
                        <?php endif ?>
                    </b>
                </h3>
            </div>
            <div class="card-content collapse show">
                <div class="card-body p-0">
                    <div class="table-responsive text-center timetable">
                        <table class="table mb-0">
                            <thead>
                                <th><?= lang('app.subject') ?></th>
                                <th><?= lang('app.teacher') ?></th>
                                <th><?= lang('app.book') ?></th>
                                <th><?= lang('app.contacts') ?></th>
                            </thead>
                            <tbody>
                                <?php foreach ($subjects as $dt) : ?>
                                    <?php $teacher = $usr->find($dt['head_id']) ?>
                                    <tr>
                                        <?php if (session('lang') != 'ar') : ?>
                                            <td><?= $dt['name'] ?></td>
                                            <td><?= $teacher['kun_yah'] ?> <?= $teacher['name'] ?> <?= $teacher['mname'] ?> <?= $teacher['lname'] ?></td>
                                        <?php else : ?>
                                            <td><?= $dt['name_ar'] ?></td>
                                            <td><?= $teacher['kun_yah_ar'] ?> <?= $teacher['name_ar'] ?> <?= $teacher['mname_ar'] ?> <?= $teacher['lname_ar'] ?></td>
                                        <?php endif ?>
                                        <td>
                                            <?php if ($dt['book'] != null) : ?>
                                                <a href="<?= base_url($dt['book']) ?>" class="btn btn-sm btn-teal round" target="_blank"><i class="ft ft-download-cloud"></i></a>
                                            <?php else : ?>
                                                <span class="btn btn-sm btn-outline-teal round"><i class="ft ft-download-cloud"></i></span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-block">
                                                <?php if ($teacher['phone'] != null) : ?>
                                                    <a href="tel:+255<?= $teacher['phone'] ?>" class="btn btn-sm round btn-primary"><i class="ft ft-phone-call"></i></a>
                                                    <a href="https://wa.me/255<?= $teacher['phone'] ?>" class="btn btn-sm round btn-success"><i class="la la-whatsapp"></i></a>
                                                <?php else : ?>
                                                    <span class="btn btn-sm round btn-outline-primary"><i class="ft ft-phone-call"></i></span>
                                                    <span class="btn btn-sm round btn-outline-success"><i class="la la-whatsapp"></i></span>
                                                <?php endif ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>