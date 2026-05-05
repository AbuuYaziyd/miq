<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b><?= lang('app.periods') ?></b>
                    <a class="btn btn-danger box-shadow-1 round pull-right delete" href="<?= base_url('period/delete/' . $period['id']) ?>"><?= lang('app.delete') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <?= form_open('period/update') ?>
                <div class="row mx-1">
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.from') ?></b></label>
                            <input type="time" name="start" class="form-control" value="<?= $period['start'] ?>">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label><b><?= lang('app.to') ?></b></label>
                            <input type="time" name="end" class="form-control" value="<?= $period['end'] ?>">
                        </fieldset>
                    </div>
                    <input type="hidden" name="id" value="<?= $period['id'] ?>">
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-2"><?= lang('app.submit') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.doYouReallyWantToDelete') ?>',
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