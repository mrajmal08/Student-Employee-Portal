<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PreCasApplication extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "pre_cas_applications";
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'pre_cas_application_courses', 'pre_cas_application_id', 'course_id');
    }
}
