<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="card" style="zoom: 1;">
                    <div class="card-header bg-hexagons border-top-3 border-top-danger" style="justify-content: center; display:flex">
                        <div class="card-body pt-0">
                            <h4>
                                <span class="h1 danger"><b><?= env('APP_NAME') ?></b></span><br>
                                <?= lang('app.academics') ?>: <b><?= $school['name'] ?></b><br>
                                <?= lang('app.className') ?>: <b><?= $course['name'] ?></b><br>
                                <?= lang('app.subName') ?>: <b><?= $sub['name'] ?></b><br>
                                <?= lang('app.acYear') ?>: <b><?= $year['name'] ?></b>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <ul class="nav nav-pills nav-fill nav-topline justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" id="base-fasl1" data-toggle="tab" aria-controls="fasl1" href="#fasl1" aria-expanded="true"><?= lang('app.fasli1') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-fasl2" data-toggle="tab" aria-controls="fasl2" href="#fasl2" aria-expanded="false"><?= lang('app.fasli2') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-fasl" data-toggle="tab" aria-controls="fasl" href="#fasl" aria-expanded="false"><?= lang('app.acYear') ?></a>
                </li>
            </ul>
            <div class="tab-content pt-1 border-grey border-lighten-2 border-0-top">
                <div role="tabpanel" class="tab-pane active" id="fasl1" aria-expanded="true" aria-labelledby="base-fasl1">
                    <div class="card">
                        <?= form_open('result/update-course') ?>
                        <div class="card-header">
                            <h3><b><?= lang('app.enterResults') ?> - <?= lang('app.fasli1') ?> | <?= lang('app.males') ?></b>
                            </h3>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-hover table-md mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">
                                                <ul>
                                                    # - <?= lang('app.name') ?>
                                                </ul>
                                            </th>
                                            <th class="border-top-0"><?= lang('app.mark') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stuAll as $key => $dt) : ?>
                                            <?php $mark = $r->mark($class['id'], $dt['id'], $sub['id']) ?>
                                            <tr>
                                                <td class="text-truncate">
                                                    <ul>
                                                        <a href="<?= base_url('result/show/' . $dt['id'] . '/' . $class['id']) ?>" class="btn btn-sm round btn-outline-black" target="_blank">
                                                            <?= $dt['malaf'] ?>
                                                        </a><br>
                                                        <?= ($dt['name_ar'] != null ? $dt['name_ar'] : $dt['name'] . ' ' . $dt['lname']) ?>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate">
                                                    <?php if ($mark['course'] != 0) : ?>
                                                        <input type="text" name="course<?= $key ?>" class="form-control" value="<?= $mark['course'] ?>">
                                                    <?php else : ?>
                                                        <input type="text" name="course<?= $key ?>" class="form-control" placeholder="100%">
                                                    <?php endif ?>
                                                </td>
                                                <input type="hidden" name="id[]" value="<?= $mark['id'] ?>">
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><?= lang('app.send') ?></button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="fasl2" aria-labelledby="base-fasl2">
                    <div class="card">
                        <?= form_open('result/update-final') ?>
                        <div class="card-header">
                            <h3><b><?= lang('app.enterResults') ?> - <?= lang('app.fasli2') ?> | <?= lang('app.males') ?></b>
                            </h3>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-hover table-md mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">
                                                <ul>
                                                    # - <?= lang('app.name') ?>
                                                </ul>
                                            </th>
                                            <th class="border-top-0"><?= lang('app.mark') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stuAll as $key => $dt) : ?>
                                            <?php $mark = $r->mark($class['id'], $dt['id'], $sub['id']) ?>
                                            <tr>
                                                <td class="text-truncate">
                                                    <ul>
                                                        <a href="<?= base_url('result/show/' . $dt['id'] . '/' . $class['id']) ?>" class="btn btn-sm round btn-outline-black" target="_blank">
                                                            <?= $dt['malaf'] ?>
                                                        </a><br>
                                                        <?= ($dt['name_ar'] != null ? $dt['name_ar'] : $dt['name'] . ' ' . $dt['lname']) ?>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate">
                                                    <?php if ($mark['final'] != 0) : ?>
                                                        <input type="text" name="final<?= $key ?>" class="form-control" value="<?= $mark['final'] ?>">
                                                    <?php else : ?>
                                                        <input type="text" name="final<?= $key ?>" class="form-control" placeholder="100%">
                                                    <?php endif ?>
                                                </td>
                                                <input type="hidden" name="id[]" value="<?= $mark['id'] ?>">
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><?= lang('app.send') ?></button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="fasl" aria-labelledby="base-fasl">
                    <div class="card">
                        <div class="card-header">
                            <h3><b><?= lang('app.results') ?> - <?= lang('app.acYear') ?> | <?= lang('app.males') ?></b></h3>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-hover table-md mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">
                                                <ul>
                                                    # - <?= lang('app.name') ?>
                                                </ul>
                                            </th>
                                            <th class="border-top-0"><?= lang('app.mark') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stuAll as $key => $dt) : ?>
                                            <?php $mark = $r->mark($class['id'], $dt['id'], $sub['id']) ?>
                                            <tr>
                                                <td class="text-truncate">
                                                    <ul>
                                                        <a href="<?= base_url('result/show/' . $dt['id'] . '/' . $class['id']) ?>" class="btn btn-sm round btn-outline-black" target="_blank">
                                                            <?= $dt['malaf'] ?>
                                                        </a><br>
                                                        <?= ($dt['name_ar'] != null ? $dt['name_ar'] : $dt['name'] . ' ' . $dt['lname']) ?>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate">
                                                    <input type="text" disabled class="form-control" value="<?= $mark['final'] + $mark['course'] ?>">
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
    </div>
</div>
<?= $this->endSection() ?>