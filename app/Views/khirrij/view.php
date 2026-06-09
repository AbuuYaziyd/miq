<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <?= $this->include('khirrij/info') ?>
    <div class="col-md-6">
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
    <div class="col-xl-6">
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