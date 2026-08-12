<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-2 text-center"><b><?= lang('app.marks') ?></b></h3>
            </div>
            <div class="card-body">
                <?php foreach ($schools as $key => $sc) : ?>
                    <?php if ($sch->course($sc['id']) != null) : ?>
                        <h1>
                            <b>
                                <?php if (session('lang') != 'ar') : ?>
                                    <?= $sc['name'] ?>
                                <?php else : ?>
                                    <?= $sc['name_ar'] ?>
                                <?php endif ?>
                            </b>
                        </h1>
                        <hr>
                        <div class="row">
                            <?php foreach ($sch->course($sc['id']) as $key => $dt) : ?>
                                <?php $students = $sub->stuCount($dt['id']) ?>
                                <?php if ($crs->stuCount($dt['id']) >= 1) : ?>
                                    <div class="col-md-<?= count($sch->course($sc['id'])) == 2 ? 6 : (count($sch->course($sc['id'])) == 4 ? 6 : 4) ?> mb-1">
                                        <?php if ($crs->checkGPA($dt['id'], $year['id'], $exam)) : ?>
                                            <a href="<?= base_url('result/' . $exam . '/show/' . $dt['id'] . '/' . $year['id']) ?>" class="btn btn-purple btn-lg btn-block mb-1">
                                                <?= lang('app.results') ?> -
                                                <?php if (session('lang') != 'ar') : ?>
                                                    <?= $dt['name'] ?>
                                                <?php else : ?>
                                                    <?= $dt['name_ar'] ?>
                                                <?php endif ?>
                                            </a>
                                        <?php else : ?>
                                            <?php $calc = false ?>
                                            <?php $no = 0 ?>
                                            <?php foreach ($sub->where('course_id', $dt['id'])->findAll() as $key => $sb) : ?>
                                                <?php $done = $sub->done($sb['id']) ?>
                                                <?php if ($done[$exam] == $students) : ?>
                                                    <span href="<?= base_url('result/' . $exam . '/marks/' . $sb['id']) ?>" class="btn btn-success round mb-1">
                                                        <?php if (session('lang') != 'ar') : ?>
                                                            <?= $sb['name'] ?>
                                                        <?php else : ?>
                                                            <?= $sb['name_ar'] ?>
                                                        <?php endif ?>
                                                    </span>
                                                    <?php $calc = true ?>
                                                    <?php $no = $no + 1 ?>
                                                <?php elseif ($done[$exam . '_mark'] == $students) : ?>
                                                    <a href="<?= base_url('result/' . $exam . '/marks/' . $sb['id']) ?>" class="btn btn-outline-success round mb-1">
                                                        <?php if (session('lang') != 'ar') : ?>
                                                            <?= $sb['name'] ?>
                                                        <?php else : ?>
                                                            <?= $sb['name_ar'] ?>
                                                        <?php endif ?></a>
                                                <?php else : ?>
                                                    <?php if ($done['mark'] == 0) : ?>
                                                        <a href="<?= base_url('result/add-subject-marks/' . $sb['id']) ?>" class="btn btn-outline-purple round mb-1 sure">
                                                            <?php if (session('lang') != 'ar') : ?>
                                                                <?= $sb['name'] ?>
                                                            <?php else : ?>
                                                                <?= $sb['name_ar'] ?>
                                                            <?php endif ?>
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="<?= base_url('result/' . $exam . '/marks/' . $sb['id']) ?>" class="btn btn-danger round mb-1">
                                                            <?php if (session('lang') != 'ar') : ?>
                                                                <?= $sb['name'] ?>
                                                            <?php else : ?>
                                                                <?= $sb['name_ar'] ?>
                                                            <?php endif ?>
                                                        </a>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                            <?php if ($no != $sub->where('course_id', $dt['id'])->countAllResults()) : ?>
                                                <span class="btn btn-outline-danger btn-lg btn-block mb-1">
                                                    <?php if (session('lang') != 'ar') : ?>
                                                        <?= $dt['name'] ?>
                                                    <?php else : ?>
                                                        <?= $dt['name_ar'] ?>
                                                    <?php endif ?>
                                                </span>
                                            <?php else : ?>
                                                <a href="<?= base_url('result/' . $exam . '/gpa/' . $dt['id']) ?>" class="btn btn-outline-success btn-lg btn-block mb-1">
                                                    <?php if (session('lang') != 'ar') : ?>
                                                        <?= $dt['name'] ?>
                                                    <?php else : ?>
                                                        <?= $dt['name_ar'] ?>
                                                    <?php endif ?>
                                                </a>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <div class="modal fade text-left" id="btn<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <?php foreach ($sub->where('course_id', $dt['id'])->findAll() as $key => $sb) : ?>
                                                    <a href="<?= base_url('subject/show/' . $sb['id']) ?>" target="_blank" class="btn btn-outline-dark round mb-1 subjects delete "><?= $sb['name'] ?></a>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <hr>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>