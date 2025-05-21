<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CaseStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "case_statuses";
    protected $guarded = [];
}
