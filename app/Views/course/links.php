<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($course as $dt) : ?>
        <div class="col-xl-3">
            <?php $validation = \Config\Services::validation() ?>
            <?= form_open('course/link') ?>
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="black"><b><?= $dt['name'] ?></b></h3>
                            </div>
                            <div>
                                <i class="la la-link black font-large-2 float-right"></i>
                            </div>
                        </div>
                        <hr>
                        <?php if ($dt['link'] != null) : ?>
                            <a href="<?= $dt['link'] ?>" target="_blank" class="btn btn-block btn-lg btn-outline-warning mt-2"><?= lang('app.doroosLink') ?></a>
                            <a href="<?= base_url('course/delete-link/' . $dt['id']) ?>" class="btn btn-block btn-lg btn-danger mt-2 delete"><?= lang('app.delete') ?></a>
                        <?php else : ?>
                            <fieldset class="mb-1">
                                <label><b><?= lang('app.doroosLink') ?></b></label>
                                <?php if ($validation->getError('link')) : ?>
                                    <span class="badge badge-danger"> <?= $errors = $validation->getError('link') ?></span>
                                <?php endif ?>
                                <input type="text" name="link" class="form-control" placeholder="<?= lang('app.doroosLink') ?>">
                            </fieldset>
                            <input type="hidden" name="id" value="<?= $dt['id'] ?>">
                            <button type="submit" class="btn btn-block btn-lg btn-primary"><?= lang('app.submit') ?></button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            </form>
        </div>
    <?php endforeach ?>
</div>
<script>
    $('.delete').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.sure') ?>',
            text: '<?= lang('app.afterDeleteItsGone') ?>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            }
        })
    });
</script>
<?= $this->endSection() ?>