<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.absentsAndRuksa') ?></b></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped custom-table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th><?= lang('app.student') ?></th>
                                <th><?= lang('app.attendanceTime') ?></th>
                                <th><?= lang('app.status') ?></th>
                                <th><?= lang('app.reason') ?></th>
                                <th><?= lang('app.choose') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($attendance as $key => $dt) : ?>
                                <?php $stu = $att->stu($dt['student_id']) ?>
                                <tr>
                                    <td><?= $stu['name'] ?> <?= $stu['mname'] ?> <?= $stu['lname'] ?></td>
                                    <td>
                                        <span>
                                            <?php if (service('request')->getLocale() != 'ar') : ?>
                                                <p><?= date('d-m-Y H:m', strtotime($dt['created_at'])) ?></p>
                                            <?php else : ?>
                                                <p><?= date('H:m d-m-Y', strtotime($dt['created_at'])) ?></p>
                                            <?php endif ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="btn btn-sm btn-<?= $dt['status'] == 2 ? 'warning' : 'danger' ?> round">
                                            <?= $dt['status'] == 2 ? lang('app.ruksa') : lang('app.absent') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($dt['file'] != null) : ?>
                                            <a href="<?= base_url($dt['file']) ?>" target="_blank" class="btn btn-sm btn-<?= $dt['reply'] != 1 ? 'outline-' : '' ?>success round">
                                                <?= $dt['reason'] ?>
                                            </a>
                                        <?php else : ?>
                                            <span class="btn btn-sm btn-danger round">
                                                <?= lang('app.nothingFound') ?>
                                            </span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($dt['file'] != null) : ?>
                                            <?php if ($dt['reply'] != 1) : ?>
                                                <?php if (session('role') != 'admin') : ?>
                                                    <span class="btn btn-sm btn-outline-warning round">
                                                        <?= lang('app.processing') ?>
                                                    </span>
                                                <?php else : ?>
                                                    <a href="<?= base_url('attendance/reply/' . $dt['id']) ?>" class="btn btn-sm btn-warning round">
                                                        <?= lang('app.open') ?>
                                                    </a>
                                                <?php endif ?>
                                            <?php else : ?>
                                                <span class="btn btn-sm btn-success round">
                                                    <?= lang('app.approved') ?>
                                                </span>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <a href="<?= base_url('attendance/appeal/' . $dt['id']) ?>" class="btn btn-sm btn-small btn-<?= $dt['status'] == 2 ? 'warning' : 'danger' ?> round"><?= lang('app.addReason') ?></a>
                                        <?php endif ?>
                                    </td>
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