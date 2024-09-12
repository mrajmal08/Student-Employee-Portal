<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentMedia extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "students_media";
    protected $guarded = [];

    public function media()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

}
