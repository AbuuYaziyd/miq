<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Academy;
use App\Models\ActivityLog;
use App\Models\Gpa;
use App\Models\Result;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;

class FinalController extends BaseController
{
    public function open()
    {
        $res = new Result();
        $yr = new Year();

        $final = $res->where('year_id', $yr->where('current', 1)->first()['id'])->first()['final_status'];
        // dd($final);

        if ($final != null) {
            return redirect()->back()->with('type', 'error')->with('text', lang('app.resultsAlreadyOpened'))->with('title', lang('app.sorry'));
        } else {
            $results = $res->where('year_id', $yr->where('current', 1)->first()['id'])->findAll();
            // dd($results);

            foreach ($results as $dt) {
                $data = [
                    'final_status' => 'add',
                ];
                $res->update($dt['id'], $data);
            }
            // dd($data);

            return redirect()->back()->with('type', 'success')->with('text', lang('app.resultsOpenedSuccessfull'))->with('title', lang('app.ok'));   
        }
    }

    public function add($id)
    {
        helper('form');

        $res = new Result();
        $usr = new User();
        $class = new Academy();
        $sub = new Subject();
        $year = new Year();
        $sch = new School();

        $c = $sub->find($id)['class_id'];
        $y = $year->where('current', 1)->first()['id'];
        $sc = $class->find($c)['school_id'];
        $final = $res->where('year_id', $y)->first()['final_status'];

        $data['title'] = lang('app.results');
        $data['sub'] = $sub->find($id);
        $data['sch'] = $sch->find($sc);
        $data['stu'] = $usr->where('level', $c)->orderBy('sex', 'desc')->findAll();
        $data['r'] = $res;
        $data['check'] = $final;
        $data['class'] = $class->find($c);
        $data['year'] = $year->find($y);
        // dd($data);

        return view('marks/final/add', $data);
    }

