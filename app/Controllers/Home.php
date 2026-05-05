<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Models\Result;
use App\Models\Setting;
use App\Models\Website;

class Home extends BaseController
{
    public function index(): string
    {
        $web = new Website();

        $data['title'] = lang('app.welcome');
        $data['carousel'] = $web->where('item', 'carousel')->first();
        $data['hero'] = $web->where('item', 'hero')->findAll();
        // dd($data);

        return view('home/index', $data);
        // return view('home/index', $data);
    }

    public function locale($locale)
    {
        // dd($locale);

        $session = session();
        $session->remove('lang');
        $session->set('lang', $locale);
        return redirect()->back();
    }

    function rooms()
    {
        $set = new Setting();

        $data['title'] = lang('app.rooms');
        $data['rooms'] = $set->where(['name' => 'room', 'link!=' => null])->findAll();
        // dd($data);

        return view('home/rooms', $data);
    }

    function test()
    {
        $adm = new Admin();
        $res = new Result();

        $class_id = 3;
        $result = $adm->findAll();
        foreach ($result as $d) {
            for ($i=18; $i <= 26; $i++) {
                $theRes = $res->where(['course_id' => $class_id, 'subject_id' => $i, 'student_id' => $d['student_id']])->first();
                // dd($theRes, $d[$i] - $theRes['course']); 
                $data = [
                    'final' => ($d[$i] - $theRes['course']),
                    'final_status' => 'marked'
                ];

                // $res->update($theRes['id'], $data);
            }
        }
        dd($result, $result['0'][20], $data);

        dd('test');
    }
}
