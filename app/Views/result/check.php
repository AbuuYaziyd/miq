<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><b><?= lang('app.results') ?></b></h2>
            </div>
            <?php if ($res) : ?>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dataex-res-constructor">
                            <thead>
                                <tr>
                                    <th><?= lang('app.year') ?></th>
                                    <th><?= lang('app.look') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res as $dt) : ?>
                                    <tr>
                                        <td><?= $yr->year($dt['year_id']) ?></td>
                                        <td>
                                            <a href="<?= base_url('result/year/' . $sub) ?>" class="btn btn-sm btn-purple round float-right"><?= lang('app.look') ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<script>
    $('#marks').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '<?= lang('app.thisYearMarks') ?>',
            text: "<?= lang('app.sureThisYearMarks') ?>",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.yes') ?>',
            cancelButtonText: '<?= lang('app.no') ?>',
        }).then(function(result) {
            if (result.value) {
                document.getElementById('marks_form').submit()
            }
        })
    });
</script>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>