<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\Register;
use App\Models\Setting;
use App\Models\User;
use App\Models\Year;

class AdminController extends BaseController
{
    public function index()
    {
        $usr = new User();
        $att = new Attendance();
        $set = new Setting();

        $data['title'] = lang('app.dashboard');
        $data['students'] = $usr->where('role', 'student')->countAllResults();
        $data['teachers'] = $usr->where('fn', 'teacher')->countAllResults();
        $data['user'] = $usr->find(session('id'));
        $data['rooms'] = $set->where(['name' => 'room', 'link!=' => null])->findAll();
        $data['attendance'] = $att->where(['status' => 0, 'reason!=' => null, 'file!=' => null, 'reply' => null])->findAll();
        // dd($data);

        return view('admin/index', $data);
    }

    public function setting()
    {
        $data['title'] = lang('app.settings');
        // dd($data);

        return view('admin/setting', $data);
    }

    public function registration()
    {
        $reg = new Register();

        $data['title'] = lang('app.newStudents');
        $data['users'] = $reg->findAll();
        // dd($data);

        return view('admin/registration', $data);
    }

    // public function showReg($id)
    // {
    //     helper('form');

    //     $reg = new Register();
    //     $crs = new Course();
    //     $usr = new User();
    //     $typ = new FeeType();

    //     $register = $reg->find($id);
    //     $data['title'] = lang('app.newStudents');
    //     $data['course'] = $crs->findAll();
    //     $data['register'] = $register;
    //     $data['user'] = $usr->where('email', $register['email'])->first();
    //     $data['fee'] = $typ->find(1);
    //     $data['maombi'] = env('maombi');
    //     // dd($data);

    //     return view('admin/user-registered', $data);
    // }

    // public function regDelete($id)
    // {
    //     // dd($id);

    //     $act = new ActivityLog();
    //     $reg = new Register();

    //     $reg->delete($id);

    //     $act->addActivity(session('id'), 'Delete new Registered Student from the System: ', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

    //     return redirect()->to('admin/registration')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    // }

    // public function register()
    // {
    //     // dd($this->request->getVar());

    //     $reg = new Register();
    //     $usr = new User();
    //     $act = new ActivityLog();

    //     $level = $this->request->getVar('level');
    //     $dt = $reg->find($this->request->getVar('id'));
    //     // dd($dt, $level);

    //     $newUser = [
    //         'password'      => password_hash(strtoupper($dt['lname']), PASSWORD_DEFAULT),
    //         'nationality'   => $dt['nationality'],
    //         'username'      => $usr->studentID(),
    //         'address'       => strtoupper($dt['address']),
    //         'name'          => strtoupper($dt['fname']),
    //         'mname'         => strtoupper($dt['mname']),
    //         'lname'         => strtoupper($dt['lname']),
    //         'email'         => strtolower($dt['email']),
    //         'phone'         => $dt['phone'],
    //         'sex'           => $dt['sex'],
    //         'dob'           => $dt['dob'],
    //         'role'          => 'student',
    //         'fn'            => 'student',
    //         'level'         => $level,
    //     ];
    //     // dd($newUser);

    //     $usr->insert($newUser);

    //     $act->addActivity(session('id'), 'Register new Student to System: ', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

    //     return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    // }

    // public function malipo()
    // {
    //     // dd($this->request->getVar());

    //     $reg = new Register();
    //     $yr = new Year();
    //     $typ = new FeeType();
    //     $fee = new Fee();
    //     $act = new ActivityLog();

    //     $user_id = $this->request->getVar('user_id');
    //     $level = $this->request->getVar('level');
    //     $dt = $reg->find($this->request->getVar('id'));
    //     $type = $typ->find(1);
    //     $query = $fee->select()->orderBy('id', 'desc')->where('receipt!=', null)->first();
    //     // dd($user_id, $level, $dt, $type, $query);

    //     if (isset($query)) {
    //         $invc = $query['receipt'];
    //         $invc = substr($invc, 10, 13);
    //         $invc = $invc + 1;
    //         $invc = "MIH" . date("my") . sprintf('%04s', $invc);
    //     } else {
    //         $invc = "MIH" . date("my") . sprintf('%04s', 1);
    //     }
    //     // dd($invc);

    //     // dd(count($this->request->getVar('month')));
    //     for ($i = 0; $i < count($this->request->getVar('month')); $i++) {
    //         $data = [
    //             'month'     => $this->request->getVar('month')[$i],
    //             'total'     => $this->request->getVar('amount'),
    //             'amount'    => $type['amount'],
    //             'status'    => 'verified',
    //             'user_id'   => $user_id,
    //             'image'     => $this->request->getVar('image'),
    //             'year_id'   => $yr->where('current!=', null)->first()['id'],
    //             'fee_type'  => $type['id'],
    //             'course_id' => $level,
    //             'admin_id'  => session('id'),
    //             'receipt'   => $invc,
    //         ];
    //         $fee->save($data);
    //     }
    //     // dd($data);

    //     $reg->delete($dt['id']);

    //     $act->addActivity(session('id'), 'Register new Student Payments: ', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

    //     return redirect()->to('admin/registration')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    // }

    function rooms()
    {
        helper('form');

        $set = new Setting();

        $data['title'] = lang('app.rooms');
        $data['rooms'] = $set->where('name', 'room')->findAll();
        // dd($data);

        return view('admin/rooms', $data);  
    }

    public function room()
    {
        // dd($this->request->getVar());

        $set = new Setting();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        $link = $this->request->getVar('link');
        // dd($id, $link);

        $data = ['link'   => $link];
        // dd($data);

        $set->update($id, $data);

        $act->addActivity(session('id'), 'Opening Link: ' . $id, 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('admin/rooms')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    function deleteRoom($id)
    {
        $set = new Setting();
        $act = new ActivityLog();

        $data = ['link' => null];
        // dd($data);

        $set->update($id, $data);

        $act->addActivity(session('id'), 'Closing Link: ' . $id, 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('admin/rooms')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }
}
