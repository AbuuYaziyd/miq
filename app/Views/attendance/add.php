<!-- <?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card" style="zoom: 1;">
            <div class="card-header bg-hexagons border-top-3 border-top-danger" style="justify-content: center; display:flex">
                <div class="card-body pt-0">
                    <h4>
                        <span class="h1 danger"><b><?= env('APP_NAME') ?></b></span><br>
                        <?= lang('app.academics') ?>: <b><?= $sch['name'] ?></b><br>
                        <?= lang('app.className') ?>: <b><?= $class['name'] ?></b><br>
                        <?= lang('app.date') ?>: <b><?= date('d/m/Y') ?></b>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <?= form_open('attendance/save') ?>
        <div class="card">
            <div class="card-header">
                <h3><b><?= $sex == 'm' ? lang('app.males') : lang('app.females') ?></b></h3>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered attendance" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.name') ?></th>
                                    <th><?= lang('app.present') ?></th>
                                    <th><?= lang('app.ruksa') ?></th>
                                    <th><?= lang('app.absent') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stu as $key => $dt) : ?>
                                    <tr id="stu<?= $key ?>" class="">
                                        <input type="hidden" name="student_id[]" value="<?= $dt['id'] ?>">
                                        <input type="hidden" name="sex[]" value="<?= $dt['sex'] ?>">
                                        <td style="width: 1%;"><?= $dt['malaf'] ?></td>
                                        <td><?= $dt['name_ar'] ?? $dt['name'] . $dt['lname'] ?></td>
                                        <td style="width: 1%;">
                                            <input type="radio" name="status<?= $key ?>" value="1" onclick="$('#stu<?= $key ?>').removeClass();" checked>
                                        </td>
                                        <td style="width: 1%;">
                                            <input type="radio" name="status<?= $key ?>" value="2" onclick="$('#stu<?= $key ?>').removeClass().addClass('bg-warning bg-lighten-3');">
                                        </td>
                                        <td style="width: 1%;">
                                            <input type="radio" name="status<?= $key ?>" value="0" onclick="$('#stu<?= $key ?>').removeClass().addClass('bg-danger bg-lighten-3');">
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                    <input type="hidden" name="teacher_id" value="<?= session('id') ?>">
                    <input type="hidden" name="date" value="<?= date('d-m-Y') ?>">
                    <button type="submit" class="btn btn-block btn-primary btn-lg mt-1"><?= lang('app.send') ?></button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?> -->