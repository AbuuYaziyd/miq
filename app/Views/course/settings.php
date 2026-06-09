<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card" style="zoom: 1;">
            <div class="card-header bg-hexagons border-top-3 border-top-primary" style="justify-content: center; display:flex">
                <div class="card-body pt-0">
                    <h4>
                        <span class="h1 "><b><?= lang('app.appName') ?></b></span><br>
                        <?= lang('app.school') ?>: <b><?= $sch['name'] ?></b><br>
                        <?= lang('app.className') ?>: <b><?= $class['name'] ?></b><br><br>
                        <b><?= lang('app.advancedSettings') ?></b>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-auto m-2 text-center">
                    <a href="<?= base_url('gpa/view/' . $class['id'] . '/' . $yr['id']) ?>" class="btn btn-lg btn-teal  m-1"><?= lang('app.studentsResults') ?></a>
                    <a class="btn btn-danger btn-lg m-1" href="<?= base_url('student/upgrade/' . $class['id']) ?>"><?= lang('app.editStudents') ?></a>
                    <!-- <a href="<?= base_url('subject/class/' . $class['id']) ?>" class="btn btn-warning btn-lg m-1"><?= lang('app.editSubjects') ?></a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>