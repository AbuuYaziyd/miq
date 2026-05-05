<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.gradeEdit') ?></b></h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('grade/update') ?>
                <div class="row mx-1">
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.gradeName') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" value="<?= $grade['name'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.gradeName_ar') ?></b></label>
                        <?php if ($validation->getError('name_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name_ar" value="<?= $grade['name_ar'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.grade') ?></b></label>
                        <?php if ($validation->getError('ramz')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('ramz') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="ramz" value="<?= $grade['ramz'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <label for=""><b><?= lang('app.grade') ?></b></label>
                        <?php if ($validation->getError('ramz_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('ramz_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="ramz_ar" value="<?= $grade['ramz_ar'] ?>" class="form-control">
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <label for=""><b><?= lang('app.from') ?></b></label>
                        <fieldset class="form-group">
                            <input type="text" name="bidaya" class="form-control" value="<?= $grade['bidaya'] ?>">
                        </fieldset>
                    </div>
                    <div class=" col-md-4">
                        <label for=""><b><?= lang('app.to') ?></b></label>
                        <fieldset class="form-group">
                            <input type="text" name="nihaya" class="form-control" value="<?= $grade['nihaya'] ?>">
                        </fieldset>
                    </div>
                    <div class=" col-md-4">
                        <label for=""><b><?= lang('app.points') ?></b></label>
                        <fieldset class="form-group">
                            <input type="text" name="point" class="form-control" value="<?= $grade['point'] ?>">
                        </fieldset>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $grade['id'] ?>">
                <div class="row mx-1">
                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-lg btn-primary mb-2"><?= lang('app.edit') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#delete').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: 'حقيقة تريد الحذف؟',
            text: "بعد الحذف خلاص فهو محذوف!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم!',
            cancelButtonText: 'لا!',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'تمام',
                    text: 'ما حذفنا شيء :)',
                    icon: 'error',
                    showConfirmButton: false,
                })
            }
        })
    });
</script>
<?= $this->endSection() ?>