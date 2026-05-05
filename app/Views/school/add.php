<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.addSchool') ?></b>
                    <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('school') ?>"><?= lang('app.back') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('school/create') ?>
                <div class="row mx-1">
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.name') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="<?= lang('app.name') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.name_ar') ?></b></label>
                        <?php if ($validation->getError('name_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name_ar" class="form-control" placeholder="<?= lang('app.name_ar') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-12">
                        <label for=""><b><?= lang('app.tchName') ?></b></label>
                        <?php if ($validation->getError('head_id')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('head_id') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <select class="custom-select" name="head_id">
                                <option selected disabled><?= lang('app.choose') ?></option>
                                <?php foreach ($tch as $dt) : ?>
                                    <?php if (session('lang') != 'ar') : ?>
                                        <?php $tch_nm = $dt['name'] . ' ' . $dt['mname'] . ' ' . $dt['lname'] ?>
                                    <?php else : ?>
                                        <?php $tch_nm = $dt['name_ar'] . ' ' . $dt['mname_ar'] . ' ' . $dt['lname_ar'] ?>
                                    <?php endif ?>
                                    <option value="<?= $dt['id'] ?>"><?= $tch_nm ?></option>
                                <?php endforeach ?>
                            </select>
                        </fieldset>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-2"><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>