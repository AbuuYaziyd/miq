<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\School;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;

class SubjectController extends BaseController
{
    public function course($id)
    {
        $sub = new Subject();
        $cls = new Course();
        $sch = new School();

        $data['title'] = lang('app.subject');
        $data['sub'] = $sub->where('course_id', $id)->findAll();
        $data['course'] = $cls->find($id);
        $data['courses'] = $cls->findAll();
        $data['no'] = $sub->where('course_id', $id)->countAllResults();
        $data['s'] = $sub;
        $data['sch'] = $sch;
        $data['cls'] = $cls;
        // dd($data);

        return view('subject/course', $data);
    }

    public function add($id)
    {
        helper('form');

        $user = new User();
        $crs = new Course();
        $sch = new School();
        $sub = new Subject();

        $course = $crs->find($id);
        $data['title'] = lang('app.subject');
        $data['course'] = $course;
        $data['subjects'] = $sub->where('course_id', null)->findAll();
        $data['sch'] = $sch->find($course['school_id']);
        $data['tch'] = $user->where('fn', 'teacher')->findAll();
        // dd($data);

        return view('subject/add', $data);
    }

    public function create()
    {
        // dd($this->request->getVar());

        helper('form');

        $user = new User();
        $crs = new Course();
        $sch = new School();
        $sbj = new Subject();
        $act = new ActivityLog();

        $input = $this->validate(
            [   //Rules
                'name' => 'required|min_length[3]|max_length[50]',
                'name_ar' => 'required|min_length[3]|max_length[50]',
                'head_id' => 'required',
            ],
            [   // Errors
                'name' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                    'max_length' => lang('error.max_length'),
                    'is_unique' => lang('error.is_unique'),
                ],
                'name_ar' =>
                [
                    'required' => lang('error.required'),
                    'min_length' => lang('error.min_length'),
                    'max_length' => lang('error.max_length'),
                    'is_unique' => lang('error.is_unique'),
                ],
                'head_id' =>
                [
                    'required' => lang('error.required'),
                ],
            ]
        );

        // dd($input);
        if (!$input) {
            $course = $crs->find($this->request->getVar('course_id'));
            $data['title'] = lang('app.subject');
            $data['validation'] = $this->validator;
            $data['course'] = $course;
            $data['tch'] = $user->where('fn', 'teacher')->findAll();
            $data['sch'] = $sch->find($course['school_id']);
            // dd($data);

            return view('subject/add', $data);
        } else {

            $data = [
                'name'          => strtoupper($this->request->getVar('name')),
                'name_ar'       => $this->request->getVar('name_ar'),
                'head_id'       => $this->request->getVar('head_id'),
                'ramz'          => strtoupper($this->request->getVar('ramz')),
                'course_id'     => $this->request->getVar('course_id'),
            ];
            // dd($data);

            $sbj->save($data);

            $act->addActivity(session('id'), 'Create New Subject', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

            return redirect()->to('subject/course/' . $this->request->getVar('course_id'))->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
        }
    }

    public function show($id)
    {
        helper('form');

        $sub = new Subject();
        $usr = new User();
        $crs = new Course();
        $set = new Setting();
        $tmt = new Timetable();

        $subject = $sub->find($id);
        $this_course = $crs->find($subject['course_id']);

        $data['title'] = lang('app.subject');
        $data['sub'] = $subject;
        $data['course'] = $crs->where('school_id', $this_course['school_id'])->findAll();
        $data['days'] = [1, 2, 3, 4, 5, 6, 7];
        $data['times'] = $tmt->where('subject_id', $id)->orderBy('day', 'asc')->findAll();
        $data['timetable'] = $tmt->where('subject_id', $id)->findAll();
        $data['s'] = $sub;
        $data['tch'] = $usr->where('fn', 'teacher')->findAll();
        $data['stu'] = $usr->where(['fn' => 'student', 'level' => $subject['course_id']])->findAll();
        // dd($data);

        return view('subject/show', $data);
    }

