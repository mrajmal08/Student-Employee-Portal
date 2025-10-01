<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TaskAssignTo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "task_assign_to";
    protected $guarded = [];
}
