<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><?= lang('app.class') ?>
                    <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('class') ?>"><?= lang('app.back') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('class/add') ?>
                <div class="row mx-1">
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.className') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="<?= lang('app.className') ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.tchName') ?></b></label>
                        <fieldset class="form-group">
                            <select class="custom-select" name="teacher_id" id="class_id">
                                <option selected disabled><?= lang('app.choose') ?></option>
                                <?php foreach ($tch as $key => $data) : ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.shift') ?></b></label>
                        <select class="custom-select" name="shift_id" id="class_id">
                            <option selected disabled><?= lang('app.choose') ?></option>
                            <?php foreach ($shift as $key => $data) : ?>
                                <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-2"><?= lang('app.send') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>