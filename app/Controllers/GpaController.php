<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hijri;
use App\Models\ActivityLog;
use App\Models\Course;
use App\Models\Gpa;
use App\Models\Result;
use App\Models\School;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;

class GpaController extends BaseController
{
    function class($exam, $id, $year_id)
    {
        $gpa = new Gpa();
        $sch = new School();
        $crs = new Course();
        $set = new Setting();

        $course = $crs->find($id);
        // dd($course);

        $cors_name = session('lang') != 'ar' ? $course['name'] : $course['name_ar'];
        $data['title'] = lang('app.results') . ' - ' . $cors_name;
        $data['gpa'] = $gpa;
        $data['course'] = $course;
        $data['exam'] = $exam;
        $data['name'] = $set->where('name', 'name')->first();
        $data['location'] = $set->where('name', 'location')->first();
        $data['school'] = $sch->find($course['school_id']);
        $data['class_gpa'] = $gpa->where(['course_id' => $id, 'year_id' => $year_id, $exam . '_gpa!=' => null])->orderBy($exam . '_marks', 'DESC')->findAll();
        // dd($data);

        return view('gpa/class', $data);    
    }

    public function kashf($id, $fasl)
    {
        // dd($fasl, $id);
        $gpa = new Gpa();
        $set = new Setting();

        $data['title'] = lang('app.academicProgress');
        $data['gpa'] = $gpa;
        $data['mudir'] = $set->where('name', 'mudir')->first();
        $data['taalim'] = $set->where('name', 'taalim')->first();
        $data['gpas'] =  $gpa->where(['student_id' => $id, 'course_id' => $fasl])->first();
        // dd($data);

        return view('gpa/kashf', $data);
    }

    public function report($exam, $id, $fasl)
    {
        // dd($fasl, $id, $exam);
        $res = new Result();
        $set = new Setting();
        $yer = new Year();
        $gpa = new Gpa();
        $usr = new User();
        $crs = new Course();
        $sub = new Subject();

        $year_id = $yer->where('current', 1)->first()['id'];

        $data['title'] = lang('app.academicProgress');
        $data['gpa'] = $gpa;
        $data['exam'] = $exam;
        $data['class'] = $crs->find($fasl);
        $data['student'] = $usr->find($id);
        $data['mudir'] = $set->where('name', 'mudir')->first();
        $data['taalim'] = $set->where('name', 'taalim')->first();
        $data['colour'] = $set->where('name', 'colour')->first();
        $data['markaz'] = $set->where('name', 'name')->first();
        $data['location'] = $set->where('name', 'location')->first();
        $data['postabox'] = $set->where('name', 'postabox')->first();
        $data['subjects'] = $sub->where('course_id', $fasl)->findAll();
        $data['students'] = $usr->where('level', $fasl)->countAllResults();
        $data['results'] =  $res->where(['student_id' => $id, 'course_id' => $fasl, 'year_id' => $year_id])->findAll();
        $data['marks'] =  $res->where(['student_id' => $id, 'course_id' => $fasl, 'year_id' => $year_id])->selectSum($exam)->get()->getRow();
        $data['muadala'] =  $res->where(['student_id' => $id, 'course_id' => $fasl, 'year_id' => $year_id])->selectAvg($exam)->get()->getRow();
        $data['stu_gpa'] =  $gpa->where(['student_id' => $id, 'course_id' => $fasl, 'year_id' => $year_id])->first();
        // dd($data);

        return view('gpa/report', $data);
    }

    function progress($id)
    {
        $gpa = new Gpa();
        $set = new Setting();

        $data['title'] = lang('app.academicProgress');
        $data['gpa'] = $gpa;
        $data['mudir'] = $set->where('name', 'mudir')->first();
        $data['taalim'] = $set->where('name', 'taalim')->first();
        $data['gpas'] =  $gpa->where('student_id', $id)->orderBy('course_id', 'asc')->findAll();
        // dd($data);

        return view('gpa/progress', $data);
    }

    public function edit()
    {
        $sub = new Subject();
        $res = new Result();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $course_id = $this->request->getVar('course_id');
        $user_id = $this->request->getVar('user_id');
        $year_id = $this->request->getVar('year_id');
        $exam = $this->request->getVar('exam');
        // dd($course_id, $user_id, $exam);

        $subjects = $sub->where('course_id', $course_id)->countAllResults();
        $student_results = $res->where(['course_id' => $course_id, 'student_id' => $user_id, 'year_id' => $year_id])->findAll();
        // dd($student_results, $subjects);

        foreach ($student_results as $r) {
            $dt = [$exam . '_status' => 'edit'];
            $res->update($r['id'], $dt);
        }

        $act->addActivity(session('id'), 'Edit Marks - AFTER Rendering GPA -', 'Results was Opened for Editing!');

        return redirect()->back();
    }

