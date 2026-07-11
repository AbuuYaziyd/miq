<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><?= lang('app.year') ?>
                    <?php if (session('role')=='admin') : ?>
                    <a class="btn btn-outline-success box-shadow-1 round pull-right" href="<?= base_url('year/add') ?>"><?= lang('app.add') ?></a>
                    <?php else : ?>
                    <span class="btn btn-outline-teal box-shadow-1 round pull-right"><?= $current['name'] ?></span>
                    <?php endif ?>
                </h3>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0"><?= lang('app.name') ?></th>
                                <?php if (session('role')=='admin') : ?>
                                <th class="border-top-0"><?= lang('app.choose') ?></th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($year as $key => $dt) : ?>
                                <tr>
                                    <td class="text-truncate"><?= $key + 1 ?></td>
                                    <td class="text-truncate"><?= $dt['name'] ?></td>
                                    <?php if (session('role')=='admin') : ?>
                                    <td><a href="<?= base_url('year/edit/' . $dt['id']) ?>" class="btn btn-sm btn-outline-warning round"><?= lang('app.edit') ?></a> </td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if (session('role')=='admin') : ?>
            <div class="card-body">
                <div class="btn-group mr-1 mb-1 float-right">
                    <button type="button" class="btn btn-outline-primary round btn-sm float-right"><?= $current['name'] ?></button>
                    <button type="button" class="btn btn-primary round dropdown-toggle btn-sm float-right" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu float-right">
                        <?php foreach ($year as $dt) : ?>
                        <a href="<?= base_url('year/change/'.$dt['id']) ?>" class="dropdown-item <?= $current['id']==$dt['id']?'disabled':'' ?>"><?= $dt['name'] ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <?= lang('app.currentYear') ?>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>