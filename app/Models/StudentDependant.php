<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentDependant extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "student_dependants";
    protected $guarded = [];
}
