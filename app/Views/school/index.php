<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<?php if (session('fn') == 'admin') : ?>
    <a href="<?= base_url('school/add') ?>" class="btn btn-primary btn-lg btn-block mb-2"><?= lang('app.addSchool') ?></a>
<?php endif ?>
<div class="row">
    <?php foreach ($school as $key => $dt) : ?>
        <div class="col-md-<?= count($school) == 3 ? 4 : 6 ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4><b><?= session('lang') != 'ar' ? $dt['name'] : $dt['name_ar'] ?></b><a href="<?= base_url('school/show/' . $dt['id']) ?>" class="btn btn-sm btn-warning round float-right"><?= lang('app.open') ?></a></h4>
                    </div>
                    <li class="list-group-item">
                        <a href="<?= base_url('course/' . $dt['id']) ?>" class="btn btn-sm round btn<?= $c->classCount($dt['id']) != null ? '' : '-outline' ?>-danger float-right"><?= $c->classCount($dt['id']) ?></a><?= lang('app.courses') ?>
                    </li>
                    <div class="card-body">
                        <?php $tch = $c->teacher($dt['head_id']) ?>
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