<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PreCasApplicationCourse extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "pre_cas_application_courses";
    protected $guarded = [];
}
