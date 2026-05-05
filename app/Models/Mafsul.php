<?php

namespace App\Models;

use CodeIgniter\Model;

class Mafsul extends Model
{
    protected $table            = 'mafsuls';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'student_id',
        'reason',
        'info',
        'school_id',
        'year_id',
        'file',
        'class_id',
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

    function addMafsul($id, $reason, $info)
    {
        $fasl = new Mafsul();
        $usr = new User();
        $cls = new Course();
        $yr = new Year();

        $user = $usr->find($id);
        $dataMafsul = [
            'student_id' => $user['id'],
            'class_id' => 3, //$user['level'],
            'school_id' => 1, //$cls->find($user['level'])['school_id'],
            'year_id' => $yr->where('current', 1)->first()['id'],
            'reason' => $reason ?? '',
            'info' => $info ?? '',
        ];

        // dd($dataMafsul);
        $fasl->save($dataMafsul);
    }
}
