<!-- <?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>
                    <b><?= $user['name_ar'] ?></b> - <?= lang('app.results') ?> - <?= $user['name'] ?>
                    <a class="btn btn-outline-warning box-shadow-1 round pull-right" href="<?= base_url('result/kashf/' . $_SESSION['id']) ?>"><?= lang('app.myRes') ?></a>
                </h2>
            </div>
            <?php if ($res) : ?>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dataex-res-constructor">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.subject') ?></th>
                                    <th><?= lang('app.courseWork') ?></th>
                                    <th><?= lang('app.final') ?></th>
                                    <th><?= lang('app.sum') ?></th>
                                    <th><?= lang('app.grade') ?></th>
                                    <th><?= lang('app.taqdir') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res as $key => $data) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $data['name'] ?></span>
                                        </td>
                                        <td><?= 0 ?></td>
                                        <td><?= $data['marks']  ?></td>
                                        <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $data['marks']  ?></span></td>
                                        <?php if ($data['marks'] >= 95) {
                                            $grade = 'ممتاز مرتفع';
                                            $point = 5;
                                            $alama = 'أ+';
                                        } elseif ($data['marks'] >= 90) {
                                            $grade = 'ممتاز';
                                            $point = 4.75;
                                            $alama = 'أ';
                                        } elseif ($data['marks'] >= 85) {
                                            $grade = 'جيد جدا مرتفع';
                                            $point = 4.5;
                                            $alama = 'ب+';
                                        } elseif ($data['marks'] >= 80) {
                                            $grade = 'جيد جدا';
                                            $point = 4;
                                            $alama = 'ب';
                                        } elseif ($data['marks'] >= 75) {
                                            $grade = 'جيد مرتفع';
                                            $point = 3.5;
                                            $alama = 'ج+';
                                        } elseif ($data['marks'] >= 70) {
                                            $grade = 'جيد';
                                            $point = 3;
                                            $alama = 'ج';
                                        } elseif ($data['marks'] >= 65) {
                                            $grade = 'مقبول مرتفع';
                                            $point = 2.5;
                                            $alama = 'د+';
                                        } elseif ($data['marks'] >= 60) {
                                            $grade = 'مقبول';
                                            $point = 2;
                                            $alama = 'د';
                                        } else {
                                            $grade = 'راســـــــــب';
                                            $point = 1;
                                            $alama = 'هـ';
                                        } ?>
                                        <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $alama ?></span>
                                        </td>
                                        <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $grade ?></span>
                                        </td>
                                    </tr>
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
<?= $this->include('layouts/table') ?> -->