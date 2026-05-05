<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="zoom: 1;">
                    <div class="card-header bg-hexagons border-top-3 border-bottom-black border-top-danger">
                        <div class="card-content collapse show bg-hexagons">
                            <div class="card-body pt-0" style=" display:flex">
                                <h4>
                                    <span class="h1 mb-1"><b><?= env('APP_NAME') ?></b></span><br>
                                    <?= lang('app.academics') ?>: <b><?= $sch['name'] ?></b><br>
                                    <?= lang('app.className') ?>: <b><?= $class['name'] ?></b><br>
                                    <?= lang('app.subName') ?>: <b><?= $sub['name'] ?></b><br>
                                    <?= form_open('result/year') ?>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><?= lang('app.acYear') ?></span>
                                        </div>
                                        <input type="hidden" name="class" value="<?= $class['id'] ?>">
                                        <input type="hidden" name="sub" value="<?= $sub['id'] ?>">
                                        <input type="hidden" name="school" value="<?= $sch['id'] ?>">
                                        <select name="year" class="custom-select" onchange="this.form.submit()">
                                            <?php foreach ($years as $dt) : ?>
                                                <option value="<?= $dt['id'] ?>" <?= $year['id'] == $dt['id'] ? 'selected' : '' ?>><?= $dt['name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    </form>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (count($search) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h3><b><?= lang('app.results') ?> - <?= lang('app.males') ?></b></h3>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="" class="table table-hover table-md mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.name') ?></th>
                                    <th><?= lang('app.fasli1') ?></th>
                                    <th><?= lang('app.fasli2') ?></th>
                                    <th><?= lang('app.total') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($search as $key => $dt) : ?>
                                    <?php $std = $res->stu($dt['student_id']) ?>
                                    <?php if ($std['sex'] == 'M') : ?>
                                        <tr>
                                            <td class="text-truncate">
                                                <a href="<?= base_url('result/show/' . $std['id'] . '/' . $class['id']) ?>" target="_blank" class="btn btn-sm round btn-outline-black <?= session('role') != 'admin' ? 'disabled' : '' ?>"><?= $std['malaf'] ?> </a>
                                            </td>
                                            <td><?= ($std['name_ar'] != null ? $std['name_ar'] : $std['name'] . ' ' . $std['lname']) ?></td>
                                            <td style="width: 1%;"><?= $dt['course'] ?? 0 ?></td>
                                            <td style="width: 1%;"><?= $dt['final'] ?? 0 ?></td>
                                            <td style="width: 1%;"><?= ($dt['final'] ?? 0) + ($dt['course'] ?? 0) ?></td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3><b><?= lang('app.results') ?> - <?= lang('app.females') ?></b></h3>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="" class="table table-hover table-md mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0"><?= lang('app.name') ?></th>
                                    <th class="border-top-0"><?= lang('app.course') ?></th>
                                    <th class="border-top-0"><?= lang('app.final') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($search as $key => $dt) : ?>
                                    <?php $std = $res->stu($dt['student_id']) ?>
                                    <?php if ($std['sex'] == 'F') : ?>
                                        <tr>
                                            <td class="text-truncate">
                                                <a href="<?= base_url('result/show/' . $std['id'] . '/' . $class['id']) ?>" target="_blank" class="btn btn-sm round btn-outline-black <?= session('role') != 'admin' ? 'disabled' : '' ?>"><?= $std['malaf'] ?> </a>
                                            </td>
                                            <td><?= ($std['name_ar'] != null ? $std['name_ar'] : $std['name'] . ' ' . $std['lname']) ?></td>
                                            <td style="width: 1%;"><?= $dt['course'] ?? 0 ?></td>
                                            <td style="width: 1%;"><?= $dt['final'] ?? 0 ?></td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="card text-center">
                <div class="card-header">
                    <h3><b><?= lang('app.nothingFound') ?></b></h3>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>