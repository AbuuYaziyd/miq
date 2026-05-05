<?php

namespace App\Models;

use CodeIgniter\Model;

class Attendance extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'attendances';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'student_id',
        'course_id',
        'status',
        'sex',
        'reply',
        'date',
        'file',
        'reason',
        'year_id',
        'teacher_id',
        'school_id',
    ];

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

    function status($date, $stu, $class)
    {
        $at = new Attendance();
        $year = new Year();
        $yr = $year->where('current!=', null)->first()['id'];

        return $at->where(['class_id' => $class, 'student_id' => $stu, 'date' => $date, 'year_id' => $yr])->first();
    }

    function stu($id)
    {
        $user = new User;

        return $user->find($id);
    }

    function thisMonth($stu)
    {
        $att = new Attendance();


        $t = $att->where(['created_at >=' => date('m-Y'), 'student_id' => $stu])->findAll();
        $p = 0;
        $a = 0;
        $r = 0;
        foreach ($t as $value) {
            if ($value['status'] == 1) {
                $p = $p + 1;
            } elseif ($value['status'] == 2) {
                $r = $r + 1;
            } else {
                $a = $a + 1;
            }
        }
        $data['p'] = $p;
        $data['a'] = $a;
        $data['r'] = $r;
        
        return $data;
    }

    function subject($id)
    {
        $sub = new Subject();
        
        return $sub->find($id);
    }
}
