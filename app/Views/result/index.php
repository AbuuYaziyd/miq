<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<?php if (session('role') == 'admin') : ?>
    <div class="row">
        <?php if ($course != null) : ?>
            <div class="col-md-6 mb-1">
                <?php if ($course['course_status'] == 'gpa' || $course['course_status'] == 'edit') : ?>
                    <a href="<?= base_url('result/course/calculation') ?>" class="btn btn-success pull-right btn-lg btn-block"><?= lang('app.openResults') ?> | <?= lang('app.fasli1') ?></a>
                <?php elseif ($course['course_status'] == null) : ?>
                    <a href="<?= base_url('result/course/add') ?>" class="btn btn-danger pull-right btn-lg btn-block open"><?= lang('app.results') ?> | <?= lang('app.fasli1') ?></a>
                <?php else : ?>
                    <a href="<?= base_url('result/course/calculation') ?>" class="btn btn-teal pull-right btn-lg btn-block"><?= lang('app.results') ?> | <?= lang('app.fasli1') ?></a>
                <?php endif ?>
            </div>
            <div class="col-md-6 mb-1">
                <?php if ($final['final_status'] == 'gpa' || $final['final_status'] == 'edit') : ?>
                    <a href="<?= base_url('result/final/calculation') ?>" class="btn btn-success pull-right btn-lg btn-block"><?= lang('app.openResults') ?> | <?= lang('app.fasli2') ?></a>
                <?php elseif ($final['final_status'] == null) : ?>
                    <a href="<?= base_url('result/final/add') ?>" class="btn btn-danger pull-right btn-lg btn-block open"><?= lang('app.results') ?> | <?= lang('app.fasli2') ?></a>
                <?php else : ?>
                    <a href="<?= base_url('result/final/calculation') ?>" class="btn btn-teal pull-right btn-lg btn-block "><?= lang('app.results') ?> | <?= lang('app.fasli2') ?></a>
                <?php endif ?>
            </div>
        <?php else : ?>
            <a href="<?= base_url('result/open') ?>" class="btn btn-blue pull-right btn-lg btn-block result"><?= lang('app.openResults') ?></a>
        <?php endif ?>
    </div>
    <hr>
<?php endif ?>
<?php if (count($all_years) >= 1) : ?>
    <div class="row">
        <?php foreach ($all_years as $y) : ?>
            <div class="col-md-6">
                <div class="card" data-height="">
                    <div class="card-header">
                        <h3><b> <?= lang('app.year') ?>: <?= $yr->year($y['year_id']) ?></b> <a data-action="collapse"><i class="ft-plus pull-right"></i></a></h3>
                    </div>
                    <div class="card-content collapse">
                        <div class="card-body text-center">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= lang('app.course') ?></th>
                                            <th><?= lang('app.fasli1') ?></th>
                                            <th><?= lang('app.fasli2') ?></th>
                                            <th><?= lang('app.year') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($crs->result($y['year_id']) as $cl) : ?>
                                            <tr>
                                                <td>
                                                    <?php if (session('lang') != 'ar') : ?>
                                                        <?= $crs->course($cl['course_id'])['name'] ?>
                                                    <?php else : ?>
                                                        <?= $crs->course($cl['course_id'])['name_ar'] ?>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <?php if ($crs->checkGPA($cl['course_id'], $y['year_id'], 'course') >= 1) : ?>
                                                        <a href="<?= base_url('result/course/show/' . $cl['course_id'] . '/' . $y['year_id']) ?>" class="btn btn-primary round"><?= lang('app.view') ?></a>
                                                    <?php else : ?>
                                                        <span class="btn btn-outline-primary round"><?= lang('app.view') ?></span>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <?php if ($crs->checkGPA($cl['course_id'], $y['year_id'], 'final') >= 1) : ?>
                                                        <a href="<?= base_url('result/final/show/' . $cl['course_id'] . '/' . $y['year_id']) ?>" class="btn btn-info round"><?= lang('app.view') ?></a>
                                                    <?php else : ?>
                                                        <span class="btn btn-outline-info round"><?= lang('app.view') ?></span>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <?php if ($crs->checkGPA($cl['course_id'], $y['year_id'], 'final') >= 1) : ?>
                                                        <a href="<?= base_url('result/all/' . $cl['course_id'] . '/' . $y['year_id']) ?>" class="btn btn-pink round"><?= lang('app.view') ?></a>
                                                    <?php else : ?>
                                                        <span class="btn btn-outline-pink round"><?= lang('app.view') ?></span>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<script>
    $('.result').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.allStudentPresent') ?>',
            text: '<?= lang('app.allStudentsNotInClassMarksWillBeNulled') ?>',
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

    $('.open').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.openResults') ?>',
            text: '<?= lang('app.allStudentsNotInClassMarksWillBeNulled') ?>',
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

    $('#done').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: 'هل تم ادخال النتائج وتصحيحها؟',
            text: "بعد ارسال لا يمكنكم تصحيح النتائج!",
            icon: 'info',
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery(document).on('change', 'select#class', function(e) {
        e.preventDefault();
        var school_id = jQuery(this).val();
        getClassList(school_id);

    });

    jQuery(document).on('change', 'select#sub', function(e) {
        e.preventDefault();
        var class_id = jQuery(this).val();
        getSubList(class_id);

    });

    function getClassList(school_id) {
        $.ajax({
            url: '<?= base_url('result/getClass') ?>',
            type: 'post',
            data: {
                school_id: school_id,
            },
            dataType: 'json',
            beforeSend: function() {
                jQuery('select#sub').find("option:eq(0)").html("بالهدو...");
            },
            success: function(json) {
                var options = '';
                options += '<option selected disabled><?= lang('app.className') ?></option>';
                for (var i = 0; i < json.length; i++) {
                    options += '<option value="' + json[i].id + '">' + json[i].name + '</option>';
                }
                jQuery("select#sub").html(options);

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    };

    function getSubList(class_id) {
        $.ajax({
            url: '<?= base_url('result/getSub') ?>',
            type: 'post',
            data: {
                class_id: class_id,
            },
            dataType: 'json',
            beforeSend: function() {
                jQuery('select#subId').find("option:eq(0)").html("بالهدو...");
            },
            success: function(json) {
                var options = '';
                options += '<option selected disabled><?= lang('app.subName') ?></option>';
                for (var i = 0; i < json.length; i++) {
                    options += '<option value="' + json[i].id + '">' + json[i].name + ' - (' + json[i].ramz + ')</option>';
                }
                jQuery("select#subId").html(options);

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
</script>
<?= $this->endSection() ?>