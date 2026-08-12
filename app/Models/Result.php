<?php

namespace App\Models;

use CodeIgniter\Model;

class Result extends Model
{
    protected $table            = 'results';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'student_id',
        'year_id',
        'school_id',
        'course_id',
        'subject_id',
        'teacher_id',
        'username',
        'course',
        'final',
        'course_status',
        'final_status',
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

    public function getResultsAll($class, $year)
    {
        // $sub = new ClassSub();
        $res = new Result();

        // $class = $sub->where('class_id', $class)->orderBy('subjectId', 'desc')->first();
        $usr = $res->select('stdId')
            ->join('users u', 'results.stdId=u.id')
            ->where(['year' => $year, 'class_id' => $class])
            ->distinct()
            ->findAll();

        for ($j = 0; $j < count($usr); $j++) {

            $m[] = $usr[$j]['stdId'];
            // $data['user'] = $user->find($usr[$j]['stdId']);

            // for ($i=0; $i < $class['subjectId']; $i++) { 
            // // $cl[] = $i;
            // $data['marks'][] = $res
            //         ->join('subjects s', 'results.subId=s.id')
            //         ->where(['year' => $year, 'class_id' => $class, 'subjectId' => $i, 'stdId' => $usr[$j]['stdId']])
            //         ->get();
            // }
        }
        return $m;
    }

    public function registerResultsToClass($course_id, $students, $year_id, $school_id)
    {
        $sub = new Subject();
        $res = new Result();

        foreach ($students as $dt) {
            foreach ($sub->where('course_id', $course_id)->findAll() as $sb) {
                $data = [
                    'course_id' => $course_id,
                    'school_id' => $school_id,
                    'subject_id' => $sb['id'],
                    'year_id' => $year_id,
                    'username' => $dt['username'],
                    'student_id' => $dt['id'],
                ];
                $res->save($data);
            }
        }
    }

    function stu($id)
    {
        $user = new User;
        return $user->find($id);
    }

    public function grade($mark)
    {
        $grd = new Grade();
        
        $data = $grd->where(['bidaya>=' => intval($mark), 'nihaya<=' => intval($mark)])->first();
        // dd($data);

        return $data;
    }

    public function masar($masar)
    {
        $grd = new Grade();
        $mas = $grd->where(['bidaya>=' => intval($masar), 'nihaya<=' => intval($masar)])->first();
        // dd($mas);

        return $mas;
    }

    function mark($c, $std, $s)
    {
        $mark = new Result;
        $yr = new Year();
        
        $year_id = $yr->where('current', 1)->first()['id'];
        $m = $mark->where(['course_id' => $c, 'subject_id' => $s, 'student_id' => $std, 'year_id' => $year_id])->first();
        // dd($m);
        return $m;
    }

    function markThisYear($c, $std, $s)
    {
        $mark = new Result;
        $yr = new Year();

        $y = $yr->where('current', 1)->first()['id'];
        $m = $mark->where(['course_id' => $c, 'subject_id' => $s, 'student_id' => $std, 'year_id' => $y])->first();
        // dd($m);
        return $m;
    }
}
