<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "students";
    protected $guarded = [];
    public $timestamps = true;

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id');
    }

    public function dependants()
    {
        return $this->belongsToMany(Dependant::class, 'student_dependants', 'student_id', 'dependant_id');
    }

    public function media()
    {
        return $this->hasMany(StudentMedia::class, 'student_id', 'id');
    }

}
