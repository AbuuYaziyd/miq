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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.carousel') ?></b></h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('web/carousel') ?>
                <div class="row mx-1">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.text') ?></b></label>
                            <?php if ($validation->getError('text')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('text') ?></span>
                            <?php endif ?>
                            <textarea name="text" class="form-control"><?= $carousel['text'] ?></textarea>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.text_ar') ?></b></label>
                            <?php if ($validation->getError('text_ar')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('text_ar') ?></span>
                            <?php endif ?>
                            <textarea name="text_ar" class="form-control"><?= $carousel['text_ar'] ?></textarea>
                        </fieldset>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $carousel['id'] ?>">
                <div class="row mx-1">
                    <div class="col">
                        <button type="submit" class="btn btn-block btn-lg btn-primary mt-1 mb-2"><?= lang('app.edit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card rounded p-5">
            <div id="success"></div>
            <?= form_open_multipart('web/image') ?>
            <div class="row mx-1">
                <div class="col-12">
                    <fieldset class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <div class="media mb-2">
                                    <input type="hidden" name="id" value="<?= $carousel['id'] ?>">
                                    <input type="file" name="image" id="picha" onchange="readURL(this)" style="display: none;">
                                    <label class="mr-1" for="picha">
                                        <img src="<?= $carousel['image'] != '#' ? base_url($carousel['image']) : base_url('app-assets/images/no-image.jpg') ?>" alt="carousel" id="img" class="users-avatar-shadow" height="100%" width="100%">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $carousel['id'] ?>">
            <div class="row">
                <?php if ($carousel['image'] != '#') : ?>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-block btn-lg btn-primary mb-2"><?= lang('app.edit') ?></button>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('web/delete-image/' . $carousel['id']) ?>" class="btn btn-block btn-outline-danger btn-lg mb-2" id="delete"><?= lang('app.delete') ?></a>
                    </div>
                <?php else : ?>
                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-lg btn-primary"><?= lang('app.submit') ?></button>
                    </div>
                <?php endif ?>
            </div>
            </form>
        </div>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector("#img").setAttribute("src", e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </div>
</div>
<?= $this->endSection() ?>