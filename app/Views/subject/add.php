<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.subject') ?></b></h3>
            </div>
            <hr>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('subject/create') ?>
                <div class="row mx-1">
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.subjectName') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="<?= lang('app.subjectName') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.subjectName_ar') ?></b></label>
                        <?php if ($validation->getError('name_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name_ar" class="form-control" placeholder="<?= lang('app.subjectName_ar') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.ramz') ?></b></label>
                        <?php if ($validation->getError('ramz')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('ramz') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="ramz" class="form-control" placeholder="<?= lang('app.ramz') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.tchName') ?></b></label>
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
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.course') ?></b></label>
                        <fieldset class="form-group">
                            <?php if (session('lang') != 'ar') {
                                $nm = $course['name'] . ' - ' . $sch['name'];
                            } else {
                                $nm = $course['name_ar'] . ' - ' . $sch['name_ar'];
                            } ?>
                            <input type="text" class="form-control" value="<?= $nm ?>" readonly>
                        </fieldset>
                    </div>
                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-2"><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($subjects as $dt) : ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4><b><?= $dt['name'] ?></b><a href="<?= base_url('subject/put/' . $dt['id'] . '/' . $course['id']) ?>" class="btn btn-sm btn-teal round float-right"><?= lang('app.add') ?></a></h4>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>