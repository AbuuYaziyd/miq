<?php

namespace App\Controllers;

use App\Models\Setting;
use App\Models\Website;

class Home extends BaseController
{
    public function index()
    {
        $set = new Setting();
        $web = new Website();

        $mauqii = $set->where('name', 'register')->first();

        $data['title'] = lang('app.welcome');
        $data['carousel'] = $web->where('item', 'carousel')->first();
        $data['hero'] = $web->where('item', 'hero')->findAll();
        $data['email'] = $set->where('name', 'email')->first();
        $data['phone'] = $set->where('name', 'phone')->first();
        $data['markaz'] = $set->where('name', 'name')->first();
        $data['colour'] = $set->where('name', 'colour')->first();
        $data['location'] = $set->where('name', 'location')->first();
        $data['logo'] = $set->where('name', 'logo')->first();
        // dd($data, $mauqii);

        if ($mauqii['link'] != 'checked') {
            return view('home/index', $data);
        } else {
            return view('home/website', $data);
        }
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
        dd('test');
    }
}
