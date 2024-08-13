<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PostCasApplication extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "post_cas_applications";
    protected $guarded = [];
}
