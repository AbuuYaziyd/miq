<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php if (session('fn') == 'admin') : ?>
        <div id="recent-transactions" class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <?php if (session('lang') != 'ar') : ?>
                            <b><?= $sch['name'] ?></b>
                        <?php else : ?>
                            <b><?= $sch['name_ar'] ?></b>
                        <?php endif ?>
                        <a class="btn btn-primary box-shadow-1 round pull-right" href="<?= base_url('course/add/' . $sch['id']) ?>"><?= lang('app.addCourse') ?></a>
                    </h3>
                    <div class="heading-elements">
                    </div>
                </div>
                <div class="card-content">
                    <?php $validation = \Config\Services::validation() ?>
                    <?= form_open('school/update') ?>
                    <div class="row mx-1">
                        <div class="col-md-4">
                            <label for=""><b><?= lang('app.name') ?></b></label>
                            <?php if ($validation->getError('name')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                            <?php endif ?>
                            <fieldset class="form-group">
                                <input type="text" name="name" value="<?= $sch['name'] ?>" class="form-control" <?= session('role') != 'admin' ? 'readonly' : '' ?>>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <label for=""><b><?= lang('app.name_ar') ?></b></label>
                            <?php if ($validation->getError('name_ar')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                            <?php endif ?>
                            <fieldset class="form-group">
                                <input type="text" name="name_ar" value="<?= $sch['name_ar'] ?>" class="form-control" <?= session('role') != 'admin' ? 'readonly' : '' ?>>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <label for=""><b><?= lang('app.tchName') ?></b></label>
                            <?php if ($validation->getError('head_id')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('head_id') ?></span>
                            <?php endif ?>
                            <fieldset class="form-group">
                                <select class="custom-select" <?= session('role') != 'admin' ? 'disabled' : '' ?> name="head_id">
                                    <?php foreach ($tch as $key => $dt) : ?>
                                        <?php if (session('lang') != 'ar') : ?>
                                            <?php $tch_nm = $dt['name'] . ' ' . $dt['mname'] . ' ' . $dt['lname'] ?>
                                        <?php else : ?>
                                            <?php $tch_nm = $dt['name_ar'] . ' ' . $dt['mname_ar'] . ' ' . $dt['lname_ar'] ?>
                                        <?php endif ?>
                                        <option value="<?= $dt['id'] ?>" <?= $dt['id'] == $sch['head_id'] ? 'selected' : '' ?>><?= $tch_nm ?></option>
                                    <?php endforeach ?>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $sch['id'] ?>">
                    <div class="row mx-1">
                        <div class="col">
                            <?php if (session('role') == 'admin') : ?>
                                <button type="submit" class="btn btn-block btn-lg btn-primary mt-1 mb-2"><?= lang('app.edit') ?></button>
                            <?php endif ?>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
<div class="row">
    <?php foreach ($ac as $key => $dt) : ?>
        <div class="col-md-<?= count($ac) == 2 ? 6 : (count($ac) == 4 ? 6 : 4) ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4>
                        <?php if (session('lang') != 'ar') : ?>
                            <b><?= $dt['name'] ?></b>
                        <?php else : ?>
                            <b><?= $dt['name_ar'] ?></b>
                        <?php endif ?>
                        <a href="<?= base_url('course/show/' . $dt['id']) ?>" class="btn btn-sm btn-warning round float-right"><?= lang('app.open') ?></a></h4>
                    </div>
                    <li class="list-group-item">
                        <span class="btn btn-sm round btn-outline-danger float-right"><?= $c->stuCount($dt['id']) ?></span><?= lang('app.students') ?>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= base_url('subject/class/' . $dt['id']) ?>" class="btn btn-sm round btn-blue float-right"><?= $c->subCount($dt['id']) ?></a><?= lang('app.subjects') ?>
                    </li>
                    <li class="list-group-item">
                        <?php $tch = $c->teacher($dt['head_id']) ?>
                        <?php if (session('lang') != 'ar') : ?>
                            <?php $tch_nm = $tch['name'] . ' ' . $tch['mname'] . ' ' . $tch['lname'] ?>
                        <?php else : ?>
                            <?php $tch_nm = $tch['name_ar'] . ' ' . $tch['mname_ar'] . ' ' . $tch['lname_ar'] ?>
                        <?php endif ?>
                        <span class="btn btn-sm round btn<?= $dt['head_id'] != session('id') ? '-outline' : '' ?>-blue float-right"><?= $tch_nm ?></span><?= lang('app.tchName') ?>
                    </li>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>