<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card punch-status">
            <div class="card-body">
                <h4>
                    <b><?= lang('app.attendance') ?> |
                        <?php if (session('lang') != 'ar') : ?>
                            <b><?= $user['name'] ?> <?= $user['mname'] ?> <?= $user['lname'] ?></b>
                        <?php else : ?>
                            <b><?= $user['name_ar'] ?> <?= $user['mname_ar'] ?> <?= $user['lname_ar'] ?></b>
                        <?php endif ?></b>
                </h4>
                <hr>
                <div class="punch-det">
                    <h6><b><?= lang('app.changeDate') ?></b></h6>
                    <?= form_open('attendance/date') ?>
                    <input type="hidden" name="student_id" value="<?= $user['id'] ?>">
                    <input type="date" name="date" max="<?= date('Y-m-d') ?>" class="form-control" value="<?= $date ?>" onchange="this.form.submit()">
                    </form>
                </div>
                <hr>
                    <?php if ($day != null) : ?>
                <?php foreach ($day as $dy) : ?>
                        <div class="punch-det">
                            <span class="text-center">
                                <h6><?= lang('app.subject') ?>: <b>fgfdhhjg</b></h6>
                            </span>
                            <table class="table">
                                <th><b><?= lang('app.attendanceTime') ?></b></th>
                                <th><b><?= lang('app.teacher') ?></b></th>
                                <th><b><?= lang('app.status') ?></b></th>
                                <tr>
                                    <td>
                                        <?php if (service('request')->getLocale() != 'ar') : ?>
                                            <p><?= date('d-m-Y H:m', strtotime($dy['created_at'])) ?></p>
                                        <?php else : ?>
                                            <p><?= date('H:m d-m-Y', strtotime($dy['created_at'])) ?></p>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?= $att->stu($dy['teacher_id'])['name_ar'] ?? $att->stu($dy['teacher_id'])['lname'] ?>
                                    </td>
                                    <td>
                                        <?php if ($dy['status'] == 1) : ?>
                                            <span class="badge badge-pill badge-success"><?= lang('app.present') ?></span>
                                        <?php elseif ($dy['status'] == 2) : ?>
                                            <span class="badge badge-pill badge-warning"><?= lang('app.ruksa') ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-pill badge-danger"><?= lang('app.absent') ?></span>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            </table>
                            <h6></h6>
                        </div>
                <?php endforeach ?>
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
                <hr>
                <div class="punch-det">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card att-statistics">
            <div class="card-body">
                <h3><b><?= lang('app.thisMonthStatistics') ?> - (<?= date('m/Y') ?>)</b></h3>
                <hr>
                <?php
                $no_of_days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
                $thisMonth = $att->thisMonth($user['id'], $date);
                ?>
                <div class="stats-list">
                    <div class="stats-info">
                        <p><b><?= lang('app.present') ?>: </b> <strong><?= $thisMonth['p'] ?> <small>/ <?= $no_of_days ?> <?= lang('app.days') ?></small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?= ($thisMonth['p'] / $no_of_days) * 100 ?>%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p><b><?= lang('app.absent') ?>: </b> <strong><?= $thisMonth['a'] ?> <small>/ <?= $no_of_days ?> <?= lang('app.days') ?></small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?= ($thisMonth['a'] / $no_of_days) * 100 ?>%" aria-valuenow="<?= ($thisMonth['a'] / $no_of_days) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p><b><?= lang('app.ruksa') ?>: </b> <strong><?= $thisMonth['r'] ?> <small>/ <?= $no_of_days ?> <?= lang('app.days') ?></small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= ($thisMonth['r'] / $no_of_days) * 100 ?>%" aria-valuenow="<?= ($thisMonth['r'] / $no_of_days) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($notPresent) : ?>
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
                                    <th style="width: 1px;">#</th>
                                    <th><?= lang('app.attendanceTime') ?></th>
                                    <th><?= lang('app.status') ?></th>
                                    <th><?= lang('app.reason') ?></th>
                                    <th><?= lang('app.choose') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notPresent as $key => $dt) : ?>
                                    <tr>
                                        <td><span><?= $key + 1 ?></span></td>
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
                                                        <span class="btn btn-sm btn-danger round">
                                                            <?= lang('app.notVerified') ?>
                                                        </span>
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
<?php endif ?>
<?= $this->endSection() ?>