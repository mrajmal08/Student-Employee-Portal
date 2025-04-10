<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\User;


class SessionController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $sessionQuery = Session::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $sessionQuery->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $sessions = $sessionQuery->paginate($perPage);
            } else {
                $sessions = $sessionQuery->get();
            }

            foreach ($sessions as $session) {
                $session->created_by = User::userDetails($session->created_by);
                $session->updated_by = User::userDetails($session->updated_by);
            }

            return $this->successResponse('Sessions data retrieved successfully', $sessions);
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
            $session = Session::add($request->all());
            return $this->successResponse('Session added successfully', $session, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add session', $e->getMessage());
        }
    }

    public function single($id)
    {
        $session = Session::find($id);
        if (!$session) {
            return $this->errorResponse('Session id not found', null, 404);
        }
        return $this->successResponse('Session detail get successfully', $session);
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
            $session = Session::edit($request->all());
            return $this->successResponse('Session updated successfully', $session, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Session', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $session = Session::find($id);

            if (!$session) {
                return $this->errorResponse('Session id not found', null, 404);
            }

            $session->delete();
            return $this->successResponse('Session deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete session', $e->getMessage());
        }
    }
}
