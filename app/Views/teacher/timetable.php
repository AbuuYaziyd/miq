<?php

use App\Models\Course;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Timetable;

$tmt = new Timetable();
$sub = new Subject();
$crs = new Course();
$prd = new Period();

$subjects = $sub->where('head_id', $user['id'])->findAll();
$course = $crs->findAll();
$period = $prd->findAll();
// dd($subjects, $course, $period);
?>
<h1><b><?= lang('app.subjects') ?></b></h1>
<div class="row">
    <?php foreach ($subjects as $dt) : ?>
        <?php foreach ($sub->orderBy('start', 'asc')->timetable($dt['id']) as $dj) : ?>
            <?php if ($dj['day'] == date('w')) : ?>
                <div class="col-md-3 col-sm-6">
                    <a href="<?= base_url('subject/class/' . $dt['id']) ?>" target="_blank">
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
                                            <i class="la la-calendar secondary font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    <?php endforeach ?>
</div>
<hr>
<div class="row">
    <?php foreach ($course as $cr) : ?>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <b><?= $cr['name'] ?></b>
                        <a href="<?= base_url('course/class/' . $cr['id'] . '/' . $user['id']) ?>" class="btn btn-purple btn-sm round pull-right"><?= lang('app.view') ?></a>
                    </h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body p-0">
                        <div class="table-responsive text-center timetable">
                            <table class="table mb-0">
                                <thead>
                                    <th><?= lang('app.day') ?></th>
                                    <?php foreach ($period as $key => $p) : ?>
                                        <th><?= lang('app.period') ?> #<?= $p['id'] ?></th>
                                    <?php endforeach ?>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < 7; $i++) : ?>
                                        <tr>
                                            <th scope="row" class="border-top-0"><?= lang('app.siku' . $i) ?></th>
                                            <?php foreach ($period as $pd) : ?>
                                                <?php $data = $tmt->where(['day' => $i, 'period_id' => $pd['id'], 'course_id' => $cr['id']])->findAll() ?>
                                                <td class="border-top-0 text-right">
                                                    <?php if ($data) : ?>
                                                        <?php foreach ($data as $sb) : ?>
                                                            <?php $subject = $sub->subject($sb['subject_id']) ?>
                                                            <?php if ($subject['head_id'] == $user['id']) : ?>
                                                                <span class="btn btn-sm btn-<?= $sb['day'] == date('w') ? 'success' : 'primary' ?> round">
                                                                    <?= $subject['name'] ?>
                                                                </span>
                                                            <?php else : ?>
                                                                <span class="btn btn-sm btn-outline-<?= $sb['day'] == date('w') ? 'success' : 'primary' ?> round">
                                                                    <?= $subject['name'] ?>
                                                                </span>

                                                                <!-- <span class="btn btn-sm btn-danger round">N/A</span>  -->
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    <?php else : ?>
                                                        <span class="btn btn-sm btn-outline-danger round">---</span>
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
    <?php endforeach ?>
</div>
<hr>