<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card att-statistics">
            <div class="card-body">
                <h3 class="text-center"><b><?= lang('app.addReason') ?></b></h3>
                <hr>
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open_multipart('attendance/submit-appeal') ?>
                <div class="col-12">
                    <label for=""><?= lang('app.addReason') ?> <span class="danger">*</span></label>
                    <?php if ($validation->getError('reason')) : ?>
                        <span class="badge badge-danger"> <?= $errors = $validation->getError('reason') ?></span>
                    <?php endif ?>
                    <input type="text" class="form-control" name="reason"><br>
                    <label for=""><?= lang('app.addMalaf') ?> <span class="danger">*</span></label>
                    <?php if ($validation->getError('file')) : ?>
                        <span class="badge badge-danger"> <?= $errors = $validation->getError('file') ?></span>
                    <?php endif ?>
                    <input type="file" name="file" class="form-control">
                    <input type="hidden" name="id" value="<?= $day['id'] ?>">
                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-lg my-2"><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card punch-status">
            <div class="card-body">
                <h3>
                    <b>
                        <?= lang('app.attendance') ?> -
                        <?php if ($day != null) : ?>
                            <?php if ($day['status'] == 1) : ?>
                                <span class="badge badge-pill badge-success"><?= lang('app.present') ?></span>
                            <?php elseif ($day['status'] == 2) : ?>
                                <span class="badge badge-pill badge-warning"><?= lang('app.ruksa') ?></span>
                            <?php else : ?>
                                <span class="badge badge-pill badge-danger"><?= lang('app.absent') ?></span>
                            <?php endif ?>
                        <?php elseif (date('D', strtotime($date)) == 'Sat' || date('D', strtotime($date)) == 'Sun') : ?>
                            <span class="badge badge-pill badge-secondary"><?= lang('app.weekend') ?></span>
                        <?php else : ?>
                            <span class="badge badge-pill badge-secondary"><?= lang('app.nothingFound') ?></span>
                        <?php endif ?>
                    </b>
                </h3>
                <hr>
                <?php if ($day != null) : ?>
                    <div class="punch-det">
                        <h6><b><?= lang('app.attendanceTime') ?></b></h6>
                        <?php if (service('request')->getLocale() != 'ar') : ?>
                            <p><?= date('d-m-Y H:m', strtotime($day['created_at'])) ?></p>
                        <?php else : ?>
                            <p><?= date('H:m d-m-Y', strtotime($day['created_at'])) ?></p>
                        <?php endif ?>
                    </div>
                    <div class="punch-det">
                        <h6><b><?= lang('app.teacher') ?></b></h6>
                        <p><?= $att->stu($day['teacher_id'])['name_ar'] ?? $att->stu($day['teacher_id'])['lname'] ?></p>
                    </div>
                <?php elseif (date('D', strtotime($date)) == 'Sat' || date('D', strtotime($date)) == 'Sun') : ?>
                    <div class="punch-det">
                        <h6><b><?= lang('app.weekend') ?></b></h6>
                        <p><?= lang('app.nothingFound') ?></p>
                    </div>
                <?php else : ?>
                    <div class="punch-det">
                        <h6><b><?= lang('app.nothingFound') ?></b></h6>
                        <p><?= lang('app.nothingFound') ?></p>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>