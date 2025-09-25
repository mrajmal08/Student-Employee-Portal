<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\TaskType;
use App\Models\User;

class TaskTypeController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    { 
        try {
            $taskTypeQuery = TaskType::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $taskTypeQuery->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $types = $taskTypeQuery->paginate($perPage);
            } else {
                $types = $taskTypeQuery->get();
            }

            foreach ($types as $type) {
                $type->created_by = User::userDetails($type->created_by);
                $type->updated_by = User::userDetails($type->updated_by);
            }

            return $this->successResponse('Task type data retrieved successfully', $types);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving type', $e->getMessage());
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
            $taskType = TaskType::add($request->all());
            return $this->successResponse('Task type added successfully', $taskType, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add Task type', $e->getMessage());
        }
    }

    public function single($id)
    {
        $taskType = TaskType::find($id);
        if (!$taskType) {
            return $this->errorResponse('Task type id not found', null, 404);
        }
        return $this->successResponse('Task type detail get successfully', $taskType);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:task_types,id',
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $taskType = TaskType::edit($request->all());
            return $this->successResponse(' Task type updated successfully', $taskType, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Task type', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $taskType = TaskType::find($id);

            if (!$taskType) {
                return $this->errorResponse('Task type id not found', null, 404);
            }

            $taskType->delete();
            return $this->successResponse('Task type deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete Task type', $e->getMessage());
        }
    }
}
