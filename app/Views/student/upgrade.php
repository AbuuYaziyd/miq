<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3><b><?= $title ?> - <?= session('lang') != 'ar' ? $class['name'] : $class['name_ar'] ?></b>
                    <a class="btn btn-outline-pink box-shadow-1 round pull-right" href="<?= base_url('course/settings/' . $class['id']) ?>"><?= lang('app.back') ?></a>
                </h3>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <?= form_open('student/edit/' . $class['id']) ?>
                            <table id="recent-orders" class="table table-hover table-xl mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 10%;"><?= lang('app.malaf') ?></th>
                                        <th><?= lang('app.name') ?></th>
                                        <th><?= lang('app.choose') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stu as $stuKey => $data) : ?>
                                        <tr>
                                            <td><?= $stuKey + 1 ?></td>
                                            <input type="hidden" name="id[]" value="<?= $data['id'] ?>">
                                            <td><a href="<?= base_url('students/info/' . $data['id']) ?>" target="_blank"><span class="btn btn-outline-info btn-sm round"><?= $data['username'] ?></span></a></td>
                                            <td>
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $data['name'] ?> <?= $data['mname'] ?> <?= $data['lname'] ?>
                                                <?php else : ?>
                                                    <?= $data['name_ar'] ?> <?= $data['mname_ar'] ?> <?= $data['lname_ar'] ?>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <select class="custom-select form-control" name="level<?= $stuKey ?>">
                                                    <?php foreach ($drs as $key => $dt) : ?>
                                                            <option value="<?= $dt['id'] ?>" <?= $dt['id'] == $next ? 'selected' : '' ?>>
                                                                <?php if (session('lang') != 'ar') : ?>
                                                                    <?= $dt['name'] ?>
                                                                <?php else : ?>
                                                                    <?= $dt['name_ar'] ?>
                                                                <?php endif ?>
                                                            </option>
                                                    <?php endforeach ?>
                                                    <option value="graduate" <?= $next == (count($drs) + 1) ? 'selected' : '' ?>><?= lang('app.graduates') ?></option>
                                                    <option value="masfsul"><?= lang('app.mafsul') ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td colspan="3"><b><?= lang('app.promote') ?></b></td>
                                        <td>
                                            <button type="submit" class="btn btn-warning btn-block round"><?= lang('app.promote') ?></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#check').click(function(event) {
        var $that = $(this);
        $(':checkbox').each(function() {
            this.checked = $that.is(':checked');
        });
    });

    function save() {
        document.getElementById('form').submit();
    }
</script>
<?= $this->endSection() ?>