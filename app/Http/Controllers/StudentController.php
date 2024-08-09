<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
use App\Models\StudentDependant;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use App\Models\Dependant;
use App\Models\Student;
use App\Models\Course;
use Carbon\Carbon;
use Validator;
use Redirect;

class StudentController extends Controller
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
        $studentsQuery = Student::orderBy('id', 'DESC');


        if ($request->has('name')) {
            $studentsQuery->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }

        $filters = [
            'email' => 'email',
            'phone_no' => 'phone_no',
            'nationality' => 'nationality'
        ];

        foreach ($filters as $requestKey => $column) {
            if ($request->filled($requestKey)) {
                $studentsQuery->where($column, 'like', '%' . $request->$requestKey . '%');
            }
        }
        $students = $studentsQuery->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $dependants = Dependant::orderBy('id', 'DESC')->get();
        $courses = Course::orderBy('id', 'DESC')->get();

        return view('students.create', compact('dependants', 'courses'));
    }

    public function view(){
        return view('students.view');
    }

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:students,email',
            'nationality' => 'required|max:255',
            'phone_no' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:1,2',
            'address' => 'required',
            'course_id' => 'required',
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
            $data['email'] = $request->email;
            $data['phone_no'] = $request->phone_no;
            $data['date_of_birth'] = $request->date_of_birth;
            $data['gender'] = $request->gender;
            $data['passport'] = $request->passport;
            $data['nationality'] = $request->nationality;
            $data['address'] = $request->address;
            $data['academic_history'] = $request->work_experience;
            $data['travel_history'] = $request->travel_history;
            $data['work_experience'] = $request->work_experience;
            $data['intake'] = $request->intake;
            $data['notes'] = $request->notes;
            $data['dependant_no'] = $request->dependant_no;
            $data['previous_cas'] = $request->previous_cas;


            $timestamp = Carbon::now()->timestamp;
            $documents = ['passport_doc', 'brp_doc', 'financial_statement_doc', 'qualification_doc', 'lang_doc', 'miscellaneous_doc', 'tb_certificate_doc', 'previous_cas_doc'];

            foreach ($documents as $doc) {
                if ($request->hasFile($doc)) {
                    $filename = rand(99999, 234567) . $timestamp . '.' . $request->$doc->extension();
                    $request->$doc->move(public_path('assets/studentFiles'), $filename);
                    $data[$doc] = $filename;
                }
            }

            $students = Student::create($data);
            if ($students) {
                $studentId = $students->id;
                $courseIds = $request->course_id ?? [];
                foreach ($courseIds as $courseId) {
                    StudentCourse::create([
                        'student_id' => $studentId,
                        'course_id' => $courseId
                    ]);
                }

                $dependantIds = $request->dependant_id ?? [];
                foreach ($dependantIds as $dependantId) {
                    StudentDependant::create([
                        'student_id' => $studentId,
                        'dependant_id' => $dependantId
                    ]);
                }
            }

            $flasher->option('position', 'top-center')->addSuccess('Student added Successfully');
            return redirect()->route('students.index')->with('message', 'Student added Successfully');
        } catch (\Exception $e) {
            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('students.index')->with('message', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $student = Student::find($id);

        if (!$student) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('students.index')->with('error', 'Id not found');
        }

        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'email' => 'required',
            'nationality' => 'required|max:255',
            'phone_no' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:1,2',
            'address' => 'required',
            'dependant_id' => 'required',
            'course_id' => 'required',
        ]);

        $student->update($validatedData);
        $flasher->option('position', 'top-center')->addSuccess('Student updated Successfully');
        return redirect()->route('students.index')->with('message', 'Student updated Successfully');
    }

    public function delete($id, FlasherInterface $flasher)
    {
        $student = Student::find($id);

        if (!$student) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('students.index')->with('error', 'Id not found');
        }
        $student->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('Student deleted Successfully');
        return redirect()->route('students.index')->with('message', 'Student deleted Successfully');
    }
}
