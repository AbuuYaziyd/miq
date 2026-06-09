<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hijri;
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

    // public function edit()
    // {
    //     // dd($this->request->getVar());
    //     $class_id = $this->request->getVar('class_id');
    //     $gpa_id = $this->request->getVar('gpa_id');
    //     $user_id = $this->request->getVar('user_id');

    //     $sub = new Subject();
    //     $res = new Result();
    //     $gpa = new Gpa();
    //     $act = new ActivityLog();

    //     $subjects = $sub->where('class_id', $class_id)->countAllResults();
    //     $student_results = $res->where(['class_id' => $class_id, 'student_id' => $user_id])->findAll();
    //     // dd($student_results);

    //     // Total Marks
    //     $marks = $gpa->sum($user_id, $class_id);

    //     //Points 
    //     $pt = $res->where(['student_id' => $user_id, 'class_id' => $class_id])->findAll();
    //     $p = 0;

    //     foreach ($pt as $mark_point) {
    //         $point = ($res->grade(($mark_point['course'] + $mark_point['final']))['point']);
    //         $p = $p + $point;
    //     }

    //     // Calculate GPA
    //     $muadala = ($marks / (($subjects) * 100)) * 5;

    //     $data = [
    //         'marks' => $marks,
    //         'gpa' => $muadala,
    //         'point' => $p,
    //     ];
    //     // dd($data);

    //     $gpa->update($gpa_id, $data);

    //     foreach ($student_results as $r) {
    //         $dt = ['status' => 'done'];
    //         $res->update($r['id'], $dt);
    //     }

    //     $act->addActivity(session('id'), 'GPA Calculation -AFTER EDITING MARKS-', 'GPA was Edited and Saved Successfully!');

    //     return redirect()->back();
    // }

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
