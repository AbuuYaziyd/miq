<?php
$err = 0;
?>
<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="card" style="zoom: 1;">
                    <div class="card-header bg-hexagons border-top-3 border-top-danger" style="justify-content: center; display:flex">
                        <div class="card-body pt-0">
                            <h4>
                                <span class="h1 danger"><b><?= lang('app.appName') ?></b></span><br>
                                <?php if (session('lang') != 'ar') : ?>
                                    <?= lang('app.school') ?>: <b><?= $school['name'] ?></b><br>
                                    <?= lang('app.course') ?>: <b><?= $course['name'] ?></b><br>
                                    <?= lang('app.subject') ?>: <b><?= $subject['name'] ?></b><br>
                                <?php else : ?>
                                    <?= lang('app.school') ?>: <b><?= $school['name_ar'] ?></b><br>
                                    <?= lang('app.course') ?>: <b><?= $course['name_ar'] ?></b><br>
                                    <?= lang('app.subject') ?>: <b><?= $subject['name_ar'] ?></b><br>
                                <?php endif ?>
                                <?= lang('app.acYear') ?>: <b><?= $year['name'] ?></b>
                            </h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if ($check['course_status'] == 'add' || $check['final_status'] == 'add') : ?>
                            <div class="btn-group pull-right">
                                <a href="<?= base_url('result/sign/' . $subject['id'] . '/M') ?>" class="btn btn-primary round" target="_blank"><?= lang('app.kashfM') ?></a>
                                <a href="<?= base_url('result/sign/' . $subject['id'] . '/F') ?>" class="btn btn-pink round" target="_blank"><?= lang('app.kashfF') ?></a>
                            </div>
                        <?php else : ?>
                            <a href="<?= base_url('result/' . $exam . '/done/' . $subject['id']) ?>" class="btn btn-black round pull-right done"><?= lang('app.doneResults') ?></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (count($male) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h3><b><?= lang('app.enterResults') ?> - <?= lang('app.males') ?></b></h3>
                </div>
                <?= form_open('result/' . $exam . '/update') ?>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-md mb-0">
                            <thead>
                                <tr>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.fullname') ?></th>
                                    <th><?= lang('app.marks') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($male as $key => $dt) : ?>
                                    <?php $mark = $res->markThisYear($subject['course_id'], $dt['id'], $subject['id']) ?>
                                    <?php if ($mark != null) : ?>
                                        <tr>
                                            <td>
                                                <a href="<?= base_url('result/student/' . $dt['id']) ?>" class="btn btn-sm round btn-outline-black">
                                                    <input type="hidden" name="id[]" value="<?= $mark['id'] ?>">
                                                    <?= $dt['username'] ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $dt['name'] ?> <?= $dt['mname'] ?> <?= $dt['lname'] ?>
                                                <?php else : ?>
                                                    <?= $dt['name_ar'] ?> <?= $dt['mname_ar'] ?> <?= $dt['lname_ar'] ?>
                                                <?php endif ?>
                                            </td>
                                            <?php if ($mark[$exam] != 0) : ?>
                                                <td>
                                                    <input type="number" name="<?= $exam ?>[]" class="form-control" value="<?= $mark[$exam] ?>">
                                                </td>
                                            <?php else : ?>
                                                <td class="text-truncate">
                                                    <input type="text" name="<?= $exam ?>[]" class="form-control" placeholder="50%">
                                                </td>
                                            <?php endif ?>
                                        </tr>
                                    <?php else : ?>
                                        <?php $err = $err + 1 ?>
                                        <tr>
                                            <td>
                                                <span class="btn btn-sm round btn-black">
                                                    <?= $dt['username'] ?>
                                                </span><br>
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $dt['name'] ?> <?= $dt['mname'] ?> <?= $dt['lname'] ?>
                                                <?php else : ?>
                                                    <?= $dt['name_ar'] ?> <?= $dt['mname_ar'] ?> <?= $dt['lname_ar'] ?>
                                                <?php endif ?>
                                            </td>
                                            <td colspan="2">
                                                <a href="<?= base_url('result/insert/' . $dt['id']) ?>" class="btn btn-danger btn-block"><?= lang('app.studentsResults') ?></a>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">
                    <input type="hidden" name="exam" value="<?= $exam ?>">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" <?= $err > 0 ? 'disabled' : '' ?>><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        <?php else : ?>
            <div class="card text-center">
                <div class="card-header">
                    <h3><b><?= lang('app.nothingFound') ?></b></h3>
                </div>
            </div>
        <?php endif ?>
        <?php if (count($female) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h3><b><?= lang('app.enterResults') ?> - <?= lang('app.females') ?></b></h3>
                </div>
                <?= form_open('result/' . $exam . '/update') ?>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-md mb-0">
                            <thead>
                                <tr>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.fullname') ?></th>
                                    <th><?= lang('app.marks') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($female as $key => $dt) : ?>
                                    <?php $mark = $res->markThisYear($subject['course_id'], $dt['id'], $subject['id']) ?>
                                    <?php if ($mark != null) : ?>
                                        <tr>
                                            <td>
                                                <a href="<?= base_url('result/' . $exam . '/show/' . $dt['id'] . '/' . $course['id']) ?>" class="btn btn-sm round btn-outline-black" target="_blank">
                                                    <input type="hidden" name="id[]" value="<?= $mark['id'] ?>">
                                                    <?= $dt['username'] ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $dt['name'] ?> <?= $dt['mname'] ?> <?= $dt['lname'] ?>
                                                <?php else : ?>
                                                    <?= $dt['name_ar'] ?> <?= $dt['mname_ar'] ?> <?= $dt['lname_ar'] ?>
                                                <?php endif ?>
                                            </td>
                                            <?php if ($mark[$exam] != 0) : ?>
                                                <td>
                                                    <input type="number" name="<?= $exam ?>[]" class="form-control" value="<?= $mark[$exam] ?>">
                                                </td>
                                            <?php else : ?>
                                                <td class="text-truncate">
                                                    <input type="text" name="<?= $exam ?>[]" class="form-control" placeholder="50%">
                                                </td>
                                            <?php endif ?>
                                        </tr>
                                    <?php else : ?>
                                        <?php $err = $err + 1 ?>
                                        <tr>
                                            <td>
                                                <span class="btn btn-sm round btn-black">
                                                    <?= $dt['username'] ?>
                                                </span><br>
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $dt['name'] ?> <?= $dt['mname'] ?> <?= $dt['lname'] ?>
                                                <?php else : ?>
                                                    <?= $dt['name_ar'] ?> <?= $dt['mname_ar'] ?> <?= $dt['lname_ar'] ?>
                                                <?php endif ?>
                                            </td>
                                            <td colspan="2">
                                                <a href="<?= base_url('result/insert/' . $dt['id']) ?>" class="btn btn-danger btn-block"><?= lang('app.studentsResults') ?></a>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">
                    <input type="hidden" name="exam" value="<?= $exam ?>">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" <?= $err > 0 ? 'disabled' : '' ?>><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        <?php else : ?>
            <div class="card text-center">
                <div class="card-header">
                    <h3><b><?= lang('app.nothingFound') ?></b></h3>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<script>
    $('.done').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.allStudentMarked') ?>',
            text: '<?= lang('app.allStudentsNotMarkedWillBeNulled') ?>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            }
        })
    });
</script>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>