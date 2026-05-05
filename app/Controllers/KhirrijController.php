<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Academy;
use App\Models\Gpa;
use App\Models\Khirrij;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;

class KhirrijController extends BaseController
{
    public function index()
    {
        $kh = new Khirrij();
        $user = new User();
        $yr = new Year();

        $data['title'] = lang('app.graduates');
        // $data['std'] = $kh->where('student_id!=', null)->findAll();
        $data['std'] = $user->where(['role' => 'student', 'fn' => 'student', 'level' => 'graduate'])->orderBy('username', 'ASC')->findAll();
        $data['year'] = $yr->findAll();
        $data['yr'] = $kh->select('year_id')->distinct()->findAll();
        $data['k'] = $kh;
        // dd($data);

        return view('khirrij/index', $data);
    }

    // /*
    // * Search graduates on the DB based on the provided year_id
    // */ 
    // public function year($id)
    // {
    //     $kh = new Khirrij();
    //     $yr = new Year();

    //     $data['title'] = lang('app.graduates');
    //     $data['std'] = $kh->where('year_id', $id)->findAll();
    //     $data['year'] = $yr->findAll();
    //     $data['yr'] = $kh->select('year_id')->distinct()->findAll();
    //     $data['k'] = $kh;
    //     $data['yr_id'] = $id;
    //     // dd($data);

    //     return view('khirrij/year', $data);
    // }

    // /*
    // * Show graduate Data
    // */ 
    // public function show($id)
    // {
    //     // dd($id);
    //     $usr = new User();
    //     $cl = new Academy();
    //     $sub = new Subject();
    //     $gpa = new Gpa();

    //     $user = $usr->find($id);
    //     $class = $cl->find($user['level']);

    //     $data['title'] = lang('app.graduate');
    //     $data['stu'] = $user;
    //     $data['class'] = $class;
    //     $data['c'] = $cl;
    //     $data['s'] = $sub;
    //     $data['gpa'] = $gpa->where('student_id', $id)->findAll();
    //     // $data['allClass'] = $cl->where('school_id', $class['school_id'])->findAll();
    //     // dd($data);

    //     // $kh = new Khirrij();

    //     // $data['title'] = lang('app.graduates');
    //     // $data['std'] = $kh->where('student_id!=', null)->findAll();
    //     // $data['k'] = $kh;
    //     // dd($data);

    //     return view('khirrij/show', $data);
    // }

    // public function info($id)
    // {
    //     $usr = new User();
    //     $cl = new Academy();
    //     $sub = new Subject();
    //     $khir = new Khirrij();

    //     $user = $usr->find($id);
    //     $class = $cl->find($user['level']);
    //     // $grd = $khir->where('student_id', $id)->first();
    //     // dd($grd);

    //     $data['title'] = lang('app.students');
    //     $data['stu'] = $user;
    //     $data['class'] = $class;
    //     $data['c'] = $cl;
    //     $data['s'] = $sub;
    //     // dd($data);

    //     return view('khirrij/view', $data);
    // }
}
