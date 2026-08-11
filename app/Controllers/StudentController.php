<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Country;
use App\Models\Course;
use App\Models\Gpa;
use App\Models\Khirrij;
use App\Models\Mafsul;
use App\Models\School;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;
use App\Models\Year;

class StudentController extends BaseController
{
    function index()
    {
        $usr = new User();
        $crs = new Course();
        $sub = new Subject();
        $tmt = new Timetable();
        $sch = new School();
        $set = new Setting();

        $student = $usr->find(session('id'));
        $class = $crs->find($student['level']);
        // dd($class);

        $data['title'] = lang('app.academic');
        $data['stu'] = $student;
        $data['school'] = $sch->find($class['school_id']);
        $data['class'] = $class;
        $data['classes'] = $crs->findAll();
        $data['subjects'] = $sub->where('course_id', $student['level'])->findAll();
        $data['timetable'] = $tmt->where('course_id', $student['level'])->findAll();
        $data['rooms'] = $set->where(['name' => 'room', 'link!=' => null])->findAll();
        $data['c'] = $crs;
        $data['s'] = $sub;
        // dd($data);

        return view('student/index', $data);
    }

    public function view($id)
    {
        $crs = new Course();
        $usr = new User();

        $data['title'] = lang('app.students');
        $data['stu'] = $usr->where(['level' => $id, 'fn' => 'student'])->orderBy('id', 'RANDOM')->findAll();
        $data['class'] = $crs->find($id);
        // dd($data);

        return view('student/view', $data);
    }

    public function new()
    {
        helper('form');

        $crs = new Course();

        $data['title'] = lang('app.addNewStudent');
        $data['course'] = $crs->findAll();
        $data['crs'] = $crs;
        // dd($data);

        return view('student/new', $data);
    }

