<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskPriority extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "task_priorities";
    protected $guarded = [];

    public static function add($priority)
    {
        $new_priority = new TaskPriority();
        $new_priority->name = $priority['name'];
        $new_priority->description = $priority['description'];
        $new_priority->created_by = Auth::user()->id;
        $new_priority->updated_by = Auth::user()->id;
        $new_priority->save();
        return $new_priority;
    }

    public static function edit($priority)
    {
        DB::table('task_priorities')->where('id', $priority['id'])->update(
            [
                'name' => isset($priority['name']) ? $priority['name'] : Null,
                'description' => isset($priority['description']) ? $priority['description'] : Null,
                'updated_by' => Auth::user()->id
            ]
        );
        return true;
    }
}
