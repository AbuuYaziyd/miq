<!-- <?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php if ($stu['level'] != 'graduate') : ?>
        <?= $this->include('students/info') ?>
    <?php else : ?>
        <?= $this->include('khirrij/info') ?>
    <?php endif ?>
</div>
<?php if (count($pr) > 0) : ?>
    <div class="row">
        <div class="col-12 mb-2">
            <?php if (session('role') != 'admin') : ?>
                <a href="<?= base_url('print/all/' . $stu['id']) ?>" target="_blank" class="btn btn-teal btn-lg btn-block"><?= lang('app.academicProgress') ?></a>
            <?php else : ?>
                <a href="<?= base_url('print/progress/' . $stu['id']) ?>" target="_blank" class="btn btn-teal btn-lg btn-block"><?= lang('app.academicProgress') ?></a>
            <?php endif ?>
        </div>
        <?php foreach ($pr as $dt) : ?>
            <div class="col-md-<?= count($pr) == 2 ? 6 : (count($pr) == 4 ? 6 : 4) ?>">
                <a href="<?= base_url('result/show/' . $stu['id'] . '/' . $dt['class_id']) ?>">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="danger"><?= $p->class($dt['class_id'])['name'] ?></h3>
                                    </div>
                                    <div>
                                        <i class="icon-bulb danger font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>
    <?php if ($res[0]['status'] != 'done') : ?>
        <div class="row">
            <div class="col-12 mb-2">
                <a href="<?= base_url('result/show/' . $stu['id'] . '/' . $class['id']) ?>" class="btn btn-lg btn-block btn-outline-info"><b><?= lang('app.thisYearMarks') ?></b></a>
            </div>
        </div>
    <?php endif ?>
<?php elseif ($res[0]['status'] != 'done') : ?>
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url('result/show/' . $stu['id'] . '/' . $class['id']) ?>" class="btn btn-lg btn-block btn-outline-info"><b><?= lang('app.thisYearMarks') ?></b></a>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2><b><?= lang('app.notFound') ?></b></h2>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<?= $this->endSection() ?> -->