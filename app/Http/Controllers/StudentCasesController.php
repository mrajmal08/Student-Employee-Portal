<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\StudentCase;

class StudentCasesController extends Controller
{
    use ApiResponseTrait;

    public function add(Request $request)
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
}