    function update()
    {
        // dd($this->request->getVar());
        
        $res = new Result();
        $act = new ActivityLog();

        $mark_id = $this->request->getVar('id');
        $sub_id = $this->request->getVar('subject_id');
        // dd($mark_id, $sub_id);

        foreach ($mark_id as $key => $dt) {
            $data = [
                'final' => floatval($this->request->getVar('final')[$key]) ?? 0,
                'final_status' => 'marked',
            ];
            // dd($data);
            $res->update($dt, $data);
        }
        // dd($data);

        $act->addActivity(session('id'), 'Add Marks to DB', ($key + 1) . 'Student marks were registered Saved Successfully!');

        return redirect()->to('result/final/marks/' . $sub_id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.ok'));
    }

    public function marks($sub_id)
    {
        helper('form');

        $res = new Result();
        $user = new User();
        $class = new Academy();
        $sub = new Subject();
        $year = new Year();
        $sch = new School();

        $s = $sub_id;
        $c = $sub->find($sub_id)['class_id'];
        $y = $year->where('current', 1)->first()['id'];
        $sc = $class->find($c)['school_id'];
        // dd($c, $s, $sc, $y);

        $stuAll = $user->where(['role' => 'student', 'level' => $c])->orderBy('sex', 'desc')->findAll();
        $check = $res->where(['class_id' => $c, 'subject_id' => $s, 'school_id' => $sc, 'year_id' => $y])->first()['final_status'];
        // dd($check, $stuAll);

        $data['title'] = lang('app.results');
        $data['stu'] = $stuAll;
        $data['r'] = $res;
        $data['check'] = $check;
        $data['class'] = $class->find($c);
        $data['sch'] = $sch->find($sc);
        $data['sub'] = $sub->find($s);
        $data['year'] = $year->find($y);
        $data['yr'] = $year->findAll();
        // dd($data);

        if (session('role') != 'student') {
            if ($check == 'gpa') {
                // dd('mark');
                return redirect()->to('result/final/show/' . $c . '/' . $y);
            } elseif ($check != 'done') {
                return view('marks/final/add', $data);
            } elseif ($check == null) {
                return redirect()->to('result/final/show/' . $c . '/' . $y);
            } else {
                // dd('view');
                return view('marks/final/view', $data);
            }
        } else {
            return redirect()->to(base_url('user'))->with('type', 'error')->with('text', lang('app.authorisedPersonellOnly'))->with('title', lang('app.sorry'));
        }
    }

    public function done($sub_id)
    {
        $sub = new Subject();
        $res = new Result();
        $yr = new Year();

        $subject = $sub->find($sub_id);
        $class_id = $subject['class_id'];
        $year = $yr->where('current', 1)->first()['id'];
        $marks = $res->where(['year_id' => $year, 'class_id' => $class_id, 'subject_id' => $sub_id])->findAll();
        // dd($marks);

        foreach ($marks as $dt) {
            $data = [
                'final_status' => 'done'
            ];

            $res->update($dt['id'], $data);
        }

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.ok'));
    }

    public function show($id, $yr)
    {
        helper('form');

        $user = new User();
        $sub = new Subject();
        $gpa = new Gpa();
        $sch = new School();
        $cl = new Academy();
        $year = new Year();

        $class = $cl->find($id);
        $check = $gpa->where(['class_id' => $id, 'year_id' => $yr, 'position!=' => null])->countAllResults();
        // dd($check);

        if ($check > 0) {
            return redirect()->to('result/finished/' . $id . '/' . $yr);
        }
        // $users = $user->where('level', $id)->findAll();
        // $search = ;

        // dd(count($search));
        // dd($results);
        $data['title'] = lang('app.results') . ' - ' . $class['name'];
        $data['gp'] = $gpa;
        $data['sub'] = $sub->where('class_id', $id)->findAll();
        $data['results'] = $user->where('level', $id)->findAll();
        $data['class'] = $class;
        $data['year'] = $year->find($yr);
        $data['yr'] = $year->findAll();
        $data['sch'] = $sch->find($class['school_id']);
        $data['position'] = $gpa->where(['class_id' => $id, 'year_id' => $yr, 'position_final!=' => null])->orderBy('position_final', 'ASC')->findAll();
        $data['gpa'] = $gpa->where(['class_id' => $id, 'year_id' => $yr, 'gpa_final!=' => null])->orderBy('marks_final', 'DESC')->findAll();


        // if ($results > 0) {
        //     $data['results'] = true;
        // }

        // dd(count($search) > 0);
        // dd($search[0]['position'] != null);
        // if (count($search) > 0) {
        //     if ($search[0]['position'] != null) {
        //         // $search = ;

        //         $data['position'] = $search;
        //         $data['std'] = $search;
        //     }
        //     // $data['gpa'] = true;
        // }


        // dd($data);

        return view('marks/final/show', $data);
    }

    public function gpa($id)
    {
        $res = new Result();
        $usr = new User();
        $sub = new Subject();
        $class = new Academy();
        $year = new Year();
        $gp = new Gpa();
        $act = new ActivityLog();

        $students = $usr->where('level', $id)->countAllResults();
        $sc = $class->find($id)['school_id'];
        $y = $year->where('current', 1)->first()['id'];
        $subjects = $sub->where('class_id', $id)->countAllResults();
        $class_std = $usr->where('level', $id)->findAll();
        $check = $gp->where(['class_id' => $id, 'year_id' => $y, 'gpa_final!=' => null])->countAllResults();
        // dd($check);

        if (!($check <= 0)) {
            // dd('show data');
            return redirect()->to('result/final/show/' . $id . '/' . $y);
        } else {
            foreach ($class_std as $user) {
                $st = $res->where(['student_id' => $user['id'], 'class_id' => $id])->findAll();
                // dd($st);

                // Total Marks
                $marks = $gp->sumFinal($user['id'], $id);
                // dd($marks);

                $stu_gpa = $gp->where(['student_id' => $user['id'], 'class_id' => $id])->first();
                $gpa = ($marks/$subjects);
                $data = [
                    'marks_final' => $marks,
                    'gpa_final' => $gpa,
                    'number_of_students' => $students,
                ];
                // dd($data);


                $gp->update($stu_gpa['id'], $data);

                foreach ($st as $re) {
                    $result = $res->find($re['id']);
                    $d = ['final_status' => 'gpa'];

                    $res->update($result['id'], $d);
                }
            }
            // dd($data);

            $act->addActivity(session('id'), 'GPA Calculation', 'GPA for second semester was Calculated and Saved Successfully!');

            return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }
    }

    public function position($id)
    {
        $year = new Year();
        $gp = new Gpa();
        $class = new Academy();
        $act = new ActivityLog();

        $sc = $class->find($id)['school_id'];
        $y = $year->where('current', 1)->first()['id'];

        $p = $gp->where(['school_id' => $sc, 'class_id' => $id, 'year_id' => $y])->orderBy('marks_final', 'desc')->findAll();
        // dd($p);

        foreach ($p as $key => $d) {
            $dt = [
                'position_final' => $key + 1,
                'marks' => $d['marks_final'] + $d['marks_course'],
                'gpa' => ($d['marks_final'] + $d['marks_course'])/$d['subjects'],
            ];

            $gp->update($d['id'], $dt);
        }
        // dd($dt);

        $act->addActivity(session('id'), 'Final Position Calculation', 'Position for second semester results was Assigned and Saved Successfully!');

        return redirect()->to('result/final/show/' . $id . '/' . $y)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function calculation()
    {
        $cls = new Academy();
        $stu = new User();
        $sch = new School();
        $sub = new Subject();
        $yr = new Year();

        $data['title'] = lang('app.students');
        $data['sch'] = $sch->findAll();
        $data['class'] = $cls->findAll();
        $data['sub'] = $sub;
        $data['s'] = $sch;
        $data['c'] = $cls;
        $data['year'] = $yr->where('current', 1)->first();
        $data['stu'] = $stu->where('level', null)->where('fn', 'student')->findAll();
        // dd($data);

        return view('marks/final/calculation', $data);
    }
}
