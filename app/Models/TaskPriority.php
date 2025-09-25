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

    public static function add($status)
    {
        $new_status = new TaskPriority();
        $new_status->name = $status['name'];
        $new_status->description = $status['description'];
        $new_status->created_by = Auth::user()->id;
        $new_status->updated_by = Auth::user()->id;
        $new_status->save();
        return $new_status;
    }

    public static function edit($status)
    {
        DB::table('task_priorities')->where('id', $status['id'])->update(
            [
                'name' => isset($status['name']) ? $status['name'] : Null,
                'description' => isset($status['description']) ? $status['description'] : Null,
                'updated_by' => Auth::user()->id
            ]
        );
        return true;
    }
}
