<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "departments";
    protected $guarded = [];

    public static function add($department)
    {
        $new_department = new Department();
        $new_department->name = $department['name'];
        $new_department->description = $department['description'];
        $new_department->created_by = Auth::user()->id;
        $new_department->updated_by = Auth::user()->id;
        $new_department->save();
        return $new_department;
    }

    public static function edit($department)
    {
        DB::table('departments')->where('id', $department['id'])->update(
            [
                'name' => isset($department['name']) ? $department['name'] : Null,
                'description' => isset($department['description']) ? $department['description'] : Null,
                'updated_by' => Auth::user()->id
            ]
        );
        return true;
    }
}
