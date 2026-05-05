<?php

namespace App\Models;

use CodeIgniter\Model;

class Course extends Model
{
    protected $table            = 'courses';
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
        'school_id',
        'image',
        'link',
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

    function stuCount($id)
    {
        $usr = new User;
        return $usr->where(['level' => $id, 'fn' => 'student'])->countAllResults();
    }

    function subCount($id)
    {
        $sub = new Subject;
        return $sub->where('course_id', $id)->countAllResults();
    }

    function teacher($id)
    {
        $user = new User;
        return $user->where('id', $id)->first();
    }

    function school($id)
    {
        $sc = new School();
        return $sc->find($id);
    }

    function subject($id)
    {
        $sub = new Subject;
        return $sub->where('course_id', $id)->findAll();
    }

    function course($id)
    {
        $crs = new Course;
        return $crs->find($id);
    }

    function courses($id)
    {
        $crs = new Course;
        return $crs->where('school_id', $id)->findAll();
    }

    function checkGPA($class_id, $year_id, $exam)
    {
        $gpa = new Gpa();

        $type = $exam . '_gpa';
        $mark = $gpa->where(['course_id' => $class_id, 'year_id' => $year_id, $type . '!=' => null])->countAllResults();
        // dd($mark);

        return $mark;
    }

    function result($id)
    {
        $res = new Result();
        return $res->where(['year_id' => $id, 'course_status' => 'gpa'])->orWhere('final_status', 'gpa')->select('course_id')->distinct()->findAll();
    }
}
