<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="zoom: 1;">
                    <div class="card-header bg-hexagons border-top-3 border-bottom-black border-top-danger">
                        <div class="card-content collapse show bg-hexagons">
                            <div class="card-body pt-0" style="justify-content: center; display:flex">
                                <h4>
                                    <span class="h1 mb-1"><b><?= APP_NAME ?></b></span><br>
                                    <?= lang('app.academics') ?>: <b><?= $sch['name'] ?></b><br>
                                    <?= lang('app.className') ?>: <b><?= $class['name'] ?></b><br>
                                    <?= lang('app.subName') ?>: <b><?= $sub['name'] ?></b><br>
                                    <?= form_open('result/year/') ?>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><?= lang('app.acYear') ?></span>
                                        </div>
                                        <input type="hidden" name="class" value="<?= $class['id'] ?>">
                                        <input type="hidden" name="sub" value="<?= $sub['id'] ?>">
                                        <input type="hidden" name="school" value="<?= $sch['id'] ?>">
                                        <select name="year" class="custom-select" onchange="this.form.submit()">
                                            <?php foreach ($yr as $dt) : ?>
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
        <?php if (count($search) <= 0) : ?>
            <div class="card text-center">
                <div class="card-header">
                    <h3><b><?= lang('app.nothingFound') ?></b></h3>
                </div>
            </div>
        <?php else : ?>
            <div class="card">
                <div class="card-header">
                    <h3><b><?= lang('app.results') ?> - <?= lang('app.males') ?></b></h3>
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
                                <?php foreach ($search as $key => $data) : ?>
                                    <?php if ($data['sex'] == 'M') : ?>
                                        <tr>
                                            <td class="text-truncate">
                                                <a href="<?= base_url('result/show/' . $data['id'] . '/' . $class['id']) ?>" target="_blank" class="btn btn-sm round btn-outline-black <?= session('role') != 'admin' ? 'disabled' : '' ?>"><?= $data['malaf'] ?> </a>
                                            </td>
                                            <td><?= ($data['nameArabic'] != null ? $data['nameArabic'] : $data['name'] . ' ' . $data['lname']) ?></td>
                                            <td style="width: 1%;"><?= $data['course'] ?></td>
                                            <td style="width: 1%;"><?= $data['final'] ?></td>
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
                                <?php foreach ($search as $key => $data) : ?>
                                    <?php if ($data['sex'] == 'F') : ?>
                                        <tr>
                                            <td class="text-truncate">
                                                <a href="<?= base_url('result/show/' . $data['id'] . '/' . $class['id']) ?>" target="_blank" class="btn btn-sm round btn-outline-black <?= session('role') != 'admin' ? 'disabled' : '' ?>"><?= $data['malaf'] ?> </a>
                                            </td>
                                            <td><?= ($data['nameArabic'] != null ? $data['nameArabic'] : $data['name'] . ' ' . $data['lname']) ?></td>
                                            <td style="width: 1%;"><?= $data['course'] ?></td>
                                            <td style="width: 1%;"><?= $data['final'] ?></td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>