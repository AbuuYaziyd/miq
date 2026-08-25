<?php

use App\Models\Setting;

$set = new Setting();

$logo = $set->where('name', 'logo')->first();
?>
<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="content-body">
    <section class="row flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0 mb-2">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <div>
                                <a href="<?= base_url() ?>"><img src="<?= base_url($logo['link']) ?>" alt="logo" height="180px"></a>
                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span><?= lang('app.recoverpassword') ?></span>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php $validation = \Config\Services::validation(); ?>
                            <?= form_open('password') ?>
                            <label class="text-bold-600"><?= lang('app.username') ?></label>
                            <?php if ($validation->getError('identity')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('identity') ?></span>
                            <?php endif ?>
                            <fieldset class="form-group position-relative has-icon-left mb-1">
                                <input type="text" class="form-control" name="identity" placeholder="<?= lang('app.username') ?>">
                                <div class="form-control-position">
                                    <i class="la la-user"></i>
                                </div>
                            </fieldset>
                            <label class="text-bold-600"><?= lang('app.lname') ?></label>
                            <?php if ($validation->getError('lname')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('lname') ?></span>
                            <?php endif ?>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" class="form-control" name="lname" placeholder="<?= lang('app.lname') ?>">
                                <div class="form-control-position">
                                    <i class="la la-credit-card"></i>
                                </div>
                            </fieldset>
                            <label class="text-bold-600"><?= lang('app.phone') ?></label>
                            <?php if ($validation->getError('phone')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('phone') ?></span>
                            <?php endif ?>
                            <fieldset class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+</span>
                                    </div>
                                    <input type="number" class="form-control" name="phone" placeholder="255123456789">
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> <?= lang('app.newpassword') ?></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center"><a href="<?= base_url('login') ?>"><?= lang('app.login') ?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>