<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hijri;
use App\Models\Academy;
use App\Models\Course;
use App\Models\Gpa;
use App\Models\Khirrij;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;

class KhirrijController extends BaseController
{
    public function index()
    {
        $khr = new Khirrij();
        $usr = new User();
        $yr = new Year();
        $hjr = new Hijri;

        $data['title'] = lang('app.graduates');
        $data['std'] = $usr->where(['role' => 'graduate', 'fn' => 'student', 'level' => 'graduate'])->orderBy('name_ar', 'ASC')->findAll();
        $data['year'] = $yr->findAll();
        $data['yr'] = $khr->select('year_id')->distinct()->findAll();
        $data['khr'] = $khr;
        $data['hjr'] = $hjr;
        // dd($data);

        return view('khirrij/index', $data);
    }

    /*
    * Search graduates on the DB based on the provided year_id
    */
    public function year($id)
    {
        $khr = new Khirrij();
        $yr = new Year();
        $hjr = new Hijri;

        $data['title'] = lang('app.graduates');
        $data['std'] = $khr->where('year_id', $id)->findAll();
        $data['year'] = $yr->findAll();
        $data['yr'] = $khr->select('year_id')->distinct()->findAll();
        $data['khr'] = $khr;
        $data['yr_id'] = $id;
        $data['hjr'] = $hjr;
        // dd($data);

        return view('khirrij/year', $data);
    }

    /*
    * Show graduate Data
    */
    public function show($id)
    {
        // dd($id);
        $usr = new User();
        $cl = new Course();
        $sub = new Subject();
        $gpa = new Gpa();

        $user = $usr->find($id);
        $class = $cl->find($user['level']);

        $data['title'] = lang('app.graduate');
        $data['stu'] = $user;
        $data['class'] = $class;
        $data['c'] = $cl;
        $data['s'] = $sub;
        $data['gpa'] = $gpa->where('student_id', $id)->findAll();
        // $data['allClass'] = $cl->where('school_id', $class['school_id'])->findAll();
        // dd($data);

        // $kh = new Khirrij();

        // $data['title'] = lang('app.graduates');
        // $data['std'] = $kh->where('student_id!=', null)->findAll();
        // $data['k'] = $kh;
        // dd($data);

        return view('khirrij/show', $data);
    }
}
