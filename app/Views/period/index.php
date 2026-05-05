<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php if (count($period) >= 1) : ?>
        <a href="<?=base_url('timetable')  ?>" class="btn btn-lg btn-block btn-primary m-1"><?= lang('app.timetable') ?></a>
    <?php endif ?>
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b><?= lang('app.periods') ?></b>
                    <a href="<?= base_url('period/add')  ?>" class=" btn btn-primary round pull-right"><?= lang('app.add') ?></a>
                </h3>
            </div>
            <?php if (count($period) >= 1) : ?>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.periodStart') ?></th>
                                    <th><?= lang('app.periodEnd') ?></th>
                                    <?php if (session('role') == 'admin') : ?>
                                        <th><?= lang('app.choose') ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($period as $key => $dt) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><b><?= $dt['start'] ?></b></td>
                                        <td><b><?= $dt['end'] ?></b></td>
                                        <?php if (session('role') == 'admin') : ?>
                                            <td><a href="<?= base_url('period/show/' . $dt['id']) ?>" class="btn btn-sm btn-outline-warning round"><?= lang('app.edit') ?></a> </td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>