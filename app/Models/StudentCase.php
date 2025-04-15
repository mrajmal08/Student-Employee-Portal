<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentCase extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "student_cases";
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public static function add($case)
    {
        $student_case = new StudentCase();
        $student_case->course_id = $case['course_id'];
        $student_case->session_id = $case['session_id'];
        $student_case->agent_id = $case['agent_id'];
        $student_case->created_by = Auth::user()->id;
        $student_case->updated_by = Auth::user()->id;
        $student_case->save();
        return $student_case;
    }
}
