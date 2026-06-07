<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>

<div class="content-body">
    <section class="row flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <div>
                                <a href="<?= base_url() ?>"><img src="<?= base_url('app-assets/images/logo/logo.png') ?>" alt="logo" height="180px"></a>
                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span><?= lang('app.appName') ?></span>
                        </h6>
                    </div>
                    <div class="card-body text-center">
                        <?php if (session('isLoggedIn') != true) : ?>
                            <a href="<?= base_url('login') ?>" class="btn btn-block btn-lg btn-secondary round mb-1"><?= lang('app.login') ?></a>
                        <?php else : ?>
                            <a href="<?= base_url('login') ?>" class="btn btn-block btn-lg btn-outline-success round mb-1"><b><?= lang('app.dashboard') ?></b></a>
                        <?php endif ?>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <div class="text-center"><a href="<?= base_url() ?>" class="btn btn-sm btn-outline-purple round"><?= lang('app.appName') ?> | <?= lang('app.ourLocation') ?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>