<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= $title ?></b>
                    <div class="form-group float-right">
                        <?= form_open('web/mauqii') ?>
                        <form action="/submit-path" method="POST">
                            <label class="switch">
                                <input type="checkbox" name="mauqii" id="switcherySize" class="switchery" data-size="lg" <?= $mauqii['link'] ?> onchange="this.form.submit()">
                                <input type="hidden" name="id" value="<?= $mauqii['id'] ?>">
                            </label>
                        </form>
                    </div>
                </h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('teacher/create') ?>
                <div class="row mx-1">
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.name') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="omar">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.mname') ?></b></label>
                        <?php if ($validation->getError('mname')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('mname') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="mname" class="form-control" placeholder="muhammad">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.lname') ?></b></label>
                        <?php if ($validation->getError('lname')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('lname') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="lname" class="form-control" placeholder="salim">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.name_ar') ?></b></label>
                        <?php if ($validation->getError('name_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name_ar" class="form-control" placeholder="عمر">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.mname_ar') ?></b></label>
                        <?php if ($validation->getError('mname_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('mname_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="mname_ar" class="form-control" placeholder="محمد">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.lname_ar') ?></b></label>
                        <?php if ($validation->getError('lname_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('lname_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="lname_ar" class="form-control" placeholder="سالم">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.email') ?></b></label>
                        <?php if ($validation->getError('email')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('email') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="example@mail.com">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.academicLevel') ?></b></label>
                        <?php if ($validation->getError('level')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('level') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <select class="custom-select" name="level">
                                <option selected disabled><?= lang('app.choose') ?></option>
                                <option value="mutawassitwa"><?= lang('app.mutawassitwa') ?></option>
                                <option value="thanawi"><?= lang('app.thanawi') ?></option>
                                <option value="degree"><?= lang('app.degree') ?></option>
                                <option value="masters"><?= lang('app.masters') ?></option>
                                <option value="phD"><?= lang('app.phD') ?></option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.dob') ?></b></label>
                        <?php if ($validation->getError('dob')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('dob') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="date" name="dob" class="form-control" value="<?= date('Y-m-d') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.phone') ?></b></label>
                        <?php if ($validation->getError('phone')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('phone') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <?php if (session('lang') != 'ar') : ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+</span>
                                    </div>
                                    <input type="text" class="form-control" name="phone" placeholder="255683123456">
                                </div>
                            <?php else : ?>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="phone" placeholder="255683123456">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">+</span>
                                    </div>
                                </div>
                            <?php endif ?>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.sex') ?></b></label>
                        <?php if ($validation->getError('level')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('level') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <input type="radio" name="sex" value="M" checked> <?= lang('app.male') ?>
                                </div>
                                <div class="col-6">
                                    <input type="radio" name="sex" value="F"> <?= lang('app.female') ?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-2"><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('web/carousel') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="teal"><?= lang('app.carousel') ?></h3>
                            </div>
                            <div>
                                <i class="la la-globe teal spinner font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-teal" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('web/about') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="purple"><?= lang('app.about') ?></h3>
                            </div>
                            <div>
                                <i class="icon-notebook purple font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('web/admission') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="black"><?= lang('app.admission') ?></h3>
                            </div>
                            <div>
                                <i class="icon-note black font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('announce') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger"><?= lang('app.announcements') ?></h3>
                            </div>
                            <div>
                                <i class="la la-bullhorn danger font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('blog') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info"><?= lang('app.blogs') ?></h3>
                            </div>
                            <div>
                                <i class="ft ft-cast info font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('web/contact') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="pink"><?= lang('app.contacts') ?></h3>
                            </div>
                            <div>
                                <i class="icon-screen-smartphone pink font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-pink" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<?= $this->endSection() ?>