<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Dependant extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "dependants";
    protected $guarded = [];

    public function dependants()
    {
        return $this->belongsToMany(Student::class, 'student_dependants', 'dependant_id', 'student_id');
    }
}
