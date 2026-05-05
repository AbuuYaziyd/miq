<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $muadala = 0;
$masomo = 0;
$points = 0 ?>
<?php for ($i = 0; $i < 4; $i++) : ?>
    <div class="row">
        <div class="col-12">
            <?php if ($res[$i]['res'] != 0) : ?>
                <div class="card">
                    <div class="card-header">
                        <h2><?= lang('app.' . ($_SESSION['role'] == 'admin' ? 'results' : 'myRes') . '') ?> - <b><?= $user['nameArabic'] ?> - <?= $res[$i]['class']['name'] ?></b>
                            <a class="btn btn-outline-success box-shadow-1 round pull-right" href="<?= base_url('result/kashf/print/' . $user['id'] . '/' . $res[$i]['class']['id']) ?>" target="_blank" rel="noopener noreferrer"><?= lang('app.print') ?></a>
                        </h2>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered dataex-res-constructor">
                                <thead>
                                    <tr>
                                        <th colspan="6" style="text-align: center;">
                                            <?= lang('app.' . ($_SESSION['role'] == 'admin' ? 'results' : 'myRes') . '') ?> <?= $res[$i]['class']['name'] ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th><?= lang('app.subject') ?></th>
                                        <th><?= lang('app.final') ?></th>
                                        <th><?= lang('app.points') ?></th>
                                        <th><?= lang('app.grade') ?></th>
                                        <th><?= lang('app.taqdir') ?></th>
                                    </tr>
                                </thead>
                                <tbody><?php $point = 0;
                                        $total = 0 ?>
                                    <?php foreach ($res[$i]['res'] as $key => $data) : ?>
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
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $data['name'] ?></span>
                                            </td>
                                            <td>
                                                <?php if ($data['year'] == "2021-02") :?>
                                                    <a href="<?= base_url('result/delet/'.$data['resId']) ?>"><?= $data['marks']  ?></a>
                                                <?php else : ?>
                                                    <?= $data['marks'] ?>
                                                <?php endif ?>
                                            </td>
                                            <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $point ?></span>
                                            </td>
                                            <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $alama ?></span>
                                            </td>
                                            <td><span <?= ($data['marks'] < 60 ? 'class="badge badge-danger"' : '') ?>><?= $grade ?></span>
                                            </td>
                                        </tr>
                                        <?php $total = $total + $data['marks'] ?>
                                        <?php $points += $point ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table><br>
                            <table class="table table-striped table-bordered" style="text-align: center;">
                                <thead>
                                    <th><?= lang('app.purpose') ?></th>
                                    <th><?= lang('app.subject') ?></th>
                                    <th><?= lang('app.muadalaHuu') ?></th>
                                    <th><?= lang('app.masarMuadala') ?></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><?= lang('app.fasliy') ?></th>
                                        <td><?= $sub[$i] ?></td>
                                        <td><?= $masar = round((($total / (($key + 1) * 100)) * 5), 2) ?></td>
                                        <?php if ($masar >= 4.75) {
                                            $color = '#D79334';
                                            $grade = 'التمييز';
                                        } elseif ($masar >= 3.75) {
                                            $color = '#228B22';
                                            $grade = 'الاجتهاد';
                                        } elseif ($masar >= 2.75) {
                                            $color = '#0096FF';
                                            $grade = 'الإصرار';
                                        } else {
                                            $color = 'red';
                                            $grade = 'التعثر';
                                        } ?>
                                        <td><b><span style="color:<?= $color ?>"><?= $grade ?></span></b></td>
                                    </tr>
                                    <tr>
                                        <?php $muadala += $masar ?>
                                        <?php $masomo += $sub[$i] ?>
                                        <th><?= lang('app.tarakum') ?></th>
                                        <td> <?= $masomo ?></td>
                                        <td><?= $mudl = round(($muadala / ($i + 1)), 2) ?></td>
                                        <?php if ($mudl >= 4.75) {
                                            $color = '#D79334';
                                            $grade = 'التمييز';
                                        } elseif ($mudl >= 3.75) {
                                            $color = '#228B22';
                                            $grade = 'الاجتهاد';
                                        } elseif ($mudl >= 2.75) {
                                            $color = '#0096FF';
                                            $grade = 'الإصرار';
                                        } else {
                                            $color = 'red';
                                            $grade = 'التعثر';
                                        } ?>
                                        <td><b><span style="color:<?= $color ?>"><?= $grade ?></span></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endfor ?>
<!-- <a href="<?= base_url('result/kashf/print/' . $user['id']) ?>" class="btn btn-outline-amber btn-print btn-lg btn-block mb-1" target="_blank" rel="noopener noreferrer"><?= lang('app.print') ?></a> -->
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>