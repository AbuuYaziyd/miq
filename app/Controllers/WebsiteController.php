<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Setting;
use App\Models\Website;

class WebsiteController extends BaseController
{
    public function index()
    {
        helper('form');

        $set = new Setting();

        $data['title'] = lang('app.website');
        $data['name'] = $set->where('name', 'name')->first();
        $data['email'] = $set->where('name', 'email')->first();
        $data['phone'] = $set->where('name', 'phone')->first();
        $data['location'] = $set->where('name', 'location')->first();
        $data['postabox'] = $set->where('name', 'postabox')->first();
        $data['mudir'] = $set->where('name', 'mudir')->first();
        $data['taalim'] = $set->where('name', 'taalim')->first();
        $data['logo'] = $set->where('name', 'logo')->first();
        $data['colour'] = $set->where('name', 'colour')->first();
        $data['register'] = $set->where('name', 'register')->first();
        $data['mauqii'] = $set->where('name', 'register')->first();
        // dd($data);

        return view('web/index', $data);
    }

    function carousel()
    {
        helper('form');

        $web = new Website();

        $data['title'] = lang('app.website');
        $data['carousel'] = $web->where('item', 'carousel')->first();
        $data['hero'] = $web->where('item', 'hero')->findAll();
        // dd($data);

        return view('web/carousel', $data);
    }

