<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <?php if (count($query) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h2><b class="warning"><?= lang('app.attendance') ?></b></h2>
                </div>
                <?= form_open('attendance/update') ?>
                <div class="card-content collapse show text-center">
                    <div class="card-body card-dashboard">
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
                                <?php foreach ($query as $key => $dt) : ?>
                                    <?php $user = $usr->find($dt['student_id']) ?>
                                        <tr id="stu<?= $key ?>">
                                            <input type="hidden" name="id[]" value="<?= $dt['id'] ?>">
                                            <td><a href=" <?= base_url('student/page/' . $user['id']) ?>"><?= $user['username'] ?></a></td>
                                            <td>
                                                <?= $user['name'] ?>
                                                <?= $user['mname'] ?>
                                                <?= $user['lname'] ?>
                                                <br>
                                                <?= $user['name_ar'] ?>
                                                <?= $user['mname_ar'] ?>
                                                <?= $user['lname_ar'] ?>
                                            </td>
                                            <td style="width: 1%;">
                                                <input type="radio" name="status<?= $key ?>" value="1" onclick="$('#stu<?= $key ?>').removeClass();" <?= $dt['status'] == 1 ? 'checked' : '' ?>>
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
                        <input type="hidden" name="course_id" value="<?= $class['id'] ?>">
                        <button type="submit" class="tn btn-lg btn-block btn-warning mt-2"><?= lang('app.attendanceEdit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        <?php else : ?>
            <div class="card">
                <div class="card-header">
                    <h2><b><?= lang('app.attendance') ?></b></h2>
                </div>
                <?= form_open('attendance/create') ?>
                <div class="card-content collapse show text-center">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered attendance" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.fullname') ?></th>
                                    <th><?= lang('app.present') ?></th>
                                    <th><?= lang('app.ruksa') ?></th>
                                    <th><?= lang('app.absent') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($std as $key => $dt) : ?>
                                        <tr id="stu<?= $key ?>">
                                            <input type="hidden" name="student_id[]" value="<?= $dt['id'] ?>">
                                            <input type="hidden" name="sex[]" value="<?= $dt['sex'] ?>">
                                            <td><a href=" <?= base_url('student/page/' . $dt['id']) ?>"><?= $dt['username'] ?></a></td>
                                            <td>
                                                <?= $dt['name'] ?>
                                                <?= $dt['mname'] ?>
                                                <?= $dt['lname'] ?>
                                                <br>
                                                <?= $dt['name_ar'] ?>
                                                <?= $dt['mname_ar'] ?>
                                                <?= $dt['lname_ar'] ?>
                                            </td>
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
                        <input type="hidden" name="course_id" value="<?= $class['id'] ?>">
                        <input type="hidden" name="school_id" value="<?= $class['school_id'] ?>">
                        <button type="submit" class="tn btn-lg btn-block btn-primary mt-2"><?= lang('app.takeAttendance') ?></button>
                    </div>
                </div>
                </form>
            </div>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>