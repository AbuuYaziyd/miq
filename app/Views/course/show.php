<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4 mb-2">
        <a href="<?= base_url('course/settings/' . $course['id']) ?>" class="btn btn-teal pull-right btn-lg btn-block <?= count($students) > 0 ? '' : 'disabled' ?>"><?= lang('app.advancedSettings') ?></a>
    </div>
    <div class="col-md-4 mb-2">
        <a href="<?= base_url('course/attendance/M/' . $course['id']) ?>" class="btn btn-danger pull-right btn-lg btn-block att"><?= lang('app.attendance') ?></a>
    </div>
    <div class="col-md-4 mb-2">
        <a href="<?= base_url('course/students/' . $course['id']) ?>" class="btn btn-purple pull-right btn-lg btn-block"><?= lang('app.allStudents') ?></a>
    </div>
</div>
<div class="row">
    <div id="recent-transactions" class="col-md-6">
        <div class="card">
            <div class="card-header">
                <?php if (session('lang') != 'ar') : ?>
                    <h3><b><?= $course['name'] ?></b></h3>
                <?php else : ?>
                    <h3><b><?= $course['name_ar'] ?></b></h3>
                <?php endif ?>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('course/update') ?>
                <div class="row mx-1">
                    <div class="col-12">
                        <label for=""><b><?= lang('app.className') ?></b></label>
                        <?php if ($validation->getError('name')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name" value="<?= $course['name'] ?>" class="form-control" <?= session('role') != 'admin' ? 'readonly' : '' ?>>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <label for=""><b><?= lang('app.className_ar') ?></b></label>
                        <?php if ($validation->getError('name_ar')) : ?>
                            <span class="badge badge-danger"> <?= $errors = $validation->getError('name_ar') ?></span>
                        <?php endif ?>
                        <fieldset class="form-group">
                            <input type="text" name="name_ar" value="<?= $course['name_ar'] ?>" class="form-control" <?= session('role') != 'admin' ? 'readonly' : '' ?>>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <label for=""><b><?= lang('app.tchName') ?></b></label>
                        <fieldset class="form-group">
                            <select class="custom-select" <?= session('role') != 'admin' ? 'disabled' : '' ?> name="head_id" id="class_id">
                                <?php foreach ($tch as $dt) : ?>
                                    <?php if (session('lang') != 'ar') : ?>
                                        <?php $tch_nm = $dt['name'] . ' ' . $dt['mname'] . ' ' . $dt['lname'] ?>
                                    <?php else : ?>
                                        <?php $tch_nm = $dt['name_ar'] . ' ' . $dt['mname_ar'] . ' ' . $dt['lname_ar'] ?>
                                    <?php endif ?>
                                    <option value="<?= $dt['id'] ?>" <?= $dt['id'] == $course['head_id'] ? 'selected' : '' ?>><?= $tch_nm ?></option>
                                <?php endforeach ?>
                            </select>
                        </fieldset>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                <div class="row mx-1">
                    <div class="col">
                        <?php if (session('role') == 'admin') : ?>
                            <button type="submit" class="btn btn-block btn-lg btn-primary mt-1 mb-2"><?= lang('app.edit') ?></button>
                        <?php endif ?>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="recent-transactions" class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b><?= lang('app.subjects') ?> - <?= count($sub) ?></b>
                    <a href="<?= base_url('subject/course/' . $course['id']) ?>" class="btn btn-outline-pink pull-right round"><?= lang('app.allSubjects') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <div class="row mx-1">
                    <div class="col mb-2">
                        <?php foreach ($sub as $key => $dt) : ?>
                            <a href="<?= base_url('subject/show/' . $dt['id']) ?>" target="_blank" class="btn btn-outline-black round mb-1">
                                <?php if (session('lang') != 'ar') : ?>
                                    <b><?= $dt['name'] ?></b>
                                <?php else : ?>
                                    <b><?= $dt['name_ar'] ?></b>
                                <?php endif ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TIME TABLE -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><b><?= lang('app.students') ?> - <?= lang('app.males') ?></b></h2>
            </div>
            <div class="card-content collapse show text-center">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dtTable">
                        <thead>
                            <tr>
                                <th><?= lang('app.username') ?></th>
                                <th><?= lang('app.fullname') ?></th>
                                <th><?= lang('app.contacts') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $key => $dt) : ?>
                                <?php if ($dt['sex'] == 'M') : ?>
                                    <tr>
                                        <td><a href="<?= base_url('student/page/' . $dt['id']) ?>" class="btn btn-sm btn-outline-cyan round"><?= $dt['username'] ?></a></td>
                                        <td>
                                            <?= $dt['name'] ?>
                                            <?= $dt['mname'] ?>
                                            <?= $dt['lname'] ?>
                                            <br>
                                            <?= $dt['name_ar'] ?>
                                            <?= $dt['mname_ar'] ?>
                                            <?= $dt['lname_ar'] ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-block">
                                                <a href="tel:/+255<?= $dt['phone'] ?>" class="btn btn-sm round btn-outline-secondary"><i class="icon-call-out"></i></a>
                                                <a href="https://wa.me/255<?= $dt['phone'] ?>" class="btn btn-sm round btn-outline-success"><i class="la la-whatsapp"></i></a>
                                                <a href="sms://255<?= $dt['phone'] ?>" class="btn btn-sm round btn-outline-warning"><i class="la la-comments"></i></a>
                                                <a href="mailto:/<?= $dt['email'] ?>" class="btn btn-sm round btn-outline-info"><i class="icon-envelope"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><b><?= lang('app.students') ?> - <?= lang('app.females') ?></b></h2>
            </div>
            <div class="card-content collapse show text-center">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dtTable">
                        <thead>
                            <tr>
                                <th><?= lang('app.username') ?></th>
                                <th><?= lang('app.fullname') ?></th>
                                <th><?= lang('app.contacts') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $key => $dt) : ?>
                                <?php if ($dt['sex'] == 'F') : ?>
                                    <tr>
                                        <td><a href="<?= base_url('student/page/' . $dt['id']) ?>" class="btn btn-sm btn-outline-cyan round"><?= $dt['username'] ?></a></td>
                                        <td>
                                            <?= $dt['name'] ?>
                                            <?= $dt['mname'] ?>
                                            <?= $dt['lname'] ?>
                                            <br>
                                            <?= $dt['name_ar'] ?>
                                            <?= $dt['mname_ar'] ?>
                                            <?= $dt['lname_ar'] ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-block">
                                                <a href="tel:/+255<?= $dt['phone'] ?>" class="btn btn-sm round btn-outline-secondary"><i class="icon-call-out"></i></a>
                                                <a href="https://wa.me/255<?= $dt['phone'] ?>" class="btn btn-sm round btn-outline-success"><i class="la la-whatsapp"></i></a>
                                                <a href="sms://255<?= $dt['phone'] ?>" class="btn btn-sm round btn-outline-warning"><i class="la la-comments"></i></a>
                                                <a href="mailto:/<?= $dt['email'] ?>" class="btn btn-sm round btn-outline-info"><i class="icon-envelope"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.att').on('click', function(e) {
        e.preventDefault();
        urlM = '<?= base_url('course/attendance/M/' . $course['id']) ?>';
        urlF = '<?= base_url('course/attendance/F/' . $course['id']) ?>';
        Swal.fire({
            title: '<?= lang('app.attendances') ?>',
            // text: '<?= lang('app.afterDeleteItsGone') ?>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.males') ?>',
            cancelButtonText: '<?= lang('app.females') ?>',
        }).then(function(result) {
            if (result.value) {
                window.location.href = urlM;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = urlF;
            }
        })
    });
</script>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>