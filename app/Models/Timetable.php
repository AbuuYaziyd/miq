<?php

namespace App\Models;

use CodeIgniter\Model;

class Timetable extends Model
{
    protected $table            = 'timetables';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'day',
        'subject_id',
        'period_id',
        'course_id',
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
        $usr = new User;
        return $usr->find($id);
    }

    function data($id)
    {
        $tmt = new Timetable(); 
        $sub = new Subject();
        $crs = new Course();
        $prd = new Period();
        $usr = new User();
        $sch = new School();

        $data = $tmt->find($id);
        // dd($data, $id);

        $subject = $sub->find($data['subject_id']);
        $course = $crs->find($data['course_id']);
        $period = $prd->find($data['period_id']);
        $teacher = $usr->find($subject['head_id']);
        $school = $sch->find($course['school_id']);

        $data = [
            'course' => $course,
            'subject' => $subject,
            'teacher' => $teacher,
            'period' => $period,
            'school' => $school,
        ];
        // dd($data);
        
         return $data;
    }
}
