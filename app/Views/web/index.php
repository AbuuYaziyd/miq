<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= $title ?></b>
                    <div class="form-group float-right">
                        <?= form_open('web/mauqii') ?>
                        <label class="switch">
                            <input type="checkbox" name="mauqii" id="switcherySize" class="switchery" data-size="lg" <?= $mauqii['link'] ?> onchange="this.form.submit()">
                            <input type="hidden" name="id" value="<?= $mauqii['id'] ?>">
                        </label>
                        </form>
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.fullname') ?></b></h3>
            </div>
            <div class="card-content">
                <?= form_open('web/setting') ?>
                <div class="row mx-1">
                    <div class="col-md-12 mb-2">
                        <label for=""><b><?= lang('app.sw') ?></b></label>
                        <input type="text" name="value" class="form-control mb-1" value="<?= $name['value'] ?>">
                        <label for=""><b><?= lang('app.ar') ?></b></label>
                        <input type="text" name="value_ar" class="form-control mb-1" value="<?= $name['value_ar'] ?>">
                        <input type="hidden" name="id" value="<?= $name['id'] ?>">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><?= lang('app.submit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.phone') ?></b></h3>
            </div>
            <div class="card-content">
                <?= form_open('web/setting') ?>
                <div class="row mx-1">
                    <div class="col-md-12 mb-2">
                        <label for=""><b><?= lang('app.phone') ?> #1</b></label>
                        <input type="number" name="value" class="form-control mb-1" value="<?= $phone['value'] ?>">
                        <label for=""><b><?= lang('app.phone') ?> #2</b></label>
                        <input type="number" name="link" class="form-control mb-1" value="<?= $phone['link'] ?>">
                        <input type="hidden" name="id" value="<?= $phone['id'] ?>">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><?= lang('app.submit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.location') ?></b></h3>
            </div>
            <div class="card-content">
                <?= form_open('web/setting') ?>
                <div class="row mx-1">
                    <div class="col-md-12 mb-2">
                        <label for=""><b><?= lang('app.sw') ?></b></label>
                        <input type="text" name="value" class="form-control mb-1" value="<?= $location['value'] ?>">
                        <label for=""><b><?= lang('app.ar') ?></b></label>
                        <input type="text" name="value_ar" class="form-control mb-1" value="<?= $location['value_ar'] ?>">
                        <input type="hidden" name="id" value="<?= $location['id'] ?>">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><?= lang('app.submit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.posta') ?></b></h3>
            </div>
            <div class="card-content">
                <?= form_open('web/setting') ?>
                <div class="row mx-1">
                    <div class="col-md-12 mb-2">
                        <label for=""><b><?= lang('app.sw') ?></b></label>
                        <input type="text" name="value" class="form-control mb-1" value="<?= $postabox['value'] ?>">
                        <label for=""><b><?= lang('app.ar') ?></b></label>
                        <input type="text" name="value_ar" class="form-control mb-1" value="<?= $postabox['value_ar'] ?>">
                        <input type="hidden" name="id" value="<?= $postabox['id'] ?>">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><?= lang('app.submit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b>
                        <?php if (session('lang') != 'ar') : ?>
                            <?= $mudir['extra'] ?>
                        <?php else : ?>
                            <?= $mudir['extra_ar'] ?>
                        <?php endif ?>
                    </b>
                    <a href="<?= base_url('web/sign/' . $mudir['id']) ?>" class="btn btn-danger round pull-right"><?= lang('app.sign') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?= form_open('web/setting') ?>
                <div class="row mx-1">
                    <div class="col-md-12 mb-2">
                        <label for=""><b><?= lang('app.sw') ?></b></label>
                        <input type="text" name="value" class="form-control mb-1" value="<?= $mudir['value'] ?>">
                        <label for=""><b><?= lang('app.ar') ?></b></label>
                        <input type="text" name="value_ar" class="form-control mb-1" value="<?= $mudir['value_ar'] ?>">
                        <input type="hidden" name="id" value="<?= $mudir['id'] ?>">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><?= lang('app.submit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b>
                        <?php if (session('lang') != 'ar') : ?>
                            <?= $taalim['extra'] ?>
                        <?php else : ?>
                            <?= $taalim['extra_ar'] ?>
                        <?php endif ?>
                    </b>
                    <a href="<?= base_url('web/sign/' . $taalim['id']) ?>" class="btn btn-danger round pull-right"><?= lang('app.sign') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?= form_open('web/setting') ?>
                <div class="row mx-1">
                    <div class="col-md-12 mb-2">
                        <label for=""><b><?= lang('app.sw') ?></b></label>
                        <input type="text" name="value" class="form-control mb-1" value="<?= $taalim['value'] ?>">
                        <label for=""><b><?= lang('app.ar') ?></b></label>
                        <input type="text" name="value_ar" class="form-control mb-1" value="<?= $taalim['value_ar'] ?>">
                        <input type="hidden" name="id" value="<?= $taalim['id'] ?>">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><?= lang('app.submit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b><?= lang('app.register') ?></b>
                    <a href="<?= base_url('web/sign/' . $logo['id']) ?>" class="btn btn-danger round pull-right"><?= lang('app.logo') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <div class="row mx-1">
                    <div class="col-md-12 mb-2">
                        <?= form_open('web/setting') ?>
                        <label for=""><b><?= lang('app.email') ?></b></label>
                        <div class="input-group">
                            <input type="text" name="value" class="form-control" value="<?= $email['value'] ?>">
                            <input type="hidden" name="id" value="<?= $email['id'] ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><?= lang('app.submit') ?></button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <?php if (session('fn') == 'admin') : ?>
                        <div class="col-md-12 mb-2">
                            <?= form_open('web/setting') ?>
                            <label for=""><b><?= lang('app.regNo') ?></b></label>
                            <div class="input-group">
                                <input type="number" name="value" class="form-control" value="<?= $register['value'] ?>">
                                <input type="hidden" name="id" value="<?= $register['id'] ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><?= lang('app.submit') ?></button>
                                </div>
                            </div>
                            </form>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (session('fn') == 'admin') : ?>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3><b><?= lang('app.colours') ?></b></h3>
                </div>
                <div class="card-content">
                    <?= form_open('web/setting') ?>
                    <div class="row mx-1">
                        <div class="col-md-6 mb-2">
                            <div class="form-group text-center">
                                <label><b>Primary</b></label>
                                <p>
                                    <input type="text" name="value" class="form-control preferredHex" value="<?= $colour['value'] ?>" style="display: none;">
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group text-center">
                                <label><b>Secondary</b></label>
                                <p>
                                    <input type="text" name="link" class="form-control preferredHex" value="<?= $colour['link'] ?>" style="display: none;">
                                </p>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $colour['id'] ?>">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary btn-block btn-lg" type="submit"><?= lang('app.submit') ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('web/carousel') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="teal"><?= lang('app.carousel') ?></h3>
                            </div>
                            <div>
                                <i class="la la-globe teal spinner font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-teal" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('web/about') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="purple"><?= lang('app.about') ?></h3>
                            </div>
                            <div>
                                <i class="icon-notebook purple font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('web/admission') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="black"><?= lang('app.admission') ?></h3>
                            </div>
                            <div>
                                <i class="icon-note black font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('announce') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger"><?= lang('app.announcements') ?></h3>
                            </div>
                            <div>
                                <i class="la la-bullhorn danger font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('blog') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info"><?= lang('app.blogs') ?></h3>
                            </div>
                            <div>
                                <i class="ft ft-cast info font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?= base_url('web/contact') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="pink"><?= lang('app.contacts') ?></h3>
                            </div>
                            <div>
                                <i class="icon-screen-smartphone pink font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-pink" role="progressbar" style="width: <?= 100 ?>%" aria-valuenow="<?= 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div> -->
</div>
<?= $this->endSection() ?>