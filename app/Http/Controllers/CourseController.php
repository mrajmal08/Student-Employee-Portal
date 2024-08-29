<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use Validator;
use Redirect;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $coursesQuery = Course::orderBy('id', 'DESC');


        if ($request->has('name')) {
            $coursesQuery->where('name', 'like', '%' . $request->name . '%');
        }

        $courses = $coursesQuery->get();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                $flasher->options([
                    'timeout' => 3000,
                    'position' => 'top-center',
                ])->option('position', 'top-center')->addError('Validation Error', $error);
                return Redirect::back()->withErrors($validator)->withInput();
            }
        }

        try {
            $data['name'] = $request->name;

            Course::create($data);
            $flasher->option('position', 'top-center')->addSuccess('Course added Successfully');

            return redirect()->route('courses.index')->with('message', 'Course added Successfully');
        } catch (\Exception $e) {
            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('courses.index')->with('message', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $course = Course::find($id);

        if (!$course) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('courses.index')->with('error', 'Id not found');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $course->update($validatedData);
        $flasher->option('position', 'top-center')->addSuccess('Course updated Successfully');
        return redirect()->route('courses.index')->with('message', 'Course updated Successfully');
    }

    public function delete($id, FlasherInterface $flasher)
    {
        $Course = Course::find($id);

        if (!$Course) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('courses.index')->with('error', 'Id not found');
        }
        $Course->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('Course deleted Successfully');
        return redirect()->route('courses.index')->with('message', 'Course deleted Successfully');
    }
}
