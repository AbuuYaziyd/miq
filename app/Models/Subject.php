<?php

namespace App\Models;

use CodeIgniter\Model;

class Subject extends Model
{
    protected $table            = 'subjects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'name_ar',
        'info',
        'info_ar',
        'head_id',
        'course_id',
        'ramz',
        'link',
        'image',
        'book',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function teacher($id)
    {
        $usr = new User;
        return $usr->find($id);
    }

    function course($id)
    {
        $crs = new Course();
        return $crs->find($id);
    }

    function stuTimetable($id, $level)
    {
        $tmt = new Timetable();
        $time = $tmt->where(['subject_id' => $id, 'day' => date('w'), 'course_id' => $level])->findAll();
        // dd($time);

        return $time;
    }

    function timetable($id)
    {
        $tmt = new Timetable();
        $time = $tmt->where(['subject_id' => $id, 'day' => date('w')])->findAll();
        // dd($time);

        return $time;
    }

    function subject($sub_id)
    {
        $sub = new Subject();
        return $sub->where(['id' => $sub_id])->first();
    }

    function done($id)
    {
        $res = new Result();
        $yr = new Year();

        $year = $yr->where('current', 1)->first()['id'];

        $mark['course'] = $res->where(['subject_id' => $id, 'year_id' => $year, 'course_status' => 'done'])->countAllResults();
        $mark['final'] = $res->where(['subject_id' => $id, 'year_id' => $year, 'final_status' => 'done'])->countAllResults();
        $mark['course_mark'] = $res->where(['subject_id' => $id, 'year_id' => $year, 'course_status' => 'marked'])->countAllResults();
        $mark['final_mark'] = $res->where(['subject_id' => $id, 'year_id' => $year, 'final_status' => 'marked'])->countAllResults();
        $mark['mark'] = $res->where(['subject_id' => $id, 'year_id' => $year])->countAllResults();
        // dd($mark);

        return $mark;
    }

    function stuCount($id)
    {
        $usr = new User;
        return $usr->where(['level' => $id, 'fn' => 'student'])->countAllResults();
    }
}
