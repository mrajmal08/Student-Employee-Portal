<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\User;


class StatusController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $statusQuery = Status::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $statusQuery->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $statuses = $statusQuery->paginate($perPage);
            } else {
                $statuses = $statusQuery->get();
            }

            foreach ($statuses as $status) {
                $status->created_by = User::userDetails($status->created_by);
                $status->updated_by = User::userDetails($status->updated_by);
            }

            return $this->successResponse('Status data retrieved successfully', $statuses);
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
            $status = Status::add($request->all());
            return $this->successResponse('Status added successfully', $status, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add status', $e->getMessage());
        }
    }

    public function single($id)
    {
        $status = Status::findOrFail($id);
        return $this->successResponse('Status detail get successfully', $status);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:status,id',
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $status = Status::edit($request->all());
            return $this->successResponse('Status updated successfully', $status, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Status', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $status = Status::find($id);

            if (!$status) {
                return $this->errorResponse('Status id not found', null, 404);
            }

            $status->delete();
            return $this->successResponse('Status deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete status', $e->getMessage());
        }
    }
}
