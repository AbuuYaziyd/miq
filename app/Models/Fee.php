<?php

namespace App\Models;

use CodeIgniter\Model;

class Fee extends Model
{
    protected $table            = 'fees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'course_id',
        'year_id',
        'admin_id',
        'fee_type',
        'amount',
        'total',
        'image',
        'month',
        'status',
        'receipt',
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
        $usr = new User();
        $data = $usr->find($id);

        return $data;
    }

    function fee($id)
    {
        $fee = new Fee();
        $data = $fee->find($id);

        return $data;
    }

    function receipt($no)
    {
        $fee = new Fee();
        $data = $fee->where('receipt', $no)->first();

        return $data;
    }

    function feeType($id)
    {
        $typ = new FeeType();
        $data = $typ->find($id);

        return $data;
    }

    function monthPaid($month, $userId)
    {
        $fee = new Fee();
        $data = $fee->where(['month' => $month, 'user_id' => $userId])->first();
        // dd(isset($data));

        return isset($data);
    }
}
