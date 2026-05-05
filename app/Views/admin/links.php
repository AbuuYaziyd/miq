<div class="row">
    <div class="col-xl-3 col-md-6 col-12">
        <a href="<?= base_url('user/profile/' . $user['id']) ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h2 class="teal"><b><?= $user['username'] ?></b></h2>
                                <h6><?= lang('app.profile') ?></h6>
                            </div>
                            <div>
                                <i class="icon-user teal font-large-3 float-righ"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <a href="<?= url_to('student.data') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h2 class="warning"><b><?= $students ?></b></h2>
                                <h6><?= lang('app.students') ?></h6>
                            </div>
                            <div>
                                <i class="icon-users warning font-large-3 float-righ"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <a href="<?= base_url('teacher/data') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h2 class="primary"><b><?= $teachers ?></b></h2>
                                <h6><?= lang('app.teachers') ?></h6>
                            </div>
                            <div>
                                <i class="ft ft-briefcase primary font-large-3 float-righ"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <a href="<?= base_url('school') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h6 class="text-muted"><?= lang('app.schools') ?></h6>
                                <h3><b><?= lang('app.academic') ?></b></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="la la-university black font-large-3 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <a href="<?= base_url('admin/setting') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h6 class="text-muted"><?= lang('app.settings') ?></h6>
                                <h3><b><?= lang('app.settings') ?></b></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="la la-cog spinner pink font-large-3 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <a href="<?= base_url('period') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h6 class="text-muted"><?= lang('app.timetable') ?></h6>
                                <h3><b><?= lang('app.periods') ?></b></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-calendar success font-large-3 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <a href="<?= base_url('fee') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h6 class="text-muted"><?= lang('app.fees') ?></h6>
                                <h3><b><?= lang('app.fees') ?></b></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="la la-credit-card danger font-large-3 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <a href="<?= base_url('result') ?>">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h6 class="text-muted"><?= lang('app.results') ?></h6>
                                <h3><b><?= lang('app.results') ?></b></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="ft ft-bar-chart-2 purple font-large-3 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php if (count($rooms) > 0) : ?>
        <div class="col-xl-3 col-md-6 col-12">
            <a href="<?= base_url('rooms') ?>">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3><b><?= count($rooms) ?></b></h3>
                                    <h6 class="text-muted"><?= lang('app.room') ?></h6>
                                </div>
                                <div class="align-self-center">
                                    <i class="ft ft-airplay pink font-large-3 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif ?>
    <?php if ($attendance) :  ?>
        <div class="col-xl-3 col-md-6 col-12">
            <a href="<?= base_url('attendance') ?>">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="text-muted"><?= lang('app.attendances') ?></h6>
                                    <h3><b><?= lang('app.attendances') ?></b></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="ft ft-check-circle amber font-large-3 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif ?>
</div>
<hr>