<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($rooms as $rm) : ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <b><?= lang('app.room') ?> | <?= $rm['value'] ?></b>
                        <?php if ($rm['link'] != null) : ?>
                            <a href="<?= base_url('admin/delete-room/' . $rm['id']) ?>" class="btn btn-danger round pull-right"><?= lang('app.delete') ?></a>
                        <?php endif ?>
                    </h4>
                </div>
                <hr>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <?php if ($rm['link'] != null) : ?>
                            <a href="<?= $rm['link'] ?>" class="btn btn-lg btn-block btn-purple" target="_blank"><?= lang('app.room') ?> | <?= $rm['value'] ?></a>
                        <?php else : ?>
                            <?= form_open('admin/room') ?>
                                <fieldset>
                                    <label><b><?= lang('app.link') ?></b></label>
                                    <input type="text" class="form-control" name="link" placeholder="<?= lang('app.link') ?>">
                                </fieldset>
                                <input type="hidden" name="id" value="<?= $rm['id'] ?>">
                                <button class="btn btn-lg btn-block btn-primary mt-1"><?= lang('app.submit') ?></button>
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>