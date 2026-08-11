<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<?php if (count($gp) > 0) : ?>
    <?php if ($res[0]['course_status'] != 'gpa') : ?>
        <div class="row">
            <div class="col-12 mb-2">
                <a href="<?= base_url('result/user/' . $stu['id'] . '/' . $class['id']) ?>" class="btn btn-lg btn-block btn-outline-info"><b><?= lang('app.thisYearMarks') ?></b></a>
            </div>
        </div>
    <?php endif ?>
<?php elseif ($res[0]['course_status'] != 'gpa') : ?>
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url('result/user/' . $stu['id'] . '/' . $class['id']) ?>" class="btn btn-lg btn-block btn-outline-info"><b><?= lang('app.thisYearMarks') ?></b></a>
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

<div class="row">
    <?php foreach ($school as $sc) : ?>
        <div class="col-md-4">
            <div class="card" data-height="">
                <div class="card-header">
                    <h3>
                        <b>
                            <?= lang('app.results') ?>:
                            <?php if (session('lang') != 'ar') : ?>
                                <?= $sc['name'] ?>
                                <?php else : ?><?= $sc['name_ar'] ?>
                            <?php endif ?>
                        </b>
                        <a data-action="collapse"><i class="ft-plus pull-right"></i></a>
                    </h3>
                </div>
                <div class="card-content collapse">
                    <div class="card-body text-center">
                        <?php foreach ($sch->course($sc['id']) as $key => $cl) : ?>
                            <?php if ($sch->checkResults($stu['id'], $cl['id'])) : ?>
                                <a href="<?= base_url('result/user/' . $stu['id'] . '/' . $cl['id']) ?>" class="btn btn-primary btn-block round" target="_blank">
                                    <i class="ft ft-eye"></i> | 
                                    <?php if (session('lang') != 'ar') : ?>
                                        <?= $cl['name'] ?>
                                    <?php else : ?>
                                        <?= $cl['name_ar'] ?>
                                    <?php endif ?>
                                </a>
                                <?php $ok = true ?>
                            <?php else : ?>
                                <span class="btn btn-secondary btn-block round">
                                    <?php if (session('lang') != 'ar') : ?>
                                        <?= $cl['name'] ?>
                                    <?php else : ?>
                                        <?= $cl['name_ar'] ?>
                                    <?php endif ?>
                                </span>
                                <?php $ok = false ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                    <div class="card-footer text-center">
                        <?php if ($ok) : ?>
                            <?php if (session('role') != 'admin') : ?>
                                <a href="<?= base_url('gpa/all/' . $stu['id']) ?>" target="_blank" class="btn btn-teal btn-lg btn-block round"><i class="ft ft-download"></i> | <?= lang('app.academicProgress') ?></a>
                            <?php else : ?>
                                <a href="<?= base_url('gpa/progress/' . $stu['id']) ?>" target="_blank" class="btn btn-teal btn-lg btn-block round"><i class="ft ft-download"></i> | <?= lang('app.academicProgress') ?></a>
                            <?php endif ?>
                        <?php else : ?>
                            <span class="btn btn-outline-teal btn-lg btn-block round"><?= lang('app.academicProgress') ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>