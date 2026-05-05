<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b><?= lang('app.addCourse') ?></b>
                    <?php if (session('role') == 'admin') : ?>
                        <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('school/show/' . $sc['id']) ?>"><?= lang('app.back') ?></a>
                    <?php endif ?>
                </h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('course/create') ?>
                <div class="row m-1">
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.className') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="<?= lang('app.className') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.className_ar') ?></b></label>
                        <?php if ($validation->getError('name_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name_ar" class="form-control" placeholder="<?= lang('app.className_ar') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.tchName') ?></b></label>
                        <?php if ($validation->getError('teacher_id')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('teacher_id') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <select class="custom-select" name="teacher_id">
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
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.school') ?></b></label>
                        <select class="custom-select" name="school_id">
                            <?php foreach ($sch as $key => $data) : ?>
                                <option value="<?= $data['id'] ?>" <?= $data['id'] == $sc['id'] ? 'selected' : '' ?>><?= $data['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary my-2"><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>