<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.grades') ?></b></h3>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0"><?= lang('app.gradeName') ?></th>
                                <th class="border-top-0"><?= lang('app.grade') ?></th>
                                <th class="border-top-0"><?= lang('app.from') ?></th>
                                <th class="border-top-0"><?= lang('app.to') ?></th>
                                <th class="border-top-0"><?= lang('app.gradeName_ar') ?></th>
                                <th class="border-top-0"><?= lang('app.grade_ar') ?></th>
                                <?php if (session('role') == 'admin') : ?>
                                    <th class="border-top-0"><?= lang('app.choose') ?></th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grade as $key => $dt) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $dt['name'] ?></td>
                                    <td><b><?= $dt['ramz'] ?></b></td>
                                    <td><b><?= $dt['bidaya'] ?></b></td>
                                    <td><b><?= $dt['nihaya'] ?></b></td>
                                    <td><b><?= $dt['ramz_ar'] ?></b></td>
                                    <td><?= $dt['name_ar'] ?></td>
                                    <?php if (session('role') == 'admin') : ?>
                                        <td><a href="<?= base_url('grade/show/' . $dt['id']) ?>" class="btn btn-sm btn-outline-warning round"><?= lang('app.edit') ?></a> </td>
                                    <?php endif ?>
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