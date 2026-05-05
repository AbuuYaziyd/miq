<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
</div>
<?php if (count($gpas) > 0) : ?>
    <div class="row">
        <?php foreach ($gpas as $dt) : ?>
            <div class="col-md-<?= count($gpas) == 2 ? 6 : (count($gpas) == 4 ? 6 : 4) ?>">
                <a href="<?= base_url('result/view/' . $stu['id'] . '/' . $dt['course_id']) ?>">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="danger"><?= $gpa->class($dt['course_id'])['name'] ?></h3>
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
    <?php if ($res[0]['course_status'] != 'gpa') : ?>
        <div class="row">
            <div class="col-12 mb-2">
                <a href="<?= base_url('result/show/' . $stu['id'] . '/' . $class['id']) ?>" class="btn btn-lg btn-block btn-outline-info"><b><?= lang('app.thisYearMarks') ?></b></a>
            </div>
        </div>
    <?php endif ?>
<?php elseif ($res[0]['course_status'] != 'gpa') : ?>
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
<?= $this->endSection() ?>