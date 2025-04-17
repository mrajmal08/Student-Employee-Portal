<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;

class DepartmentController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $departmentQuery = Department::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $departmentQuery->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $departments = $departmentQuery->paginate($perPage);
            } else {
                $departments = $departmentQuery->get();
            }

            foreach ($departments as $department) {
                $department->created_by = User::userDetails($department->created_by);
                $department->updated_by = User::userDetails($department->updated_by);
            }

            return $this->successResponse('Department data retrieved successfully', $departments);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving status', $e->getMessage());
        }
    }

    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $department = Department::add($request->all());
            return $this->successResponse('Department added successfully', $department, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add Department', $e->getMessage());
        }
    }

    public function single($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return $this->errorResponse('Department id not found', null, 404);
        }
        return $this->successResponse('department detail get successfully', $department);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:departments,id',
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $department = Department::edit($request->all());
            return $this->successResponse('Department updated successfully', $department, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Department', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return $this->errorResponse('Department id not found', null, 404);
            }

            $department->delete();
            return $this->successResponse('Department deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete Department', $e->getMessage());
        }
    }
}

