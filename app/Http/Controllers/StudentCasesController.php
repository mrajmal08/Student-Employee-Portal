<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\StudentCase;

class StudentCasesController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $query = StudentCase::with(['student', 'course', 'session', 'agent']);

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('session_id')) {
            $query->where('session_id', $request->session_id);
        }

        if ($request->filled('agent_id')) {
            $query->where('agent_id', $request->agent_id);
        }

        if ($request->has('pagination') && $request->pagination == 1) {
            $perPage = $request->input('per_page', 20);
            $search_data = $query->paginate($perPage);
        } else {
            $search_data = $query->get();
        }

        return $this->successResponse('Case List', $search_data, 201);
    }


    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'exists:courses,id,deleted_at,NULL',
            'session_id' => 'exists:sessions,id,deleted_at,NULL',
            'agent_id' => 'exists:users,id,deleted_at,NULL',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {

            $student = StudentCase::add($request->all());
            return $this->successResponse('Case added successfully', $student, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add case', $e->getMessage());
        }
    }

    public function single($id)
    {
        try {
            $cases = StudentCase::with(['student', 'course', 'session', 'agent'])
                ->where('student_id', $id)
                ->get();

            if ($cases->isEmpty()) {
                return $this->errorResponse('There are no cases related to this patient.', null, 404);
            }

            return $this->successResponse('Cases retrieved successfully.', $cases, 200);

        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve cases.', $e->getMessage());
        }
    }

}
