<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="content-body">
    <div class="row">
        <div id="recent-sales" class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3><b><?= $title ?></b></h3>
                </div>
                <div class="card-content mt-1 m-2">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl dtTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.fullName') ?></th>
                                    <th><?= lang('app.contacts') ?></th>
                                    <th><?= lang('app.address') ?></th>
                                    <th><?= lang('app.age') ?></th>
                                    <th><?= lang('app.show') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $key => $dt) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= strtoupper($dt['fname']) ?> <?= strtoupper($dt['mname']) ?> <?= strtoupper($dt['lname']) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="tel:<?= $dt['phone'] ?>" class="btn btn-sm btn-outline-primary round" target="_blank"><i class="icon-screen-smartphone"></i></a>
                                                <a href="https://wa.me/<?= $dt['phone'] ?>" class="btn btn-sm btn-outline-success round" target="_blank"><i class="la la-whatsapp"></i></a>
                                                <a href="mailto:<?= $dt['email'] ?>" class="btn btn-sm btn-outline-purple round" target="_blank"><i class="icon-envelope"></i></a>
                                            </div>
                                        </td>
                                        <td class="text-truncate p-1"><?= strtoupper($dt['address']) ?></td>
                                        <td>
                                            <?php
                                            $date = new DateTime($dt['dob']);
                                            $now = new DateTime();
                                            $age = $now->diff($date);
                                            ?>
                                            <?= $age->y ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/show-user-register/' . $dt['id']) ?>" class="btn btn-sm btn-outline-warning round"><?= lang('app.show') ?></a>
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
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>