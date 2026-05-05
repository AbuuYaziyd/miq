<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card" style="zoom: 1;">
                    <div class="card-header bg-hexagons border-top-3 border-top-danger">
                        <div style="justify-content: center; display:flex">
                            <span class="h1 danger"><b><?= env('APP_NAME') ?></b></span>
                        </div>
                    </div>
                    <div class="card-content collapse show bg-hexagons">
                        <div class="card-body pt-0" style="justify-content: center; display:flex">
                            <h4><?= lang('app.academics') ?>: <b><?= $sch['name'] ?></b><br>
                                <?= lang('app.className') ?>: <b><?= $class['name'] ?></b><br>
                                <?= lang('app.subName') ?>: <b><?= $sub['name'] ?></b><br>
                                <?= lang('app.acYear') ?>: <b><?= $year['name'] ?></b>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.results') ?> - <?= lang('app.males') ?></b></h3>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="" class="table table-hover table-md mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0"><?= lang('app.name') ?></th>
                                <th class="border-top-0"><?= lang('app.course') ?></th>
                                <th class="border-top-0"><?= lang('app.final') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stuM as $key => $dt) : ?>
                                <?php $mark = $r->mark($class['id'], $dt['id'], $year['id'], $sub['id']) ?>
                                <tr>
                                    <td class="text-truncate">
                                        <a href="<?= base_url('result/show/' . $dt['id'] . '/' . $class['id']) ?>" target="_blank" class="btn btn-sm round btn-outline-black <?= session('role') != 'admin' ? 'disabled' : '' ?>"><?= $dt['malaf'] ?> </a>
                                    </td>
                                    <td>
                                        <?= ($dt['name_ar'] != null ? $dt['name_ar'] : $dt['name'] . ' ' . $dt['lname']) ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('result/course/' . $mark['id']) ?>" class="btn btn-outline-primary btn-sm round edit"><?= $mark['course'] ?></a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('result/final/' . $mark['id']) ?>" class="btn btn-outline-success btn-sm round edit"><?= $mark['final'] ?></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.results') ?> - <?= lang('app.females') ?></b></h3>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="" class="table table-hover table-md mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0"><?= lang('app.name') ?></th>
                                <th class="border-top-0"><?= lang('app.course') ?></th>
                                <th class="border-top-0"><?= lang('app.final') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stuF as $key => $dt) : ?>
                                <?php $mark = $r->mark($class['id'], $dt['id'], $year['id'], $sub['id']) ?>
                                <tr>
                                    <td class="text-truncate">
                                        <a href="<?= base_url('result/show/' . $dt['id'] . '/' . $class['id']) ?>" target="_blank" class="btn btn-sm round btn-outline-black <?= session('role') != 'admin' ? 'disabled' : '' ?>"><?= $dt['malaf'] ?> </a>
                                    </td>
                                    <td>
                                        <?= ($dt['name_ar'] != null ? $dt['name_ar'] : $dt['name'] . ' ' . $dt['lname']) ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('result/course/' . $mark['id']) ?>" class="btn btn-outline-primary btn-sm round edit"><?= $mark['course'] ?></a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('result/final/' . $mark['id']) ?>" class="btn btn-outline-success btn-sm round edit"><?= $mark['final'] ?></a>
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
<?= $this->endSection() ?>