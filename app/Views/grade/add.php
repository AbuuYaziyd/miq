<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><?= lang('app.grades') ?>
                    <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('grade') ?>"><?= lang('app.back') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('grade/create') ?>
                <div class="row mx-1">
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.gradeName') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="<?= lang('app.gradeName') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b><?= lang('app.from') ?></b></label>
                        <fieldset class="form-group">
                            <input type="text" name="bidaya" class="form-control" placeholder="<?= lang('app.grdBegg') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-3">
                        <label for=""><b><?= lang('app.to') ?></b></label>
                        <fieldset class="form-group">
                            <input type="text" name="nihaya" class="form-control" placeholder="<?= lang('app.grdEnd') ?>">
                        </fieldset>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-2"><?= lang('app.send') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>