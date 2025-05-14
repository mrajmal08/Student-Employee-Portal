<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\User;

class InterviewController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $interviewQuery = Interview::with(['status'])->orderByDesc('id');

            if ($request->filled('interviewer_name')) {
                $interviewQuery->where('interviewer_name', 'like', '%' . $request->interviewer_name . '%');
            }

            if ($request->filled('interview_date')) {
                $interviewQuery->where('interview_date', $request->interview_date);
            }

            if ($request->filled('status_id')) {
                $interviewQuery->where('status_id', $request->status_id);
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $interviews = $interviewQuery->paginate($perPage);
            } else {
                $interviews = $interviewQuery->get();
            }

            foreach ($interviews as $interview) {
                $interview->created_by = User::userDetails($interview->created_by);
                $interview->updated_by = User::userDetails($interview->updated_by);
            }

            return $this->successResponse('Interviews retrieved successfully', $interviews);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving interviews', $e->getMessage());
        }
    }

    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'referral_date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $interview = Interview::add($request->all());
            return $this->successResponse('Interview added successfully', $interview, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add interview', $e->getMessage());
        }
    }

}
