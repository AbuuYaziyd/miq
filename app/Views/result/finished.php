<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card" style="zoom: 1;">
            <div class="card-header bg-hexagons border-top-3 border-top-primary" style="justify-content: center; display:flex">
                <div class="card-body pt-0">
                    <h4>
                        <span class="h1"><b><?= env('APP_NAME') ?></b></span><br>
                        <?= lang('app.academics') ?>: <b><?= $sch['name'] ?></b><br>
                        <?= lang('app.className') ?>: <b><?= $class['name'] ?></b><br>
                        <?= lang('app.acYear') ?>: <b><?= $year['name'] ?></b>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><b><?= $title ?></b></h2>
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
                                <th><?= lang('app.muadala') ?></th>
                                <th><?= lang('app.position') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key => $dt) : ?>
                                <?php $st = $gp->user($dt['student_id']) ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><a href="<?= base_url('result/show/' . $dt['student_id'] . '/' . $dt['class_id']) ?>" target="_blank"><?= $dt['malaf'] ?></a></td>
                                    <td><?= ($st['name_ar'] ?? $st['name'] . ' ' . $st['lname']) ?></td>
                                    <td><?= $dt['marks_course'] + $dt['marks_final'] ?></td>
                                    <td><?= $dt['gpa_course'] + $dt['gpa_final'] ?></td>
                                    <td><?= $dt['position'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>