    public function update()
    {
        // dd($this->request->getVar());

        $sub = new Subject();
        $act = new ActivityLog();

        $id = $this->request->getVar('id');
        $course_id = $this->request->getVar('course_id');
        // dd($id);

        $data = [
            'name'      => strtoupper($this->request->getVar('name')),
            'name_ar'   => $this->request->getVar('name_ar'),
            'head_id'   => $this->request->getVar('head_id'),
            'ramz'      => strtoupper($this->request->getVar('ramz')),
            'course_id' => $course_id,
        ];
        // dd($data);

        $sub->update($id, $data);

        $act->addActivity(session('id'), 'Update Subject Data', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('subject/course/' . $course_id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function about($id)
    {
        helper('form');

        $sub = new Subject();
        $usr = new User();
        $att = new Attendance();

        $subject = $sub->find($id);
        // dd(date('Y-m-d'), $subject);

        $data['title'] = lang('app.class');
        $data['subject'] = $subject;
        $data['usr'] = $usr;
        $data['std'] = $usr->where('level', $subject['course_id'])->findAll();
        $data['query'] = $att->where(['date' => date('Y-m-d'), 'subject_id' => $id])->findAll();
        // dd($data);

        return view('subject/about', $data);
    }

    public function book()
    {
        // dd($this->request->getFile('book'));
        // dd($this->request->getVar('id'));

        $sub = new Subject();
        $act = new ActivityLog();

        $subject = $sub->find($this->request->getVar('id'));
        // dd($subject);

        $validationRule = $this->validate(
            [
                'book' => 'uploaded[book]|mime_in[book,application/pdf]',
            ],
            [   // Errors
                'book' => [
                    'uploaded' => lang('error.uploaded'),
                    'mime_in' => lang('error.mime'),
                ],
            ]
        );
        // dd($validationRule);

        if (!$validationRule) {
            helper('form');

            $data['title'] = lang('app.profile');
            $data = ['errors' => $this->validator->getErrors()];
            // dd($data['errors']['book']);

            return redirect()->back()->with('toast', 'error')->with('title', lang('app.sorry'))->with('text', $data['errors']['book']);
        }

        $bk = $subject['book'];
        // dd($bk);

        // dd(file_exists($bk));
        if (file_exists($bk)) {
            unlink($bk);
        }

        $newBk = $this->request->getFile('book');
        $ext = $newBk->getClientExtension();
        $name = time() . '.' . $ext;
        // dd($name);

        $dataBook = [
            'book' => 'public/books/' . $name,
        ];
        // dd($dataBook);

        $newBk->move('public/books/', $name);

        $sub->update($subject['id'], $dataBook);

        $act->addActivity(session('id'), 'Subject Book Updated', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('subject/about/' . $subject['id'])->with('type', 'success')->with('title', lang('app.done'))->with('text', lang('app.successfully'));
    }

    public function debook($id)
    {
        $sub = new Subject();
        $act = new ActivityLog();

        $data = ['book' => null];
        // dd($data);

        $sub->update($id, $data);
        
        $act->addActivity(session('id'), 'Delete Subject Book', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('subject/about/' . $id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function delete($id)
    {
        $sub = new Subject();
        $act = new ActivityLog();

        $subject = $sub->find($id);
        $data = ['course_id' => null];
        // dd($id, $data, $subject);
        
        $sub->update($id, $data);

        $act->addActivity(session('id'), 'Subject Removed', 'Subject was Removed Successfully! Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->to('course/show/' . $subject['course_id'])->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function put($id, $cls_id)
    {
        $sub = new Subject();
        $act = new ActivityLog();
        $acd = new Course();

        $class = $acd->find($cls_id);
        $data = ['course_id' => $cls_id];
        // dd($id, $class, $cls_id);

        $sub->update($id, $data);

        $act->addActivity(session('id'), 'Subject Added', 'Subject was Updated to class:' . $class['name'] . ' Successfully!');

        return redirect()->to('subject/course/' . $cls_id)->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function class($id)
    {
        helper('form');

        $sub = new Subject();
        $usr = new User();
        $att = new Attendance();

        $subject = $sub->find($id);
        // $date = date('Y-m-d')
        // dd(date('Y-m-d'));

        $data['title'] = lang('app.class');
        $data['subject'] = $subject;
        $data['usr'] = $usr;
        $data['std'] = $usr->where('level', $subject['course_id'])->findAll();
        $data['query'] = $att->where(['date' => date('Y-m-d'), 'course_id' => $id])->findAll();
        // dd($data);

        return view('subject/class', $data);
    }
}
