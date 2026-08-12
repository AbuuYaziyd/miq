<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Course;
use App\Models\Gpa;
use App\Models\Grade;
use App\Models\Result;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;

class ResultController extends BaseController
{
    public function index()
    {
        helper('form');

        $crs = new Course();
        $yr = new Year();
        $gpa = new Gpa();
        $res = new Result();
        $sch = new School();

        $year = $yr->where('current', 1)->first()['id'];
        $all_years = $gpa->select('year_id')->distinct()->findAll();
        $final = $res->where('year_id', $year)->first();
        $course = $res->where('year_id', $year)->first();
        // dd($final, $course);

        $data['title'] = lang('app.results');
        $data['yr'] = $yr;
        $data['final'] = $final;
        $data['course'] = $course;
        $data['class'] = $crs->findAll();
        $data['crs'] = $crs;
        $data['year'] = $year;
        $data['all_years'] = $all_years;
        $data['sch'] = $sch->findAll();
        // dd($data);

        if (session('role') != 'student') {
            return view('result/index', $data);
        } else {
            return redirect()->to('result/student/' . session('id'));
        }
    }

    public function open()
    {
        $res = new Result();
        $yr = new Year();
        $usr = new User();
        $cls = new Course();
        $sub = new Subject();
        $sch = new School();

        $theResult = $res->where('year_id', $yr->where('current', 1)->first()['id'])->first();
        // dd($theResult);

        if ($theResult != null) {
            return redirect()->back()->with('type', 'error')->with('text', lang('app.resultsAlreadyOpened'))->with('title', lang('app.sorry'));
        } else {
            $year = $yr->where('current', 1)->first();
            $schools = $sch->findAll();
            foreach ($schools as $sh) {
                foreach ($cls->where('school_id', $sh['id'])->findAll() as $cl) {
                    foreach ($sub->where('course_id', $cl['id'])->findAll() as $sb) {
                        $users = $usr->where('level', $cl['id'])->findAll();
                        $check = $res->where(['course_id' => $cl['id'], 'subject_id' => $sb['id'], 'school_id' => $sh['id'], 'year_id' => $year['id']])->findAll();

                        if (count($users) > 0 && $check == null) {
                            $res->registerResultsToClass($cl['id'], $users, $year['id'], $sh['id']);
                        }
                    }
                }
            }
            // dd($users, $check);

            return redirect()->back()->with('type', 'success')->with('text', lang('app.resultsOpenedSuccessfull'))->with('title', lang('app.ok'));
        }
    }

    public function add($exam)
    {
        $res = new Result();
        $yr = new Year();

        $year = $yr->where('current', 1)->first();
        $all_result = $res->where('year_id', $year['id'])->findAll();
        // dd($exam, $all_result);

        foreach ($all_result as $rs) {
            $data = [$exam . '_status' => 'add'];

            $res->update($rs['id'], $data);
        }
        // dd($data);

        return redirect()->back()->with('type', 'success')->with('text', lang('app.resultsOpenedSuccessfull'))->with('title', lang('app.ok'));
    }

    public function calculation($exam)
    {
        $crs = new Course();
        $stu = new User();
        $sch = new School();
        $sub = new Subject();
        $yr = new Year();

        $data['title'] = lang('app.marks');
        $data['schools'] = $sch->findAll();
        $data['courses'] = $crs->findAll();
        $data['sub'] = $sub;
        $data['exam'] = $exam;
        $data['sch'] = $sch;
        $data['crs'] = $crs;
        $data['year'] = $yr->where('current', 1)->first();
        $data['students'] = $stu->where(['level' => null, 'role' => 'student'])->findAll();
        // dd($data);

        return view('result/calculation', $data);
    }

