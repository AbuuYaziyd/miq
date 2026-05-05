<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($rooms as $rm) :  ?>
        <div class="col-xl-3 col-md-6 col-12">
            <a href="<?= $rm['link'] ?>" target="_blank">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="text-muted"><?= lang('app.room') ?></h6>
                                    <h3><b><?= lang('app.room') ?> | <?= $rm['value'] ?></b></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="ft ft-airplay pink font-large-3 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>