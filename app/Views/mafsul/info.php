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
                                        <?php if (session('role') == 'admin') : ?>
                                            <th><?= lang('app.returnSchool') ?></th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= base_url('user/profile/' . $stu['id']) ?>" class="btn btn-outline-info round btn-sm"><?= $stu['username'] ?></a></td>
                                        <td><?= $stu['name_ar'] ?? $stu['name'] . ' ' . $stu['lname'] ?></td>
                                        <td><?= $stu['sex'] != 'M' ? lang('app.female') : lang('app.male') ?></td>
                                        <?php if ($stu['dob'] != null) : ?>
                                            <td><?= date('d-m-Y', strtotime($stu['dob'])) ?></td>
                                        <?php else : ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <td><span class="btn btn-sm btn-teal round"><?= $class['name'] ?? '---' ?></span></td>
                                        <?php if (session('role') == 'admin') : ?>
                                            <td><a href="<?= base_url('mafsul/back/' . $mafsul['id']) ?>" class="btn btn-info round btn-sm"><?= lang('app.returnSchool') ?></a></td>
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