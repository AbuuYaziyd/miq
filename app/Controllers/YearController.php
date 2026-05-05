<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Year;

class YearController extends BaseController
{
    public function index()
    {
        $year = new Year();

        $data['title'] = lang('app.acYear');
        $data['year'] = $year->findAll();
        $data['current'] = $year->where('current!=', null)->first();
        // dd($data);

        return view('year/index', $data);
    }

    public function add()
    {
        helper('form');

        $data['title'] = lang('app.acYear');

        return view('year/add', $data);
    }

    public function create()
    {
        // dd($this->request->getVar());

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

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.acYear');
            $data['validation'] = $this->validator;

            return view('year/add', $data);
        } else {

            $year = new Year();

            $all_years = $year->findAll();

            $data = [
                'name' => $this->request->getVar('name'),
            ];
            // dd($data);

            $year->save($data);

            $act->addActivity(session('id'), 'Create New Academic Year', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

            $all_years = $year->findAll();
            if (count($all_years) == 1) {
                $new = $all_years[0];
                // dd($new);

                $dt = ['current' => 1];
                $year->update($new['id'], $dt);
            }

            return redirect()->to('year')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }
    }

    public function show($id)
    {
        helper('form');
        
        $year = new Year();

        $data['title'] = lang('app.acYear');
        $data['year'] = $year->find($id);
        // dd($data);

        return view('year/show', $data);
    }

    public function update()
    {
        $year = new Year();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        $data = ['name' => $this->request->getVar('name')];
        // dd($data, $id);

        $ok = $year->update($id, $data);

        $act->addActivity(session('id'), 'Update Academic Year', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        if ($ok) {
            return redirect()->to('year')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        } else {
            return redirect()->to('year')->with('type', 'error')->with('text', lang('app.unsuccessfully'))->with('title', lang('app.sorry'));
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

        $act->addActivity(session('id'), 'Academic Year', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    // public function delete($id)
    // {
    //     $year = new Year();
    //     $act = new ActivityLog();

    //     $ok = $year->delete($id);

    //     $act->addActivity(session('id'), 'Delete Academic Year', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

    //     if ($ok) {
    //         return redirect()->to('year')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    //     } else {
    //         return redirect()->to('year')->with('type', 'error')->with('text', lang('app.unsuccessfully'))->with('title', lang('app.sorry'));
    //     }
    // }
}
