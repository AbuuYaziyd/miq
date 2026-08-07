<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-2"><b><?= lang('app.students') ?></b>
                    <?php if (session('role') == 'admin') : ?>
                        <a class="btn btn-pink box-shadow-1 round pull-right" href="<?= base_url('student/new') ?>"><?= lang('app.addNewStudent') ?></a>
                    <?php endif ?>
                </h1>
            </div>
        </div>
    </div>
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-body">
                <?php foreach ($sch as $sc) : ?>
                    <?php if ($s->course($sc['id']) != null) : ?>
                        <h1>
                            <?php if (session('lang') != 'ar') : ?>
                                <b><?= $sc['name'] ?></b>
                            <?php else : ?>
                                <b><?= $sc['name_ar'] ?></b>
                            <?php endif ?>
                        </h1>
                        <hr>
                        <div class="row">
                            <?php foreach ($s->course($sc['id']) as $dt) : ?>
                                <div class="col-md-<?= count($s->course($sc['id'])) == 2 ? 6 : (count($s->course($sc['id'])) == 4 ? 6 : 4) ?> mb-1">
                                    <a href="<?= base_url('student/view/' . $dt['id']) ?>" class="btn btn-secondary btn-lg btn-block">
                                        <?php if (session('lang') != 'ar') : ?>
                                            <?= $dt['name'] ?>
                                        <?php else : ?>
                                            <?= $dt['name_ar'] ?>
                                        <?php endif ?>
                                    </a>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <hr>
                    <?php endif ?>
                <?php endforeach ?>
                <?php if (session('role') == 'admin') : ?>
                    <div class="row">
                        <div class="col-md-6 mt-1">
                            <a href="<?= base_url('khirrij') ?>" class="btn btn-warning btn-lg btn-block"><?= lang('app.graduates') ?></a>
                        </div>
                        <div class="col-md-6 mt-1">
                            <a href="<?= base_url('mafsul') ?>" class="btn btn-danger btn-lg btn-block"><?= lang('app.mafsuls') ?></a>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($stu as $st) : ?>
        <?php if (session('lang') != 'ar') : ?>
            <?php $name = $st['name'] . ' ' . $st['mname'] . ' ' . $st['lname'] ?>
        <?php else : ?>
            <?php $name = $st['name_ar'] . ' ' . $st['mname_ar'] . ' ' . $st['lname_ar'] ?>
        <?php endif ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4><b><?= $name ?></b></h4>
                    </div>
                    <li class="list-group-item">
                        <span class="btn btn-sm round btn-outline-danger float-right"><?= $st['username'] ?></span><?= lang('app.username') ?>
                    </li>
                    <div class="card-body">
                        <div class="btn-group mb-1 float-right">
                            <button type="button" class="btn btn-dark round btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= lang('app.choose') ?></button>
                            <div class="dropdown-menu">
                                <?php foreach ($class as $dt) : ?>
                                    <a class="dropdown-item" href="<?= base_url('student/assign/' . $st['id'] . '/' . $dt['id']) ?>">
                                        <?php if (session('lang') != 'ar') : ?>
                                            <?= $dt['name'] ?> - <?= $c->school($dt['school_id'])['name'] ?>
                                        <?php else : ?>
                                            <?= $dt['name_ar'] ?> - <?= $c->school($dt['school_id'])['name_ar'] ?>
                                        <?php endif ?>
                                    </a>
                                <?php endforeach ?>
                                <a class="dropdown-item" href="<?= base_url('student/change-class/' . $st['id'] . '/mafsul') ?>"><?= lang('app.mafsul') ?></a>
                            </div>
                        </div>
                        <?= lang('app.course') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>