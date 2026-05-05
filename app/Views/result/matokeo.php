<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php if ($marks != null) : ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2><b><?= $title ?></b></h2>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered ex">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.name') ?></th>
                                    <?php foreach ($masomo as $key => $data) : ?>
                                        <th><?= ($data['name'] )?></th>
                                    <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr></tr> -->
                                <?php foreach ($marks as $u => $dt) : ?>
                                        <tr>
                                            <td><?= $u+1 ?></td>
                                            <?php if ($dt['user'] != null) : ?> 
                                            <?php foreach ($dt['user'] as $d => $ok) : ?>
                                                <td><a href="<?= base_url('result/show/'.$ok['id'].'/'.$class_id.'/'.$year) ?>"><?= $ok['name_ar'] ?></a></td>
                                            <?php endforeach ?>
                                            <?php else :?>
                                                <td class="danger"><?= lang('app.notFound') ?></td>
                                            <?php endif ?>
                                            <?php foreach ($dt['marks'] as $d => $ok) : ?>
                                                <td class="<?= $ok['marks']>=60?'':'danger' ?>"><?= $ok['marks'] ?></td>
                                            <?php endforeach ?>
                                        </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>