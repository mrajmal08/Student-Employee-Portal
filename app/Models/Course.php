<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "courses";
    protected $guarded = [];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses', 'course_id', 'student_id');
    }

    public function preCasApplications()
    {
        return $this->belongsToMany(PreCasApplication::class, 'pre_cas_application_courses', 'course_id', 'pre_cas_application_id');
    }
}
