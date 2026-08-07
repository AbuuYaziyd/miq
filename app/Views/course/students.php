<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b><?= lang('app.kashf') ?> - <?= session('lang') != 'ar' ? $course['name'] : $course['name_ar'] ?></b>
                </h3>
            </div>
            <?php if ($std) : ?>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.name') ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($std as $key => $data) : ?>
                                    <tr>
                                        <td style="width: 2px;"><a href="<?= base_url('students/info/' . $data['id']) ?>"><?= $data['username'] ?></a></td>
                                        <td style="width: 30%;"><?= $data['name_ar'] ?> <?= $data['mname_ar'] ?> <?= $data['lname_ar'] ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
<?= $this->include('layouts/table') ?>