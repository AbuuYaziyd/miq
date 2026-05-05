<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
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
                    <a href=" <?= base_url($day['file']) ?>" class="btn btn-info btn-sm round pull-right" target="_blank"><?= lang('app.reason') ?></a>
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
                        <p>
                            <?php $teach = $att->stu($day['teacher_id']) ?>
                            <?php if (session('lang') != 'ar') : ?>
                                <?= $teach['name'] ?>
                                <?= $teach['mname'] ?>
                                <?= $teach['lname'] ?>
                            <?php else : ?>
                                <?= $teach['name_ar'] ?>
                                <?= $teach['mname_ar'] ?>
                                <?= $teach['lname_ar'] ?>
                            <?php endif ?>
                        </p>
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
                <div class="row">
                    <div class="col-md-4">
                        <a href="<?= base_url('attendance/accept/' . $day['id']) ?>" class="btn btn-success btn-lg btn-block mb-1"><?= lang('app.accept') ?></a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url('attendance/dismss/' . $day['id']) ?>" class="btn btn-warning btn-lg btn-block mb-1"><?= lang('app.dismiss') ?></a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url('attendance/delete/' . $day['id']) ?>" class="btn btn-danger btn-lg btn-block mb-1"><?= lang('app.delete') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>