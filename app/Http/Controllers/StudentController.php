<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
use App\Models\RecruitmentAgent;
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
        $studentsQuery = Student::with('dependants')->orderBy('id', 'DESC');

        $filters = [
            'name' => 'name',
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
        $recruitmentAgent = RecruitmentAgent::orderBy('id', 'DESC')->get();

        return view('students.create', compact('dependants', 'courses', 'recruitmentAgent'));
    }

    public function view($id)
    {
        $student = Student::findOrFail($id);
        return view('students.view', compact('student'));
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
            'passport_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'brp_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'financial_statement_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'qualification_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'lang_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'miscellaneous_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'tb_certificate_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'previous_cas_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
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
                    $filenames = [];
                    foreach ($request->file($doc) as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = rand(99999, 234567) . $timestamp . '.' . $extension;
                        $file->move(public_path('assets/studentFiles'), $filename);

                        $filenames[] = $filename;
                    }

                    $data[$doc] = implode(',', $filenames);
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
        $dependants = Dependant::all();
        $courses = Course::all();
        $selectedCourses = $student->courses->pluck('id')->toArray();
        $selectedDependants = $student->dependants->pluck('id')->toArray();

        return view('students.edit', compact('student', 'courses', 'dependants', 'selectedCourses', 'selectedDependants'));
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $student = Student::find($id);
        if (!$student) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('students.index')->with('error', 'Id not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'nationality' => 'required|max:255',
            'phone_no' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:1,2',
            'address' => 'required',
            'course_id' => 'required',
            'passport_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'brp_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'financial_statement_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'qualification_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'lang_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'miscellaneous_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'tb_certificate_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
            'previous_cas_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
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

        $timestamp = Carbon::now()->timestamp;
        $documentFields = [
            'passport_doc',
            'brp_doc',
            'financial_statement_doc',
            'qualification_doc',
            'lang_doc',
            'miscellaneous_doc',
            'tb_certificate_doc',
            'previous_cas_doc'
        ];

        $validatedData = [];
        foreach ($documentFields as $field) {
            if ($request->hasFile($field)) {
                // $existingFiles = explode(',', $student->$field);

                // try {
                //     foreach ($existingFiles as $file) {
                //         $filePath = public_path('assets/studentFiles/' . $file);
                //         if (file_exists($filePath)) {
                //             unlink($filePath);
                //         }
                //     }
                // } catch (\Exception $e) {
                //     $flasher->option('position', 'top-center')->addError('Failed to delete old files for');
                //     return redirect()->back()->with('error', 'Failed to delete old files for ' . $field);
                // }

                $newFilesArray = [];
                foreach ($request->file($field) as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(99999, 234567) . $timestamp . '.' . $extension;
                    $file->move(public_path('assets/studentFiles'), $filename);
                    $newFilesArray[] = $filename;
                }

                $validatedData[$field] = implode(',', $newFilesArray);
            }
        }

        if ($request->name) {
            $validatedData['name'] = $request->name;
        }
        if ($request->email) {
            $validatedData['email'] = $request->email;
        }
        if ($request->nationality) {
            $validatedData['nationality'] = $request->nationality;
        }
        if ($request->phone_no) {
            $validatedData['phone_no'] = $request->phone_no;
        }
        if ($request->date_of_birth) {
            $validatedData['date_of_birth'] = $request->date_of_birth;
        }
        if ($request->gender) {
            $validatedData['gender'] = $request->gender;
        }
        if ($request->address) {
            $validatedData['address'] = $request->address;
        }
        if ($request->intake) {
            $validatedData['intake'] = $request->intake;
        }
        if ($request->previous_cas) {
            $validatedData['previous_cas'] = $request->previous_cas;
        }

        $student->update($validatedData);

        if ($student) {
            $studentId = $student->id;
            $courseIds = $request->input('course_id', []);
            foreach ($courseIds as $courseId) {
                StudentCourse::updateOrCreate(
                    ['student_id' => $studentId, 'course_id' => $courseId],
                    ['student_id' => $studentId, 'course_id' => $courseId]
                );
            }

            $dependantIds = $request->input('dependant_id', []);
            foreach ($dependantIds as $dependantId) {
                StudentDependant::updateOrCreate(
                    ['student_id' => $studentId, 'dependant_id' => $dependantId],
                    ['student_id' => $studentId, 'dependant_id' => $dependantId]
                );
            }
        }

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
