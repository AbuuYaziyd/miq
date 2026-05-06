<?php

namespace App\Controllers;

use App\Models\Gpa;
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
        $gpa = new Gpa();
        $gpas = $gpa->findAll();
        foreach ($gpas as $gp) {
            $data = [
                'gpa' => $gp['course_gpa'] + $gp['final_gpa']
            ];
            // $gpa->update($gp['id'], $data);
        }
        // dd($data);


        dd('test');
    }
}
