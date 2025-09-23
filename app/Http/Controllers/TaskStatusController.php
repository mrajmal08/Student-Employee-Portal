<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $taskStatusQuery = TaskStatus::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $taskStatusQuery->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $statuses = $taskStatusQuery->paginate($perPage);
            } else {
                $statuses = $taskStatusQuery->get();
            }

            foreach ($statuses as $status) {
                $status->created_by = User::userDetails($status->created_by);
                $status->updated_by = User::userDetails($status->updated_by);
            }

            return $this->successResponse('Task status data retrieved successfully', $statuses);
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
            $taskStatus = TaskStatus::add($request->all());
            return $this->successResponse('Task status added successfully', $taskStatus, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add Task status', $e->getMessage());
        }
    }

    public function single($id)
    {
        $taskStatus = TaskStatus::find($id);
        if (!$taskStatus) {
            return $this->errorResponse('Task status id not found', null, 404);
        }
        return $this->successResponse('Task status detail get successfully', $taskStatus);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:task_statuses,id',
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $taskStatus = TaskStatus::edit($request->all());
            return $this->successResponse(' Task status updated successfully', $taskStatus, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Task status', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $taskStatus = TaskStatus::find($id);

            if (!$taskStatus) {
                return $this->errorResponse('Task Status id not found', null, 404);
            }

            $taskStatus->delete();
            return $this->successResponse('Task Status deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete Task status', $e->getMessage());
        }
    }
}
