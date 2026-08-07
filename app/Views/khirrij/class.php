<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<?php if ($new) : ?>
    <div class="row">
        <div id="recent-transactions" class="col-12">
            <form action="<?= base_url('class/addStd') ?>" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3><?= lang('app.addStudents') ?> - <b><?= $class['name'] ?></b> <button class="btn btn-outline-success box-shadow-1 round pull-right" type="submit" onclick="save();"><?= lang('app.add') ?></button></h3>
                        <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 2px;">#</th>
                                                <th><?= lang('app.malaf') ?></th>
                                                <th><?= lang('app.name') ?></th>
                                                <th><input type="checkbox" id="check"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($new as $key => $data) : ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $data['malaf'] ?></td>
                                                    <td><?= ($data['name_ar'] ?? $data['lname']) ?></td>
                                                    <td><input type="checkbox" name="stuId[]" value="<?= $data['id'] ?>"></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= $class['name'] ?></b> <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('class') ?>"><?= lang('app.back') ?></a></h3>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="recent-orders" class="table table-hover table-xl mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 10%;"><?= lang('app.malaf') ?></th>
                                        <th><?= lang('app.name') ?></th>
                                        <th>
                                            <?= lang('app.promote') ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stu as $key => $data) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $data['malaf'] ?></td>
                                            <td><?= ($data['name_ar'] ?? $data['name']) ?></td>
                                            <td><a href="#" class="btn btn-outline-warning round btn-sm"><?= lang('app.look') ?></a></td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td colspan="3"><b><?= lang('app.hgjk') ?></b></td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="btn-group mr-1 mb-1">
                                                        <button type="button" class="btn btn-outline-warning round btn-sm"><?= lang('app.promote') ?></button>
                                                        <button type="button" class="btn btn-warning dropdown-toggle btn-sm round" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 41px, 0px);">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#check').click(function(event) {
        var $that = $(this);
        $(':checkbox').each(function() {
            this.checked = $that.is(':checked');
        });
    });

    function save() {
        document.getElementById('form').submit();
    }
</script>
<?= $this->endSection() ?>