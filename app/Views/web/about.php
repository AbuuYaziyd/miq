<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.about') ?></b></h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('web/about') ?>
                <div class="row mx-1">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.title') ?></b></label>
                            <?php if ($validation->getError('title')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('title') ?></span>
                            <?php endif ?>
                            <input type="text" name="title" value="<?= $about['title'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.text') ?></b></label>
                            <?php if ($validation->getError('text')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('text') ?></span>
                            <?php endif ?>
                            <input type="text" name="text" value="<?= $about['text'] ?>" class="form-control">
                        </fieldset>
                    </div>
                </div>
                <div class="row mx-1">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.title_ar') ?></b></label>
                            <?php if ($validation->getError('title_ar')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('title_ar') ?></span>
                            <?php endif ?>
                            <input type="text" name="title_ar" value="<?= $about['title_ar'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.text_ar') ?></b></label>
                            <?php if ($validation->getError('text_ar')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('text_ar') ?></span>
                            <?php endif ?>
                            <input type="text" name="text_ar" value="<?= $about['text_ar'] ?>" class="form-control">
                        </fieldset>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $about['id'] ?>">
            <div class="row mx-1">
                <div class="col">
                    <button type="submit" class="btn btn-block btn-lg btn-primary mt-1 mb-2"><?= lang('app.submit') ?></button>
                </div>
            </div>
            </form>
        </div>
        <div class="row">
            <?php foreach ($about_text as $ab) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-content">
                            <?php $validation = \Config\Services::validation() ?>
                            <?= form_open('web/about-text') ?>
                            <div class="row mx-1">
                                <div class="col-12">
                                    <fieldset class="form-group">
                                        <label><b><?= lang('app.title') ?></b></label>
                                        <?php if ($validation->getError('title')) : ?>
                                            <span class="badge badge-danger"> <?= $errors = $validation->getError('title') ?></span>
                                        <?php endif ?>
                                        <input type="text" name="title" value="<?= $ab['title'] ?>" class="form-control">
                                    </fieldset>
                                </div>
                                <div class="col-12">
                                    <fieldset class="form-group">
                                        <label><b><?= lang('app.text') ?></b></label>
                                        <?php if ($validation->getError('text')) : ?>
                                            <span class="badge badge-danger"> <?= $errors = $validation->getError('text') ?></span>
                                        <?php endif ?>
                                        <input type="text" name="text" value="<?= $ab['text'] ?>" class="form-control">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mx-1">
                                <div class="col-12">
                                    <fieldset class="form-group">
                                        <label><b><?= lang('app.title_ar') ?></b></label>
                                        <?php if ($validation->getError('title_ar')) : ?>
                                            <span class="badge badge-danger"> <?= $errors = $validation->getError('title_ar') ?></span>
                                        <?php endif ?>
                                        <input type="text" name="title_ar" value="<?= $ab['title_ar'] ?>" class="form-control">
                                    </fieldset>
                                </div>
                                <div class="col-12">
                                    <fieldset class="form-group">
                                        <label><b><?= lang('app.text_ar') ?></b></label>
                                        <?php if ($validation->getError('text_ar')) : ?>
                                            <span class="badge badge-danger"> <?= $errors = $validation->getError('text_ar') ?></span>
                                        <?php endif ?>
                                        <input type="text" name="text_ar" value="<?= $ab['text_ar'] ?>" class="form-control">
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $ab['id'] ?>">
                        <div class="row mx-1">
                            <div class="col">
                                <button type="submit" class="btn btn-block btn-lg btn-primary mt-1 mb-2"><?= lang('app.submit') ?></button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>