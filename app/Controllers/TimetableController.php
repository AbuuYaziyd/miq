<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLog;
use App\Models\Course;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Timetable;

class TimetableController extends BaseController
{
    public function index()
    {
        $crs = new Course();

        $data['title'] = lang('app.timetable');
        $data['course'] = $crs->findAll();
        // dd($data);
        
        return view('timetable/index', $data);
    }

    public function mustawa($id)
    {
        helper('form');

        $crs = new Course();
        $tmt = new Timetable();
        $sub = new Subject();
        $prd = new Period();

        $data['title'] = lang('app.timetable');
        $data['course'] = $crs->find($id);
        $data['time'] = $tmt->where('course_id', $id)->findAll();
        $data['period'] = $prd->findAll();
        $data['subjects'] = $sub->where('course_id', $id)->findAll();
        $data['tmt'] = $tmt;
        $data['sub'] = $sub;
        // dd($data);

        return view('timetable/mustawa', $data);
    }

    public function create()
    {
        // dd($this->request->getVar());

        $act = new ActivityLog();
        $tmt = new Timetable();
        $prd = new Period();

        $course_id = $this->request->getVar('course_id');
        $periods = $prd->findAll();
        // dd($course_id, $periods);

        for ($i=0; $i <= 6; $i++) { 
            foreach ($periods as $prc) {
                $data = [
                    'day' => $i,
                    'start' => $prc['start'],
                    'end' => $prc['end'],
                    'course_id' => $course_id,
                ];
                // dd($data);

                $tmt->save($data);
            }
        }
        // dd($data);

        $act->addActivity(session('id'), 'Create Subject - COURSE WISE - Timetable', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function add()
    {
        // dd($this->request->getVar());

        $act = new ActivityLog();
        $tmt = new Timetable();

        $id = $this->request->getVar('id');
        // dd($id);

        $data = [
            'subject_id'    => $this->request->getVar('subject_id'),
            'period_id'    => $this->request->getVar('period_id'),
        ];
        // dd($data);

        $tmt->update($id, $data);

        $act->addActivity(session('id'), 'Update Subject - Timetable', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }

    public function delete($id)
    {
        // dd($id);

        $tmt = new Timetable();
        $act = new ActivityLog();

        $data = [
            'subject_id' => null,
            'period_id' => null,
        ];

        $tmt->update($id, $data);

        $act->addActivity(session('id'), 'Remove Subject - Timetable', 'Task was Performed by: ' . session('name') . ', email: ' . session('email') . ', username: ' . session('username') . '!');

        return redirect()->back()->with('type', 'success')->with('text', lang('app.successfully'))->with('title', lang('app.done'));
    }
}
