<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="content-body">
    <section class="row flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-10 box-shadow-2 p-0 mb-2">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-1">
                        <div class="card-title text-center">
                            <div>
                                <img src="<?= base_url('app-assets/images/logo/logo.png') ?>" alt="logo" height="180px">
                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span><?= lang('app.register') ?></span>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php $validation = \Config\Services::validation() ?>
                            <?= form_open('student/create') ?>
                            <div class="row">
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.fname') ?> <span class="danger">*</span> :</label>
                                    <?php if ($validation->getError('name')) : ?>
                                        <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                                    <?php endif ?>
                                    <input type="text" class="form-control" name="name" placeholder="<?= lang('app.fname') ?>">
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.mname') ?> <span class="danger">*</span> :</label>
                                    <?php if ($validation->getError('mname')) : ?>
                                        <span class="badge badge-danger"> <?= $errors = $validation->getError('mname') ?></span>
                                    <?php endif ?>
                                    <input type="text" class="form-control" name="mname" placeholder="<?= lang('app.mname') ?>">
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.lname') ?> <span class="danger">*</span> :</label>
                                    <?php if ($validation->getError('lname')) : ?>
                                        <span class="badge badge-danger"> <?= $errors = $validation->getError('lname') ?></span>
                                    <?php endif ?>
                                    <input type="text" class="form-control" name="lname" placeholder="<?= lang('app.lname') ?>">
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.fname_ar') ?> <span class="danger">*</span> :</label>
                                    <?php if ($validation->getError('name_ar')) : ?>
                                        <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                                    <?php endif ?>
                                    <input type="text" class="form-control" name="name_ar" placeholder="<?= lang('app.fname_ar') ?>">
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.mname_ar') ?> <span class="danger">*</span> :</label>
                                    <?php if ($validation->getError('mname_ar')) : ?>
                                        <span class="badge badge-danger"> <?= $errors = $validation->getError('mname_ar') ?></span>
                                    <?php endif ?>
                                    <input type="text" class="form-control" name="mname_ar" placeholder="<?= lang('app.mname_ar') ?>">
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.lname_ar') ?> <span class="danger">*</span> :</label>
                                    <?php if ($validation->getError('lname_ar')) : ?>
                                        <span class="badge badge-danger"> <?= $errors = $validation->getError('lname_ar') ?></span>
                                    <?php endif ?>
                                    <input type="text" class="form-control" name="lname_ar" placeholder="<?= lang('app.lname_ar') ?>">
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.dob') ?><span class="danger">*</span></label>
                                    <?php if ($validation->getError('dob')) : ?>
                                        <span class="badge badge-danger"> <?= $errors = $validation->getError('dob') ?></span>
                                    <?php endif ?>
                                    <input type="date" class="form-control" name="dob" placeholder="<?= lang('app.dob') ?>">
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.course') ?></label>
                                    <select name="level" class="custom-select">
                                        <option selected disabled><?= lang('app.choose') ?></option>
                                        <?php foreach ($course as $dt) : ?>
                                            <option value="<?= $dt['id'] ?>">
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $crs->school($dt['school_id'])['name'] ?> - <?= $dt['name'] ?>
                                                <?php else : ?>
                                                    <?= $dt['name_ar'] ?>
                                                <?php endif ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.sex') ?></label>
                                    <?php if ($validation->getError('sex')) : ?>
                                        <span class="badge badge-danger"> <?= $errors = $validation->getError('sex') ?></span>
                                    <?php endif ?>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="radio" name="sex" value="M" checked> <?= lang('app.male') ?>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" name="sex" value="F"> <?= lang('app.female') ?>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="col-md-4 mb-1">
                                    <label><?= lang('app.phone') ?></label>
                                    <input type="number" class="form-control" name="phone" placeholder="255683123456">
                                </fieldset>
                                <fieldset class="col-md-8 mb-1">
                                    <label><?= lang('app.email') ?></label>
                                    <input type="email" class="form-control" name="email" placeholder="example@mail.com">
                                </fieldset>
                            </div>
                            <button type="submit" class="btn btn-info btn-lg btn-block"><?= lang('app.submit') ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>