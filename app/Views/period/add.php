<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b><?= lang('app.periods') ?></b>
                    <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('period') ?>"><?= lang('app.back') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('period/create') ?>
                <div class="row mx-1">
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.from') ?></b></label>
                            <?php if ($validation->getError('start')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('start') ?></span>
                            <?php endif ?>
                            <input type="time" name="start" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.to') ?></b></label>
                            <?php if ($validation->getError('end')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('end') ?></span>
                            <?php endif ?>
                            <input type="time" name="end" class="form-control">
                        </fieldset>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-2"><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>