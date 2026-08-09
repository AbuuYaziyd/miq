<?php
$points = 0;
$total = 0;
?>
<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<?php if ($res) : ?>
    <div class="row">
        <div class="col-12">
            <?php if (session('role') == 'admin' && $student_gpa != null) : ?>
                <?php if ($results[0]['course_status'] == 'gpa') : ?>
                    <?= form_open('result/change', ['id' => 'form']) ?>
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <input type="hidden" name="course_id" value="<?= $student_gpa['course_id'] ?>">
                    <button type="submit" class="btn btn-danger btn-lg m-2 submit"><?= lang('app.edit') ?></button>
                    </form>
                <?php elseif ($results[0]['course_status'] == 'edit') : ?>
                    <?= form_open('gpa/edit', ['id' => 'gpa_form']) ?>
                    <input type="hidden" name="gpa_id" value="<?= $student_gpa['id'] ?>">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <input type="hidden" name="course_id" value="<?= $student_gpa['course_id'] ?>">
                    <button type="submit" class="btn btn-purple btn-lg mb-1 gpa"><?= lang('app.muadalaHuu') ?></button>
                    </form>
                <?php endif ?>
            <?php endif ?>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        <?php if (session('lang') != 'ar') : ?>
                        <b><?= $user['name'] ?> <?= $user['mname'] ?> <?= $user['lname'] ?></b> | <?= lang('app.results') ?> - <?= $class['name'] ?>
                        <?php else : ?>
                        <b><?= $user['name_ar'] ?> <?= $user['mname_ar'] ?> <?= $user['lname_ar'] ?></b> | <?= lang('app.results') ?> - <?= $class['name_ar'] ?>
                        <?php endif ?>
                        <?php if ($student_gpa != null) : ?>
                            <?php if (session('role') == 'admin' || session('level') == 4) : ?>
                                <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('gpa/kashf/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a>
                            <?php elseif ($results[0]['status'] == 'done') : ?>
                                <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('gpa/kashf/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a>
                            <?php endif ?>
                        <?php endif ?>
                    </h2>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered attendance">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.subject') ?></th>
                                    <th><?= lang('app.fasli1') ?></th>
                                    <?php if ($results[0]['final_status'] != null) : ?>
                                        <th><?= lang('app.fasli2') ?></th>
                                        <th><?= lang('app.mark') ?></th>
                                    <?php endif ?>
                                    <th><?= lang('app.grade') ?></th>
                                    <th><?= lang('app.taqdir') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sub as $key => $dt) : ?>
                                    <?php $mark = $res->mark($class['id'], $user['id'], $dt['id']) ?>
                                    <?php $sum = $mark['final'] + $mark[$exam] ?>
                                    <?php $grade = $res->grade($sum) ?>
                                    <tr>
                                        <td style="width: 1%;"><?= $key + 1 ?></td>
                                        <td style="width: 15%;">
                                            <?php if (session('lang') != 'ar') : ?>
                                                <?= $dt['name'] ?>
                                            <?php else : ?>
                                                <?= $dt['name_ar'] ?>
                                            <?php endif ?>
                                        </td>
                                        <?php if (session('role') != 'student') : ?>
                                            <!-- course -->
                                            <?php if ($mark[$exam . '_status'] == null) : ?>
                                                <td style="width: 1%;">*</td>
                                            <?php elseif ($mark[$exam . '_status'] == 'done' || $mark[$exam . '_status'] == 'gpa') : ?>
                                                <td style="width: 1%;"><?= $mark[$exam] ?></td>
                                            <?php else : ?>
                                                <td style="width: 1%;"><a href="<?= base_url('result/' . $exam . '/edit/' . $mark['id']) ?>" class="btn btn-secondary btn-sm round"><?= $mark[$exam] ?></a></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <td style="width: 1%;">
                                            <span class="<?= ($mark[$exam] < 30 ? 'danger' : '') ?>">
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $res->grade($mark[$exam] * 2)['ramz'] ?>
                                                <?php else : ?>
                                                    <?= $res->grade($mark[$exam] * 2)['ramz_ar'] ?>
                                                <?php endif ?>
                                            </span>
                                        </td>
                                        <td style="width: 15%;">
                                            <span class="<?= ($mark[$exam] < 30 ? 'danger' : '') ?>">
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $res->grade($mark[$exam] * 2)['name'] ?>
                                                <?php else : ?>
                                                    <?= $res->grade($mark[$exam] * 2)['name_ar'] ?>
                                                <?php endif ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php $total += $sum ?>
                                    <?php $points += $grade['point'] ?>
                                <?php endforeach ?>
                            </tbody>
                        </table><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<script>
    $('.submit').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '<?= lang('app.edit') ?>',
            text: "<?= lang('app.editResults') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                document.getElementById("form").submit()
            }
        })
    });
</script>
<script>
    $('.gpa').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '<?= lang('app.muadalaHuu') ?>',
            text: "<?= lang('app.positionReg') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                document.getElementById("gpa_form").submit()
            }
        })
    });
</script>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>