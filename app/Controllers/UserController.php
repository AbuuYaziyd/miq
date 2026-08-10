<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Country;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        if (session('role') == 'student') {
            return redirect()->to('student');
        } elseif (session('role') == 'teacher') {
            return redirect()->to('teacher');
        } elseif (session('role') == 'admin') {
            return redirect()->to('admin');
        } elseif (session('role') == 'khirrij') {
            return redirect()->to('khirrij');
        } elseif (session('role') == 'mafsul') {
            return redirect()->to('mafsul');
        }
    }

    public function profile($id)
    {
        $usr = new User();
        $crs = new Course();
        $sub = new Subject();

        $user = $usr->find($id);

        $data['title'] = lang('app.profile');
        $data['user'] = $user;
        $data['usr'] = $usr;
        $data['course'] = $crs->where('id', $user['level'])->first();
        $data['sub'] = $sub;
        // dd($data);

        return view('user/profile', $data);
    }

    public function show($id)
    {
        helper('form');

        $user = new User();
        $nat = new Country();
        
        $data['title'] = lang('app.profile');
        $data['user'] = $user->find($id);
        $data['nat'] = $nat->findAll();
        // dd($data);

        return view('user/show', $data);
    }

    public function update($id)
    {
        // dd($this->request->getVar());

        $usr = new User();
        $act = new ActivityLog();
        
        $id = $this->request->getVar('id');
        $user = $usr->find($id);
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
            'dob'           => $this->request->getVar('dob'),
            'sex'           => $this->request->getVar('sex'),
            'kun_yah'       => ucwords(strtolower($this->request->getVar('kun_yah'))),
            'kun_yah_ar'    => $this->request->getVar('kun_yah_ar'),
        ];
        // dd($data);

        $usr->update($id, $data);

        $act->addActivity(session('id'), 'Update ' . $user['name'] .' Data', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('user/show/' . $user['id'])->with('type', 'success')->with('title', lang('app.done'))->with('text', lang('app.successfully'));
    }

    // public function image()
    // { 
    //     // dd($this->request->getFile('avatar'));

    //     $usr = new User();
    //     $act = new ActivityLog();

    //     $user = $usr->find($this->request->getVar('id'));
    //     // dd($user);

    //     $validationRule = $this->validate(
    //         [
    //             'avatar' => 'uploaded[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/svg]|max_size[avatar,2048]',
    //         ],
    //         [   // Errors
    //             'avatar' => [
    //                 'uploaded' => lang('error.uploaded'),
    //                 'mime_in' => lang('error.mime'),
    //                 'max_size' => lang('error.max_size'),
    //             ],
    //         ]
    //     );
    //     // dd($validationRule);

    //     if (!$validationRule) {
    //         helper('form');

    //         $data['title'] = lang('app.profile');
    //         $data['user'] = $user;
    //         $data = ['errors' => $this->validator->getErrors()];
    //         // dd($data['errors']['avatar']);

    //         return redirect()->back()->with('toast', 'error')->with('title', lang('app.sorry'))->with('text', $data['errors']['avatar']);
    //     }

    //     $img = $user['avatar'];
    //     // dd($img);

    //     // dd(file_exists($img));
    //     if (file_exists($img)) {
    //         unlink($img);
    //     }
    //     $newImg = $this->request->getFile('avatar');
    //     $ext = $newImg->getClientExtension();
    //     $name = time() . $user['id'] . '.' . $ext;
    //     // dd($name);

    //     $dataIMG = [
    //         'avatar' => 'public/avatar/' . $name,
    //     ];
    //     // dd($dataIMG);

    //     $newImg->move('public/avatar/', $name);

    //     $usr->update($user['id'], $dataIMG);

    //     if ($user['id'] == session('id')) {
    //         $sess = session();
    //         $sess->remove('avatar');
    //         $sess->set('avatar', 'public/avatar/' . $name);
    //         $sess->close();
    //     }

    //     $act->addActivity(session('id'), 'User Avatar Updated', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

    //     return redirect()->to('user/profile/' . $user['id'])->with('type', 'success')->with('title', lang('app.done'))->with('text', lang('app.successfully'));
    // }

    // function deleteImage($id)
    // {
    //     $usr = new User();
    //     $act = new ActivityLog();

    //     $user = $usr->find($id);

    //     // dd(file_exists($user['avatar']));
    //     if (file_exists($user['avatar'])) {
    //         unlink($user['avatar']);
    //     }
        
    //     $dt['avatar'] = null;
    //     // dd($dt);

    //     $usr->update($id, $dt);

    //     if ($user['id'] == session('id')) {
    //         $sess = session();
    //         $sess->remove('avatar');
    //         $sess->set('avatar', null);
    //         $sess->close();
    //     }

    //     $act->addActivity(session('id'), 'User Avatar', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

    //     return redirect()->back()->with('toast', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    // }
}