    public function gpa()
    {
        $sub = new Subject();
        $res = new Result();
        $gpa = new Gpa();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $course_id = $this->request->getVar('course_id');
        $user_id = $this->request->getVar('user_id');
        $gpa_id = $this->request->getVar('gpa_id');
        $year_id = $this->request->getVar('year_id');
        $exam = $this->request->getVar('exam');
        // dd($course_id, $user_id, $exam);

        $subjects = $sub->where('course_id', $course_id)->countAllResults();
        $student_results = $res->where(['course_id' => $course_id, 'student_id' => $user_id, 'year_id' => $year_id])->findAll();
        // dd($student_results, $subjects);

        // Total Marks
        $marks = $gpa->sum($user_id, $course_id)['sum'];

        // Calculate GPA
        $muadala = ($marks / (($subjects) * 100)) * 100;

        $data = [
            $exam . '_marks' => $marks,
            'gpa' => $muadala,
        ];
        // dd($data);

        $gpa->update($gpa_id, $data);

        foreach ($student_results as $r) {
            $dt = [$exam . '_status' => 'gpa'];
            $res->update($r['id'], $dt);
        }

        $gpas = $gpa->where(['course_id' => $course_id, 'year_id' => $year_id])->orderBy($exam . '_marks', 'desc')->findAll();
        foreach ($gpas as $key => $gp) {
            $data = [
                $exam . '_position' => $key + 1,
            ];
            $gpa->update($gp['id'], $data);
        }
        // dd($gpas, $data);

        $act->addActivity(session('id'), 'GPA Calculation - AFTER EDITING MARKS -', 'GPA was Edited and Saved Successfully!');

        return redirect()->back();
    }

    public function view($id, $yr)
    {
        helper('form');

        $res = new Result();
        $user = new User();
        $sub = new Subject();
        $gpa = new Gpa();
        $sch = new School();
        $cl = new Course();
        $year = new Year();

        $class = $cl->find($id);
        $results = $res->where(['course_id' => $id, 'year_id' => $yr])->findAll();
        $users = $user->where(['role' => 'student', 'level' => $id])->findAll();
        $search = $gpa->where(['course_id' => $id, 'year_id' => $yr])->orderBy('marks', 'DESC')->findAll();

        // dd(count($search));
        // dd($results);
        
        $data['title'] = lang('app.results') . ' - ' . $class['name'];
        $data['pr'] = $gpa;
        $data['sub'] = $sub->where('course_id', $id)->findAll();
        $data['std'] = $users;
        $data['class'] = $class;
        $data['year'] = $year->find($yr);
        $data['yr'] = $year->findAll();
        $data['sch'] = $sch->find($class['school_id']);
        $data['results'] = false;
        $data['muadala'] = false;
        $data['position'] = false;


        if ($results > 0) {$data['results'] = true;} 

        if (count($search) > 0) {
            if ($search[0]['position'] != null) {
                $search = $gpa->where(['course_id' => $id, 'year_id' => $yr])->orderBy('position', 'ASC')->findAll();
                
                $data['position'] = true;
                $data['std'] = $search;
            }
            $data['muadala'] = true;
            $data['std'] = $search;
        }
        // dd($data);

        return view('gpa/view', $data);
    }

    public function search($link)
    {
        $gpa = new Gpa();
        $set = new Setting();

        $find = $gpa->where('link', $link)->first();
        $data['title'] = lang('app.academicProgress');
        $data['gpa'] = $gpa;
        $data['mudir'] = $set->where('name', 'mudir')->first();
        $data['taalim'] = $set->where('name', 'taalim')->first();
        $data['gpas'] =  $gpa->where('student_id', $find['student_id'])->orderBy('course_id', 'asc')->findAll();
        // dd($data);

        return view('gpa/progress', $data);
    }

    function fasl($id, $year_id)
    {
        $gpa = new Gpa();
        $sch = new School();
        $crs = new Course();
        $set = new Setting();

        $course = $crs->find($id);
        // dd($course);

        $cors_name = session('lang') != 'ar' ? $course['name'] : $course['name_ar'];
        $data['title'] = lang('app.results') . ' - ' . $cors_name;
        $data['gpa'] = $gpa;
        $data['course'] = $course;
        $data['name'] = $set->where('name', 'name')->first();
        $data['location'] = $set->where('name', 'location')->first();
        $data['school'] = $sch->find($course['school_id']);
        $data['class_gpa'] = $gpa->where(['course_id' => $id, 'year_id' => $year_id, 'gpa!=' => null])->orderBy('marks', 'DESC')->findAll();
        // dd($data);

        return view('gpa/fasl', $data);
    }
}
