<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><b><?= $title ?></b></h2>
            </div>
            <?php if ($mafsul) : ?>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dataex-res-constructor">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.name') ?></th>
                                    <th><?= lang('app.phone') ?></th>
                                    <th><?= lang('app.email') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mafsul as $key => $dt) : ?>
                                    <tr>
                                        <?php $user = $fasl->user($dt['student_id']) ?>
                                        <td><?= $key + 1 ?></td>
                                        <td><a href="<?= base_url('mafsul/show/' . $dt['id']) ?>"><?= $user['username'] ?></a></td>
                                        <td><?= ($user['name_ar'] ?? $user['name'] . ' ' . $user['lname']) ?></td>
                                        <td><a href="tel:+255<?= $user['phone'] ?>" class="badge badge-secondary">0<?= $user['phone'] ?></a></td>
                                        <td><a href="mailto:<?= $user['email'] ?>" class="badge bagde-info"><?= $user['email'] ?? lang('app.notFound') ?></a></td>
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
<?= $this->include('layouts/table') ?>
<?= $this->endsection() ?>