    function carouselUpdate()
    {
        helper('form');

        $web = new Website();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $id = $this->request->getVar('id');
        // dd($id);
        
        $input = $this->validate(
            [   //Rules
                'text' => 'required|min_length[3]',
                'text_ar' => 'required|min_length[3]',
            ],
            [   // Errors
                'text' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'text_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.website');
            $data['carousel'] = $web->where('item', 'carousel')->findAll();
            $data['hero'] = $web->where('item', 'hero')->findAll();
            $data['validation'] = $this->validator;
            // dd($data);

            return view('web/carousel', $data);
        } else {
            $data = [
                'text'      => $this->request->getVar('text'),
                'text_ar'   => $this->request->getVar('text_ar'),
            ];
            // dd($data);

            $ok = $web->update($id, $data);

            $act->addActivity(session('id'), 'Update Website Content: Carousel', 'Task was Performed by: '. session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

            if ($ok) {
            return redirect()->to('web/carousel')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
            }
        }
    }

    function image()
    {
        helper('form');

        $web = new Website();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');

        // dd($this->request->getFile('image'));
        if ($this->request->getFile('image')) {
            $validationRule = $this->validate(
                [
                    'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/svg]|max_size[image,2048]',
                ],
                [   // Errors
                    'image' => [
                        'uploaded' => lang('error.uploaded'),
                        'mime_in' => lang('error.mime'),
                        'max_size' => lang('error.max_size'),
                    ],
                ]
            );

            // dd($validationRule);
            if (!$validationRule) {
                $error = $this->validator->getError('image');
                return redirect()->back()->with('type', 'error')->with('title', $error);
            }

            $img = $web->find($id)['image'];
            // dd($img);

            // dd(file_exists($img));
            if (file_exists($img)) {
                unlink($img);
            }

            $newImg = $this->request->getFile('image');
            $ext = $newImg->getClientExtension();
            $name = time() . $id . '.' . $ext;
            // dd($name);

            $dataIMG = [
                'image' => 'public/carousel/' . $name,
            ];

            $newImg->move('public/carousel/', $name);
            $web->update($id, $dataIMG);

            $act->addActivity(session('id'), 'Carousel Image Change', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');
        }

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    function deleteImage($id)
    {
        $web = new Website();

        $img = $web->find($id);
        $data = ['image' => '#'];
        // dd($data, $img);

        // dd(file_exists($img['image']));
        if (file_exists($img['image'])) {
            unlink($img['image']);
        }

        $web->update($id, $data);

        return redirect()->back();
    }

    function about()
    {
        helper('form');

        $web = new Website();

        $data['title'] = lang('app.website');
        $data['about'] = $web->where('item', 'about')->first();
        $data['about_text'] = $web->where('item', 'aboutText')->findAll();
        // dd($data);

        return view('web/about', $data);
    }

    function aboutTextUpdate()
    {
        helper('form');

        $web = new Website();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $id = $this->request->getVar('id');
        // dd($id);

        $input = $this->validate(
            [   //Rules
                'title' => 'required|min_length[3]',
                'title_ar' => 'required|min_length[3]',
                'text' => 'required|min_length[3]',
                'text_ar' => 'required|min_length[3]',
            ],
            [   // Errors
                'title' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'title_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'text' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'text_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.about');
            $data['about'] = $web->where('item', 'about')->first();
            $data['about_text'] = $web->where('item', 'aboutText')->findAll();
            $data['validation'] = $this->validator;
            // dd($data);

            return view('web/about', $data);
        } else {
            $data = [
                'title'         => $this->request->getVar('title'),
                'title_ar'      => $this->request->getVar('title_ar'),
                'text'          => $this->request->getVar('text'),
                'text_ar'       => $this->request->getVar('text_ar'),
            ];
            // dd($data);

            $ok = $web->update($id, $data);

            $act->addActivity(session('id'), 'Update Website Content: AboutText', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

            if ($ok) {
                return redirect()->to('web/about')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
            }
        }
    }

    function aboutUpdate()
    {
        helper('form');

        $web = new Website();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $id = $this->request->getVar('id');
        // dd($id);

        $input = $this->validate(
            [   //Rules
                'title' => 'required|min_length[3]',
                'title_ar' => 'required|min_length[3]',
                'text' => 'required|min_length[3]',
                'text_ar' => 'required|min_length[3]',
                'content' => 'required|min_length[3]',
                'content_ar' => 'required|min_length[3]',
            ],
            [   // Errors
                'title' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'title_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'text' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'text_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'content' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
                'content_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $data['title'] = lang('app.about');
            $data['about'] = $web->where('item', 'about')->first();
            $data['validation'] = $this->validator;
            // dd($data);

            return view('web/about', $data);
        } else {
            $data = [
                'title'         => $this->request->getVar('title'),
                'title_ar'      => $this->request->getVar('title_ar'),
                'text'          => $this->request->getVar('text'),
                'text_ar'       => $this->request->getVar('text_ar'),
                'content'       => $this->request->getVar('content'),
                'content_ar'    => $this->request->getVar('content_ar'),
            ];
            // dd($data);

            $ok = $web->update($id, $data);

            $act->addActivity(session('id'), 'Update Website Content: About', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

            if ($ok) {
                return redirect()->to('web/about')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
            }
        }
    }

    function admission()
    {
        helper('form');

        $set = new Setting();

        $data['title'] = lang('app.website');
        $data['admission'] = $set->where('name', 'registration')->first();
        $data['ad_text'] = $set->where('name', 'registrationText')->first();
        $data['reg'] = $set->where('name', 'regInfo')->findAll();
        // dd($data);
        
        return view('web/admission', $data);
    }

    function admissionUpdate()
    {
        helper('form');

        $set = new Setting();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $admission_id = $this->request->getVar('admission_id');

        $admission_data = [
            'value' => $this->request->getVar('admission_value'),
            'link' => $this->request->getVar('admission_link'),
            'extra' => $this->request->getVar('admission_extra'),
        ];
        // dd($admission_id, $admission_data);

        $set->update($admission_id, $admission_data);

        $act->addActivity(session('id'), 'Update Website Content: Admission', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('web/admission')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    function contact()
    {
        helper('form');

        $set = new Setting();

        $data['title'] = lang('app.website');
        $data['email'] = $set->where('name', 'email')->first();
        $data['name'] = $set->where('name', 'name')->first();
        $data['facebook'] = $set->where('name', 'facebook')->first();
        $data['phone'] = $set->where('name', 'phone')->first();
        $data['instagram'] = $set->where('name', 'instagram')->first();
        $data['telegram'] = $set->where('name', 'telegram')->first();
        $data['location'] = $set->where('name', 'location')->first();
        $data['whatsapp'] = $set->where('name', 'whatsapp')->first();
        $data['twitter'] = $set->where('name', 'twitter')->first();
        // dd($data);

        return view('web/contact', $data);
    }

    function contactUpdate()
    {
        helper('form');

        $set = new Setting();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $name_id = $this->request->getVar('name_id');
        $name_dt = [
            'value' => $this->request->getVar('name_sw'),
            'extra' => $this->request->getVar('name_ar'),
            ];
        // dd($name_dt, $name_id);

        $set->update($name_id, $name_dt);

        $email_id = $this->request->getVar('email_id');
        $email_dt = ['value' => $this->request->getVar('email')];
        // dd($email_dt, $email_id);

        $set->update($email_id, $email_dt);

        $phone_id = $this->request->getVar('phone_id');
        $phone_dt = [
            'value' => $this->request->getVar('phone'),
            'link' => $this->request->getVar('phone2'),
        ];
        // dd($phone_dt, $phone_id);

        $set->update($phone_id, $phone_dt);

        $location_id = $this->request->getVar('location_id');
        $location_dt = [
            'value' => $this->request->getVar('location'),
            'link' => $this->request->getVar('link'),
            'extra' => $this->request->getVar('extra'),
        ];
        // dd($location_dt, $location_id);

        $set->update($location_id, $location_dt);

        $facebook_id = $this->request->getVar('facebook_id');
        $facebook_dt = ['link' => $this->request->getVar('facebook')];
        // dd($facebook_dt, $facebook_id);

        $set->update($facebook_id, $facebook_dt);

        $twitter_id = $this->request->getVar('twitter_id');
        $twitter_dt = ['link' => $this->request->getVar('twitter')];
        // dd($twitter_dt, $twitter_id);

        $set->update($twitter_id, $twitter_dt);

        $telegram_id = $this->request->getVar('telegram_id');
        $telegram_dt = ['link' => $this->request->getVar('telegram')];
        // dd($telegram_dt, $telegram_id);

        $set->update($telegram_id, $telegram_dt);

        $whatsapp_id = $this->request->getVar('whatsapp_id');
        $whatsapp_dt = ['link' => $this->request->getVar('whatsapp')];
        // dd($whatsapp_dt, $whatsapp_id);

        $set->update($whatsapp_id, $whatsapp_dt);

        // dd($data);

        $act->addActivity(session('id'), 'Update Website Content: Contacts', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('web/contact')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    function hero()
    {
        helper('form');

        $web = new Website();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $id = $this->request->getVar('id');
        // dd($id);

        $data = [
            'title'         => $this->request->getVar('title'),
            'title_ar'      => $this->request->getVar('title_ar'),
        ];
        // dd($data);

        $web->update($id, $data);

        $act->addActivity(session('id'), 'Update Website Content: Hero', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('web/carousel')->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    function mauqii()
    {
        helper('form');

        $set = new Setting();
        $act = new ActivityLog();

        // dd($this->request->getVar());

        $id = $this->request->getVar('id');

        $data = ['link' => $this->request->getVar('mauqii') != 'on' ? null : 'checked'];
        // dd($data, $id);

        $set->update($id, $data);

        $act->addActivity(session('id'), 'Update Website Content: Hero', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    function setting()
    {
        // dd($this->request->getVar());

        helper('form');

        $set = new Setting();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        // dd($id);

        $data = [
            'info'      => $this->request->getVar('info'),
            'value'     => $this->request->getVar('value'),
            'extra'     => $this->request->getVar('extra'),
            'link'      => $this->request->getVar('link'),
            'value_ar'  => $this->request->getVar('value_ar'),
            'extra_ar'  => $this->request->getVar('extra_ar'),
        ];
        // dd($data);

        $set->update($id, $data);

        $act->addActivity(session('id'), 'Update Setting Content', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    function sign($id)
    {
        helper('form');

        $set = new Setting();

        $img = $set->find($id);
        $data['title'] = lang('app.image');
        $data['image'] = $set->find($id);
        // dd($data);

        return view('web/sign', $data);
    }

    function signature()
    {
        helper('form');

        $set = new Setting();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');

        // dd($this->request->getFile('link'));
        if ($this->request->getFile('link')) {
            $validationRule = $this->validate(
                [
                    'link' => 'uploaded[link]|mime_in[link,image/jpg,image/jpeg,image/png,image/svg]|max_size[link,2048]',
                ],
                [   // Errors
                    'link' => [
                        'uploaded' => lang('error.uploaded'),
                        'mime_in' => lang('error.mime'),
                        'max_size' => lang('error.max_size'),
                    ],
                ]
            );

            // dd($validationRule);
            if (!$validationRule) {
                $error = $this->validator->getError('link');
                // dd($error);
                return redirect()->back()->with('type', 'error')->with('title', $error);
            }

            $img = $set->find($id)['link'];
            // dd($img);

            // dd(file_exists($img));
            if (file_exists($img)) {
                unlink($img);
            }

            $newImg = $this->request->getFile('link');
            $ext = $newImg->getClientExtension();
            $name = time() . $id . '.' . $ext;
            // dd($name);

            $dataIMG = [
                'link' => 'public/logo/' . $name,
            ];

            $newImg->move('public/logo/', $name);
            $set->update($id, $dataIMG);

            $act->addActivity(session('id'), 'Carousel Image Change', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');
        }

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }
}
