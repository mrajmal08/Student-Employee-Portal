<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }

    public static function add($course)
    {
        $new_course = new Course();
        $new_course->name = $course['name'];
        $new_course->created_by = Auth::user()->id;
        $new_course->updated_by = Auth::user()->id;
        $new_course->save();
        return $new_course;
    }

    public static function edit($course)
    {
        DB::table('courses')->where('id', $course['id'])->update(
            [
                'name' => isset($course['name']) ? $course['name'] : Null,
                'updated_by' => Auth::user()->id
            ]
        );
        return true;
    }
}
