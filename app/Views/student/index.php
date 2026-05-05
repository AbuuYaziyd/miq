<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<?= $this->include('student/info') ?>
<?= $this->include('student/links') ?>
<?= $this->include('student/timetable') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    <b><?= lang('app.khutwa') ?></b>
                    <a class="pull-right" data-action="collapse"><i class="ft-plus"></i></a>
                </h3>
            </div>
            <div class="card-content collapse">
                <div class="card-body">
                    <table class="table table-striped table-responsive" style="text-align: center;">
                        <tbody>
                            <?php foreach ($classes as $key => $dt) : ?>
                                <tr>
                                    <th><?= $dt['name'] ?></th>
                                    <?php foreach ($c->subject($dt['id']) as $key => $sub) : ?>
                                        <td>
                                            <div class="bs-callout-primary callout-border-left p-1">
                                                <strong><?= $sub['name'] ?></strong><br>
                                                <span class="badge badge-<?= $stu['level'] == $dt['id'] ? 'info' : ($stu['level'] < $dt['id'] ? 'secondary' : 'success') ?> badge-pill"><?= $sub['ramz'] ?></span><br>
                                                <?php $tch = $s->teacher($sub['head_id']) ?>
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?php $tch_nm = $tch['name'] . ' ' . $tch['mname'] . ' ' . $tch['lname'] ?>
                                                <?php else : ?>
                                                    <?php $tch_nm = $tch['name_ar'] . ' ' . $tch['mname_ar'] . ' ' . $tch['lname_ar'] ?>
                                                <?php endif ?>
                                                <span><?= $tch_nm ?></span>
                                            </div><br>
                                        </td>
                                    <?php endforeach ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.sure').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            text: '<?= lang('app.surePass') ?> <?= $stu['name_ar'] ?? $stu['name'] . ' ' . $stu['lname'] ?>',
            title: '<?= lang('app.passchange') ?>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>!',
            cancelButtonText: '<?= lang('app.no') ?>!',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            }
        })
    });
</script>
<?= $this->endSection() ?>