    public function marks($exam, $id)
    {
        helper('form');

        $res = new Result();
        $usr = new User();
        $crs = new Course();
        $sub = new Subject();
        $year = new Year();
        $sch = new School();

        $s = $id;
        $c = $sub->find($id)['course_id'];
        $y = $year->where('current', 1)->first()['id'];
        $sc = $crs->find($c)['school_id'];
        // dd($c, $s, $sc, $y);

        $male = $usr->where(['fn' => 'student', 'sex' => 'M', 'level' => $c])->orderBy('name_ar', 'asc')->findAll();
        $female = $usr->where(['fn' => 'student', 'sex' => 'F', 'level' => $c])->orderBy('name_ar', 'asc')->findAll();
        $check = $res->where(['course_id' => $c, 'subject_id' => $s, 'school_id' => $sc, 'year_id' => $y])->first();
        // dd($check, $students);

        if ($check == null) {
            return redirect()->back()->with('type', 'error')->with('text', lang('app.studentNotFound'))->with('title', lang('app.sorry'));
        }

        $data['title'] = lang('app.results');
        $data['male'] = $male;
        $data['female'] = $female;
        $data['exam'] = $exam;
        $data['res'] = $res;
        $data['check'] = $check;
        $data['course'] = $crs->find($c);
        $data['school'] = $sch->find($sc);
        $data['subject'] = $sub->find($s);
        $data['year'] = $year->find($y);
        // dd($data);
        
        // dd($check[$exam . '_status']);
        if ($check[$exam . '_status'] == null) {
            dd('show');
            return redirect()->back()->with('type', 'error')->with('text', lang('app.studentNotFound'))->with('title', lang('app.sorry'));
        // } elseif ($check['course_status'] == 'gpa') {
        //     // dd('mark');
        //     return redirect()->to('result/course/show/' . $c . '/' . $y);
        } elseif ($check[$exam . '_status'] != 'done') {
            // dd('add');
            return view('result/marks', $data);
        }
    }

