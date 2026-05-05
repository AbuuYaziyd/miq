<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.admission') ?></b></a></h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('web/admission') ?>
                <div class="row mx-1">
                    <div class="col-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.title') ?></b></label>
                            <input type="text" name="admission_value" value="<?= $admission['value'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.title_ar') ?></b></label>
                            <input type="text" name="admission_link" value="<?= $admission['link'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.appDeadline') ?></b></label>
                            <input type="date" name="admission_extra" value="<?= $admission['extra'] ?>" class="form-control">
                        </fieldset>
                    </div>
                </div>
                <input type="hidden" name="admission_id" value="<?= $admission['id'] ?>">
                <div class="row mx-1">
                    <div class="col">
                        <button type="submit" class="btn btn-block btn-lg btn-primary mt-1 mb-2"><?= lang('app.submit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>