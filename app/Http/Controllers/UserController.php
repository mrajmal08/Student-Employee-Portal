<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $userQuery = User::with(['role', 'department', 'designation', 'session'])->orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $userQuery->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('email')) {
                $userQuery->where('email', 'like', '%' . $request->email . '%');
            }
            if ($request->filled('phone_no')) {
                $userQuery->where('phone_no', 'like', '%' . $request->phone_no . '%');
            }
            if ($request->filled('status')) {
                $userQuery->where('status', $request->status);
            }
            if ($request->filled('role_id')) {
                $userQuery->where('role_id', $request->role_id);
            }
            if ($request->filled('department_id')) {
                $userQuery->where('department_id', $request->department_id);
            }
            if ($request->filled('designation_id')) {
                $userQuery->where('designation_id', $request->designation_id);
            }
            if ($request->filled('session_id')) {
                $userQuery->where('session_id', $request->session_id);
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $users = $userQuery->paginate($perPage);
            } else {
                $users = $userQuery->get();
            }

            foreach ($users as $user) {
                $user->created_by = User::userDetails($user->created_by);
                $user->updated_by = User::userDetails($user->updated_by);
            }

            return $this->successResponse('Users data retrieved successfully', $users);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving users', $e->getMessage());
        }
    }


    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'role_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'session_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        if (isset($request->password) && isset($request->confirm_password)) {
            if ($request->password == $request->confirm_password) {
                $user['password'] = $request->password;
            } else {
                return $this->errorResponse('Validation failed', $validator->errors(), 422);
            }
        }

        try {

            $user = User::add($request->all());
            return $this->successResponse('User added successfully', $user, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add User', $e->getMessage());
        }
    }


    public function single($id)
    {
        $user = User::find($id);
        return $this->successResponse('User detail get successfully', $user);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($user->id == 1){
            return $this->errorResponse('Sorry; Super Admin can not be updated', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $updatedUser = User::edit($user, $request->all());
            return $this->successResponse('User updated successfully', $updatedUser, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update User', $e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);

            if ($user->id == 1){
                return $this->errorResponse('Sorry; Super Admin can not be deleted', null, 404);
            }

            if (!$user) {
                return $this->errorResponse('User id not found', null, 404);
            }

            $user->delete();
            return $this->successResponse('User deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete user', $e->getMessage());
        }
    }

    public function get_all_roles()
    {
        try {

            $roles = Role::orderBy('id', 'DESC')->get();
            return $this->successResponse('Roles data retrieved successfully', $roles);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving Roles', $e->getMessage());
        }
    }
}
