<?php

namespace App\Models;

use App\Libraries\Hijri;
use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'mname',
        'lname',
        'email',
        'name_ar',
        'mname_ar',
        'lname_ar',
        'kun_yah',
        'kun_yah_ar',
        'role',
        'fn',
        'dob',
        'sex',
        'phone',
        'username',
        'password',
        'address',
        'nationality',
        'avatar',
        'level',
        'web',
        'info',
        'twitter',
        'insta',
        'facebook',
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

    function teacherID()
    {
        $usr = new User();
        $hjr = new Hijri();

        $query = $usr->where('fn', 'teacher')->orderBy('id', 'desc')->first();
        $hijri = $hjr->GeToHijr(date('d'), date('m'), date('Y'));
        // dd($hijri, $query);

        if ($query != null) {
            $invc = $query['username'];
            $invc = substr($invc, 3, 6);
            $invc = $invc + 1;
            $username = 106 . sprintf('%03s', $invc);
        } else {
            $username = 106 . sprintf('%03s', 1);
        }
        // dd($username);

        return $username;
    }

    function studentID()
    {
        $usr = new User();
        $hjr = new Hijri();

        $query = $usr->where('fn', 'student')->orderBy('id', 'desc')->first();
        $hijri = $hjr->GeToHijr(date('d'), date('m'), date('Y'));
        // dd($hijri, $query);

        if ($query != null) {
            $invc = $query['username'];
            $invc = substr($invc, 6, 10);
            $invc = $invc + 1;
            $username = substr($hijri['year'], 2) . sprintf('%02s', $hijri['month']) . date("s") . sprintf('%04s', $invc);
        } else {
            $username = substr($hijri['year'], 2) . sprintf('%02s', $hijri['month']) . date("s") . sprintf('%04s', 1);
        }
        // dd($username);

        return $username;
    }
}
