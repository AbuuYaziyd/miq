<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Period;

class PeriodController extends BaseController
{
    public function index()
    {
        $prd = new Period();

        $data['title'] = lang('app.periods');
        $data['period'] = $prd->findAll();
        // dd($data);

        return view('period/index', $data);
    }

    public function add()
    {
        helper('form');

        $prd = new Period();

        $data['title'] = lang('app.periods');
        // dd($data);

        return view('period/add', $data);
    }

    public function create()
    {
        // dd($this->request->getVar());

        helper('form');

        $prd = new Period();
        $act = new ActivityLog();

        $input = $this->validate(
            [   //Rules
                'start' => 'required',
                'end' => 'required',
            ],
            [   // Errors
                'start' =>
                [
                    'required' => lang('error.required'),
                ],
                'end' =>
                [
                    'required' => lang('error.required'),
                ],
            ]
        );
        // dd($input);

        if (!$input) {
            $data['title'] = lang('app.periods');
            $data['validation'] = $this->validator;
            // dd($data);

            echo view('period/add', $data);
        } else {

            $data = [
                'start' => $this->request->getVar('start'),
                'end'   => $this->request->getVar('end'),
            ];
            // dd($data);

            $prd->save($data);

            $act->addActivity(session('id'), 'Create New Period', 'New Period was Created Successfully!');

            return redirect()->to('period')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }

    }

    public function show($id)
    {
        helper('form');

        $prd = new Period();

        $data['title'] = lang('app.periods');
        $data['period'] = $prd->find($id);
        // dd($data);

        return view('period/show', $data);
    }

    public function update()
    {
        // dd($this->request->getVar());

        $prd = new Period();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        // dd($id);

        $data = [
            'start' => $this->request->getVar('start'),
            'end'   => $this->request->getVar('end'),
        ];
        // dd($data);

        $prd->update($id, $data);

        $act->addActivity(session('id'), 'Update Period', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('period')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function delete($id)
    {
        $prd = new Period();
        $act = new ActivityLog();

        // dd($id);
        $prd->delete($id);

        $act->addActivity(session('id'), 'Delete Period', 'Period was Deleted Successfully!');

        return redirect()->to('period')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }
}
