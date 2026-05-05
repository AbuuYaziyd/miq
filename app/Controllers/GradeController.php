<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Grade;

class GradeController extends BaseController
{
    public function index()
    {
        $grade = new Grade();

        $data['title'] = lang('app.grades');
        $data['grade'] = $grade->findAll();
        // dd($data);

        return view('grade/index', $data);
    }

    public function show($id)
    {
        helper('form');

        $grade = new Grade();

        $data['title'] = lang('app.grade');
        $data['grade'] = $grade->find($id);
        // dd($data);

        return view('grade/show', $data);
    }

    public function update()
    {
        // dd($this->request->getVar());

        $grade = new Grade();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        // dd($id);

        $data = [
            'name'      => $this->request->getVar('name'),
            'name_ar'   => $this->request->getVar('name_ar'),
            'bidaya'    => $this->request->getVar('bidaya'),
            'nihaya'    => $this->request->getVar('nihaya'),
            'ramz'      => $this->request->getVar('ramz'),
            'ramz_ar'   => $this->request->getVar('ramz_ar'),
            'point'     => $this->request->getVar('point'),
        ];
        // dd($data);

        $grade->update($id, $data);

        $act->addActivity(session('id'), 'Update Grade', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('grade')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    // public function add()
    // {
    //     helper('form');

    //     $data['title'] = lang('app.grade');

    //     if (session('role') != 'user') {
    //         return view('grade/add', $data);
    //     } else {
    //         return redirect()->to(base_url('user'));
    //     }
    // }

    // public function create()
    // {
    //     helper('form');

    //     $input = $this->validate(
    //         [   //Rules
    //             'name' => 'required|min_length[3]|max_length[50]|is_unique[grades.name]',
    //         ],
    //         [   // Errors
    //             'name' =>
    //             [
    //                 'required' => lang('error.required'),
    //                 'min_length' => lang('error.min_length'),
    //                 'max_length' => lang('error.max_length'),
    //                 'is_unique' => lang('error.is_unique'),
    //             ],
    //         ]
    //     );

    //     if (!$input) {
    //         $data['title'] = lang('app.grade');
    //         $data['validation'] = $this->validator;
    //         echo view('grade/add', $data);
    //     } else {

    //         $grade = new Grade();
    //         $act = new ActivityLog();

    //         $data = [
    //             'name'     => $this->request->getVar('name'),
    //             'bidaya'    => $this->request->getVar('bidaya'),
    //             'nihaya' => $this->request->getVar('nihaya'),
    //         ];

    //         // dd($data); exit;
    //         $ok = $grade->save($data);

    //         if ($ok) {
    //             $act->addActivity(session('id'), 'Create New Grade', 'New Grade was Created Successfully!');

    //             return redirect()->to('grade')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    //         }
    //     }

    // }

    // public function delete($id)
    // {

    //     $grade = new Grade();
    //     $act = new ActivityLog();

    //     // dd($id);exit;
    //     $ok = $grade->delete($id);

    //     if ($ok) {
    //         $act->addActivity(session('id'), 'Delete Grade', 'Grade was Deleted Successfully!');

    //         return redirect()->to('grade')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    //     } else {
    //         return redirect()->to('grade')->with('type', 'error')->with('text', lang('app.unsuccessfully'))->with('title', lang('app.sorry'));
    //     }
    // }
}
