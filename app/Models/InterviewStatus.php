<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class InterviewStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "interview_statuses";
    protected $guarded = [];

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'status_id');
    }

}
