<?php

namespace App\Models;

use CodeIgniter\Model;

class School extends Model
{
    protected $table            = 'schools';
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

    function classCount($id)
    {
        $cls = new Course();
        return $cls->where('school_id', $id)->countAllResults();
    }

    function teacher($id)
    {
        $usr = new User;
        return $usr->where('id', $id)->first();
    }

    function school($id)
    {
        $sc = new School();
        return $sc->find($id);
    }

    function course($id)
    {
        $crs = new Course();
        return $crs->where('school_id', $id)->findAll();
    }

    function checkResults($id, $course_id)
    {
        $gpa = new Gpa();
        $check = $gpa->where(['course_id' => $course_id, 'student_id' => $id])->findAll();
        // dd($check);

        return $check;
    }
}
