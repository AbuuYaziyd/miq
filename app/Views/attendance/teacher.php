<!-- <?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($class as $dt) : ?>
        <div class="col-md-4 <?= $dt['teacher_id'] != session('id') ? 'd-none' : '' ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4><b><?= $dt['name'] ?></b><a href="<?= base_url('attendance/view/' . $dt['id']) ?>" class="btn btn-sm btn-purple round float-right"><?= lang('app.attendance') ?></a></h4>
                    </div>
                    <li class="list-group-item">
                        <span class="btn btn-sm round btn-outline-danger float-right"><?= $c->stuCount($dt['id']) ?></span><?= lang('app.students') ?>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= base_url('attendance/show/' . $dt['id'] . '/m') ?>" class="btn btn-sm round btn-blue float-right  <?= ($c->stuCount($dt['id']) != null ? '' : 'disabled') ?>"><?= lang('app.attendance') ?></a><?= lang('app.male') ?>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= base_url('attendance/show/' . $dt['id'] . '/f') ?>" class="btn btn-sm round btn-pink float-right  <?= ($c->stuCount($dt['id']) != null ? '' : 'disabled') ?>"><?= lang('app.attendance') ?></a><?= lang('app.female') ?>
                    </li>
                    <div class="card-body">
                        <span class="btn btn-sm round btn<?= $dt['teacher_id'] != session('id') ? '-outline' : '' ?>-teal float-right"><?= $c->teacher($dt['id'])['name_ar'] ?></span><?= lang('app.teacher') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?> -->