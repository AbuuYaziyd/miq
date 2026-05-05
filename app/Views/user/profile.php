<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                        <div class="col-12 col-sm-4 p-2">
                        </div>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><?= lang('app.kun_yah') ?>:</td>
                                <td><b><?= $user['kun_yah'] ?></b></td>
                            </tr>
                            <tr>
                                <td><?= lang('app.kun_yah_ar') ?>:</td>
                                <td><b><?= $user['kun_yah_ar'] ?></b></td>
                            </tr>
                            <tr>
                                <td><?= lang('app.fullName') ?>:</td>
                                <td class="users-view-name"><b><?= $user['name'] . ' ' . $user['mname'] . ' ' . $user['lname'] ?></b></td>
                            </tr>
                            <tr>
                                <td><?= lang('app.fullName_ar') ?>:</td>
                                <td class="users-view-name"><b><?= $user['name_ar'] . ' ' . $user['mname_ar'] . ' ' . $user['lname_ar'] ?></b></td>
                            </tr>
                            <tr>
                                <td><?= lang('app.username') ?>:</td>
                                <td class="users-view-name"><b><?= $user['username'] ?></b></td>
                            </tr>
                            <tr>
                                <td><?= lang('app.email') ?>:</td>
                                <td><a href="mailto:<?= $user['email'] ?>" class="btn btn-outline-blue btn-sm round"><b><?= $user['email'] ?></b></a></td>
                            </tr>
                            <tr>
                                <td><?= lang('app.phone') ?>:</td>
                                <td><a href="tel:+255<?= $user['phone'] ?>" class="btn btn-outline-primary btn-sm round"><b><?= '+' . $user['phone'] ?></b></a></td>
                            </tr>
                            <tr>
                                <?php if ($user['role'] == 'student') : ?>
                                    <td><?= lang('app.academicLevel') ?>:</td>
                                    <td><b><?= ($user['level'] == null ? lang('app.notFound') : $course['name']) ?></b></td>
                                <?php else : ?>
                                    <td><?= lang('app.academicLevel') ?>:</td>
                                    <td><b><?= ($user['level'] == null ? lang('app.notFound') : lang('app.' . $user['level'])) ?></b></td>
                                <?php endif ?>
                            </tr>
                            <tr>
                                <td><?= lang('app.status') ?>:</td>
                                <td><b><?= lang('app.muntadhim') ?></b></td>
                            </tr>
                            <tr>
                                <td><?= lang('app.dob') ?>:</td>
                                <td><b><?= $user['dob'] ?></b></td>
                            </tr>
                            <tr>
                                <td><?= lang('app.sex') ?>:</td>
                                <td><b><?= $user['sex'] == 'M' ? lang('app.male') : lang('app.female') ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="<?= base_url('user/show/' . $user['id']) ?>" class="btn btn-lg btn-block btn-primary mt-2"><?= lang('app.edit') ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <div class="media mb-2">
                            <label class="mr-1" for="picha">
                                <img src="<?= $user['avatar'] != null ? base_url($user['avatar']) : base_url('app-assets/images/avatar/av.png') ?>" alt="avatar" id="img" class="users-avatar-shadow rounded-circle" height="250" width="250">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<?= $this->endSection() ?>