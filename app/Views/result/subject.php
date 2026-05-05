<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-3"><b><?= lang('app.subjects') ?> | <?= $class['name'] ?></b></h3>
            </div>
            <div class="card-content">
                <div class="row mx-1">
                    <div class="col mb-2">
                        <?php foreach ($sub as $key => $dt) : ?>
                            <a href="<?= base_url('result/check/' . $dt['id']) ?>" class="btn btn-outline-dark round mb-1 subjects delete "><?= $dt['name'] ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>