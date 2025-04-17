<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\User;

class DesignationController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $designationQuery = Designation::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $designationQuery->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $designations = $designationQuery->paginate($perPage);
            } else {
                $designations = $designationQuery->get();
            }

            foreach ($designations as $designation) {
                $designation->created_by = User::userDetails($designation->created_by);
                $designation->updated_by = User::userDetails($designation->updated_by);
            }

            return $this->successResponse('Designations data retrieved successfully', $designations);
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
            $designation = Designation::add($request->all());
            return $this->successResponse('Designation added successfully', $designation, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add designation', $e->getMessage());
        }
    }

    public function single($id)
    {
        $designation = Designation::find($id);
        if (!$designation) {
            return $this->errorResponse('Designation id not found', null, 404);
        }
        return $this->successResponse('Designation detail get successfully', $designation);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:sessions,id',
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $designation = Designation::edit($request->all());
            return $this->successResponse('Designation updated successfully', $designation, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Designation', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $designation = Designation::find($id);

            if (!$designation) {
                return $this->errorResponse('Designation id not found', null, 404);
            }

            $designation->delete();
            return $this->successResponse('Designation deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete Designation', $e->getMessage());
        }
    }
}
