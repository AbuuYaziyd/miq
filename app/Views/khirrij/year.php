<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><b><?= $title ?></b>
                    <select name="year" class="custom-select col-8 pull-right" id="year_select">
                        <option value="<?= base_url('khirrij') ?>" selected><?= lang('app.choose') ?></option>
                        <?php foreach ($yr as $y) : ?>
                            <option value="<?= base_url('khirrij/year/' . $y['year_id']) ?>" <?= $yr_id == $y['year_id'] ? 'selected' : '' ?>><?= $khr->year($y['year_id'])['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </h2>
            </div>
            <?php if ($std) : ?>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dataex-res-constructor">
                            <thead>
                                <tr>
                                    <th><?= lang('app.certNo') ?></th>
                                    <th><?= lang('app.name') ?></th>
                                    <th><?= lang('app.name') ?></th>
                                    <th><?= lang('app.taqdir') ?></th>
                                    <th><?= lang('app.taqdir') ?></th>
                                    <th><?= lang('app.city') ?></th>
                                    <th><?= lang('app.city') ?></th>
                                    <th><?= lang('app.dob') ?></th>
                                    <th><?= lang('app.dob') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($std as $key => $us) : ?>
                                    <?php $user = $khr->user($us['student_id']) ?>
                                    <tr>
                                        <td>
                                            <a href="<?= base_url('khirrij/show/' . $user['id']) ?>" class="btn btn-sm btn-outline-primary round">
                                                <?= $user['certificate_no'] ?? lang('app.notFound') ?>
                                                <a>
                                        </td>
                                        <td><?= $user['name_ar'] ?> <?= $user['mname_ar'] ?> <?= $user['lname_ar'] ?></td>
                                        <td><?= $user['name'] ?> <?= $user['mname'] ?> <?= $user['lname'] ?></td>
                                        <td><?= $khr->grade(round($us['gpa']))['name'] ?></td>
                                        <td><?= $khr->grade(round($us['gpa']))['name_ar'] ?></td>
                                        <td><?= $khr->city($user['city_id'])['name_ar'] ?></td>
                                        <td><?= $khr->city($user['city_id'])['name'] ?></td>
                                        <td><?= $hjr->strToHijri($user['dob'], "d F Y", 'ar') ?>هـ</td>
                                        <td><?= $user['dob'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->include('layouts/table') ?>
<script>
    $(function() {
        // bind change event to select
        $('#year_select').on('change', function() {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });
</script>
<script>
    $('.delete').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            // title: <?= lang('app.graduated?') ?>,
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
                    timer: 1000,
                })
            }
        })
    });
</script>
<?= $this->endsection() ?>