    function addSubjectMarks($sub_id)
    {
        $res = new Result();
        $yr = new Year();
        $sbj = new Subject();
        $cls = new Course();
        $usr = new User();

        $year_id = $yr->where('current', 1)->first()['id'];
        $subject = $sbj->find($sub_id);
        $class = $cls->find($subject['course_id']);
        $stu = $usr->where('level', $class['id'])->findAll();
        // dd($sub_id, $year_id, $stu, $class);

        foreach ($stu as $dt) {
            $data = [
                'course_id' => $class['id'],
                'school_id' => $class['school_id'],
                'subject_id' => $sub_id,
                'year_id' => $year_id,
                'username' => $dt['username'],
                'student_id' => $dt['id'],
                'course_status' => 'add',
                'final_status' => 'add',
            ];
            $res->save($data);
        }
        // dd($data);

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function sign($id, $sex)
    {
        $res = new Result();
        $usr = new User();
        $sub = new Subject();

        $c = $sub->find($id)['course_id'];

        $data['title'] = lang('app.results');
        $data['subject'] = $sub->find($id);
        $data['students'] = $usr->where(['level' => $c, 'sex' => $sex])->orderBy('name_ar', 'asc')->findAll();
        $data['res'] = $res;
        // dd($data);

        return view('result/sign', $data);
    }

    function update()
    {
        // dd($this->request->getVar());

        $res = new Result();
        $act = new ActivityLog();

        $mark_id = $this->request->getVar('id');
        $exam = $this->request->getVar('exam');
        $subject_id = $this->request->getVar('subject_id');
        // dd($mark_id, $subject_id, $exam);

        foreach ($mark_id as $key => $dt) {
            $data = [
                $exam => floatval($this->request->getVar($exam)[$key]),
                $exam . '_status' => 'marked',
                'teacher_id' => session('id'),
            ];
            // dd($data);

            $res->update($dt, $data);
        }
        // dd($data);

        $act->addActivity(session('id'), 'Add Marks to DB', ($key + 1) . 'Student ' . $exam .' marks were registered Saved Successfully!');

        return redirect()->to('result/' . $exam . '/marks/' . $subject_id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function done($exam, $id)
    {
        $sub = new Subject();
        $res = new Result();
        $yr = new Year();

        $subject = $sub->find($id);
        $year = $yr->where('current', 1)->first();
        $marks = $res->where(['year_id' => $year['id'], 'course_id' => $subject['course_id'], 'subject_id' => $id])->findAll();
        // dd($marks, $year, $exam, $subject);

        foreach ($marks as $dt) {
            $data = [
                $exam . '_status' => 'done'
            ];

            $res->update($dt['id'], $data);
        }

        return redirect()->to('result/' . $exam . '/calculation')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.ok'));
    }

    public function gpa($exam, $id)
    {
        $res = new Result();
        $usr = new User();
        $sub = new Subject();
        $crs = new Course();
        $yr = new Year();
        $gpa = new Gpa();
        $act = new ActivityLog();

        $school_id = $crs->find($id)['school_id'];
        $current_year = $yr->where('current', 1)->first()['id'];
        $students = $usr->where(['level' => $id, 'fn' => 'student'])->findAll();
        $subjects = $sub->where('course_id', $id)->countAllResults();
        $check = $gpa->where(['course_id' => $id, 'year_id' => $current_year])->findAll();
        // dd($students, $school_id, $current_year, $subjects, $check);

        // dd(!(count($check) <= 0));
        if (!(count($check) <= 0)) {

            // dd($check);
            foreach ($check as $ck) {
                // Total Marks
                $total_marks = $gpa->sum($ck['student_id'], $id);
                $exam_gpa = ($total_marks[$exam] / $subjects);
                $total = $total_marks[$exam] + $ck['course_marks'];
                // dd($total_marks[$exam], $exam_gpa, $exam);

                $data = [
                    $exam . '_marks' => $total_marks[$exam],
                    $exam . '_gpa' => $exam_gpa,
                    'marks' => $total,
                ];
                // dd($data);

                $gpa->update($ck['id'], $data);

                $results = $res->where(['student_id' => $ck['student_id'], 'course_id' => $id, 'year_id' => $current_year])->findAll();
                // dd($results);
                foreach ($results as $re) {
                    $result_data = [$exam . '_status' => 'gpa'];
                    // dd($re, $result_data);

                    $res->update($re['id'], $result_data);
                }

                $act->addActivity(session('id'), 'GPA Calculation', 'GPA for ' . $exam . ' semester was Calculated and Saved Successfully!');

            }
            return redirect()->to('result/' . $exam . '/position/' . $id);
        } else {
            foreach ($students as $dt) {
                $results = $res->where(['student_id' => $dt['id'], 'course_id' => $id, 'year_id' => $current_year])->findAll();
                // dd($results);

                // Total Marks
                $total_marks = $gpa->sum($dt['id'], $id);
                // dd($total_marks[$exam]);

                $exam_gpa = ($total_marks[$exam] / $subjects);
                // dd($exam_gpa);
                $data = [
                    'student_id' => $dt['id'],
                    'course_id' => $id,
                    'year_id' => $current_year,
                    'school_id' => $school_id,
                    'username' => $dt['username'],
                    'subjects' => $subjects,
                    'number_of_students' => count($students),
                    'link' => bin2hex(random_bytes(20)),
                    $exam . '_marks' => $total_marks[$exam],
                    $exam . '_gpa' => $exam_gpa,
                ];
                // dd($data);

                $gpa->save($data);

                foreach ($results as $re) {
                    $result_data = [$exam . '_status' => 'gpa'];
                    // dd($re, $result_data);

                    $res->update($re['id'], $result_data);
                }
            }

            $act->addActivity(session('id'), 'GPA Calculation', 'GPA for ' . $exam . ' semester was Calculated and Saved Successfully!');

            return redirect()->to('result/' . $exam . '/position/' . $id);
        }
    }

    public function position($exam, $id)
    {
        $yr = new Year();
        $gpa = new Gpa();
        $crs = new Course();
        $act = new ActivityLog();

        $school_id = $crs->find($id)['school_id'];
        $year_id = $yr->where('current', 1)->first()['id'];

        $p = $gpa->where(['school_id' => $school_id, 'course_id' => $id, 'year_id' => $year_id, $exam . '_position' => null])->orderBy($exam . '_marks', 'desc')->findAll();
        // dd($p, $school_id, $year_id, $exam);

        foreach ($p as $key => $d) {
            $dt = [$exam . '_position' => $key + 1];

            $gpa->update($d['id'], $dt);
        }
        // dd($dt);

        $act->addActivity(session('id'), 'Position Calculation', 'Position for '. $exam . ' semester results was Assigned and Saved Successfully!');

        if ($exam == 'final') {
            $p = $gpa->where(['school_id' => $school_id, 'course_id' => $id, 'year_id' => $year_id, 'position' => null])->orderBy('marks', 'desc')->findAll();
            // dd($p, $exam);

            foreach ($p as $key => $d) {
                $dt = [
                    'position' => $key + 1,
                    'gpa' => $d['course_gpa'] + $d['final_gpa']
                ];

                $gpa->update($d['id'], $dt);
            }

            $act->addActivity(session('id'), 'Position Calculation', 'Position for whole year results was Assigned and Saved Successfully!');
        }

        return redirect()->to('result/' . $exam . '/show/' . $id . '/' . $year_id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function show($exam, $id, $year_id)
    {
        helper('form');

        $gpa = new Gpa();
        $sch = new School();
        $crs = new Course();
        $yr = new Year();

        $course = $crs->find($id);
        // dd($course);

        $cors_name = session('lang') != 'ar' ? $course['name'] : $course['name_ar'];
        $data['title'] = lang('app.results') . ' - ' . $cors_name;
        $data['gpa'] = $gpa;
        $data['course'] = $course;
        $data['exam'] = $exam;
        $data['year'] = $yr->find($year_id);
        $data['school'] = $sch->find($course['school_id']);
        $data['class_gpa'] = $gpa->where(['course_id' => $id, 'year_id' => $year_id, $exam . '_gpa!=' => null])->orderBy($exam . '_marks', 'DESC')->findAll();
        // dd($data);

        return view('result/show', $data);
    }

    public function view($exam, $user_id, $course_id)
    {
        helper('form');

        $res = new Result();
        $usr = new User();
        $grd = new Grade();
        $sub = new Subject();
        $crs = new Course();
        $gpa = new Gpa();
        $yr = new Year();

        $course = $crs->find($course_id);

        $data['title'] = lang('app.results');
        $data['results'] =  $res->where(['course_id' => $course_id, 'student_id' => $user_id])->findAll();
        $data['user'] = $usr->find($user_id);
        $data['year'] = $yr->where('current', 1)->first();
        $data['class'] = $course;
        $data['exam'] = $exam;
        $data['student_gpa'] = $gpa->where(['student_id' => $user_id, 'course_id' => $course_id])->first();
        $data['grade'] = $grd->findAll();
        $data['sub'] = $sub->where('course_id', $course_id)->findAll();
        $data['crs'] = $crs;
        $data['res'] = $res;
        $data['gpa'] = $gpa;
        // dd($data);

        return view('result/view', $data);
    }

    public function all($id, $year_id)
    {
        helper('form');

        $gpa = new Gpa();
        $sch = new School();
        $crs = new Course();
        $yr = new Year();

        $course = $crs->find($id);
        // dd($course);

        $cors_name = session('lang') != 'ar' ? $course['name'] : $course['name_ar']; 
        $data['title'] = lang('app.results') . ' - ' . $cors_name;
        $data['gpa'] = $gpa;
        $data['course'] = $course;
        $data['year'] = $yr->find($year_id);
        $data['school'] = $sch->find($course['school_id']);
        $data['class_gpa'] = $gpa->where(['course_id' => $id, 'year_id' => $year_id, 'gpa!=' => null])->orderBy('marks', 'DESC')->findAll();
        // dd($data);

        return view('result/all', $data);
    }

    public function student($id)
    {
        $user = new User();
        $cl = new Course();
        $gp = new Gpa();
        $res = new Result();
        $sub = new Subject();
        $sch = new School();

        $stu = $user->find($id);
        $class = $cl->find($stu['level']);

        $data['title'] = lang('app.results');
        $data['stu'] = $stu;
        $data['class'] = $class;
        $data['sch'] = $sch;
        $data['school'] = $sch->findAll();
        $data['sub'] = $sub->where('course_id', $stu['level'])->findAll();
        $data['gp'] = $gp->where('student_id', $id)->orderBy('course_id', 'asc')->select('course_id')->distinct()->findAll();
        $data['res'] = $res->where(['student_id' => $id, 'course_id' => $stu['level']])->findAll();
        $data['p'] = $gp;
        // dd($data);

        return view('result/student', $data);
    }

    function teacher($teacher_id)
    {
        // dd($teacher_id);

        $sub = new Subject();
        $crs = new Course();

        $data['title'] = lang('app.results');
        $data['crs'] = $crs;
        $data['subjects'] = $sub->where('head_id', $teacher_id)->findAll();
        // dd($data);

        return view('result/teacher', $data);
    }

    public function insert($id)
    {
        $user = new User();
        $crs = new Course();
        $gpa = new Gpa();
        $res = new Result();
        $sub = new Subject();
        $yer = new Year();
        $act = new ActivityLog();

        $student = $user->find($id);
        $course = $crs->find($student['level']);
        $year_id = $yer->where('current', 1)->first()['id'];
        // dd($student, $id);

        foreach ($sub->where('course_id', $student['level'])->findAll() as $sb) {
            $data = [
                'course_id' => $course['id'],
                'school_id' => $course['school_id'],
                'subject_id' => $sb['id'],
                'year_id' => $year_id,
                'username' => $student['username'],
                'student_id' => $student['id'],
                'teacher_id' => $sb['head_id'],
                'status' => 'add',
            ];
            $res->save($data);
        }
        // dd($data);

        $act->addActivity(session('id'), 'Add Marks to DB', 'Student marks were registered Saved Successfully!');

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function edit($exam, $id)
    {
        helper('form');

        $res = new Result();
        $usr = new User();

        $result = $res->find($id);

        $data['title'] = lang('app.results');
        $data['exam'] = $exam;
        $data['res'] = $result;
        $data['user'] = $usr->find($result['student_id']);
        // dd($data);

        return view('result/edit', $data);
    }

    function change()
    {
        // dd($this->request->getVar());
        $res = new Result();

        $id = $this->request->getVar('id');
        $exam = $this->request->getVar('exam');
        $mark = $this->request->getVar('mark');

        $result = $res->find($id);
        $data = [$exam => $mark];
        // dd($data);

        $res->update($id, $data);

        // return redirect()->to('result/view/course/' . $result['student_id'] . '/' . $result['course_id']);
        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function user($usr, $cls)
    {
        helper('form');

        $res = new Result();
        $user = new User();
        $grade = new Grade();
        $sub = new Subject();
        $cl = new Course();
        $gpa = new Gpa();
        $yr = new Year();

        $class = $cl->find($cls);
        $year = $yr->where('current', 1)->first();

        $data['res'] =  $res->where(['course_id' => $cls, 'student_id' => $usr, 'year_id' => $year['id']])->findAll();
        $data['user'] = $user->find($usr);
        $data['year'] = $year;
        $data['class'] = $class;
        $data['gpa'] = $gpa->where(['student_id' => $usr, 'course_id' => $cls, 'year_id' => $year['id']])->first();
        $data['grade'] = $grade->findAll();
        // $data['sub'] = $sub->where('course_id', $cls)->findAll();
        $data['sub'] = $res->select('subject_id')->where(['course_id' => $cls, 'student_id' => $usr, 'year_id' => $year['id']])->findAll();
        $data['c'] = $cl;
        $data['r'] = $res;
        $data['g'] = $gpa;
        $data['title'] = lang('app.results');
        // dd($data);

        return view('result/user', $data);
    }

    // public function view()
    // {
    //     helper('form');

    //     // dd($this->request->getVar());

    //     $res = new Result();
    //     $user = new User();
    //     $acd = new Academy();

    //     $year = $this->request->getVar('year');
    //     $class = $this->request->getVar('course_id');

    //     $acdmc = $acd->find($class);
    //     $data['title'] = lang('app.results') . ' - ' . $acdmc['name'];
    //     // $data['masomo'] = $clssub->where('classsubject.class_id', $class)
    //     //                 ->orderBy('classsubject.subjectId', 'desc')
    //     //                 ->join('subjects r', 'r.id=classsubject.subjectId')
    //     //                 ->findAll();
    //     $id1 =  $res->where(['year' => $year, 'class_id' => $class])
    //         ->select('student_id')
    //         ->orderBy('results.student_id', 'asc')
    //         ->distinct()
    //         ->findAll();

    //     foreach ($id1 as $key => $dt) {
    //         $data['class_id'] = $class;
    //         $data['year'] = $year;
    //         $usr = $user->find($dt);
    //         $mrk = $res //->join('users u', 'results.student_id=u.id')
    //             ->where(['year' => $year, 'class_id' => $class, 'student_id' => $dt])
    //             ->orderBy('subject_id', 'desc')
    //             ->findAll();
    //         // if ($usr!=null) {
    //         $data['marks'][] = [
    //             'user' => $usr,
    //             'marks' => $mrk
    //         ];
    //         // }
    //     }
    //     //   dd(($data));
    //     return view('result/matokeo', $data);
    // }

    // public function overview($id)
    // {
    //     $year = new Year();
    //     $gp = new Gpa();
    //     $class = new Academy();
    //     $act = new ActivityLog();

    //     $sc = $class->find($id)['school_id'];
    //     $y = $year->where('current', 1)->first()['id'];

    //     $p = $gp->where(['school_id' => $sc, 'class_id' => $id, 'year_id' => $y])->orderBy('marks', 'desc')->findAll();
    //     // dd($p);

    //     foreach ($p as $key => $d) {
    //         $dt = ['position' => $key + 1,];

    //         $gp->update($d['id'], $dt);
    //     }
    //     // dd($dt);

    //     $act->addActivity(session('id'), 'Overall Position Calculation', 'Position for second semester results was Assigned and Saved Successfully!');

    //     return redirect()->to('result/final/show/' . $id . '/' . $y)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    // }

    // public function finished($id, $yr)
    // {
    //     helper('form');

    //     $gpa = new Gpa();
    //     $sch = new School();
    //     $cl = new Academy();
    //     $year = new Year();

    //     $class = $cl->find($id);

    //     $data['title'] = lang('app.results') . ' - ' . $class['name'];
    //     $data['gp'] = $gpa;
    //     $data['class'] = $class;
    //     $data['year'] = $year->find($yr);
    //     $data['sch'] = $sch->find($class['school_id']);
    //     $data['data'] = $gpa->where(['class_id' => $id, 'year_id' => $yr])->orderBy('position', 'ASC')->findAll();
    //     // dd($data);

    //     return view('result/finished', $data);
    // }
}
