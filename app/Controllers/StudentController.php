<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Country;
use App\Models\Course;
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

            $user = new User();
            $act = new ActivityLog();

            $username = $user->studentID();
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

            $user->save($data);

            $act->addActivity(session('id'), 'Register New User - Authentication', 'User was Registered by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('malaf') . '!');

            return redirect()->route('student')->with('type', 'success')->with('text', lang('app.successfully') . lang('app.useLast'))->with('title', lang('app.done'));
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
        $stu = new User();
        $sch = new School();

        $data['title'] = lang('app.students');
        $data['sch'] = $sch->findAll();
        $data['class'] = $crs->findAll();
        $data['s'] = $sch;
        $data['c'] = $crs;
        $data['user'] = $stu->find(session('id'));
        $data['stu'] = $stu->where('level', null)->where('fn', 'student')->findAll();
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
                $ok = $reg->update($id, $data);

                $std = $reg->find($id);
                // dd($count);

                $act->addActivity(session('id'), 'Upgrade Student Class', $count . ' Student: ' . $std['name'] . ' ' . $std['lname'] . ' was assigned to Class: ' . ($cls->find($this->request->getVar('level' . $key))['name'] ?? lang('app.graduate')) . ' Successfully!');

                if ($this->request->getVar('level' . $key) == 'graduate') {
                    $dt = [
                        'student_id' => $this->request->getVar('id')[$key],
                        'year_id' => $yr->where('current!=',  null)->first()['id'],
                        'school_id' => $cls->find($this->request->getVar('old_class'))['school_id'],
                    ];
                    // dd($dt);

                    $ok = $khir->save($dt);

                    $act->addActivity(session('id'), 'Create Graduates', 'Student: ' . $std['name'] . ' ' . $std['lname'] . ' was assigned to Graduates Successfully!');
                }
            }
            if ($ok) {
                return redirect()->to('course/show/' . $class_id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
            }
        }
    }

    // function changeClass($id, $level)
    // {
    //     $usr = new User();

    //     $data = [
    //         // 'level' => $level,
    //         'role'  => $level,
    //         'info'  => 'feesPaymentNotDone'
    //     ];
    //     // dd($data);

    //     $usr->update($id, $data);

    //     return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    // }

    // function back($id)
    // {
    //     $usr = new User();

    //     $data = [
    //         'role'  => 'student',
    //         'info'  => null,
    //     ];
    //     // dd($data);

    //     $usr->update($id, $data);

    //     return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    // }

    // public function show($id)
    // {
    //     $class = new Academy();

    //     $data['title'] = lang('app.students');
    //     $data['stu'] = $class->join('users', 'users.level=classes.id')
    //         ->where(['level' => $id, 'fn' => 'student'])->orderBy('id', 'RANDOM')
    //         ->findAll();
    //     $data['class'] = $class->find($id);


    //     dd($data);
    //     if (session('role') != 'user') {
    //         return view('user/view', $data);
    //     } else {
    //         return redirect()->to(base_url('user'));
    //     }
    // }

    // public function create()
    // {
    //     // dd(($this->request->getVar()));
    //     $act = new ActivityLog();
    //     $cls = new Academy();

    //     $count = count($this->request->getVar('student_id'));
    //     if ($count != null) {
    //         for ($i = 0; $i < $count; $i++) {

    //             $user = new User();

    //             $id = $this->request->getVar('student_id')[$i];
    //             $data = [
    //                 'level' => $this->request->getVar('class_id'),
    //             ];
    //             // dd(($data));
    //             $user->update($id, $data);
    //         }

    //         $act->addActivity(session('id'), 'Assign Students to Class', $count . ' Students were assigned to Class: ' . $cls->find($this->request->getVar('class_id'))['name'] . ' Successfully!');

    //         return redirect()->to('class')->with('type', 'success')
    //             ->with('text', lang('app.successfully'))
    //             ->with('title', lang('app.done'));
    //     } else {
    //         return redirect()->to('class')->with('type', 'error')
    //             ->with('text', lang('app.unsuccessfully'))
    //             ->with('title', lang('app.sorry'));
    //     }
    // }

    // public function addStudents($id)
    // {
    //     helper('form');

    //     $class = new Academy();
    //     $user = new User();

    //     $data['title'] = lang('app.academic');
    //     $data['class'] = $class->find($id);
    //     $data['drs'] = $class->findAll();
    //     $data['stu'] = $user->where(['role' => 'user', 'fn' => 'student', 'level' => $data['class']['id']])
    //         ->findAll();
    //     $data['new'] = $user->where(['role' => 'user', 'fn' => 'student', 'level' => null])
    //         ->findAll();

    //     // dd($data);
    //     return view('student/add', $data);
    // }
}
