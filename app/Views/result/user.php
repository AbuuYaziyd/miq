<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<?php if ($res) : ?>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill nav-topline justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" id="base-fasl1" data-toggle="tab" aria-controls="fasl1" href="#fasl1" aria-expanded="true"><?= lang('app.fasli1') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-fasl2" data-toggle="tab" aria-controls="fasl2" href="#fasl2" aria-expanded="false"><?= lang('app.fasli2') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-fasl" data-toggle="tab" aria-controls="fasl" href="#fasl" aria-expanded="false"><?= lang('app.acYear') ?></a>
                </li>
            </ul>
            <div class="tab-content pt-1 border-grey border-lighten-2 border-0-top">
                <div role="tabpanel" class="tab-pane active" id="fasl1" aria-expanded="true" aria-labelledby="base-fasl1">
                    <div class="col-12">
                        <?php if ((session('role') == 'admin') && $gpa != null) : ?>
                            <?php if ($res[0]['course_status'] != null && $res[0]['course_status'] != 'edit') : ?>
                                <?= form_open('result/change-course', ['id' => 'change_course']) ?>
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="course_id" value="<?= $gpa['course_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-lg m-2" id="changeCourse"><?= lang('app.edit') ?></button>
                                </form>
                            <?php else : ?>
                                <?= form_open('print/edit-course', ['id' => 'gpa_form_course']) ?>
                                <input type="hidden" name="gpa_id" value="<?= $gpa['id'] ?>">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="course_id" value="<?= $gpa['course_id'] ?>">
                                <button type="submit" class="btn btn-purple btn-lg mb-1" id="gpaCourse"><?= lang('app.muadalaHuu') ?></button>
                                </form>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2><b><?= $user['name_ar'] ?? $user['name'] . ' ' . $user['lname'] ?></b>
                                    <?php if (session('role') == 'admin' || session('level') == 4) : ?>
                                        <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('print/kashf-darajat/course/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a>
                                    <?php elseif ($res[0]['course_status'] == 'done') : ?>
                                        <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('print/kashf-darajat/course/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a>
                                    <?php endif ?>
                                </h2>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table table-striped table-bordered attendance">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?= lang('app.subject') ?></th>
                                                <th><?= lang('app.mark') ?></th>
                                                <th><?= lang('app.grade') ?></th>
                                                <th><?= lang('app.taqdir') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0 ?>
                                            <?php foreach ($sub as $key => $dt) : ?>
                                                <?php $mark = $r->mark($class['id'], $user['id'], $dt['subject_id']) ?>
                                                <?php $subject = $g->subject($dt['subject_id']) ?>
                                                <?php $sum = $mark['course'] * 2 ?? 0 ?>
                                                <tr>
                                                    <td style="width: 1%;"><?= $key + 1 ?></td>
                                                    <td style="width: 15%;"><?= $subject['name'] ?></td>
                                                    <?php if (session('role') == 'student') : ?>
                                                        <?php if ($mark['course_status'] == null) : ?>
                                                            <td style="width: 1%;">*</td>
                                                            <td style="width: 1%;">*</td>
                                                            <td style="width: 15%;">*</td>
                                                        <?php else : ?>
                                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                                            <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                            <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                                        <?php endif ?>
                                                    <?php else : ?>
                                                        <?php if ($mark['course_status'] == null) : ?>
                                                            <td style="width: 1%;">*</td>
                                                            <td style="width: 1%;">*</td>
                                                            <td style="width: 15%;">*</td>
                                                        <?php elseif ($mark['course_status'] == 'marked' || $mark['course_status'] == 'edit') : ?>
                                                            <td style="width: 1%;"><a href="<?= base_url('result/course/' . $mark['id']) ?>" class="btn btn-secondary btn-sm round"><?= $mark['course'] ?></a></td>
                                                            <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                            <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                                        <?php else : ?>
                                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                                            <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                            <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </tr>
                                                <?php $total += $mark['course'] ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table><br>
                                    <?php $msr = $g->gpa($mark['student_id'], $mark['course_id']) ?>
                                    <?php if ($mark['course_status'] != null && $msr != null) : ?>
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
                                                <td><?= intval($msr['course_marks']) ?></td>
                                                <td><?= $msr['course_gpa'] ?></td>
                                                <td><span style="color:<?= $r->masar(intval($msr['course_gpa'] * 2))['color'] ?>"><b><?= $r->masar(intval($msr['course_gpa'] * 2))['name'] ?></b></span></td>
                                            </thead>
                                            <thead>
                                                <th><?= lang('app.tarakum') ?></th>
                                                <?php if ($msr['gpa'] != null && $msr != null) : ?>
                                                    <td><b><?= $msr['subjects'] ?></b></td>
                                                    <td><b><?= $msr['marks'] ?></b></td>
                                                    <td><b><?= $msr['gpa'] ?></b></td>
                                                    <td><span style="color:<?= $r->masar(intval($msr['gpa']))['color'] ?>"><b><?= $r->masar(intval($msr['gpa']))['name'] ?></b></span></td>
                                                <?php else : ?>
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
                                                <?php if ($mark['course_status'] != 'gpa') : ?>
                                                    <td colspan="3"><b><?= lang('app.soon') ?></b></td>
                                                <?php else : ?>
                                                    <td colspan="3"><b><?= $msr['course_position'] ?></b></td>
                                                <?php endif ?>
                                                <td colspan="3"><b><?= $msr['number_of_students'] ?? $c->stuCount($class['id']) ?></b></td>
                                            </thead>
                                        </table>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="fasl2" aria-labelledby="base-fasl2">
                    <div class="col-12">
                        <?php if (session('role') == 'admin' && $gpa != null) : ?>
                            <?php if ($res[0]['final_status'] == 'gpa' && $res[0]['final_status'] != 'marked' && $res[0]['final_status'] != null && $res[0]['final_status'] != 'edit_final') : ?>
                                <?= form_open('result/change-final', ['id' => 'change_final']) ?>
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="course_id" value="<?= $gpa['course_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-lg m-2" id="changeFinal"><?= lang('app.edit') ?></button>
                                </form>
                            <?php else : ?>
                                <?= form_open('print/edit-final', ['id' => 'gpa_form_final']) ?>
                                <input type="hidden" name="gpa_id" value="<?= $gpa['id'] ?>">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="course_id" value="<?= $gpa['course_id'] ?>">
                                <button type="submit" class="btn btn-purple btn-lg mb-1" id="gpaFinal"><?= lang('app.muadalaHuu') ?></button>
                                </form>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2><b><?= $user['name_ar'] ?? $user['name'] . ' ' . $user['lname'] ?></b>
                                    <?php if (session('role') == 'admin' || session('level') == 4) : ?>
                                        <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('print/kashf-darajat/final/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a>
                                    <?php elseif ($res[0]['final_status'] == 'done') : ?>
                                        <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('print/kashf-darajat/final/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a>
                                    <?php endif ?>
                                </h2>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table table-striped table-bordered attendance">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?= lang('app.subject') ?></th>
                                                <th><?= lang('app.mark') ?></th>
                                                <th><?= lang('app.grade') ?></th>
                                                <th><?= lang('app.taqdir') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody><?php $points = 0;
                                                $total = 0 ?>
                                            <?php foreach ($sub as $key => $dt) : ?>
                                                <?php $mark = $r->mark($class['id'], $user['id'], $dt['subject_id']) ?>
                                                <?php $subject = $g->subject($dt['subject_id']) ?>
                                                <?php $sum = $mark['final'] * 2 ?>
                                                <tr>
                                                    <td style="width: 1%;"><?= $key + 1 ?></td>
                                                    <td style="width: 15%;"><?= $subject['name'] ?></td>
                                                    <?php if (session('role') == 'student') : ?>
                                                        <?php if ($mark['final_status'] == null) : ?>
                                                            <td style="width: 1%;">*</td>
                                                            <td style="width: 1%;">*</td>
                                                            <td style="width: 15%;">*</td>
                                                        <?php elseif ($mark['final_status'] != null) : ?>
                                                            <td style="width: 1%;"><?= $mark['final'] ?? 0 ?></td>
                                                            <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                            <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                                        <?php endif ?>
                                                    <?php else : ?>
                                                        <?php if ($mark['final_status'] == 'gpa') : ?>
                                                            <td style="width: 1%;"><?= $mark['final'] ?></td>
                                                            <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                            <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                                        <?php elseif ($mark['final_status'] == 'marked' || $mark['final_status'] == 'edit_final') : ?>
                                                            <td style="width: 1%;">
                                                                <a href="<?= base_url('result/final/' . $mark['id']) ?>" class="btn btn-secondary btn-sm round"><?= $mark['final'] ?></a>
                                                            </td>
                                                            <td style="width: 1%;">
                                                                <span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span>
                                                            </td>
                                                            <td style="width: 15%;">
                                                                <span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span>
                                                            </td>
                                                        <?php else : ?>
                                                            <td style="width: 1%;">*</td>
                                                            <td style="width: 1%;">*</td>
                                                            <td style="width: 15%;">*</td>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </tr>
                                                <?php $total += $mark['final'] ?>
                                                <?php $points += $r->grade($sum)['point'] ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table><br>
                                    <?php if ($mark['final_status'] != null && $msr != null) : ?>
                                        <table class="table table-striped table-bordered" style="text-align: center;">
                                            <?php $masar = round((($total / (($key + 1) * 50)) * 50), 2) ?>
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
                                                <td><?= intval($msr['final_marks']) ?></td>
                                                <td><?= $msr['final_gpa'] ?></td>
                                                <td><span style="color:<?= $r->masar(intval($msr['final_gpa'] * 2))['color'] ?>"><b><?= $r->masar(intval($msr['final_gpa'] * 2))['name'] ?></b></span></td>
                                            </thead>
                                            <thead>
                                                <th><?= lang('app.tarakum') ?></th>
                                                <?php if ($msr['gpa'] != null) : ?>
                                                    <td><b><?= $msr['subjects'] ?></b></td>
                                                    <td><b><?= intval($msr['marks']) ?></b></td>
                                                    <td><b><?= $msr['gpa'] ?></b></td>
                                                    <td><span style="color:<?= $r->masar(intval($msr['gpa']))['color'] ?>"><b><?= $r->masar(intval($msr['gpa']))['name'] ?></b></span></td>
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
                                                    <td colspan="3"><b><?= $gpa['final_position'] ?></b></td>
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
                <div class="tab-pane" id="fasl" aria-labelledby="base-fasl">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2><b><?= $user['name_ar'] ?? $user['name'] . ' ' . $user['lname'] ?></b>
                                    <?php if (session('role') == 'admin' || session('level') == 4) : ?>
                                        <!-- <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('print/kashf-darajat/all/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a> -->
                                    <?php elseif ($res[0]['final_status'] == 'done') : ?>
                                        <!-- <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('print/kashf-darajat/all/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a> -->
                                    <?php endif ?>
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
                                                <?php $sum = $mark['course'] + $mark['final'] ?>
                                                <tr>
                                                    <td style="width: 1%;"><?= $key + 1 ?></td>
                                                    <td style="width: 15%;"><?= $subject['name'] ?></td>
                                                    <?php if (session('role') == 'student') : ?>
                                                        <?php if ($mark['final_status'] == 'gpa' || $mark['final_status'] == 'marked') : ?>
                                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                                            <td style="width: 1%;"><?= $mark['final'] ?></td>
                                                            <td style="width: 1%;"><?= $sum ?></td>
                                                            <td style="width: 1%;"><span class="<?= (($sum) < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                            <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                                        <?php elseif ($mark['course_status'] == 'gpa' || $mark['course_status'] == 'marked') : ?>
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
                                                        <?php elseif ($mark['final_status'] == 'done' || $mark['final_status'] == 'marked') : ?>
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
                                                <td><span style="color:<?= $r->masar(intval($msr['gpa']))['color'] ?>"><b><?= $r->masar(intval($msr['gpa']))['name'] ?></b></span></td>
                                            </thead>
                                            <thead>
                                                <th><?= lang('app.tarakum') ?></th>
                                                <?php if ($msr['gpa'] != null) : ?>
                                                    <td><b><?= $msr['subjects'] ?></b></td>
                                                    <td><b><?= intval($msr['marks']) ?></b></td>
                                                    <td><b><?= $msr['gpa'] ?></b></td>
                                                    <td><span style="color:<?= $r->masar(intval($msr['gpa']))['color'] ?>"><b><?= $r->masar(intval($msr['gpa']))['name'] ?></b></span></td>
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
            </div>
        </div>
    </div>
<?php endif ?>

<script>
    $('#changeCourse').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '<?= lang('app.edit') ?>',
            text: "<?= lang('app.editResults') ?>: <?= $user['name_ar'] ?>",
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
            text: "<?= lang('app.positionReg') ?>",
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
            text: "<?= lang('app.editResults') ?>: <?= $user['name_ar'] ?>",
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