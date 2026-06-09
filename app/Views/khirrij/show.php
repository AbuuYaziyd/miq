<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <?= $this->include('khirrij/info') ?>
    <div class="col-md-4">
        <a href="<?= base_url('attendance/student/' . $stu['id']) ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info"><?= lang('app.attendance') ?></h3>
                                <h6></h6>
                            </div>
                            <div>
                                <i class="icon-calendar info font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= base_url('result/student/' . $stu['id']) ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger"><?= lang('app.results') ?></h3>
                            </div>
                            <div>
                                <i class="icon-bulb danger font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= base_url('certificate/show/' . $stu['id']) ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="teal"><?= lang('app.certificate') ?></h3>
                            </div>
                            <div>
                                <i class="la la-certificate teal font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><b><?= lang('app.khutwa') ?></b></h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse">
                <div class="card-body">
                    <table class="table table-striped table-responsive" style="text-align: center;">
                        <tbody>
                            <?php foreach ($gpa as $key => $dt) : ?>
                                <tr>
                                    <th><?= $c->find($dt['class_id'])['name'] ?></th>
                                    <?php foreach ($c->getSub($dt['class_id']) as $key => $sub) : ?>
                                        <td>
                                            <div class="bs-callout-primary callout-border-left p-1">
                                                <strong><?= $key + 1 ?> <?= $sub['name'] ?></strong><br>
                                                <span class="badge badge-<?= $stu['level'] == $dt['id'] ? 'info' : ($stu['level'] < $dt['id'] ? 'secondary' : 'success') ?> badge-pill"><?= $sub['ramz'] ?></span><br>
                                                <span><?= $s->teacher($sub['teacher_id'])['name_ar'] ?? $s->teacher($sub['id'])['lname'] ?></span>
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