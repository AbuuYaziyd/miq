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
                                            <th><?= lang('app.malaf') ?></th>
                                            <th><?= lang('app.fullName') ?></th>
                                            <th><?= lang('app.sex') ?></th>
                                            <th><?= lang('app.dob') ?></th>
                                            <th><?= lang('app.level') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="<?= base_url('user/profile/' . $user['id']) ?>" class="btn btn-outline-info round btn-sm"><?= $user['username'] ?></a></td>
                                            <td><?= $user['name_ar'] ?? $user['name'] . ' ' . $user['lname'] ?></td>
                                            <td><?= $user['sex'] != 'M' ? lang('app.female') : lang('app.male') ?></td>
                                            <?php if ($user['dob'] != null) : ?>
                                                <td><?= date('d-m-Y', strtotime($user['dob'])) ?></td>
                                            <?php else : ?>
                                                <td>-</td>
                                            <?php endif ?>
                                            <td><span class="btn btn-sm btn-outline-teal round"><?= $class['name'] ?? '---' ?></span></td>
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
    <div class="col-md-8">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h3 class="text-center"><b><?= lang('app.reasonMafsul') ?></b></h3>
                    <hr>
                    <?= form_open_multipart('mafsul/update') ?>
                    <div class="col-12">
                        <label for=""><?= lang('app.addReason') ?>:</label>
                        <input type="text" class="form-control" value="<?= $mafsul['reason'] ?>" name="reason"><br>
                        <label for=""><?= lang('app.addInfoMafsul') ?>:</label>
                        <textarea name="info" id="" cols="30" rows="10" class="form-control mb-1"><?= $mafsul['info'] ?></textarea>
                        <label for=""><?= lang('app.addMalaf') ?>:</label>
                        <input type="file" name="file" class="form-control">
                        <input type="hidden" name="student_id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="id" value="<?= $mafsul['id'] ?>">
                        <input type="hidden" name="class_id" value="<?= $user['level'] ?>">
                        <input type="button" id="sure" value="<?= lang('app.send') ?>" class="btn btn-lg btn-primary btn-block btn-lg my-2">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <div class="media">
                            <img src="<?= $user['image'] != null ? base_url($user['image']) : 'https://ui-avatars.com/api/?name=' . ($user['name_ar'] ?? $user['lname']) . '&background=random&length=1&font-size=1' ?>" alt="avatar" id="img" class="users-avatar-shadow rounded-circle" height="250" width="250">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('form #sure').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: '<?= lang('app.returnSchool') ?>',
            text: '<?= lang('app.returnSchoolReally') ?>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<?= lang('app.yes') ?>!',
            cancelButtonText: '<?= lang('app.no') ?>!',
        }).then(function(result) {
            if (result.value) {
                form.submit();
            }
        })
    });
</script>
<?= $this->endSection() ?>