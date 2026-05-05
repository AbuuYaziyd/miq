<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<?php if (session('fn') == 'teacher' || session('fn') == 'mudir' || session('fn') == 'admin') : ?>
    <div class="row">
        <div class="card col-12">
            <div class="card-header">
                <h2><b><?= lang('app.class') ?></b></h2>
            </div>
            <div class="card-content collapse show text-center">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($subject['book'] != null) : ?>
                                <div class="btn-group btn-block">
                                    <a href="<?= base_url($subject['book']) ?>" class="btn btn-warning btn-lg"><?= lang('app.book') ?></a>
                                    <a href="<?= base_url('subject/debook/' . $subject['id']) ?>" class="btn btn-danger btn-lg" id="debook"><?= lang('app.deleteBook') ?></a>
                                </div>
                            <?php else : ?>
                                <?= form_open_multipart('subject/book') ?>
                                <fieldset>
                                    <label><b><?= lang('app.book') ?></b></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="book">
                                        <input type="hidden" name="id" value="<?= $subject['id'] ?>">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-warning mb-1" type="submit"><?= lang('app.submit') ?></button>
                                        </div>
                                    </div>
                                </fieldset>
                                </form>
                            <?php endif ?>
                        </div>
                        <div class="col-md-6">
                            <?php if ($subject['link'] != null) : ?>
                                <div class="btn-group btn-block">
                                    <a href="<?= $subject['link'] ?>" target="_blank" class="btn btn-primary btn-lg"><?= lang('app.link') ?></a>
                                    <a href="<?= base_url('subject/delink/' . $subject['id']) ?>" class="btn btn-danger btn-lg" id="delink"><?= lang('app.deleteLink') ?></a>
                                </div>
                            <?php elseif (session('fn') == 'teacher' || session('fn') == 'mudir' || session('fn') == 'admin') : ?>
                                <?= form_open('subject/link') ?>
                                <fieldset>
                                    <label><b><?= lang('app.link') ?></b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="link" placeholder="<?= lang('app.link') ?>">
                                        <input type="hidden" name="id" value="<?= $subject['id'] ?>">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary mb-1" type="submit"><?= lang('app.submit') ?></button>
                                        </div>
                                    </div>
                                </fieldset>
                                </form>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
<?php else : ?>
    <div class="row">
        <div class="card col-12">
            <div class="card-header">
                <h2><b><?= lang('app.class') ?></b></h2>
            </div>
            <div class="card-content collapse show text-center">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($subject['book'] != null) : ?>
                                <a href="<?= base_url($subject['book']) ?>" class="btn btn-warning btn-lg btn-block"><?= lang('app.book') ?></a>
                            <?php else : ?>
                                <span class="btn btn-outline-warning btn-lg btn-block"><?= lang('app.book') ?></span>
                            <?php endif ?>
                        </div>
                        <div class="col-md-6">
                            <?php if ($subject['link'] != null) : ?>
                                <a href="<?= base_url($subject['link']) ?>" target="_blank" class="btn btn-primary btn-lg btn-block"><?= lang('app.link') ?></a>
                            <?php else : ?>
                                <span class="btn btn-outline-primary btn-lg btn-block"><?= lang('app.book') ?></span>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<script>
    $('#delink').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.sure') ?>',
            text: '<?= lang('app.deleteLink') ?>',
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
</script>

<script>
    $('#debook').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        Swal.fire({
            title: '<?= lang('app.sure') ?>',
            text: '<?= lang('app.deleteLink') ?>',
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
</script>
<?= $this->endSection() ?>
<?= $this->include('layouts/table') ?>