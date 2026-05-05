<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php if (session('role') == 'admin') : ?>
        <div id="recent-transactions" class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3><b><?= lang('app.subject') ?></b>
                        <a class="btn btn-danger round pull-right delete" href="<?= base_url('subject/delete/' . $sub['id']) ?>"><?= lang('app.delete') ?></a>
                    </h3>
                </div>
                <div class="card-content">
                    <?php $validation = \Config\Services::validation() ?>
                    <?= form_open('subject/update') ?>
                    <div class="row mx-1">
                        <div class="col-md-6">
                            <label for=""><b><?= lang('app.className') ?></b></label>
                            <?php if ($validation->getError('name')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                            <?php endif ?>
                            <fieldset class="form-group">
                                <input type="text" name="name" value="<?= $sub['name'] ?>" class="form-control">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b><?= lang('app.className_ar') ?></b></label>
                            <?php if ($validation->getError('name_ar')) : ?>
                                <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                            <?php endif ?>
                            <fieldset class="form-group">
                                <input type="text" name="name_ar" value="<?= $sub['name_ar'] ?>" class="form-control">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b><?= lang('app.ramz') ?></b></label>
                            <fieldset class="form-group">
                                <input type="text" name="ramz" value="<?= $sub['ramz'] ?>" class="form-control">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b><?= lang('app.tchName') ?></b></label>
                            <fieldset class="form-group">
                                <select class="custom-select" name="head_id" id="class_id">
                                    <?php foreach ($tch as $key => $dt) : ?>
                                        <?php if (session('lang') != 'ar') : ?>
                                            <?php $tch_nm = $dt['name'] . ' ' . $dt['mname'] . ' ' . $dt['lname'] ?>
                                        <?php else : ?>
                                            <?php $tch_nm = $dt['name_ar'] . ' ' . $dt['mname_ar'] . ' ' . $dt['lname_ar'] ?>
                                        <?php endif ?>
                                        <option value="<?= $dt['id'] ?>" <?= $dt['id'] == $sub['head_id'] ? 'selected' : '' ?>><?= $tch_nm ?></option>
                                    <?php endforeach ?>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $sub['id'] ?>">
                    <input type="hidden" name="course_id" value="<?= $sub['course_id'] ?>">
                    <div class="row mx-1">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-lg btn-primary mb-2"><?= lang('app.edit') ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
<hr>
<div class="row">
    <?php foreach ($times as $tm) : ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4>
                            <b><?= lang('app.siku' . $tm['day']) ?></b>
                            <a href="<?= $sub['link'] ?>" class="btn btn-sm btn<?= $tm['day'] != strftime('%w') ? '-outline' : '' ?>-purple round float-right"><?= $sub['ramz'] ?></a>
                        </h4>
                    </div>
                    <hr>
                    <?php $tch = $s->teacher($sub['head_id']) ?>
                    <?php if (session('lang') != 'ar') : ?>
                        <?php $tch_nm = $tch['name'] . ' ' . $tch['mname'] . ' ' . $tch['lname'] ?>
                    <?php else : ?>
                        <?php $tch_nm = $tch['name_ar'] . ' ' . $tch['mname_ar'] . ' ' . $tch['lname_ar'] ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.aboutSubject') ?></b>
                    <a class="btn btn-teal box-shadow-1 round pull-right" href="<?= base_url('result/teacher/' . session('id')) ?>"><?= lang('app.results') ?></a>
                </h3>
            </div>
            <hr>
            <div class="card-body">
                <a href="<?= $sub['book'] ?>" class="btn btn-sm round btn-<?= $sub['link'] == null ? 'outline-' : '' ?>blue float-right <?= $sub['book'] == null ? 'disabled' : '' ?>"><?= lang('app.subBook') ?></a><?= lang('app.subBook') ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4>
                        <?php if (session('lang') != 'ar') : ?>
                            <b><?= $sub['name'] ?></b>
                        <?php else : ?>
                            <b><?= $sub['name_ar'] ?></b>
                        <?php endif ?>
                        <a href="<?= base_url('subject/about/' . $sub['id']) ?>" class="btn btn-sm btn-purple round float-right"><?= $sub['ramz'] ?></a>
                    </h4>
                </div>
                <hr>
                <div class="card-body">
                    <?php $tch = $s->teacher($sub['head_id']) ?>
                    <?php if (session('lang') != 'ar') : ?>
                        <?php $tch_nm = $tch['name'] . ' ' . $tch['mname'] . ' ' . $tch['lname'] ?>
                    <?php else : ?>
                        <?php $tch_nm = $tch['name_ar'] . ' ' . $tch['mname_ar'] . ' ' . $tch['lname_ar'] ?>
                    <?php endif ?>
                    <span class="btn btn-sm round btn<?= $sub['head_id'] != session('id') ? '-outline' : '' ?>-blue float-right"><?= $tch_nm ?></span><?= lang('app.tchName') ?>
                </div>
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
<?= $this->include('layouts/table') ?>