<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="card" style="zoom: 1;">
                    <div class="card-header bg-hexagons border-top-3 border-top-danger" style="justify-content: center; display:flex">
                        <div class="card-body pt-0">
                            <h4>
                                <span class="h1 danger"><b><?= getenv('APP_NAME') ?></b></span><br>
                                <?= lang('app.academics') ?>: <b><?= $sch['name'] ?></b><br>
                                <?= lang('app.className') ?>: <b><?= $class['name'] ?></b><br>
                                <?= lang('app.subName') ?>: <b><?= $sub['name'] ?></b><br>
                                <?= lang('app.acYear') ?>: <b><?= $year['name'] ?></b>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <?= form_open('result/subject-marks') ?>
                <input type="hidden" name="subject_id" value="<?= $sub['id'] ?>">
                <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                <input type="hidden" name="sex" value="M">
                <input type="hidden" name="year_id" value="<?= $year['id'] ?>">
                <button type="submit" class="btn btn-info btn-lg btn-block"><?= lang('app.results') ?> - <?= lang('app.males') ?></button>
                </form>
            </div>
            <div class="col-md-6 mb-2">
                <?= form_open('result/subject-marks') ?>
                <input type="hidden" name="subject_id" value="<?= $sub['id'] ?>">
                <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                <input type="hidden" name="sex" value="F">
                <input type="hidden" name="year_id" value="<?= $year['id'] ?>">
                <button type="submit" class="btn btn-pink btn-lg btn-block"><?= lang('app.results') ?> - <?= lang('app.females') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>