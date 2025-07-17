<?php

namespace App\Http\Controllers;

use App\Models\Comment as ModelsComment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class commentController extends Controller
{

    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {

            $data = DB::table('view_general_comment');
            if (!empty($request->input('case_id'))) {
                $data = $data->Where('view_general_comment.case_id', $request->input('case_id'));
            }
            if (!empty($request->input('comment_category_id'))) {
                $data = $data->Where('view_general_comment.comment_category_id', $request->input('comment_category_id'));
            }
            $data = $data->orderBy('id');
            if ($request->has('pagination') && $request->input('pagination') == 1) {
                if ($request->has('per_page')) {
                    $data = $data->paginate($request->input('per_page'));
                } else {
                    $data = $data->paginate(20);
                }
                return $this->successResponse('comments retrieved successfully', $data);
            } else {
                $data = $data->get();
                return $this->successResponse('comments retrieved successfully', $data);
            }
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving comments', $e->getMessage());
        }
    }
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'case_id' => 'required|exists:student_cases,id',
            'comment_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $comment = ModelsComment::add($request->all());
            return $this->successResponse('comment details added successfully', $comment, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add comment details', $e->getMessage());
        }
    }

    public function comment_categories()
    {
        try {
            $categories = DB::table('comment_categories')->get();
            return $this->successResponse('comment categories retrieving successfully', $categories, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving comments categories', $e->getMessage());
        }
    }
}
