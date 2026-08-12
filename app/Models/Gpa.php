<?php

namespace App\Models;

use CodeIgniter\Model;

class Gpa extends Model
{
    protected $table            = 'gpas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'student_id',
        'username',
        'subjects',
        'course_id',
        'school_id',
        'year_id',
        'number_of_students',
        'course_marks',
        'final_marks',
        'marks',
        'course_gpa',
        'final_gpa',
        'gpa',
        'course_position',
        'final_position',
        'position',
        'link',
        'id',
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

    function user($id)
    {
        $user = new User;
        return $user->find($id);
    }

    function class($id)
    {
        $cl = new Course();
        return $cl->find($id);
    }

    function year($id)
    {
        $yr = new Year();
        return $yr->find($id);
    }

    function allSubjects($course_id)
    {
        $sub = new Subject();
        return $sub->where('course_id', $course_id)->findAll();
    }

    function subject($id)
    {
        $sub = new Subject();
        return $sub->find($id);
    }

    function results($user_id, $course_id)
    {
        $res = new Result();

        $results = $res->where(['student_id' => $user_id, 'course_id' => $course_id])->findAll();
        // dd($results);

        return $results; 
    }

    function mark($c, $std, $y, $s)
    {
        $mark = new Result;
        $m = $mark->where(['course_id' => $c, 'year_id' => $y, 'subject_id' => $s, 'student_id' => $std])->first();
        // dd($m['course']+ $m['final']);
        $course = $m['course'] ?? 0;
        $final = $m['final'] ?? 0;
        $marks = $course + $final;
        // $marks = $m['course'] + $m['final'];
        return $marks;
        // return 60;
    }

    function sum($user, $class)
    {
        $res = new Result;
        $yr = new Year();

        $curr_yr = $yr->where('current', 1)->first()['id'];

        $course = $res->where(['student_id' => $user, 'course_id' => $class, 'year_id' => $curr_yr])->selectSum('course')->get()->getRow()->course;
        $final = $res->where(['student_id' => $user, 'course_id' => $class, 'year_id' => $curr_yr])->selectSum('final')->get()->getRow()->final;

        $data['course'] = $course;
        $data['final'] = $final;
        $data['sum'] = $final + $course;
        // dd($data);

        return $data;
    }

    function gpa($user, $class)
    {
        $pr = new Gpa();

        $tr = $pr->where(['student_id' => $user, 'course_id' => $class])->first();
        // dd($tr);

        return $tr;
    }

    function tarakum($user, $class)
    {
        $pr = new Gpa();

        $tr = $pr->where(['student_id' => $user, 'course_id<=' => $class])->findAll();
        // dd($tr);

        return $tr;
    }

    function position($user, $class, $yr)
    {
        $pr = new Gpa();
        $pos = $pr->where(['course_id' => $class, 'year_id' => $yr])->orderBy('course_marks', 'DESC')->findAll();
        $p = 0;
        foreach ($pos as $key => $dt) {
            if ($dt['student_id'] == $user) {
                $p = $key + 1;
            }
        }

        return $p;
    }

    public function grade($mark)
    {
        $grd = new Grade();

        $grade = $grd->where('bidaya>=', $mark)->where('nihaya<=', $mark)->first();
        // dd($grade);

        return $grade;
    }
}
