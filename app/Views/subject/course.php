<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<?php if (session('role') == 'admin') : ?>
    <a href="<?= base_url('subject/add/' . $course['id']) ?>" class="btn btn-lg btn-block btn-primary mb-2">
        <?= lang('app.add') ?> |
        <?= lang('app.subject') ?>
        <?php if (session('lang') != 'ar') : ?>
            (<?= $course['name'] ?> -
            <?= $sch->school($course['school_id'])['name'] ?>)
        <?php else : ?>
            (<?= $course['name_ar'] ?> -
            <?= $sch->school($course['school_id'])['name_ar'] ?>)
        <?php endif ?>
    </a>
<?php endif ?>
<div class="row">
    <?php foreach ($sub as $dt) : ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4><b>
                                <?php if (session('lang') != 'ar') : ?>
                                    <?= $dt['name'] ?>
                                <?php else : ?>
                                    <?= $dt['name_ar'] ?>
                                    <?php endif ?>
                                </b><a href="<?= base_url('subject/show/' . $dt['id']) ?>" class="btn btn-sm btn-warning round float-right"><?= lang('app.open') ?></a></h4>
                    </div>
                    <li class="list-group-item">
                        <span class="btn btn-sm round btn-outline-pink float-right"><?= $dt['ramz'] ?? lang('app.notFound') ?></span><?= lang('app.ramz') ?>
                    </li>
                    <li class="list-group-item">
                        <span class="btn btn-sm round btn-outline-danger float-right">
                            <?php if (session('lang') != 'ar') : ?>
                                <?= $s->course($dt['course_id'])['name'] ?>
                            <?php else : ?>
                                <?= $s->course($dt['course_id'])['name_ar'] ?>
                            <?php endif ?>
                        </span>
                        <?= lang('app.course') ?>
                    </li>
                    <div class="card-body">
                        <?php $tch = $s->teacher($dt['head_id']) ?>
                        <?php if (session('lang') != 'ar') : ?>
                            <?php $tch_nm = $tch['name'] . ' ' . $tch['mname'] . ' ' . $tch['lname'] ?>
                        <?php else : ?>
                            <?php $tch_nm = $tch['name_ar'] . ' ' . $tch['mname_ar'] . ' ' . $tch['lname_ar'] ?>
                        <?php endif ?>
                        <span class="btn btn-sm round btn<?= $dt['head_id'] != session('id') ? '-outline' : '' ?>-blue float-right"><?= $tch_nm ?></span><?= lang('app.tchName') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>