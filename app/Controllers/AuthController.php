<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        $data['title'] = lang('app.login');
        // dd($data);

        if (session('isLoggedIn') == true) {
            return redirect()->to('user');
        } else {
            helper('form');
            return view('auth/login', $data);
        }
    }

    public function auth()
    {
        // dd($this->request->getVar());

        $session = session();
        $user = new User();
        $act = new ActivityLog();

        $identity = $this->request->getVar('identity');
        $password = $this->request->getVar('password');
        $data = $user->where('username', $identity)->orWhere('email', $identity)->orWhere('phone', $identity)->first();
        // dd($data);

        if ($data) {
            $pass = $data['password'];
            $auth = password_verify($password, $pass);
            // dd($auth);

            if ($auth) {
                $sessData = [
                    'id' => $data['id'],
                    'name' => $data['name']  . ' ' . $data['mname'] . ' ' . $data['lname'],
                    'name_ar' => $data['name_ar'] . ' ' . $data['mname_ar'] . ' ' . $data['lname_ar'],
                    'kun_yah' => $data['kun_yah'],
                    'kun_yah_ar' => $data['kun_yah_ar'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'level' => $data['level'],
                    'avatar' => $data['avatar'],
                    'fn' => $data['fn'],
                    'sex' => $data['sex'],
                    'role' => $data['role'],
                    'dob' => $data['dob'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($sessData);
                // dd($sessData);

                $act->addActivity($data['id'], 'Log In - Authentication', 'User was Logged In Successfully!');

                return redirect()->to('user');
            }else {
                return redirect()->to('login')->with('identity', lang('app.dataNotRecognised'));
            }
        }else {
            return redirect()->to('login')->with('identity', lang('app.dataNotRecognised'));
        }
    }

    public function pass()
    {
        helper('form');

        $data['title'] = lang('app.recoverpassword');
        // dd($data);

        return view('auth/change', $data);
    }

    public function change($id)
    {
        helper('form');

        $usr = new User();
        $act = new ActivityLog();

        $input = $this->validate(
            [   //Rules
                'old' => 'required',
                'new' => 'required',
            ],
            [   // Errors
                'old' => [
                    'required' => lang('error.required'),
                ],
                'new' => [
                    'required' => lang('error.required'),
                ],
            ]
        );


        $old = $this->request->getVar('old');
        $new = $this->request->getVar('new');

        $data = $usr->find($id);
        $pass = $data['password'];
        $auth = password_verify($old, $pass);
        // dd($auth);

        // dd(!$input);
        if (!$input) {
            $data['title'] = lang('app.passchange');
            $data['validation'] = $this->validator;
            echo view('auth/change', $data);
        } elseif (!$auth) {
            $data['title'] = 'settings';
            return redirect()->to('change/password')->with('text', lang('app.notokoldpass'))->with('type', 'error')->with('title', lang('app.sorry'));
        } else {
            $data = [
                'password' => password_hash($new, PASSWORD_DEFAULT)
            ];
            // dd($data);

            $usr->update($id, $data);

            $act->addActivity($id, 'Change Password - Authentication', 'User\'s Password was Changed Successfully!');

            return redirect()->to(session('role'))->with('toast', 'success')->with('title', lang('app.done'))->with('text', lang('app.passchanged'));
        }
    }

    public function logout()
    {
        $act = new ActivityLog();

        $act->addActivity(session('id'), 'Log Out - Authentication', 'User was Logged Out Successfully!');

        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }

    public function recover()
    {
        helper('form');
        $data['title'] = lang('app.recoverpassword');

        return view('auth/recover', $data);
    }

    public function password()
    {
        // dd($this->request->getVar());
        helper('form');

        $input = $this->validate(
            [   //Rules
                'identity' => 'required|min_length[3]',
                'lname' => 'required|min_length[3]',
                'phone' => 'required|exact_length[12]',
            ],
            [   // Errors
                'identity' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'lname' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'phone' => [
                    'required' => lang('error.required'),
                    'exact_length' => lang('error.exact_length'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.recoverpassword');
            $data['validation'] = $this->validator;
            // dd($data);

            echo view('auth/recover', $data);
        } else {
            $user = new User();
            $act = new ActivityLog();

            $identity = $this->request->getVar('identity');
            $lname = strtoupper($this->request->getVar('lname'));
            $phone = $this->request->getVar('phone');
            $data = $user->where('username', $identity)->first();
            // dd($data);

            // dd($data>0);
            if ($data > 0) {
                // dd(!(strtolower($lname) == strtolower($data['lname']) && $phone == $data['phone']));
                if (!(strtolower($lname) == strtolower($data['lname']) || $phone == $data['phone'])) {
                    return redirect()->to('recover')->with('type', 'error')->with('title', lang('app.incorrect'))->with('text', lang('app.lname') . '/' . lang('app.phone'));
                } else {
                    $user = new User();
                    $id = $data['id'];

                    $data = ['password' => password_hash(strtoupper($lname), PASSWORD_DEFAULT),];

                    $ok = $user->update($id, $data);

                    $act->addActivity($id, 'Reset Password - Authentication', 'User\'s Password was Reset Successfully! Since Forgot password method was used.');

                    if ($ok) {
                        return redirect()->to('login')->with('type', 'success')->with('text', lang('app.passchanged').' '. lang('app.useLast'))->with('title', lang('app.done'));
                    }
                }
            } else {
                // dd(lang('app.notFound'));
                return redirect()->to('recover')->with('type', 'error')->with('text', lang('app.notFound'))->with('title', lang('app.sorry'));
            }
        }
    }

    public function reset($id)
    {
        $usr = new User();
        $act = new ActivityLog();

        $user = $usr->find($id);
        $lname = str_replace(' ', '', $user['lname']);
        // dd($user);

        $data = ['password' => password_hash(strtoupper($lname), PASSWORD_DEFAULT),];

        $usr->update($id, $data);

        $act->addActivity($id, 'Reset User Password - By Admin', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->back()->with('toast', 'success')->with('text', lang('app.passchanged') . ' ' . lang('app.useLast'))->with('title', lang('app.done'));
    }
}