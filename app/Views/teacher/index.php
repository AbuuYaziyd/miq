<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<?= $this->include('teacher/info') ?>
<?= $this->include('teacher/links') ?>
<?php if (count($class) > 0) : ?>
    <h1><b><?= lang('app.academic') ?></b></h1>
    <hr>
    <div class="row">
        <?php foreach ($class as $key => $dt) : ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4><b><?= $dt['name'] ?></b><a href="<?= base_url('course/show/' . $dt['id']) ?>" class="btn btn-sm btn-warning round float-right"><?= lang('app.view') ?></a></h4>
                        </div>
                        <li class="list-group-item">
                            <span class="btn btn-sm round btn-outline-danger float-right"><?= $ac->stuCount($dt['id']) ?></span><?= lang('app.students') ?>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= base_url('subject/class/' . $dt['id']) ?>" class="btn btn-sm round btn-blue float-right"><?= $ac->subCount($dt['id']) ?></a><?= lang('app.subjects') ?>
                        </li>
                        <!-- <li class="list-group-item">
                            <a href="<?= base_url('attendance/show/' . $dt['id'] . '/M') ?>" class="btn btn-sm round btn-primary float-right"><?= lang('app.males') ?></a><?= lang('app.takeAttendance') ?>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= base_url('attendance/show/' . $dt['id'] . '/F') ?>" class="btn btn-sm round btn-pink float-right"><?= lang('app.females') ?></a><?= lang('app.takeAttendance') ?>
                        </li> -->
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <hr>
<?php endif ?>
<?= $this->include('teacher/timetable') ?>
<?= $this->endSection() ?>