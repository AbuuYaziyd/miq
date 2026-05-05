<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Course;
use App\Models\School;
use App\Models\User;

class SchoolController extends BaseController
{
    public function index()
    {
        $sch = new School();

        $data['title'] = lang('app.schools');
        $data['school'] = $sch->findAll();
        $data['c'] = $sch;
        // dd($data);

        return view('school/index', $data);
    }

    public function add()
    {
        helper('form');

        $tch = new User();

        $data['title'] = lang('app.schools');
        $data['tch'] = $tch->where(['fn' => 'teacher'])->findAll();
        // dd($data);

        return view('school/add', $data);
    }

    public function show($id)
    {
        helper('form');

        $sch = new School();
        $usr = new User();
        $crs = new Course();

        $data['title'] = lang('app.schools');
        $data['sch'] = $sch->find($id);
        $data['c'] = $crs;
        $data['tch'] = $usr->where(['fn' => 'teacher'])->findAll();
        $data['ac'] = $crs->where('school_id', $id)->findAll();
        // dd($data);

        return view('school/show', $data);
    }

    public function create()
    {
        // dd($this->request->getVar());

        helper('form');

        $tch = new User();
        $sc = new School();
        $act = new ActivityLog();

        $input = $this->validate(
            [   //Rules
                'name' => 'required|min_length[3]|max_length[50]|is_unique[schools.name]',
                'name_ar' => 'required|min_length[3]|max_length[50]|is_unique[schools.name]',
                'head_id' => 'required',
            ],
            [   // Errors
                'name' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                    'max_length' => lang('error.max_length'),
                    'is_unique' => lang('error.is_unique'),
                ],
                'name_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                    'max_length' => lang('error.max_length'),
                    'is_unique' => lang('error.is_unique'),
                ],
                'head_id' =>
                [
                    'required' => lang('error.required'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.schools');
            $data['validation'] = $this->validator;
            $data['tch'] = $tch->where(['fn' => 'teacher'])->findAll();
            // dd($data);

            return view('school/add', $data);
        } else {


            $data = [
                'name'      => strtoupper($this->request->getVar('name')),
                'name_ar'   => $this->request->getVar('name_ar'),
                'head_id'   => $this->request->getVar('head_id'),
            ];
            // dd($data);

            $sc->save($data);

            $act->addActivity(session('id'), 'Create New School/College', 'New School/College was Created Successfully!');

            return redirect()->to('school')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }
    }

    public function update()
    {
        // dd($this->request->getVar());

        $sch = new School();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        // dd($id);

        $data = [
            'name'      => strtoupper($this->request->getVar('name')),
            'name_ar'   => $this->request->getVar('name_ar'),
            'head_id'   => $this->request->getVar('head_id'),
        ];
        // dd($data);

        $sch->update($id, $data);

        $act->addActivity(session('id'), 'Update School Data', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('school/show/' . $id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function delete($id)
    {
        $sch = new School();
        $act = new ActivityLog();

        // dd($id);
        $ok = $sch->delete($id);

        if ($ok) {
            $act->addActivity(session('id'), 'Delete School', 'School was Deleted Successfully!');

            return redirect()->to('class')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        } else {
            return redirect()->to('class')->with('type', 'error')->with('text', lang('app.unsuccessfully'))->with('title', lang('app.sorry'));
        }
    }
}
