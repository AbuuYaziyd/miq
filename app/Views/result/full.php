<div class="tab-pane" id="fasl" aria-labelledby="base-fasl">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>
                    <b>
                        <?php if (session('lang') != 'ar') : ?>
                            <?= $user['name'] ?> <?= $user['mname'] ?> <?= $user['lname'] ?>
                        <?php else : ?>
                            <?= $user['name_ar'] ?> <?= $user['mname_ar'] ?> <?= $user['lname_ar'] ?>
                        <?php endif ?>
                    </b>
                    <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('gpa/kashf/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a>
                </h2>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered attendance">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang('app.subject') ?></th>
                                <th><?= lang('app.fasli1') ?></th>
                                <th><?= lang('app.fasli2') ?></th>
                                <th><?= lang('app.marks') ?></th>
                                <th><?= lang('app.grade') ?></th>
                                <th><?= lang('app.taqdir') ?></th>
                            </tr>
                        </thead>
                        <tbody><?php $points = 0;
                                $total = 0 ?>
                            <?php foreach ($sub as $key => $dt) : ?>
                                <?php $mark = $r->mark($class['id'], $user['id'], $dt['subject_id']) ?>
                                <?php $subject = $g->subject($dt['subject_id']) ?>
                                <?php $sum = ($mark['course'] + $mark['final']) / 2 ?>
                                <tr>
                                    <td style="width: 1%;"><?= $key + 1 ?></td>
                                    <td style="width: 15%;">
                                        <?php if (session('lang') != 'ar') : ?>
                                            <?= $subject['name'] ?>
                                        <?php else : ?>
                                            <?= $subject['name_ar'] ?>
                                        <?php endif ?>
                                    </td>
                                    <?php if (session('role') == 'student') : ?>
                                        <?php if ($mark['final_status'] == 'gpa' || $mark['final_status'] == 'marked') : ?>
                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                            <td style="width: 1%;"><?= $mark['final'] ?></td>
                                            <td style="width: 1%;"><?= $sum ?></td>
                                            <td style="width: 1%;"><span class="<?= (($sum) < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                            <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                        <?php elseif ($mark['course_status'] != 'add') : ?>
                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                        <?php else : ?>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 15%;">*</td>
                                        <?php endif ?>
                                    <?php else : ?>
                                        <?php if ($mark['final_status'] == 'gpa' || $mark['final_status'] == 'marked') : ?>
                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                            <td style="width: 1%;"><?= $mark['final'] ?></td>
                                            <td style="width: 1%;"><?= $sum ?></td>
                                            <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                            <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                        <?php elseif ($mark['final_status'] != 'add') : ?>
                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 15%;">*</td>
                                        <?php else : ?>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 15%;">*</td>
                                        <?php endif ?>
                                    <?php endif ?>
                                </tr>
                                <?php $total += $sum ?>
                                <?php $points += $r->grade($sum)['point'] ?>
                            <?php endforeach ?>
                        </tbody>
                    </table><br>
                    <?php if ($mark['final_status'] != null && $msr != null) : ?>
                        <table class="table table-striped table-bordered" style="text-align: center;">
                            <thead>
                                <th><?= lang('app.position') ?></th>
                                <th><?= lang('app.subjects') ?></th>
                                <th><?= lang('app.total') ?></th>
                                <th><?= lang('app.muadalaHuu') ?></th>
                                <th><?= lang('app.masarMuadala') ?></th>
                            </thead>
                            <thead>
                                <th><?= lang('app.fasliy') ?></th>
                                <td><?= $msr['subjects'] ?></td>
                                <td><?= intval($msr['marks']) ?></td>
                                <td><?= $msr['gpa'] ?></td>
                                <?php if (session('lang') != 'ar') : ?>
                                    <td><span style="color:<?= $r->masar(intval($msr['gpa']))['colour'] ?>"><b><?= $r->masar(intval($msr['gpa']))['name'] ?></b></span></td>
                                <?php else : ?>
                                    <td><span style="color:<?= $r->masar(intval($msr['gpa']))['colour'] ?>"><b><?= $r->masar(intval($msr['gpa']))['name_ar'] ?></b></span></td>
                                <?php endif ?>
                            </thead>
                            <thead>
                                <th><?= lang('app.tarakum') ?></th>
                                <?php if ($msr['gpa'] != null) : ?>
                                    <td><b><?= $msr['subjects'] ?></b></td>
                                    <td><b><?= intval($msr['marks']) ?></b></td>
                                    <td><b><?= $msr['gpa'] ?></b></td>
                                    <td><span style="color:<?= $r->masar(intval($msr['gpa']))['colour'] ?>"><b><?= $r->masar(intval($msr['gpa']))['name'] ?></b></span></td>
                                <?php else : ?>
                                    <td><b><?= lang('app.soon') ?></b></td>
                                    <td><b><?= lang('app.soon') ?></b></td>
                                    <td><b><?= lang('app.soon') ?></b></td>
                                    <td><b><?= lang('app.soon') ?></b></td>
                                    <td><b><?= lang('app.soon') ?></b></td>
                                <?php endif ?>
                            </thead>
                        </table>
                        <!-- STUDENT POSITION -->
                        <table class="table table-striped table-bordered" style="text-align: center;">
                            <thead>
                                <th colspan="3"><?= lang('app.hisposition') ?></th>
                                <th colspan="3"><?= lang('app.studentCount') ?></th>
                            </thead>
                            <thead>
                                <?php if ($mark['final_status'] != 'gpa') : ?>
                                    <td colspan="3"><b><?= lang('app.soon') ?></b></td>
                                <?php else : ?>
                                    <td colspan="3"><b><?= $gpa['position'] ?></b></td>
                                <?php endif ?>
                                <td colspan="3"><b><?= $gpa['number_of_students'] ?? $c->stuCount($class['id']) ?></b></td>
                            </thead>
                        </table>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>