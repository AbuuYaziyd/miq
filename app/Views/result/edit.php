<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= lang('app.editResults') ?></b></h3>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <?= form_open('result/change') ?>
                    <table class="table table-hover table-md mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">
                                    <ul>
                                        # - <?= lang('app.fullname') ?>
                                    </ul>
                                </th>
                                <th class="border-top-0"><?= lang('app.result') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-truncate">
                                    <ul>
                                        <a href="<?= base_url('result/user/' . $res['student_id'] . '/' . $res['course_id']) ?>" class="btn btn-primary btn-sm round"><?= $user['username'] ?></a><br>
                                        <?php if (session('lang') != 'ar') : ?>
                                            <?= $user['name'] ?> <?= $user['mname'] ?> <?= $user['lname'] ?>
                                        <?php else : ?>
                                            <?= $user['name_ar'] ?> <?= $user['mname_ar'] ?> <?= $user['lname_ar'] ?>
                                        <?php endif ?>
                                    </ul>
                                </td>
                                <td class="text-truncate">
                                    <input type="text" name="mark" class="form-control" autofocus value="<?= $res[$exam] ?>">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-12 my-2">
                        <input type="hidden" name="id" value="<?= $res['id'] ?>">
                        <input type="hidden" name="exam" value="<?= $exam ?>">
                        <button type="submit" class="btn btn-primary btn-block btn-lg"><?= lang('app.submit') ?></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>