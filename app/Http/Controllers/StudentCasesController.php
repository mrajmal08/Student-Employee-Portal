<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\StudentCase;
use App\Models\CaseMedia;
use App\Models\User;
use Carbon\Carbon;

class StudentCasesController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $query = StudentCase::with(['student', 'course', 'session', 'agent', 'case_status'])->orderBy('id', 'DESC');

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

        foreach ($search_data as $data) {
            $data->created_by = User::userDetails($data->created_by);
            $data->updated_by = User::userDetails($data->updated_by);
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
                return $this->errorResponse('There are no cases related to this student.', null, 404);
            }
            foreach ($cases as $data) {
                $data->created_by = User::userDetails($data->created_by);
                $data->updated_by = User::userDetails($data->updated_by);
            }

            return $this->successResponse('Cases retrieved successfully.', $cases, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve cases.', $e->getMessage());
        }
    }

    public function update(Request $request)
    {

        $case = StudentCase::find($request->case_id);

        if (!$case) {
            return $this->errorResponse('Case id not found', null, 404);
        }

        try {
            $updatedCase = StudentCase::edit($case, $request->all());
            return $this->successResponse('Case updated successfully', $updatedCase, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Case', $e->getMessage(), 500);
        }
    }

    public function get_media_categories(Request $request)
    {
        try {
            $case_id = $request->has('case_id') ? $request->input('case_id') : null;
            $mediaCategories = DB::table('media_categories')->select('id', 'name')->get();
            foreach ($mediaCategories as $category) {
                $category->counter = is_null($case_id) ? null : DB::table('case_media')->where('media_category_id', $category->id)->where('case_id', $case_id)->count();
            }
            return $this->successResponse('Document Manager Categories', $mediaCategories, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Case', $e->getMessage(), 500);
        }
    }

    //get all  case media
    public function case_media(Request $request)
    {
        $caseId     = $request->get('case_id');
        $category   = $request->get('category');
        $pagination = $request->get('pagination');
        $perPage    = $request->get('per_page');

        $result = CaseMedia::search($caseId, $category, $pagination, $perPage);

        return response()->json([
            'status'  => true,
            'message' => 'All Documents List',
            'result'  => $pagination == 1 ? $result : ['data' => $result]
        ]);
    }

    public function add_media(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'case_id' => 'required|exists:student_cases,id,deleted_at,NULL',
            'category_id' => 'required|exists:media_categories,id,deleted_at,NULL',
            'file' => 'required|file|mimes:pdf|max:10240',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $timestamp = Carbon::now()->timestamp;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename = 'file_' . rand(2367, 9999) . '_' . $timestamp . '.' . $extension;

                // Save file
                $file->move(public_path('assets/docs'), $filename);

                // Insert into case_media table
                DB::table('case_media')->insert([
                    'case_id' => $request->case_id,
                    'media_category_id' => $request->category_id,
                    'file_path' => 'assets/docs/' . $filename,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                ]);

                return $this->successResponse('Media file uploaded successfully.', [], 200);
            }

            return $this->errorResponse('File not found in request.', [], 400);
        } catch (\Exception $e) {
            return $this->errorResponse('Something went wrong.', ['error' => $e->getMessage()], 500);
        }
    }


}
