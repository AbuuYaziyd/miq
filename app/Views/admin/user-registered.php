<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="content-body">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <b><?= lang('app.userInfo') ?></b>
                        <span class="pull-right"><b><?= date('d-m-Y', strtotime($register['updated_at'])) ?></b></span>
                    </h4>
                </div>
                <div class="card-content mt-1">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th><?= lang('app.subject') ?></th>
                                    <th><?= lang('app.book') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= lang('app.quranHifdh') ?></td>
                                    <td><?= $register['quran_hifdh'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang('app.quran') ?></td>
                                    <td><?= $register['quran'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang('app.fiqh') ?></td>
                                    <td><?= $register['fiqh'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang('app.nahw') ?></td>
                                    <td><?= $register['nahw'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang('app.swarf') ?></td>
                                    <td><?= $register['swarf'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang('app.other') ?></td>
                                    <td><?= $register['other'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-group btn-lg btn-block text-center mr-3">
                        <a href="tel:<?= $register['phone'] ?>" class="btn btn-primary" target="_blank"><i class="ft-phone"></i></a>
                        <a href="https://wa.me/<?= $register['phone'] ?>" class="btn btn-success" target="_blank"><i class="la la-whatsapp"></i></a>
                        <a href="mailto:<?= $register['email'] ?>" class="btn btn-purple" target="_blank"><i class="icon-envelope"></i></a>
                        <a href="sms:<?= $register['phone'] ?>" class="btn btn-info" target="_blank"><i class="la la-comments"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h1 class="display-5">
                            <b><?= strtoupper($register['fname']) ?> <?= strtoupper($register['mname']) ?> <?= strtoupper($register['lname']) ?></b>
                            - <i class="flag-icon flag-icon-<?= strtolower($register['nationality']) ?>"></i>
                            <a href="<?= base_url('admin/register-delete/' . $register['id']) ?>" class="btn btn-danger round pull-right delete"><?= lang('app.delete') ?></a>
                        </h1>
                        <?php
                        $date = new DateTime($register['dob']);
                        $now = new DateTime();
                        $age = $now->diff($date);
                        ?>
                        <span class="text-muted"><?= lang('app.age') ?>: <b><?= $age->y ?></b>,</span>
                        <span class="text-muted"><?= lang('app.dob') ?>: <b><?= date('d/m/Y', strtotime($register['dob'])) ?></b></span>
                        <hr>
                        <?= lang('app.sex') ?>: <b><?= $register['sex'] ?></b>, <?= lang('app.address') ?>: <b><?= strtoupper($register['address']) ?></b>,
                        <hr>
                        <?= lang('app.work') ?>: <b><?= $register['work'] ?></b>
                        <hr>
                        <h3><b><?= lang('app.fees') ?></b>: <b class="pull-right"><?= $register['amount'] ?> /=</b></h3>
                        <hr>
                        <?php if ($register['image'] != null) : ?>
                            <a href="<?= MAOMBI_LINK . '/' . $register['image'] ?>" itemprop="contentUrl" data-size="480x360" target="_blank">
                                <img class="img-thumbnail img-fluid" src="<?= MAOMBI_LINK . '/' . $register['image'] ?>" itemprop="thumbnail" alt="Image description" />
                            </a>
                        <?php else : ?>
                            <a href="<?= base_url('admin/register-delete/' . $register['id']) ?>" class="btn btn-lg btn-danger btn-block delete"><?= lang('app.delete') ?></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($register['amount'] > 0) : ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3><b><?= lang('app.registration') ?></b></h3>
                    </div>
                    <hr>
                    <div class="card-content">
                        <?php $validation = \Config\Services::validation() ?>
                        <?= form_open('admin/register') ?>
                        <div class="row mx-1">
                            <div class="col-12">
                                <label><b><?= lang('app.class') ?></b></label>
                                <fieldset class="form-group">
                                    <select name="level" class="custom-select">
                                        <option selected disabled><?= lang('app.select') ?></option>
                                        <?php foreach ($course as $dt) : ?>
                                            <option value="<?= $dt['id'] ?>" <?= $register['mustawa'] == $dt['id'] ? 'selected' : '' ?>><?= $dt['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </fieldset>
                            </div>
                            <?php $time = $register['amount'] / $fee['amount'] ?>
                            <input type="hidden" name="id" value="<?= $register['id'] ?>">
                            <?php if (isset($user)) : ?>
                                <span class="btn btn-lg btn-outline-black btn-block my-2"><?= lang('app.admit') ?></span>
                            <?php else : ?>
                                <button type="submit" class="btn btn-lg btn-success btn-block my-2"><?= lang('app.admit') ?></button>
                            <?php endif ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php if (isset($user)) : ?>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3><b><?= lang('app.fees') ?></b></h3>
                    </div>
                    <div class="card-content">
                        <?php $validation = \Config\Services::validation() ?>
                        <?= form_open('admin/malipo') ?>
                        <div class="row mx-1">
                            <div class="col-md-6">
                                <label><b><?= lang('app.amount') ?> (<?= lang('app.fees') ?>)</b></label>
                                <fieldset class="form-group">
                                    <input type="text" class="form-control" name="amount" value="<?= $register['amount'] ?>">
                                </fieldset>
                            </div>
                            <?php $time = $register['amount'] / $fee['amount'] ?>
                            <div class="col-md-6">
                                <label><b><?= lang('app.timePeriod') ?> (<?= lang('app.months') ?>)</b></label>
                                <fieldset class="form-group">
                                    <input type="text" class="form-control" value="<?= $time ?>" readonly>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <label><b><?= lang('app.months') ?> (<?= lang('app.fees') ?>)</b></label>
                                <fieldset class="row">
                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                        <div class="col-md-2 col-3">
                                            <input type="checkbox" name="month[]" value="<?= $i ?>" class="chk" id="<?= $i ?>"> <?= date('F', strtotime(date("Y") . "-" . $i . "-01")) ?>
                                        </div>
                                    <?php endfor ?>
                                </fieldset>
                            </div>
                            <input type="hidden" name="image" value="<?= MAOMBI_LINK . '/' . $register['image'] ?>">
                            <input type="hidden" name="id" value="<?= $register['id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="level" value="<?= $user['level'] ?>">
                            <button type="submit" class="btn btn-lg btn-success btn-block my-2"><?= lang('app.submit') ?></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>


<?php if ($register['amount'] > 0) : ?>
    <script>
        var ary = [],
            k = 0;
        document.querySelectorAll(".chk").forEach((element) => {
            element.addEventListener("click", () => {
                let idc = element.id;
                if (document.getElementById(idc).checked == true) {
                    k++;
                    if (k > <?= $time ?>) {
                        document.getElementById(ary[0]).checked = false;
                        ary[0] = ary[1];
                        ary[1] = ary[2];
                        ary[2] = idc;
                        k = <?= $time ?>;
                    } else {
                        ary[k - 1] = idc;
                    }
                } else {
                    k--;
                }
            });
        });
    </script>
<?php endif ?>

<script>
    $('.delete').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.sure') ?>',
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