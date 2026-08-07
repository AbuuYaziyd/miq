<?php

namespace App\Models;

use CodeIgniter\Model;

class Khirrij extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'khirrijs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'student_id',
        'year_id',
        'username',
        'certificate',
        'certificate_no',
        'status',
        'info',
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

    function khirrij($id)
    {
        $kh = new Khirrij();
        $data = $kh->where('student_id', $id)->first();
        // dd($data);

        return $data;
    }

    function city($id)
    {
        $kh = new City();
        $data = $kh->find($id);
        // dd($data);

        return $data;
    }

    public function grade($mark)
    {
        $res = new Grade();
        $data = $res->where('bidaya>=', $mark)->where('nihaya<=', $mark)->first();
        // dd($data);

        return $data;
    }

    function user($id)
    {
        $kh = new User();
        $data = $kh->where('id', $id)->first();
        // dd($data);

        return $data;
    }

    function year($id)
    {
        $y = new Year();
        return $y->find($id);
    }
}
