<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <?php foreach ($subjects as $dt) : ?>
            <div class="col-md-3 col-sm-6">
                <a href="<?= base_url('subject/class/' . $dt['id']) ?>">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">
                                            <?= $sub->course($dt['course_id'])['name'] ?>
                                        </h6>
                                        <h4><b><?= $dt['name'] ?></b></h4>
                                    </div>
                                    <div>
                                        <i class="ft ft-layout secondary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    <?php endforeach ?>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.students') ?> | <?= $class['name'] ?></b></h3>
            </div>
            <hr>
            <?php if ($std) : ?>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable text-center">
                            <thead>
                                <tr>
                                    <th><?= lang('app.username') ?></th>
                                    <th><?= lang('app.fullName') ?></th>
                                    <th><?= lang('app.fullName_ar') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($std as $key => $dt) : ?>
                                    <tr>
                                        <td><a href="<?= base_url('student/page/' . $dt['id']) ?>" class="btn btn-sm btn-outline-cyan round"><?= $dt['username'] ?></a></td>
                                        <td><?= $dt['name'] ?> <?= $dt['mname'] ?> <?= $dt['lname'] ?></td>
                                        <td><?= $dt['name_ar'] ?> <?= $dt['mname_ar'] ?> <?= $dt['lname_ar'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>