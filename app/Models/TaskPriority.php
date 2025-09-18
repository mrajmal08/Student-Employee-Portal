<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TaskPriority extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "task_priorities";
    protected $guarded = [];
}
