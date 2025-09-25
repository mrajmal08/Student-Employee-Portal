<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\TaskPriority;
use App\Models\User;

class TaskPriorityController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $taskPriorityQuery = TaskPriority::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $taskPriorityQuery->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $priorities = $taskPriorityQuery->paginate($perPage);
            } else {
                $priorities = $taskPriorityQuery->get();
            }

            foreach ($priorities as $priority) {
                $priority->created_by = User::userDetails($priority->created_by);
                $priority->updated_by = User::userDetails($priority->updated_by);
            }

            return $this->successResponse('Task Priority data retrieved successfully', $priorities);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving Priority', $e->getMessage());
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
            $taskPriority = TaskPriority::add($request->all());
            return $this->successResponse('Task Priority added successfully', $taskPriority, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add Task Priority', $e->getMessage());
        }
    }

    public function single($id)
    {
        $taskPriority = TaskPriority::find($id);
        if (!$taskPriority) {
            return $this->errorResponse('Task Priority id not found', null, 404);
        }
        return $this->successResponse('Task Priority detail get successfully', $taskPriority);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:task_priorities,id',
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $taskPriority = taskPriority::edit($request->all());
            return $this->successResponse(' Task Priority updated successfully', $taskPriority, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Task Priority', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $taskPriority = TaskPriority::find($id);

            if (!$taskPriority) {
                return $this->errorResponse('Task Priority id not found', null, 404);
            }

            $taskPriority->delete();
            return $this->successResponse('Task Priority deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete Task Priority', $e->getMessage());
        }
    }
}
