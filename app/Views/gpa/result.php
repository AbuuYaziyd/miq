<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><b><?= lang('app.results') ?></b></h2>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered attendance">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang('app.stuName') ?></th>
                                <?php foreach ($sub as $sb) : ?>
                                    <th><?= $sb['name'] ?></th>
                                <?php endforeach ?>
                                <th><?= lang('app.sum') ?></th>
                                <th><?= lang('app.points') ?></th>
                                <th><?= lang('app.muadalaHuu') ?></th>
                                <th><?= lang('app.look') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($std as $key => $dt) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= ($pr->user($dt[0]['stdId'])['name_ar'] ? $pr->user($dt[0]['stdId'])['name_ar'] : $pr->user($dt[0]['stdId'])['name'] . ' ' . $pr->user($dt[0]['stdId'])['lname']) ?></td>
                                    <?php foreach ($dt as $sb => $s) : ?>
                                        <td><?= $pr->mark($s['resId']) ?></td>
                                    <?php endforeach ?>
                                    <td><?= $pr->sum($dt[0]['stdId'], $dt[0]['class_id']) ?></td>
                                    <td><?= ((($pr->sum($dt[0]['stdId'], $dt[0]['class_id'])) / ((count($sub)) * 100)) * 5) ?></td>
                                    <td><?= $pr->gpa($dt[0]['stdId'], $dt[0]['class_id']) ?></td>
                                    <td><a href="<?= base_url('result/show/' . $pr->user($dt[0]['stdId'])['id'].'/'. $dt[0]['class_id']) ?>" class="btn btn-sm btn-outline-cyan round" target="_blank"><?= lang('app.look') ?></a></td>
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
<?= $this->include('layouts/table') ?>