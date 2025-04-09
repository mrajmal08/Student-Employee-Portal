<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $table = "users";

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function userDetails($id = NULL)
    {
        if(!is_null($id))
        {
            $userDetails = DB::table('users')->where('id',$id)->select('name')->first();
            $name = isset($userDetails->name) ? $userDetails->name.' ' : '';
            return $name;
        }
        else
            return NULL;
    }

    public static function add($user)
    {
        $hashedPassword = Hash::make($user['password']);
        $new_user = new User();
        $new_user->name = $user['name'];
        $new_user->email = $user['email'];
        $new_user->phone_no = $user['phone_no'];
        $new_user->password = $hashedPassword;
        $new_user->role_id = 2;
        $new_user->status = 1;
        $new_user->created_by = Auth::user()->id;
        $new_user->updated_by = Auth::user()->id;
        $new_user->save();
        return $new_user;
    }

    public static function edit($user, $requestData)
    {
        $updatedData = [];

        if (isset($requestData['name']) && $requestData['name'] !== $user->name) {
            $updatedData['name'] = $requestData['name'];
        }

        if (isset($requestData['email']) && $requestData['email'] !== $user->email) {
            $emailExists = DB::table('users')
                ->where('email', $requestData['email'])
                ->where('id', '!=', $user->id)
                ->exists();

            if ($emailExists) {
                throw new \Exception("The email {$requestData['email']} is already taken.");
            }

            $updatedData['email'] = $requestData['email'];
        }

        if (isset($requestData['phone_no']) && $requestData['phone_no'] !== $user->phone_no) {
            $updatedData['phone_no'] = $requestData['phone_no'];
        }

        if (isset($requestData['status']) && $requestData['status'] !== $user->status) {
            $updatedData['status'] = $requestData['status'];
        }

        if (isset($requestData['password']) && $requestData['password'] !== null) {
            $updatedData['password'] = Hash::make($requestData['password']);
        }

        $updatedData['updated_by'] = Auth::user()->id;

        if (!empty($updatedData)) {
            DB::table('users')->where('id', $user->id)->update($updatedData);
        }

        return User::find($user->id);
    }


}
