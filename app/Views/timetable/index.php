<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($course as $dt) : ?>
        <div class="col-xl-3">
            <a href="<?= base_url('timetable/mustawa/' . $dt['id']) ?>">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="black"><b><?= $dt['name'] ?></b></h3>
                                </div>
                                <div>
                                    <i class="la la-calendar black font-large-2 float-right"></i>
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