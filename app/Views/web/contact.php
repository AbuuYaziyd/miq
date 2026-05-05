<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.contacts') ?></b></h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('web/contact') ?>
                <div class="row mx-1">
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.fullName_ar') ?></b></label>
                            <?php if ($validation->getError('name_ar')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('email') ?></span>
                            <?php endif ?>
                            <input type="text" name="name_ar" value="<?= $name['extra'] ?>" class="form-control">
                            <input type="hidden" name="name_id" value="<?= $name['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.fullName') ?></b></label>
                            <?php if ($validation->getError('name_ar')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                            <?php endif ?>
                            <input type="text" name="name_sw" value="<?= $name['value'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.email') ?></b></label>
                            <?php if ($validation->getError('email')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('email') ?></span>
                            <?php endif ?>
                            <input type="text" name="email" value="<?= $email['value'] ?>" class="form-control">
                            <input type="hidden" name="email_id" value="<?= $email['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.phone') ?></b></label>
                            <?php if ($validation->getError('phone')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('phone') ?></span>
                            <?php endif ?>
                            <input type="number" name="phone" value="<?= $phone['value'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.phone') ?></b></label>
                            <?php if ($validation->getError('phone')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('phone') ?></span>
                            <?php endif ?>
                            <input type="number" name="phone2" value="<?= $phone['link'] ?>" class="form-control">
                            <input type="hidden" name="phone_id" value="<?= $phone['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.location') ?></b></label>
                            <?php if ($validation->getError('location')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('location') ?></span>
                            <?php endif ?>
                            <input type="text" name="location" value="<?= $location['value'] ?>" class="form-control">
                            <input type="hidden" name="location_id" value="<?= $location['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.location') ?></b></label>
                            <?php if ($validation->getError('extra')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('extra') ?></span>
                            <?php endif ?>
                            <input type="text" name="extra" value="<?= $location['extra'] ?>" class="form-control">
                            <input type="hidden" name="location_id" value="<?= $location['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.location') ?></b></label>
                            <?php if ($validation->getError('location')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('location') ?></span>
                            <?php endif ?>
                            <input type="text" name="link" value="<?= $location['link'] ?>" class="form-control">
                            <input type="hidden" name="location_id" value="<?= $location['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.facebook') ?></b></label>
                            <?php if ($validation->getError('facebook')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('facebook') ?></span>
                            <?php endif ?>
                            <input type="text" name="facebook" value="<?= $facebook['link'] ?>" class="form-control">
                            <input type="hidden" name="facebook_id" value="<?= $facebook['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.twitter') ?></b></label>
                            <?php if ($validation->getError('twitter')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('twitter') ?></span>
                            <?php endif ?>
                            <input type="text" name="twitter" value="<?= $twitter['link'] ?>" class="form-control">
                            <input type="hidden" name="twitter_id" value="<?= $twitter['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.telegram') ?></b></label>
                            <?php if ($validation->getError('telegram')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('telegram') ?></span>
                            <?php endif ?>
                            <input type="text" name="telegram" value="<?= $telegram['link'] ?>" class="form-control">
                            <input type="hidden" name="telegram_id" value="<?= $telegram['id'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.whatsapp') ?></b></label>
                            <?php if ($validation->getError('whatsapp')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('whatsapp') ?></span>
                            <?php endif ?>
                            <input type="text" name="whatsapp" value="<?= $whatsapp['link'] ?>" class="form-control">
                            <input type="hidden" name="whatsapp_id" value="<?= $whatsapp['id'] ?>">
                        </fieldset>
                    </div>
                </div>
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