<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><?= lang('app.students') ?>
                    <a class="btn btn-outline-warning box-shadow-1 round pull-right" href="<?= base_url('students/add/') ?>"><?= lang('app.edit') ?></a>
                    <a class="btn btn-outline-danger box-shadow-1 round pull-right" href="<?= base_url('students/upgrade/') ?>"><?= lang('app.promote') ?></a>
                </h2>
            </div>
            <?php if ($std) : ?>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dataex-res-constructor">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.name') ?></th>
                                    <th><?= lang('app.sex') ?></th>
                                    <th><?= lang('app.date') ?></th>
                                    <th><?= lang('app.city') ?></th>
                                    <th><?= lang('app.phone') ?></th>
                                    <th><?= lang('app.email') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($std as $key => $data) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $data['malaf'] ?></td>
                                        <td><?= ($data['name_ar'] ? $data['name_ar'] : $data['name'] . ' ' . $data['lname']) ?></td>
                                        <td><?= ($data['sex'] = 'M' ? 'ذكر' : 'أنثى') ?></td>
                                        <td><?= $data['dob'] ?></td>
                                        <td><?= $data['city'] ?></td>
                                        <td><a href="tel:/+255<?= $data['phone'] ?>" class="badge badge-secondary">0<?= $data['phone'] ?></a></td>
                                        <td><a href="mailto:/<?= $data['email'] ?>" class="badge bagde-info"><?= $data['email'] ?></a></td>
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
    $('#class').on('click', function(e) {
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
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>