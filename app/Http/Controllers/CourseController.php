<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{

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

            return response()->json([
                'status' => true,
                'message' => 'Courses data retrieved successfully',
                'result' => $courses
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }


    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $course = Course::add($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Course added successfully',
                'data' => $course
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add course',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function single($id)
    {
        $course = Course::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Course detail get successfully',
            'data' => $course
        ], 201);

    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:courses,id',
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $course = Course::edit($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Course updated successfully',
                'result' => $course
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }


    public function delete($id)
    {
        try {
            $course = Course::find($id);

            if (!$course) {
                return response()->json([
                    'status' => false,
                    'message' => 'Course not found'
                ], 404);
            }

            $course->delete();

            return response()->json([
                'status' => true,
                'message' => 'Course deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

}
