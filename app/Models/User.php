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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

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
        $new_user->department_id = $user['department_id'];
        $new_user->designation_id = $user['designation_id'];
        $new_user->session_id = $user['session_id'];
        $new_user->agency_name = $user['agency_name'];
        $new_user->institute_time = $user['institute_time'];
        $new_user->agent_market_value = $user['agent_market_value'];
        $new_user->start_date = $user['start_date'];
        $new_user->end_date = $user['end_date'];
        $new_user->nationality = $user['nationality'];
        $new_user->date_of_birth = $user['date_of_birth'];
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

        if (isset($requestData['department_id']) && $requestData['department_id'] !== null) {
            $updatedData['department_id'] = $requestData['department_id'];
        }
        if (isset($requestData['designation_id']) && $requestData['designation_id'] !== null) {
            $updatedData['designation_id'] = $requestData['designation_id'];
        }
        if (isset($requestData['session_id']) && $requestData['session_id'] !== null) {
            $updatedData['session_id'] = $requestData['session_id'];
        }
        if (isset($requestData['agency_name']) && $requestData['agency_name'] !== null) {
            $updatedData['agency_name'] = $requestData['agency_name'];
        }
        if (isset($requestData['institute_time']) && $requestData['institute_time'] !== null) {
            $updatedData['institute_time'] = $requestData['institute_time'];
        }
        if (isset($requestData['agent_market_value']) && $requestData['agent_market_value'] !== null) {
            $updatedData['agent_market_value'] = $requestData['agent_market_value'];
        }
        if (isset($requestData['start_date']) && $requestData['start_date'] !== null) {
            $updatedData['start_date'] = $requestData['start_date'];
        }
        if (isset($requestData['end_date']) && $requestData['end_date'] !== null) {
            $updatedData['end_date'] = $requestData['end_date'];
        }
        if (isset($requestData['nationality']) && $requestData['nationality'] !== null) {
            $updatedData['nationality'] = $requestData['nationality'];
        }
        if (isset($requestData['date_of_birth']) && $requestData['date_of_birth'] !== null) {
            $updatedData['date_of_birth'] = $requestData['date_of_birth'];
        }

        $updatedData['updated_by'] = Auth::user()->id;

        if (!empty($updatedData)) {
            DB::table('users')->where('id', $user->id)->update($updatedData);
        }

        return User::find($user->id);
    }


}