    public function create()
    {
        // dd($this->request->getVar());

        helper('form');

        $input = $this->validate(
            [   //Rules
                'name' => 'required|min_length[3]',
                'mname' => 'required|min_length[3]',
                'lname' => 'required|min_length[3]',
                'name_ar' => 'required|min_length[3]',
                'mname_ar' => 'required|min_length[3]',
                'lname_ar' => 'required|min_length[3]',
                'dob' => 'required',
            ],
            [   // Errors
                'name' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'mname' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'lname' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'name_ar' => [
                    'required' => lang('error.required'),
                ],
                'mname_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'lname_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'dob' => [
                    'required' => lang('error.required'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $crs = new Course();

            $data['title'] = lang('app.register');
            $data['course'] = $crs->findAll();
            $data['crs'] = $crs;
            $data['validation'] = $this->validator;
            // dd($data);

            return view('student/new', $data);
        } else {

            $usr = new User();
            $act = new ActivityLog();

            $username = $usr->studentID();
            $email = $this->request->getVar('email');
            $name = str_replace(' ', '', $this->request->getVar('name'));
            $mname = str_replace(' ', '', $this->request->getVar('mname'));
            $lname = str_replace(' ', '', $this->request->getVar('lname'));

            $data = [
                'name'      => $name,
                'mname'     => $mname,
                'lname'     => $lname,
                'password'  => password_hash(strtoupper($lname), PASSWORD_DEFAULT),
                'name_ar'   => $this->request->getVar('name_ar'),
                'mname_ar'  => $this->request->getVar('mname_ar'),
                'lname_ar'  => $this->request->getVar('lname_ar'),
                'phone'     => $this->request->getVar('phone'),
                'dob'       => $this->request->getVar('dob'),
                'level'     => $this->request->getVar('level'),
                'sex'       => $this->request->getVar('sex'),
                'email'     => ($email != '' ? $email : $username . '@gmail.com'),
                'username'  => $username,
                'role'      => 'student',
                'fn'        => 'student',
            ];
            // dd($data);

            $usr->save($data);
            $insert_id = $usr->getInsertID();

            $act->addActivity(session('id'), 'Register New User - Authentication', 'User was Registered by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('malaf') . '!');

            return redirect()->to('student/page/' . $insert_id)->with('type', 'success')->with('text', lang('app.successfully') . lang('app.useLast'))->with('title', lang('app.done'));
        }
    }

    public function assign($id, $class)
    {
        $user = new User();

        $data = ['level' => $class];
        // dd($data);

        $ok = $user->update($id, $data);

        if ($ok) {
            return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        } else {
            return redirect()->back()->with('type', 'error')->with('text', lang('app.unsuccessfully'))->with('title', lang('app.sorry'));
        }
    }

    function page($id)
    {
        $usr = new User();
        $crs = new Course();
        $sub = new Subject();
        $tmt = new Timetable();
        $sch = new School();
        $set = new Setting();

        $student = $usr->find($id);
        $class = $crs->find($student['level']);
        // dd($student, $class);

        $data['title'] = lang('app.academic');
        $data['stu'] = $student;
        $data['school'] = $sch->find($class['school_id']);
        $data['class'] = $class;
        $data['classes'] = $crs->findAll();
        $data['subjects'] = $sub->where('course_id', $student['level'])->findAll();
        $data['timetable'] = $tmt->where('course_id', $student['level'])->findAll();
        $data['rooms'] = $set->where(['name' => 'room', 'link!=' => null])->findAll();
        $data['c'] = $crs;
        $data['s'] = $sub;
        // dd($data);

        return view('student/index', $data);
    }

    public function data()
    {
        $crs = new Course();
        $usr = new User();
        $sch = new School();

        if (session('lang') != 'ar') {
            $stu = $usr->where('level', null)->where('fn', 'student')->orderBy('name', 'asc')->findAll();
        } else {
            $stu = $usr->where('level', null)->where('fn', 'student')->orderBy('name_ar', 'asc')->findAll();
        }

        $data['title'] = lang('app.students');
        $data['sch'] = $sch->findAll();
        $data['class'] = $crs->findAll();
        $data['s'] = $sch;
        $data['c'] = $crs;
        $data['stu'] = $stu;
        $data['user'] = $usr->find(session('id'));
        // dd($data);

        return view('student/data', $data);
    }

    function id($id)
    {
        $usr = new User();
        $nat = new Country();
        $crs = new Course();

        $user = $usr->find($id);
        $data['title'] = lang('app.id');
        $data['user'] = $user;
        $data['course'] = $crs->find($user['level']);
        $data['nat'] = $nat->where('code', $user['nationality'])->first();
        // dd($data);

        return view('student/id', $data);
    }

    function classChange($id, $class_id)
    {
        $usr = new User();

        $data = ['level' => $class_id];
        // dd($data);

        $usr->update($id, $data);

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function upgrade($id)
    {
        helper('form');

        $user = new User();
        $class = new Course();
        $sch = new School();

        $cl = $class->find($id);

        $data['title'] = lang('app.students');
        $data['class'] = $cl;
        $data['sch'] = $sch;
        $data['next'] = $cl['id'] + 1;
        $data['drs'] = $class->findAll();
        $data['stu'] = $user->where('level', $id)->findAll();
        // dd($data);

        return view('student/upgrade', $data);
    }

    public function edit($class_id)
    {
        // dd($this->request->getVar());

        $reg = new User();
        $khir = new Khirrij();
        $yr = new Year();
        $fasl = new Mafsul();
        $act = new ActivityLog();
        $cls = new Course();
        $sch = new School();
        $gpa = new Gpa();

        $count = count($this->request->getVar('id'));
        if ($count != null) {
            foreach ($this->request->getVar('id') as $key => $dt) {

                $id = $this->request->getVar('id')[$key];
                if ($this->request->getVar('level' . $key) == 'mafsul') {
                    $fasl->addMafsul($id, '', '');
                }

                $data = [
                    'level' => $this->request->getVar('level' . $key),
                ];
                // dd($data);

                $reg->update($id, $data);

                $std = $reg->find($id);
                // dd($count);

                $act->addActivity(session('id'), 'Upgrade Student Class', $count . ' Student: ' . $std['name'] . ' ' . $std['lname'] . ' was assigned to Class: ' . ($cls->find($this->request->getVar('level' . $key))['name'] ?? lang('app.graduate')) . ' Successfully!');

                $gpa_count = $gpa->where('student_id', $id)->countAllResults();
                $sum_gpa = $gpa->where('student_id', $id)->selectSum('gpa')->get()->getRow()->gpa;
                $school = $sch->find($cls->find($class_id)['school_id']);

                if ($this->request->getVar('level' . $key) == 'graduate') {
                    $dt = [
                        'student_id' => $this->request->getVar('id')[$key],
                        'year_id' => $yr->where('current!=',  null)->first()['id'],
                        'school_id' => $school['id'],
                        'certificate' => $school['name'],
                        'certificate_no' => $std['username'],
                        'gpa' => $sum_gpa / $gpa_count,
                    ];

                    $d = ['role' => 'graduate', 'level' => 'graduate'];
                    // dd($dt, $d);

                    $khir->save($dt);
                    $reg->update($id, $d);

                    $act->addActivity(session('id'), 'Create Graduates', 'Student: ' . $std['name'] . ' ' . $std['lname'] . ' was assigned to Graduates Successfully!');
                }
            }
            // dd($dt, $d, $gpa_count, $sum_gpa);

            return redirect()->to('course/show/' . $class_id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }
    }
}
