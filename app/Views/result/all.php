<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card" style="zoom: 1;">
            <div class="card-header bg-hexagons border-top-3 border-top-primary" style="justify-content: center; display:flex">
                <div class="card-body pt-0">
                    <h4>
                        <span class="h1"><b><?= lang('app.appName') ?></b></span><br>
                        <?php if (session('lang') != 'ar') : ?>
                            <?= lang('app.school') ?>: <b><?= $school['name'] ?></b><br>
                            <?= lang('app.course') ?>: <b><?= $course['name'] ?></b><br>
                        <?php else : ?>
                            <?= lang('app.school') ?>: <b><?= $school['name_ar'] ?></b><br>
                            <?= lang('app.course') ?>: <b><?= $course['name_ar'] ?></b><br>
                        <?php endif ?>
                        <?= lang('app.acYear') ?>: <b><?= $year['name'] ?></b>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php if (count($class_gpa) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h2>
                        <b><?= lang('app.results') ?></b>
                        <a class="btn btn-red box-shadow-1 round pull-right" href="<?= base_url('gpa/fasl/' . $course['id'] . '/' . $year['id']) ?>" target="_blank"><?= lang('app.print') ?></a>
                    </h2>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered result">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.fullname') ?></th>
                                    <th><?= lang('app.results') ?></th>
                                    <th><?= lang('app.gpa') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($class_gpa as $key => $dt) : ?>
                                    <?php $student = $gpa->user($dt['student_id']) ?>
                                    <?php $this_gpa = $gpa->gpa($dt['student_id'], $dt['course_id']) ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><a href="<?= base_url('result/user/' . $dt['student_id'] . '/' . $dt['course_id']) ?>" target="_blank"><?= $dt['username'] ?></a></td>
                                        <td>
                                            <?php if (session('lang') != 'ar') : ?>
                                                <?= $student['name'] ?> <?= $student['name'] ?> <?= $student['lname'] ?>
                                            <?php else : ?>
                                                <?= $student['name_ar'] ?> <?= $student['mname_ar'] ?> <?= $student['lname_ar'] ?>
                                            <?php endif ?>
                                        </td>
                                        <td><?= $dt['marks'] ?></td>
                                        <td><?= $dt['gpa'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif (count($results) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h2 class="danger"><b><?= lang('app.results') ?></b>
                        <?php if (count($gpa) < 0) : ?>
                            <a class="btn btn-purple box-shadow-1 round pull-right gpa" href="<?= base_url('result/course/gpa/' . $class['id']) ?>"><?= lang('app.muadalaReg') ?></a>
                        <?php endif ?>
                    </h2>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered result">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.stuName') ?></th>
                                    <th><?= lang('app.sum') ?></th>
                                    <th><?= lang('app.muadalaHuu') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $key => $dt) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><a href="<?= base_url('result/show/' . $dt['id'] . '/' . $dt['level'] ?? $dt['class_id']) ?>" target="_blank"><?= $dt['malaf'] ?></a></td>
                                        <td><?= ($dt['name_ar'] ? $dt['name_ar'] : $dt['name'] . ' ' . $dt['lname']) ?></td>
                                        <td><?= $gp->firstSemester($dt['id'], $dt['level'] ?? $dt['class_id']) ?></td>
                                        <td><?= $gp->gpaFirstSemester($dt['id'], $dt['level'] ?? $dt['class_id']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="card">
                <div class="card-header text-center">
                    <h2><b><?= lang('app.studentNotFound') ?></b></h2>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>