<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th><?= lang('app.username') ?></th>
                                            <th><?= lang('app.kun_yah') ?></th>
                                            <th><?= lang('app.fullName') ?></th>
                                            <?php if (session('role') == 'admin') : ?>
                                                <th><?= lang('app.age') ?></th>
                                                <th><?= lang('app.academicLevel') ?></th>
                                                <th><?= lang('app.edit') ?></th>
                                                <th><?= lang('app.passchange') ?></th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php if (session('role') != 'admin') : ?>
                                                <td><span class="btn btn-outline-<?= $user['sex'] != 'M' ? 'pink' : 'info' ?> round btn-sm"><?= $user['username'] ?></span></td>
                                            <?php else : ?>
                                                <td><a href="<?= base_url('user/profile/' . $user['id']) ?>" class="btn btn-outline-<?= $user['sex'] != 'M' ? 'pink' : 'info' ?> round btn-sm"><?= $user['username'] ?></a></td>
                                            <?php endif ?>
                                            <?php if (session('lang') != 'ar') : ?>
                                                <?php $name = $user['name'] . ' ' . $user['mname'] . ' ' . $user['lname'] ?>
                                                <?php $kun = $user['kun_yah'] ?>
                                            <?php else : ?>
                                                <?php $name = $user['name_ar'] . ' ' . $user['mname_ar'] . ' ' . $user['lname_ar'] ?>
                                                <?php $kun = $user['kun_yah_ar'] ?>
                                            <?php endif ?>
                                            <td><?= $kun ?? lang('app.notFound') ?></td>
                                            <td><?= $name ?></td>
                                            <?php if (session('role') == 'admin') : ?>
                                                <?php if ($user['dob'] != null) : ?>
                                                    <?php $now = new DateTime() ?>
                                                    <?php $date = new DateTime($user['dob']) ?>
                                                    <?php $dob = $now->diff($date) ?>
                                                    <td><?= $dob->y ?></td>
                                                <?php else : ?>
                                                    <td>-</td>
                                                <?php endif ?>
                                                <td><span class="btn btn-sm btn-teal round"><?= $user['level'] != null ? lang('app.' . $user['level']) : '---' ?></span></td>
                                                <td><a href="<?= base_url('teacher/edit/' . $user['id']) ?>" class="btn btn-sm btn-outline-warning round"><?= lang('app.edit') ?></a></td>
                                                <td><a href="<?= base_url('user/forgot-password/' . $user['id']) ?>" class="btn btn-danger round btn-sm sure"><?= lang('app.passchange') ?></a></td>
                                            <?php endif ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($sub as $dt) : ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4><b><?= $dt['name'] ?></b><a href="<?= base_url('subject/show/' . $dt['id']) ?>" class="btn btn-sm btn-warning round float-right"><?= lang('app.open') ?></a></h4>
                    </div>
                    <li class="list-group-item">
                        <span class="btn btn-sm round btn-outline-pink float-right"><?= $dt['ramz'] ?></span><?= lang('app.ramz') ?>
                    </li>
                    <li class="list-group-item">
                        <span class="btn btn-sm round btn-outline-danger float-right"><?= $s->course($dt['course_id'])['name'] ?></span><?= lang('app.course') ?>
                    </li>
                    <div class="card-body">
                        <?php $tch = $s->teacher($dt['head_id']) ?>
                        <?php if (session('lang') != 'ar') : ?>
                            <?php $tch_nm = $tch['name'] . ' ' . $tch['mname'] . ' ' . $tch['lname'] ?>
                        <?php else : ?>
                            <?php $tch_nm = $tch['name_ar'] . ' ' . $tch['mname_ar'] . ' ' . $tch['lname_ar'] ?>
                        <?php endif ?>
                        <span class="btn btn-sm round btn<?= $dt['head_id'] != session('id') ? '-outline' : '' ?>-blue float-right"><?= $tch_nm ?></span><?= lang('app.teacher') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<script>
    $('.sure').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            text: '<?= lang('app.passchangeof') ?><?= $name ?>',
            title: "<?= lang('app.passchange') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
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