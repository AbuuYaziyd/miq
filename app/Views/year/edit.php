<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><?= lang('app.year') ?>
                    <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('year') ?>"><?= lang('app.back') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('year/edit/' . $year['id']) ?>
                <div class="row mx-1">
                    <div class="col">
                        <label for=""><b><?= lang('app.acYear') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" value="<?= $year['name'] ?>" class="form-control">
                        </fieldset>
                    </div>
                </div>
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
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $('#delete').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            // title: <?= lang('app.graduated?') ?>,
            title: 'حقيقة تريد الحذف؟',
            text: "بعد الحذف خلاص فهو محذوف!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم!',
            cancelButtonText: 'لا!',
            confirmButtonClass: 'btn btn-warning',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'تمام',
                    text: 'ما حذفنا شيء :)',
                    type: 'error',
                    showConfirmButton: false,
                })
            }
        })
    });
</script>
<?= $this->endsection() ?>