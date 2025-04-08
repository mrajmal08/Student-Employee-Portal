<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $coursesQuery = Course::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $coursesQuery->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $courses = $coursesQuery->paginate($perPage);
            } else {
                $courses = $coursesQuery->get();
            }

            foreach ($courses as $course) {
                $course->created_by = User::userDetails($course->created_by);
                $course->updated_by = User::userDetails($course->updated_by);
            }

            return $this->successResponse('Courses data retrieved successfully', $courses);

        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving courses', $e->getMessage());
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
            $course = Course::add($request->all());
            return $this->successResponse('Course added successfully', $course, 201);


        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add course', $e->getMessage());
        }
    }

    public function single($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return $this->errorResponse('Course id not found', null, 404);
            }
        return $this->successResponse('Course detail get successfully', $course);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:courses,id',
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $course = Course::edit($request->all());
            return $this->successResponse('Course updated successfully', $course, 201);


        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update course', $e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            $course = Course::find($id);

            if (!$course) {
            return $this->errorResponse('Course id not found', null, 404);
            }

            $course->delete();
            return $this->successResponse('Course deleted successfully', null, 201);


        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete course', $e->getMessage());
        }
    }

}
