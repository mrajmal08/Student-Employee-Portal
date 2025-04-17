<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Designation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "designations";
    protected $guarded = [];

    public static function add($designation)
    {
        $new_designation = new Designation();
        $new_designation->name = $designation['name'];
        $new_designation->description = $designation['description'];
        $new_designation->created_by = Auth::user()->id;
        $new_designation->updated_by = Auth::user()->id;
        $new_designation->save();
        return $new_designation;
    }

    public static function edit($designation)
    {
        DB::table('designations')->where('id', $designation['id'])->update(
            [
                'name' => isset($designation['name']) ? $designation['name'] : Null,
                'description' => isset($designation['description']) ? $designation['description'] : Null,
                'updated_by' => Auth::user()->id
            ]
        );
        return true;
    }


}
