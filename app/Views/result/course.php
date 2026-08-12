<div role="tabpanel" class="tab-pane active" id="fasl1" aria-expanded="true" aria-labelledby="base-fasl1">
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
                    <a class="btn btn-warning box-shadow-1 round pull-right" href="<?= base_url('gpa/report/course/' . $user['id'] . '/' . $class['id']) ?>" target="_blank"><?= lang('app.kashfuDarajat') ?></a>
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
                                <?php $sum = ($mark['course'] * 2) ?? 0 ?>
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
                                        <?php if ($mark['course_status'] == null) : ?>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 15%;">*</td>
                                        <?php else : ?>
                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                            <?php if (session('lang') != 'ar') : ?>
                                                <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                            <?php else : ?>
                                                <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz_ar'] ?></span></td>
                                                <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name_ar'] ?></span></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php else : ?>
                                        <?php if ($mark['course_status'] == null) : ?>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 1%;">*</td>
                                            <td style="width: 15%;">*</td>
                                        <?php elseif ($mark['course_status'] == 'marked' || $mark['course_status'] == 'edit') : ?>
                                            <td style="width: 1%;"><a href="<?= base_url('result/course/edit/' . $mark['id']) ?>" class="btn btn-secondary btn-sm round"><?= $mark['course'] ?></a></td>
                                            <?php if (session('lang') != 'ar') : ?>
                                                <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                            <?php else : ?>
                                                <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz_ar'] ?></span></td>
                                                <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name_ar'] ?></span></td>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <td style="width: 1%;"><?= $mark['course'] ?></td>
                                            <?php if (session('lang') != 'ar') : ?>
                                                <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz'] ?></span></td>
                                                <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name'] ?></span></td>
                                            <?php else : ?>
                                                <td style="width: 1%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['ramz_ar'] ?></span></td>
                                                <td style="width: 15%;"><span class="<?= ($sum < 60 ? 'danger' : '') ?>"><?= $r->grade($sum)['name_ar'] ?></span></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php endif ?>
                                </tr>
                                <?php $total += $mark['course'] ?>
                            <?php endforeach ?>
                        </tbody>
                    </table><br>
                    <?php if ($mark['course_status'] != null) : ?>
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
                                <td><?= $gpa['subjects'] ?></td>
                                <td><?= intval($gpa['course_marks']) ?></td>
                                <td><?= $gpa['course_gpa'] ?></td>
                                <td>
                                    <span style="color:<?= $r->masar(intval($gpa['course_gpa'] * 2))['colour'] ?>">
                                        <?php if (session('lang') != 'ar') : ?>
                                            <b><?= $r->masar(intval($gpa['course_gpa'] * 2))['name'] ?></b>
                                        <?php else : ?>
                                            <b><?= $r->masar(intval($gpa['course_gpa'] * 2))['name_ar'] ?></b>
                                        <?php endif ?>
                                    </span>
                                </td>
                            </thead>
                            <thead>
                                <?php $trkm = $g->tarakum($mark['student_id'], $mark['course_id']) ?>
                                <th><?= lang('app.tarakum') ?></th>
                                <?php if ($gpa['course_gpa'] != null && $gpa != null) : ?>
                                    <td><b><?= $gpa['subjects'] ?></b></td>
                                    <td><b><?= round($gpa['course_marks']) ?></b></td>
                                    <td><b><?= $gpa['course_gpa'] ?></b></td>
                                    <?php if (session('lang') != 'ar') : ?>
                                        <td><span style="color:<?= $r->masar(intval($gpa['course_gpa'] * 2))['colour'] ?>"><b><?= $r->masar(intval($gpa['course_gpa'] * 2))['name'] ?></b></span></td>
                                    <?php else : ?>
                                        <td><span style="color:<?= $r->masar(intval($gpa['course_gpa'] * 2))['colour'] ?>"><b><?= $r->masar(intval($gpa['course_gpa'] * 2))['name_ar'] ?></b></span></td>
                                    <?php endif ?>
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
                                    <td colspan="3"><b><?= $gpa['course_position'] ?></b></td>
                                <?php endif ?>
                                <td colspan="3"><b><?= $gpa['number_of_students'] ?? $c->stuCount($class['id']) ?></b></td>
                            </thead>
                        </table>
                    <?php endif ?>
                </div>
            </div>
            <?php if ($gpa != null) : ?>
                <div class="card-footer border-top-blue-grey border-top-lighten-5">
                    <?php if ((session('role') == 'admin') && $gpa['course_gpa'] != null) : ?>
                        <?php if ($res[0]['course_status'] != null && $res[0]['course_status'] != 'edit') : ?>
                            <?= form_open('gpa/edit', ['id' => 'change_course']) ?>
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="exam" value="course">
                            <input type="hidden" name="course_id" value="<?= $gpa['course_id'] ?>">
                            <input type="hidden" name="year_id" value="<?= $gpa['year_id'] ?>">
                            <button type="submit" class="btn btn-block btn-lg btn-danger" id="changeCourse"><?= lang('app.edit') ?></button>
                            </form>
                        <?php else : ?>
                            <?= form_open('gpa/gpa', ['id' => 'gpa_form_course']) ?>
                            <input type="hidden" name="gpa_id" value="<?= $gpa['id'] ?>">
                            <input type="hidden" name="exam" value="course">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="year_id" value="<?= $gpa['year_id'] ?>">
                            <input type="hidden" name="course_id" value="<?= $gpa['course_id'] ?>">
                            <button type="submit" class="btn btn-block btn-lg btn-purple" id="gpaCourse"><?= lang('app.muadalaHuu') ?></button>
                            </form>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>