<?php
if (session('lang') != 'ar') {
    $name = $user['name'] . ' ' . $user['mname'] . ' ' . $user['lname'];
} else {
    $name = $user['name_ar'] . ' ' . $user['mname_ar'] . ' ' . $user['lname_ar'];
}
?>
<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<?php if ($res) : ?>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill nav-topline justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" id="base-fasl" data-toggle="tab" aria-controls="fasl" href="#fasl" aria-expanded="false"><?= lang('app.acYear') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="base-fasl1" data-toggle="tab" aria-controls="fasl1" href="#fasl1" aria-expanded="true"><?= lang('app.fasli1') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-fasl2" data-toggle="tab" aria-controls="fasl2" href="#fasl2" aria-expanded="false"><?= lang('app.fasli2') ?></a>
                </li>
            </ul>
            <div class="tab-content pt-1 border-grey border-lighten-2 border-0-top">
                <?= $this->include('result/course') ?>
                <?= $this->include('result/final') ?>
                <?= $this->include('result/full') ?>
            </div>
        </div>
    </div>
<?php endif ?>

<script>
    $('#changeCourse').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '<?= lang('app.edit') ?>',
            text: "<?= lang('app.editResults') ?>: <?= $name ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                document.getElementById("change_course").submit()
            }
        })
    });
</script>
<script>
    $('#gpaCourse').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '<?= lang('app.muadalaHuu') ?>',
            text: "<?= lang('app.assignPositions') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                document.getElementById("gpa_form_course").submit()
            }
        })
    });
</script>
<script>
    $('#changeFinal').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '<?= lang('app.edit') ?>',
            text: "<?= lang('app.editResults') ?>: <?= $name ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                document.getElementById("change_final").submit()
            }
        })
    });
</script>
<script>
    $('#gpaFinal').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '<?= lang('app.muadalaHuu') ?>',
            text: "<?= lang('app.positionReg') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                document.getElementById("gpa_form_final").submit()
            }
        })
    });
</script>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>