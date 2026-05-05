<!-- <?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card" style="zoom: 1;">
            <div class="card-header bg-hexagons border-top-3 border-top-primary" style="justify-content: center; display:flex">
                <div class="card-body pt-0">
                    <h4>
                        <span class="h1"><b><?= APP_NAME ?></b></span><br>
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
        <?= form_open('attendance/edit') ?>
        <div class="card">
            <div class="card-header">
                <div class="card-header">
                    <h3><b><?= $sex == 'm' ? lang('app.males') : lang('app.females') ?></b></h3>
                </div>
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
                                <?php foreach ($att as $key => $dt) : ?>
                                    <?php $stu = $at->stu($dt['student_id']) ?>
                                    <tr id="stu<?= $key ?>" class="">
                                        <input type="hidden" name="id[]" value="<?= $dt['id'] ?>">
                                        <td style="width: 1%;"><?= $stu['malaf'] ?? 0 ?></td>
                                        <td><?= $dt['name_ar'] ?? $dt['name'] . ' ' . $dt['lname'] ?></td>
                                        <td style="width: 1%;">
                                            <input type="radio" name="status<?= $key ?>" value="1" <?= $dt['status'] == 1 ? 'checked' : '' ?>>
                                        </td>
                                        <td style="width: 1%;">
                                            <input type="radio" name="status<?= $key ?>" value="2" onclick="$('#stu<?= $key ?>').removeClass().addClass('bg-warning bg-lighten-3');" <?= $dt['status'] == 2 ? 'checked' : '' ?>>
                                        </td>
                                        <td style="width: 1%;">
                                            <input type="radio" name="status<?= $key ?>" value="0" onclick="$('#stu<?= $key ?>').removeClass().addClass('bg-danger bg-lighten-3');" <?= $dt['status'] == 0 ? 'checked' : '' ?>>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                    <input type="hidden" name="teacher_id" value="<?= session('id') ?>">
                    <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
                    <button type="submit" class="btn btn-block btn-primary btn-lg mt-1"><?= lang('app.send') ?></button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?> -->