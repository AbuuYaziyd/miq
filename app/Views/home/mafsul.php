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
                                <a href="<?= base_url() ?>"><img src="<?= base_url('app-assets/images/logo/logo.svg') ?>" alt="logo" height="180px"></a>
                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span><?= lang('app.mafsul') ?></span>
                        </h6>
                    </div>
                    <div class="card-content text-center">
                        <div class="card-body">
                            <h1><?= $title ?></h1>
                            <div class="mt-2"><i class="ft ft-alert-circle danger font-large-5"></i></div>
                            <br>
                            <h4><?= $reason ?? lang('app.feesPaymentNotDone') ?></h4>
                            <hr>
                            <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-pink round"><?= lang('app.home') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?= $this->endSection() ?>