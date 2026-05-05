<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Country;
use App\Models\Course;
use App\Models\School;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\User;

class TeacherController extends BaseController
{
    public function index()
    {
        $usr = new User();
        $sch = new School();
        $crs = new Course();
        $sub = new Subject();
        $set = new Setting();

        $data['title'] = lang('app.teachers');
        $data['head'] = $sch->where('head_id', session('id'))->findAll();
        $data['teacher'] = $usr->where('role', 'teacher')->orWhere('fn', 'teacher')->findAll();
        $data['class'] = $crs->where('head_id', session('id'))->findAll();
        $data['sub'] = $sub->where('head_id', session('id'))->findAll();
        $data['user'] = $usr->find(session('id'));
        $data['rooms'] = $set->where(['name' => 'room', 'link!=' => null])->findAll();
        $data['c'] = $sch;
        $data['s'] = $sub;
        $data['ac'] = $crs;
        // dd($data);
        
        return view('teacher/index', $data);
    }

    public function add()
    {
        helper('form');

        $sbj = new Subject();
        // $user = new User();

        $data['title'] = lang('app.newTeacher');
        $data['sbj'] = $sbj->findAll();

        // $query = $user->where('fn', 'teacher')->orderBy('id', 'desc')->first();

        return view('teacher/add', $data);
    }

    public function data()
    {
        $crs = new Course();
        $usr = new User();

        $data['title'] = lang('app.teachers');
        $data['teacher'] = $usr->where(['fn' => 'teacher'])->orderBy('id', 'asc')->findAll();
        // dd($data);

        return view('teacher/data', $data);
    }

    public function create()
    {
        // dd($this->request->getVar());

        helper('form');

        $usr = new User();
        $act = new ActivityLog();

        $input = $this->validate(
            [   //Rules
                'name' => 'required|min_length[3]',
                'mname' => 'required|min_length[3]',
                'lname' => 'required|min_length[3]',
                'name_ar' => 'required|min_length[3]',
                'mname_ar' => 'required|min_length[3]',
                'lname_ar' => 'required|min_length[3]',
                'sex' => 'required',
                'dob' => 'required',
                'level' => 'required',
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
                'name_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
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
                'phone' => [
                    'required' => lang('error.required'),
                    'is_unique' => lang('error.is_unique'),
                ],
                'sex' => [
                    'required' => lang('error.required'),
                ],
                'dob' => [
                    'required' => lang('error.required'),
                ],
                'level' => [
                    'required' => lang('error.required'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.teachers');
            $data['validation'] = $this->validator;
            // dd($data);

            return view('teacher/add', $data);
        } else {
            $username = $usr->teacherID();

            // dd($this->request->getVar('email') == null);
            if ($this->request->getVar('email') == null) {
                $email = $username . '@gmail.com';
            } else {
                $email = $this->request->getVar('email');
            }
            // dd($email, $username);

            $data = [
                'name'      => strtoupper($this->request->getVar('name')),
                'mname'     => strtoupper($this->request->getVar('mname')),
                'lname'     => strtoupper($this->request->getVar('lname')),
                'name_ar'   => $this->request->getVar('name_ar'),
                'mname_ar'  => $this->request->getVar('mname_ar'),
                'lname_ar'  => $this->request->getVar('lname_ar'),
                'email'     => $email,
                'password'  => password_hash(strtoupper($this->request->getVar('lname')), PASSWORD_DEFAULT),
                'username'  => $username, //4mula
                'phone'     => $this->request->getVar('phone'),
                'sex'       => $this->request->getVar('sex'),
                'level'     => $this->request->getVar('level'),
                'dob'       => $this->request->getVar('dob'),
                'web'       => 'showOnWeb',
                'role'      => 'teacher',
                'fn'        => 'teacher',
            ];
            // dd($data);

            $usr->save($data);

            $act->addActivity(session('id'), 'Create New Teacher', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

            return redirect()->to('teacher/data')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }
    }

    public function show($id)
    {
        $user = new User();
        $sub = new Subject();

        $data['title'] = lang('app.teachers');
        $data['sub'] = $sub->where('head_id', $id)->findAll();
        $data['user'] = $user->find($id);
        $data['s'] = $sub;
        // $data['class'] = $
        // dd($data);

        return view('teacher/show', $data);
    }

    function id($id)
    {
        $usr = new User();
        $nat = new Country();
        $crs = new Course();

        $user = $usr->find($id);
        $data['title'] = lang('app.id');
        $data['user'] = $user;
        $data['level'] = lang('app.' . $user['level']);
        $data['nat'] = $nat->where('code', $user['nationality'])->first();
        // dd($data);

        return view('teacher/id', $data);
    }

    public function edit($id)
    {
        helper('form');

        $user = new User();

        $data['title'] = lang('app.teachers');
        $data['user'] = $user->find($id);
        // dd($data, $id);

        return view('teacher/edit', $data);
    }

    public function update()
    {
        // dd($this->request->getVar());

        $usr = new User();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        // dd($id);

        $data = [
            'name'          => strtoupper($this->request->getVar('name')),
            'mname'         => strtoupper($this->request->getVar('mname')),
            'lname'         => strtoupper($this->request->getVar('lname')),
            'name_ar'       => $this->request->getVar('name_ar'),
            'mname_ar'      => $this->request->getVar('mname_ar'),
            'lname_ar'      => $this->request->getVar('lname_ar'),
            'email'         => $this->request->getVar('email'),
            'phone'         => $this->request->getVar('phone'),
            'sex'           => $this->request->getVar('sex'),
            'level'         => $this->request->getVar('level'),
            'dob'           => $this->request->getVar('dob'),
            'web'           => $this->request->getVar('web'),
            'kun_yah'       => $this->request->getVar('kun_yah'),
            'kun_yah_ar'    => $this->request->getVar('kun_yah_ar'),
            'facebook'      => $this->request->getVar('facebook'),
            'insta'         => $this->request->getVar('insta'),
            'twitter'       => $this->request->getVar('twitter'),
        ];
        // dd($data);

        $usr->update($id, $data);

        $act->addActivity(session('id'), 'Edit Teacher Data', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('teacher')->with('type', 'success')->with('text', lang('app.successful'))->with('title', lang('app.done'));
    }

    public function page($id)
    {
        $usr = new User();
        $sch = new School();
        $crs = new Course();
        $sub = new Subject();
        $set = new Setting();


        $data['title'] = lang('app.teachers');
        $data['head'] = $sch->where('head_id', $id)->findAll();
        $data['teacher'] = $usr->where('role', 'teacher')->orWhere('fn', 'teacher')->findAll();
        $data['class'] = $crs->where('head_id', $id)->findAll();
        $data['sub'] = $sub->where('head_id', $id)->findAll();
        $data['user'] = $usr->find($id);
        $data['rooms'] = $set->where(['name' => 'room', 'link!=' => null])->findAll();
        $data['c'] = $sch;
        $data['s'] = $sub;
        $data['ac'] = $crs;
        // dd($data);

        return view('teacher/index', $data);
    }
}
