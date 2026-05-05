<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3> <b><?= lang('app.timetable') ?> | <?= $course['name'] ?></b></h3>
            </div>
            <div class="card-content">
                <?php if (count($time)  > 0) : ?>
                    <div class="card-body">
                        <table class="table table-striped table-bordered text-center">
                            <?php for ($i = 0; $i <= 6; $i++) : ?>
                                <?php $time = $tmt->where(['day' => $i, 'course_id' => $course['id']])->findAll() ?>
                                <tr>
                                    <td class="highlight"><b><?= lang('app.siku' . $i) ?></b></td>
                                    <?php foreach ($time as $key => $dt) : ?>
                                        <?php if ($dt['subject_id'] != null) : ?>
                                            <?php $all = $tmt->data($dt['id']) ?>
                                            <?php $tch = $all['teacher'] ?>
                                            <?php $subject = $all['subject'] ?>
                                            <?php $period = $all['period'] ?>
                                            <?php if (session('lang') != 'ar') : ?>
                                                <?php $teacher = $tch['name'] . ' ' . $tch['mname']  . ' ' . $tch['lname'] ?>
                                                <?php $sub_name = $subject['name'] ?>
                                            <?php else : ?>
                                                <?php $teacher = $tch['name_ar'] . ' ' . $tch['mname_ar']  . ' ' . $tch['lname_ar'] ?>
                                                <?php $sub_name = $subject['name_ar'] ?>
                                            <?php endif ?>
                                            <td>
                                                <b class="display-5"><?= $sub_name ?> - <?= $subject['ramz'] ?></b><br>
                                                <span class="badge badge-pill badge-warning"><?= $period['start'] ?> - <?= $period['end'] ?></span><br>
                                                <span class="badge badge-pill badge-primary"><?= $teacher ?></span>
                                                <?php if (session('role') == 'admin') : ?>
                                                    <hr>
                                                    <a href="<?= base_url('timetable/delete/' . $dt['id']) ?>" class="btn btn-sm btn-danger delete"><?= lang('app.delete') ?></a>
                                                <?php endif ?>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <?= form_open('timetable/add') ?>
                                                <select name="subject_id" class="custom-select" onchange="this.form.submit()">
                                                    <option selected disabled><?= lang('app.choose') ?></option>
                                                    <?php foreach ($subjects as $ds) : ?>
                                                        <option value="<?= $ds['id'] ?>"><?= $ds['name'] ?></option>

                                                    <?php endforeach ?>
                                                </select>
                                                <input type="hidden" name="period_id" value="<?= $key + 1 ?>">
                                                <input type="hidden" name="id" value="<?= $dt['id'] ?>">
                                                </form>
                                            </td>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </tr>
                            <?php endfor ?>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="card-body">
                        <?= form_open('timetable/create') ?>
                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                        <button type="submit" class="btn btn-primary btn-block btn-lg"><?= lang('app.registerTimetable') ?></button>
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>