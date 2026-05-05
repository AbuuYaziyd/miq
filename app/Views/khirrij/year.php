<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2><b><?= $title ?></b>
                    <select name="year" class="custom-select col-8 pull-right" id="year_select">
                        <option value="<?= base_url('khirrij') ?>" selected><?= lang('app.choose') ?></option>
                        <?php foreach ($yr as $y) : ?>
                            <option value="<?= base_url('khirrij/year/' . $y['year_id']) ?>" <?= $yr_id == $y['year_id'] ? 'selected' : '' ?>><?= $k->year($y['year_id'])['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </h2>
            </div>
            <?php if ($std) : ?>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dataex-res-constructor">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('app.malaf') ?></th>
                                    <th><?= lang('app.name') ?></th>
                                    <th><?= lang('app.phone') ?></th>
                                    <th><?= lang('app.email') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($std as $key => $data) : ?>
                                    <tr>
                                        <?php $usr = $k->kh($data['student_id']) ?>
                                        <td><?= $key + 1 ?></td>
                                        <td><a href="<?= base_url('khirrij/show/' . $usr['id']) ?>" ><?= $usr['malaf'] ?></a></td>
                                        <td><?= ($usr['name_ar'] ? $usr['name_ar'] : $usr['name'] . ' ' . $usr['lname']) ?></td>
                                        <td><a href="tel:+255<?= $usr['phone'] ?>" class="badge badge-secondary">0<?= $usr['phone'] ?></a></td>
                                        <td><a href="mailto:<?= $usr['email'] ?>" class="badge bagde-info"><?= $usr['email'] ?? lang('app.notFound') ?></a></td>
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
<?= $this->include('layouts/table') ?>
<script>
    $(function() {
        // bind change event to select
        $('#year_select').on('change', function() {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });
</script>
<script>
    $('.delete').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            // title: <?= lang('app.graduated?') ?>,
            title: 'حقيقة تريد الحذف؟',
            text: "بعد الحذف خلاص فهو محذوف!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم!',
            cancelButtonText: 'لا!',
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'تمام',
                    text: 'ما حذفنا شيء :)',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000,
                })
            }
        })
    });
</script>
<?= $this->endsection() ?>