<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Course;
use App\Models\Mafsul;
use App\Models\Subject;
use App\Models\User;

class MafsulController extends BaseController
{   
    public function index()
    {
        $fasl = new Mafsul();
        $usr = new User();
        $crs = new Course();

        $data['title'] = lang('app.mafsuls');
        $data['mafsul'] = $fasl->findAll();
        $data['ada'] = $usr->where('role', 'mafsul')->findAll();
        $data['fasl'] = $fasl;
        $data['crs'] = $crs;
        // dd($data);

        if (session('role') == 'admin') {
            return view('mafsul/index', $data);
        } elseif (session('fn') == 'student') {
            return view('home/mafsul', $data);
        } else {
            return redirect()->to('/')->with('type', 'error')->with('text', lang('app.authorisedPersonellOnly'))->with('title', lang('app.sorry'));
        }
    }

    // public function add($id)
    // {
    //     helper('form');

    //     $usr = new User();
    //     $cls = new Academy();

    //     $user = $usr->find($id);
    //     $data['title'] = lang('app.mafsuls');
    //     $data['user'] = $user;
    //     $data['class'] = $cls->find($user['level']);
    //     // dd($data);

    //     return view('mafsul/add', $data);
    // }

    // function show($id)
    // {
    //     // dd($id);
    //     $fasl = new Mafsul();
    //     $usr = new User();
    //     $cl = new Course();
    //     $sub = new Subject();

    //     $mafsul = $fasl->find($id);
    //     $stu = $usr->find($mafsul['student_id']);
    //     $class = $cl->find($mafsul['class_id']);

    //     $data['title'] = lang('app.mafsul');
    //     $data['mafsul'] = $mafsul;
    //     $data['stu'] = $stu;
    //     $data['class'] = $class;
    //     $data['c'] = $cl;
    //     $data['s'] = $sub;
    //     $data['allClass'] = $cl->where('school_id', $mafsul['school_id'])->findAll();
    //     // dd($data);

    //     return view('mafsul/show', $data);
    // }

    // function create()
    // {
    //     // dd($this->request->getVar());

    //     helper('form');

    //     $fasl = new Mafsul();
    //     $usr = new User();

    //     $id = $this->request->getVar('student_id');

    //     $fasl->addMafsul($id, $this->request->getVar('reason'), $this->request->getVar('info'));

    //     $dataUser = [
    //         'level' => 'mafsul',
    //     ];

    //     // dd($dataUser);
    //     $usr->update($id, $dataUser);

    //     return redirect()->to('mafsul')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        
    // }

    // function back($id)
    // {
    //     helper('form');

    //     $fasl = new Mafsul();
    //     $cls = new Academy();
    //     $usr = new User();

    //     $mafsul = $fasl->find($id);
    //     $user = $usr->find($mafsul['student_id']);
    //     $data['title'] = lang('app.mafsuls');
    //     $data['mafsul'] = $mafsul;
    //     $data['user'] = $user;
    //     $data['class'] = $cls->find($mafsul['class_id']);
    //     // dd($data);

    //     return view('mafsul/back', $data);
    // }

    // function update()
    // {
    //     // dd($this->request->getFile('file'));
    //     // dd($this->request->getVar());

    //     $usr = new User();
    //     $fasl = new Mafsul();
    //     $act = new ActivityLog();

    //     $file = $this->request->getFile('file');
    //     $id = $this->request->getVar('id');
    //     $user = $usr->find($this->request->getVar('student_id'));
    //     $ext = $file->getClientExtension();

    //     // dd($ext == true);
    //     if ($ext == true) {
    //         $name = time() . $user['id'] . '.' . $ext;
    //         // dd($name);

    //         $dataFILE = [
    //             'file' => 'public/mafsul/' . $name,
    //         ];

    //         $file->move('public/mafsul/', $name);
    //         $fasl->update($id, $dataFILE);
    //     }
    //     $fasl->delete($id);

    //     $dataUser = [
    //         'level' => null,
    //         'role' => 'student',
    //         'fn' => 'student',
    //     ];

    //     // dd($dataUser);
    //     $usr->update($user['id'], $dataUser);
    //     $act->addActivity(session('id'), 'Remove User From Discontinue and Added to student list', 'Task was Done Successfully!');

    //     return redirect()->to('students')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    // }

    // public function info($id)
    // {
    //     $usr = new User();
    //     $cl = new Academy();
    //     $sub = new Subject();

    //     $user = $usr->find($id);
    //     $class = $cl->find($user['level']);
    //     // dd($user);

    //     if ($user['level'] == 'graduate') {
    //         return redirect()->to('khirrij/info/' . $id);
    //     } elseif ($user['level'] == 'mafsul') {
    //         return redirect()->to('mafsul');
    //     } else {
    //         $data['title'] = lang('app.students');
    //         $data['stu'] = $user;
    //         $data['class'] = $class;
    //         $data['c'] = $cl;
    //         $data['s'] = $sub;
    //         $data['allClass'] = $cl->where('school_id', $class['school_id'])->findAll();
    //         // dd($data);

    //         return view('students/view', $data);
    //     }
    // }
    }
