<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                        <div class="col-12 p-2"></div>
                    </div>
                    <hr>
                    <?= form_open('user/update') ?>
                    <div class="row mx-1">
                        <fieldset class="col-md-4 mb-1">
                            <label><b><?= lang('app.username') ?>:</b></label>
                            <input type="text" class="form-control" value="<?= $user['username'] ?>" readonly>
                        </fieldset>
                        <fieldset class="col-md-4 mb-1">
                            <label><b><?= lang('app.email') ?>:</b></label>
                            <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>"><br>
                        </fieldset>
                        <fieldset class="col-md-4 mb-1">
                            <label><b><?= lang('app.nationality') ?>:</b></label>
                            <select name="show" class="custom-select">
                                <?php foreach ($nat as $nt) : ?>
                                    <option value="<?= $nt['code'] ?>" <?= $nt['code'] == $user['nationality'] ? 'selected' : '' ?>>
                                        <?php if (session('lang') != 'ar') : ?>
                                            <?= $nt['nationality_en'] ?>
                                        <?php else : ?>
                                            <?= $nt['nationality_ar'] ?>
                                        <?php endif ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <label><b><?= lang('app.fname') ?>:</b></label>
                            <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>"><br>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <label><b><?= lang('app.mname') ?>:</b></label>
                            <input type="text" class="form-control" name="mname" value="<?= $user['mname'] ?>"><br>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <label><b><?= lang('app.lname') ?>:</b></label>
                            <input type="text" class="form-control" name="lname" value="<?= $user['lname'] ?>"><br>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <label><b><?= lang('app.fname_ar') ?>:</b></label>
                            <input type="text" class="form-control" name="name_ar" value="<?= $user['name_ar'] ?>"><br>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <label><b><?= lang('app.mname_ar') ?>:</b></label>
                            <input type="text" class="form-control" name="mname_ar" value="<?= $user['mname_ar'] ?>"><br>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <label><b><?= lang('app.lname_ar') ?>:</b></label>
                            <input type="text" class="form-control" name="lname_ar" value="<?= $user['lname_ar'] ?>"><br>
                        </fieldset>
                        <fieldset class="col-md-4 mb-1">
                            <label><b><?= lang('app.sex') ?>:</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="radio" name="sex" <?= $user['sex'] == 'M' ? 'checked' : '' ?> value="M"> <?= lang('app.male') ?>
                                </div>
                                <div class="col-6">
                                    <input type="radio" name="sex" <?= $user['sex'] == 'F' ? 'checked' : '' ?> value="F"> <?= lang('app.female') ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="col-md-4 mb-1">
                            <label><b><?= lang('app.kun_yah') ?>:</b></label>
                            <input type="text" class="form-control" name="kun_yah" value="<?= $user['kun_yah'] ?>" placeholder="<?= lang('app.kun_yah') ?>">
                        </fieldset>
                        <fieldset class="col-md-4 mb-1">
                            <label><b><?= lang('app.kun_yah_ar') ?>:</b></label>
                            <input type="text" class="form-control" name="kun_yah_ar" value="<?= $user['kun_yah_ar'] ?>" placeholder="<?= lang('app.kun_yah_ar') ?>">
                        </fieldset>
                        <fieldset class="col-md-4 mb-1">
                            <label><b><?= lang('app.dob') ?>:</b></label>
                            <input type="date" class="form-control" name="dob" value="<?= date('Y-m-d', strtotime($user['dob'])) ?>">
                        </fieldset>
                        <fieldset class="col-md-4 mb-1">
                            <label><b><?= lang('app.phone') ?>:</b></label>
                            <div class="input-group">
                                <?php if (session('lang') != 'ar') : ?>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+</span>
                                    </div>
                                    <input type="text" class="form-control" name="phone" value="<?= $user['phone'] ?>">
                                <?php else : ?>
                                    <input type="text" class="form-control" name="phone" value="<?= $user['phone'] ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">+</span>
                                    </div>
                                <?php endif ?>
                            </div>
                        </fieldset>
                        <?php if (session('role') != 'student') : ?>
                            <fieldset class="col-md-4 mb-1">
                                <label><b><?= lang('app.showOnWeb') ?>:</b></label>
                                <select name="show" class="custom-select">
                                    <option value="showOnWeb"><?= lang('app.showOnWeb') ?></option>
                                    <option value="dontShow"><?= lang('app.dontShow') ?></option>
                                </select>
                            </fieldset>
                        <?php endif ?>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <button type="submit" class="btn btn-lg btn-block btn-secondary mt-2"><?= lang('app.submit') ?></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if (session('role') == 'admin') : ?>
        <!-- <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <?php if ($user['avatar'] != null) : ?>
                            <a href="<?= base_url('user/delete-image/' . $user['id']) ?>" class="btn btn-block btn-outline-danger mb-1 btn-lg" id="delete"><?= lang('app.delete') ?></a>
                        <?php endif ?>
                        <div class="col-12">
                            <?= form_open_multipart('user/image') ?>
                            <div class="media mb-2">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <input type="file" name="avatar" id="picha" onchange="readURL(this)" style="display: none;">
                                <label class="mr-1" for="picha">
                                    <img src="<?= $user['avatar'] != null ? base_url($user['avatar']) : base_url('app-assets/images/avatar/av.png') ?>" alt="avatar" id="img" class="users-avatar-shadow rounded-circle" height="250" width="250">
                                </label>
                            </div>
                            <button type="submit" class="btn btn-lg btn-block btn-secondary mt-2"><?= lang('app.submit') ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <?php endif ?>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector("#img").setAttribute("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $('#delete').on('click', function(e) {
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