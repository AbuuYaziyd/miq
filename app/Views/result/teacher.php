<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($subjects as $sb) : ?>
        <div class="col-xs-6 col-md-3">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <?php if (session('lang') != 'ar') : ?>
                                    <h6 class="text-muted"><?= $crs->find($sb['course_id'])['name'] ?></h6>
                                    <h3><b><?= $sb['name'] ?></b></h3>
                                <?php else : ?>
                                    <h6 class="text-muted"><?= $crs->find($sb['course_id'])['name_ar'] ?></h6>
                                    <h3><b><?= $sb['name_ar'] ?></b></h3>
                                <?php endif ?>
                            </div>
                            <div class="align-self-center">
                                <i class="ft ft-bar-chart-2 purple font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-6"><a href="<?= base_url('result/course/marks/' . $sb['id']) ?>" class="btn btn-outline-teal btn-block"><?= lang('app.fasli1') ?></a></div>
                        <div class="col-6"><a href="<?= base_url('result/final/marks/' . $sb['id']) ?>" class="btn btn-outline-pink btn-block"><?= lang('app.fasli2') ?></a></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>