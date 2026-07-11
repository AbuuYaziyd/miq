<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><?= lang('app.acYear') ?>
                    <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('year') ?>"><?= lang('app.back') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('year/create') ?>
                <div class="row mx-1">
                    <div class="col-12">
                        <label for=""><b><?= lang('app.acYear') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <select class="custom-select" name="name">
                                <?php for ($i = $year - 1; $i < $year + 2; $i++) : ?>
                                    <option value="<?= $i ?>" <?= $year == $i ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor ?>
                            </select>
                        </fieldset>
                    </div>
                    <button type="submit" id="btn" class="btn btn-lg btn-block btn-primary mb-2"><?= lang('app.send') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>