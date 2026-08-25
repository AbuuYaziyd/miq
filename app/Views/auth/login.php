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
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span><?= lang('app.login') ?></span>
                        </h6>
                    </div>
                            <?php if ((session()->getFlashdata('identity'))) : ?>
                                <h6 class="text-center">
                                    <span class="badge badge-danger float-center"><?= (session()->getFlashdata('identity')) ?></span>
                                </h6>
                            <?php endif ?>
                    <div class="card-content">
                        <div class="card-body">
                            <?= form_open('login') ?>
                            <label class="text-bold-600"><?= lang('app.username') ?></label>
                            <fieldset class="form-group position-relative has-icon-left mb-1">
                                <input type="text" class="form-control" name="identity" placeholder="<?= lang('app.username') ?>">
                                <div class="form-control-position">
                                    <i class="la la-user"></i>
                                </div>
                            </fieldset>
                            <label class="text-bold-600"><?= lang('app.password') ?></label>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control" name="password" placeholder="<?= lang('app.password') ?>">
                                <div class="form-control-position">
                                    <i class="la la-key"></i>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> <?= lang('app.login') ?></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <div class="text-center"><a href="<?= base_url('recover') ?>"><?= lang('app.recoverpassword') ?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?= $this->endSection() ?>