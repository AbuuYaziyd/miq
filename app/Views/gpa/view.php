<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card" style="zoom: 1;">
            <div class="card-header bg-hexagons border-top-3 border-top-primary" style="justify-content: center; display:flex">
                <div class="card-body pt-0">
                    <h4>
                        <span class="h1"><b><?= lang('app.appName') ?></b></span><br>
                        <?= lang('app.course') ?>:
                        <b><?= session('lang') != 'ar' ? $sch['name'] : $sch['name_ar'] ?></b>
                        <br>
                        <?= lang('app.class') ?>:
                        <b><?= session('lang') != 'ar' ? $class['name'] : $class['name_ar'] ?></b>
                        <br>
                        <?= lang('app.acYear') ?>: <b><?= $year['name'] ?></b>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php if ($position == true) : ?>
            <div class="card">
                <div class="card-header">
                    <h2><b><?= lang('app.results') ?></b></h2>
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
                                <?php foreach ($std as $key => $dt) : ?>
                                    <?php $st = $pr->user($dt['student_id']) ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><a href="<?= base_url('result/show/' . $dt['student_id'] . '/' . $dt['class_id']) ?>" target="_blank"><?= $dt['malaf'] ?></a></td>
                                        <td><?= ($st['name_ar'] ?? $st['name'] . ' ' . $st['lname']) ?></td>
                                        <td><?= $pr->sum($dt['student_id'], $dt['class_id']) ?></td>
                                        <td><?= $pr->gpa($dt['student_id'], $dt['class_id']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif ($muadala == true) : ?>
            <div class="card">
                <div class="card-header">
                    <h2 class="danger"><b><?= lang('app.results') ?></b>
                        <?php if (!$position) : ?>
                            <a class="btn btn-info box-shadow-1 round pull-right" id="send" href="<?= base_url('gpa/position/' . $sub[0]['class_id']) ?>"><?= lang('app.positionReg') ?></a>
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
                                <?php foreach ($std as $key => $dt) : ?>
                                    <?php $st = $pr->user($dt['student_id']) ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><a href="<?= base_url('result/show/' . $dt['student_id'] . '/' . $dt['class_id']) ?>" target="_blank"><?= $dt['malaf'] ?></a></td>
                                        <td><?= ($st['name_ar'] ? $st['name_ar'] : $st['name'] . ' ' . $st['lname']) ?></td>
                                        <td><?= $pr->sum($st['id'], $st['level']) ?></td>
                                        <td><?= $pr->gpa($st['id'], $st['level']) ?></td>
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
<script>
    $('#send').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: 'هل أضيف كل نتائج اﻻختبارات؟',
            text: "حقق أن كل طالب مسجل نتائجه!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم!',
            cancelButtonText: 'لا!',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            }
        })
    });
</script>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>