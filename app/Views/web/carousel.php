<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.carousel') ?></h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <div class="row mx-1">
                    <?php foreach ($hero as $key => $dt) : ?>
                        <div class="col-md-5">
                            <?= form_open('web/hero') ?>
                            <fieldset class="form-group">
                                <label><b><?= lang('app.title') ?></b></label>
                                <input type="text" name="title" value="<?= $dt['title'] ?>" class="form-control">
                            </fieldset>
                        </div>
                        <div class="col-md-5">
                            <fieldset class="form-group">
                                <label><b><?= lang('app.title_ar') ?></b></label>
                                <input type="text" name="title_ar" value="<?= $dt['title_ar'] ?>" class="form-control">
                            </fieldset>
                        </div>
                        <input type="hidden" name="id" value="<?= $dt['id'] ?>">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-block btn-lg btn-primary mt-1 mb-2"><?= lang('app.edit') ?></button>
                        </div>
                        </form>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($carousel as $key => $dt) : ?>
        <div id="recent-transactions" class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3><b><?= lang('app.carousel') ?> #<?= $key + 1 ?></b> <a href="<?= base_url('web/image/' . $dt['id']) ?>" class="btn btn-outline-purple round pull-right"><?= lang('app.image') ?></a></h3>
                </div>
                <div class="card-content">
                    <?php $validation = \Config\Services::validation() ?>
                    <?= form_open('web/carousel') ?>
                    <div class="row mx-1">
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label><b><?= lang('app.text') ?></b></label>
                                <?php if ($validation->getError('text')) : ?>
                                    <span class="badge badge-danger"> <?= $errors = $validation->getError('text') ?></span>
                                <?php endif ?>
                                <textarea name="text" class="form-control"><?= $dt['text'] ?></textarea>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label><b><?= lang('app.text_ar') ?></b></label>
                                <?php if ($validation->getError('text_ar')) : ?>
                                    <span class="badge badge-danger"> <?= $errors = $validation->getError('text_ar') ?></span>
                                <?php endif ?>
                                <textarea name="text_ar" class="form-control"><?= $dt['text_ar'] ?></textarea>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <?php if ($validation->getError('image')) : ?>
                                    <span class="badge badge-danger"> <?= $errors = $validation->getError('image') ?></span>
                                <?php endif ?>
                                <label><b><?= lang('app.image') ?></b></label>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="media mb-2">
                                            <label class="mr-1">
                                                <img src="<?= $dt['image'] != null ? base_url($dt['image']) : base_url('app-assets/images/carousel/carousel-' . $key . '.jpg') ?>" alt="carousel-<?= $key ?>" id="img" class="users-avatar-shadow" height="250" width="450">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $dt['id'] ?>">
                    <div class="row mx-1">
                        <div class="col">
                            <button type="submit" class="btn btn-block btn-lg btn-primary mt-1 mb-2"><?= lang('app.edit') ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>