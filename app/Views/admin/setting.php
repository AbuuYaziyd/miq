<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="content-body">
    <div class="row">
        <div class="col-xs-6 col-md-3">
            <a href="<?= base_url('web') ?>">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h2><b><?= lang('app.website') ?></b></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="la la-globe teal font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="<?= base_url('grade') ?>">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h2><b><?= lang('app.grades') ?></b></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-trophy amber font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="<?= base_url('year') ?>">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h2><b><?= lang('app.acYear') ?></b></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="ft ft-cast primary font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="<?= base_url('admin/registration') ?>">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h2><b><?= lang('app.newStudents') ?></b></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-users red font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="<?= base_url('admin/rooms') ?>">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h2><b><?= lang('app.rooms') ?></b></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="ft ft-airplay purple font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>