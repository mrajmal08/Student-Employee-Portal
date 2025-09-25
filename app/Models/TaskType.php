<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class TaskType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "task_types";
    protected $guarded = [];
    public static function add($type)
    {
        $new_type = new TaskType();
        $new_type->name = $type['name'];
        $new_type->description = $type['description'];
        $new_type->created_by = Auth::user()->id;
        $new_type->updated_by = Auth::user()->id;
        $new_type->save();
        return $new_type;
    }

    public static function edit($type)
    {
        DB::table('task_types')->where('id', $type['id'])->update(
            [
                'name' => isset($type['name']) ? $type['name'] : Null,
                'description' => isset($type['description']) ? $type['description'] : Null,
                'updated_by' => Auth::user()->id
            ]
        );
        return true;
    }

}

