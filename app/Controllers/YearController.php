<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hijri;
use App\Models\ActivityLog;
use App\Models\Year;

class YearController extends BaseController
{
    public function index()
    {
        // dd($_SESSION['role']);
        $year = new Year();

        $data['title'] = lang('app.acYear');
        $data['year'] = $year->findAll();
        $data['current'] = $year->where('current!=', null)->first();

        if (session('role') != 'user') {
            return view('year/index', $data);
        } else {
            return redirect()->to(base_url('user'));
        }
    }

    public function change($id)
    {
        // dd($id);
        $year = new Year();
        $act = new ActivityLog();

        $old = $year->where('current', 1)->first();
        $dt = ['current' => null];
        $year->update($old['id'], $dt);

        $new = $year->find($id);
        $dt = ['current' => 1];
        $year->update($new['id'], $dt);

        $act->addActivity(session('id'), 'Academic Year', 'Academic Year wa Changed Successfully!');

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function show($id)
    {
        helper('form');
        // dd($_SESSION['role']);
        $year = new Year();

        $data['title'] = lang('app.acYear');
        $data['year'] = $year->find($id);

        if (session('role') != 'user') {
            return view('year/edit', $data);
        } else {
            return redirect()->to(base_url('user'));
        }
    }

    public function add()
    {
        helper('form');

        $hjr = new Hijri;

        $data['title'] = lang('app.acYear');
        $data['year'] = $hjr->strToHijri(date('Y-m-d'), "Y", session('lang'));
        // dd($data);

        if (session('role') != 'user') {
            return view('year/add', $data);
        } else {
            return redirect()->to(base_url('user'));
        }
    }

    public function create()
    {
        // dd($this->request->getVar('name'));
        helper('form');

        $act = new ActivityLog();

        $input = $this->validate(
            [   //Rules
                'name' => 'required|min_length[3]|max_length[50]|is_unique[years.name]',
            ],
            [   // Errors
                'name' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                    'max_length' => lang('error.max_length'),
                    'is_unique' => lang('error.is_unique'),
                ],
            ]
        );

        if (!$input) {
            $hjr = new Hijri;

            $data['title'] = lang('app.acYear');
            $data['year'] = $hjr->strToHijri(date('Y-m-d'), "Y", session('lang'));
            $data['validation'] = $this->validator;
            
            echo view('year/add', $data);
        } else {

            $year = new Year();

            $data = [
                'name' => $this->request->getVar('name'),
            ];

            // dd($ok);
            $ok = $year->save($data);

            $act->addActivity(session('id'), 'Create New Academic Year', 'New Academic Year was Created Successfully!');

            if ($ok) {
                return redirect()->to('year')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
            }
        }
    }

    public function edit($id)
    {
        $year = new Year();
        $act = new ActivityLog();

        $data = [
            'name' => $this->request->getVar('name'),
        ];

        $ok = $year->update($id, $data);

        $act->addActivity(session('id'), 'Update Academic Year\' Data', 'Academic Year Data wa Updated Successfully!');

        if ($ok) {
            return redirect()->to('year')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }else {
            return redirect()->to('year')->with('type', 'error')->with('text', lang('app.unsuccessfully'))->with('title', lang('app.sorry'));
        }
    }

    public function delete($id)
    {
        $year = new Year();
        $act = new ActivityLog();

       $ok = $year->delete($id);

        $act->addActivity(session('id'), 'Delete Academic Year', 'Academic Year wa Deleted Successfully!');

       if ($ok) {
           return redirect()->to('year')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
       }else {
            return redirect()->to('year')->with('type', 'error')->with('text', lang('app.unsuccessfully'))->with('title', lang('app.sorry'));
       }
    }
}
