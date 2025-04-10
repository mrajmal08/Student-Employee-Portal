<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Session extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "sessions";
    protected $guarded = [];

    public static function add($session)
    {
        $new_session = new Session();
        $new_session->name = $session['name'];
        $new_session->description = $session['description'];
        $new_session->created_by = Auth::user()->id;
        $new_session->updated_by = Auth::user()->id;
        $new_session->save();
        return $new_session;
    }

    public static function edit($session)
    {
        DB::table('sessions')->where('id', $session['id'])->update(
            [
                'name' => isset($session['name']) ? $session['name'] : Null,
                'description' => isset($session['description']) ? $session['description'] : Null,
                'updated_by' => Auth::user()->id
            ]
        );
        return true;
    }
}
