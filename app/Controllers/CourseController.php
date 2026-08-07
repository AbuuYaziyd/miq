<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;

class CourseController extends BaseController
{
    public function show($id)
    {
        // dd($id);

        helper('form');

        $crs = new Course();
        $sbj = new Subject();
        $usr = new User();
        $yr = new Year();

        $data['title'] = lang('app.schools');
        $data['course'] = $crs->find($id);
        $data['c'] = $crs;
        $data['yr'] = $yr->where('current', 1)->first();
        $data['tch'] = $usr->where(['fn' => 'teacher'])->findAll();
        $data['students'] = $usr->where(['role' => 'student', 'fn' => 'student', 'level' => $id])->orderBy('username', 'ASC')->findAll();
        $data['sub'] = $sbj->where('course_id', $id)->findAll();
        // dd($data);

        return view('course/show', $data);
    }
     
    public function update()
    {
        // dd($this->request->getVar());

        $crs = new Course();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        // dd($id);

        $data = [
            'name'      => strtoupper($this->request->getVar('name')),
            'name_ar'   => $this->request->getVar('name_ar'),
            'head_id'   => $this->request->getVar('head_id'),
        ];
        // dd($data);
        
        $crs->update($id, $data);

        $act->addActivity(session('id'), 'Update Class', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('course/show/' . $id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function attendance($sex, $id)
    {
        helper('form');

        $cls = new Course();
        $sch = new School();
        $yr = new Year();
        $usr = new User();
        $att = new Attendance();

        $class = $cls->find($id);

        $data['title'] = lang('app.advancedSettings');
        $data['class'] = $class;
        $data['usr'] = $usr;
        $data['sch'] = $sch->find($class['school_id']);
        $data['yr'] = $yr->where('current', 1)->first();
        $data['std'] = $usr->where(['level' => $id, 'fn' => 'student', 'sex' => $sex])->findAll();
        $data['query'] = $att->where(['date' => date('Y-m-d'), 'course_id' => $id, 'sex' => $sex])->findAll();
        // dd($data);

        return view('course/attendance', $data);
    }

    public function settings($id)
    {
        $cls = new Course();
        $sch = new School();
        $yr = new Year();

        $class = $cls->find($id);

        $data['title'] = lang('app.advancedSettings');
        $data['class'] = $class;
        $data['sch'] = $sch->find($class['school_id']);
        $data['yr'] = $yr->where('current', 1)->first();
        // dd($data);

        return view('course/settings', $data);
    }

    function students($id)
    {
        $usr = new User();
        $crs = new Course();

        $course = $crs->find($id);
        $data['title'] = lang('app.students') . ' - ' . $course['name_ar'];
        $data['course'] = $course;
        $data['usr'] = $usr;
        $data['std'] = $usr->where('level', $id)->orderBy('sex', 'desc')->findAll();
        // dd($data);

        return view('course/students', $data);
    }

    public function add($id)
    {
        // dd($id);

        helper('form');

        $sch = new School();
        $tch = new User();

        $data['title'] = lang('app.schools');
        $data['sch'] = $sch->findAll();
        $data['sc'] = $sch->find($id);
        $data['tch'] = $tch->where(['fn' => 'teacher'])->findAll();
        // dd($data);

        return view('course/add', $data);
    }

    public function create()
    {
        // dd($this->request->getVar());

        helper('form');

        $sch = new School();
        $tch = new User();

        $input = $this->validate(
            [   //Rules
                'name' => 'required|min_length[3]|max_length[50]',
                'name_ar' => 'required|min_length[3]|max_length[50]',
                'teacher_id' => 'required',
            ],
            [   // Errors
                'name' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                    'max_length' => lang('error.max_length'),
                ],
                'name_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                    'max_length' => lang('error.max_length'),
                ],
                'teacher_id' =>
                [
                    'required' => lang('error.required'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.schools');
            $data['validation'] = $this->validator;
            $data['sch'] = $sch->findAll();
            $data['sc'] = $sch->find($this->request->getVar('school_id'));
            $data['tch'] = $tch->where(['fn' => 'teacher'])->findAll();
            // dd($data);

            return view('course/add', $data);
        } else {

            $crs = new Course();
            $act = new ActivityLog();

            $data = [
                'name'          => strtoupper($this->request->getVar('name')),
                'name_ar'       => $this->request->getVar('name_ar'),
                'head_id'       => $this->request->getVar('teacher_id'),
                'shift_id'      => $this->request->getVar('shift_id'),
                'school_id'     => $this->request->getVar('school_id'),
            ];
            // dd($data);

            $crs->save($data);

            $act->addActivity(session('id'), 'Create New Mustawa', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

            return redirect()->to('school/show/' . $this->request->getVar('school_id'))->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }
    }

    public function class($id, $teacher)
    {
        $usr = new User();
        $cls = new Course();
        $sub = new Subject();

        $data['title'] = lang('app.allStudents');
        $data['class'] = $cls->find($id);
        $data['sub'] = $sub;
        $data['subjects'] = $sub->where(['course_id' => $id, 'head_id' => $teacher])->findAll();
        $data['std'] = $usr->where('level', $id)->orderBy('sex', 'desc')->findAll();
        // dd($data);

        return view('course/class', $data);
    }

    public function links()
    {
        helper('form');

        $crs = new Course();

        $data['title'] = lang('app.doroosLink');
        $data['course'] = $crs->findAll();
        // dd($data);

        return view('course/links', $data);
    }

    public function link()
    {
        // dd($this->request->getVar());

        helper('form');

        $crs = new Course();
        $act = new ActivityLog();

        $input = $this->validate(
            [   //Rules
                'link' => 'required',
            ],
            [   // Errors
                'link' =>
                [
                    'required' => lang('error.required'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.doroosLink');
            $data['course'] = $crs->findAll();
            $data['validation'] = $this->validator;
            // dd($data);

            return view('course/links', $data);
        } else {
            $data = ['link' => $this->request->getVar('link')];
            $id = $this->request->getVar('id');
            // dd($data, $id);

            $crs->update($id, $data);

            $act->addActivity(session('id'), 'Add Doroos Link to Mustawa', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

            return redirect()->to('course/links')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }
    }

    public function deleteLink($id)
    {
        $crs = new Course();
        $act = new ActivityLog();

        $data = ['link' => null];
        // dd($data, $id);

        $crs->update($id, $data);

        $act->addActivity(session('id'), 'Delete Doroos Link from Mustawa', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('course/links')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function delete($id)
    {
        $crs = new Course();
        $act = new ActivityLog();

        // dd($id);
        $course = $crs->find($id);
        $crs->delete($id);

        $act->addActivity(session('id'), 'Delete Class', 'Class was Deleted Successfully!');

        return redirect()->to('school/show/' . $course['school_id'])->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }
}
