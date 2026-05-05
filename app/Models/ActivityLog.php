<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLog extends Model
{
    protected $table            = 'activity_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'role',
        'name',
        'email',
        'activity',
        'info',
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

    function addActivity($id, $activity, $info)
    {
        $usr = new User();
        $act = new ActivityLog();

        $user = $usr->find($id);

        $dt = [
            'user_id' => $id,
            'role' => $user['role'],
            'name' => $user['name'] . ' ' . $user['lname'],
            'email' => $user['email'],
            'activity' => $activity,
            'info' => $info,
        ];

        $act->insert($dt);
    }
}
