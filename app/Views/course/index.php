<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if(session('fn')=='admin') : ?>
<a href="<?= base_url('class/add/'.$sch['id']) ?>" class="btn btn-primary btn-lg btn-block mb-2"><?= lang('app.add') ?> <?= lang('app.class') ?></a>
<?php endif ?>
<div class="row">
    <?php foreach ($class as $key => $dt) : ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4><b><?= $dt['name'] ?></b><a href="<?= base_url('class/show/' . $dt['id']) ?>" class="btn btn-sm btn-warning round float-right"><?= lang('app.look') ?></a></h4>
                </div>
                <li class="list-group-item">
                    <span class="btn btn-sm round btn-outline-danger float-right"><?= $c->stuCount($dt['id']) ?></span><?= lang('app.students') ?>
                </li>
                <li class="list-group-item">
                    <a href="<?= base_url('subject/class/'.$dt['id']) ?>" class="btn btn-sm round btn-blue float-right"><?= $c->subCount($dt['id']) ?></a><?= lang('app.subjects') ?>
                </li>
                <li class="list-group-item">
                    <span class="btn btn-sm round btn<?= $dt['teacher_id']!=session('id')?'-outline':'' ?>-blue float-right"><?= $c->teacher($dt['id'])['name_ar'] ?></span><?= lang('app.teacher') ?>
                </li>
                <div class="card-body">
                    <span class="btn btn-sm round btn-outline-teal float-right"><?= $c->shift($dt['id'])['name'] ?></span><?= lang('app.shift') ?>
                    <?= lang('app.class') ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>