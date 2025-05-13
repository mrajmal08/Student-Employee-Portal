<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponseTrait;
use App\Models\RecruitmentAgent;
use App\Models\StudentDependant;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use App\Models\StudentMedia;
use App\Models\Dependant;
use App\Models\Student;
use App\Models\Course;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Redirect;

class StudentController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $studentsQuery = Student::orderBy('id', 'DESC');

            if ($request->filled('name')) {
                $studentsQuery->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('email')) {
                $studentsQuery->where('email', 'like', '%' . $request->email . '%');
            }
            if ($request->filled('phone_no')) {
                $studentsQuery->where('phone_no', 'like', '%' . $request->phone_no . '%');
            }

            if ($request->has('pagination') && $request->pagination == 1) {
                $perPage = $request->input('per_page', 20);
                $users = $studentsQuery->paginate($perPage);
            } else {
                $users = $studentsQuery->get();
            }

            foreach ($users as $user) {
                $user->created_by = User::userDetails($user->created_by);
                $user->updated_by = User::userDetails($user->updated_by);
            }

            return $this->successResponse('Users data retrieved successfully', $users);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving courses', $e->getMessage());
        }
    }

    public function create($id)
    {
        $dependants = Dependant::orderBy('id', 'DESC')->get();
        $courses = Course::orderBy('id', 'DESC')->get();
        $student = Student::whereNull('students.deleted_at')
            ->with([
                'dependants' => function ($query) {
                    $query->whereNull('dependants.deleted_at');
                },
                'media' => function ($query) {
                    $query->whereNull('students_media.deleted_at');
                }
            ])
            ->findOrFail($id);
        $recruitmentAgent = RecruitmentAgent::orderBy('id', 'DESC')->get();
        $status = Status::orderBy('id', 'ASC')->get();
        $selectedDependants = $student->dependants->pluck('id')->toArray();

        return view('students.create', compact('dependants', 'selectedDependants', 'courses', 'recruitmentAgent', 'status', 'student'));
    }

    public function single($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return $this->errorResponse('Student id not found', null, 404);
        }
        return $this->successResponse('Student detail get successfully', $student);
    }

    public function add()
    {

        $status = Status::orderBy('id', 'ASC')->get();

        return view('students.add', compact('status'));
    }

    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|unique:students,email',
            'nationality' => 'required|max:255',
            'date_of_birth' => 'required|max:255|date_format:Y-m-d',
            'place_of_birth' => 'required|max:255',
            'passport_start_date' => 'required|date_format:Y-m-d',
            'passport_expiry_date' => 'required|date_format:Y-m-d',
            'passport_status' => 'required|max:255',
            'phone_no' => 'required',
            'gender' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {

            $student = Student::add($request->all());

            return $this->successResponse('Student added successfully', $student, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add User', $e->getMessage());
        }
    }


    public function update(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $updatedUser = Student::edit($student, $request->all());

            if ($updatedUser) {
                $timestamp = Carbon::now()->timestamp;
                $documents = ['financial_maintenance', 'visa_document', 'visa_document2'];

                foreach ($documents as $doc) {
                    if ($request->hasFile($doc)) {
                        foreach ($request->file($doc) as $file) {
                            $extension = $file->getClientOriginalExtension();
                            $filename = $doc . '_' . rand(9999, 2367) . '_' . $timestamp . '.' . $extension;
                            $file->move(public_path('assets/studentFiles'), $filename);

                            DB::table('case_media')->insert([
                                'case_id' => $request->case_id,
                                'media_category_id' => 1,
                                'file_path' => 'assets/studentFiles/' . $filename,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }

            return $this->successResponse('Student updated successfully', $updatedUser, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Student', $e->getMessage(), 500);
        }
    }

    public function insert_old(Request $request)
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
            'status_id' => 'required',
            'passport_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'brp_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'financial_statement_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'qualification_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'lang_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'miscellaneous_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'tb_certificate_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'previous_cas_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
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
            $data['agent_id'] = $request->agent_id;
            $data['referral'] = $request->referral;
            $data['stakeholder'] = $request->stakeholder;
            $data['screened_by'] = $request->screened_by;
            $data['status_id'] = $request->status_id;
            $data['created_by'] = auth()->user()->id;
            $data['updated_by'] = auth()->user()->id;


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
        $recruitmentAgent = RecruitmentAgent::orderBy('id', 'DESC')->get();
        $status = Status::orderBy('id', 'ASC')->get();

        return view('students.edit', compact('student', 'courses', 'dependants', 'selectedCourses', 'selectedDependants', 'recruitmentAgent', 'status'));
    }

    public function update_old(Request $request, $id, FlasherInterface $flasher)
    {

        if ($request->documents_type) {
            if (is_null($request->documents)) {

                $flasher->option('position', 'top-center')->addError('Documents field is required');
                return redirect()->back()->with('message', 'Student updated Successfully');
            }
        }

        if ($request->documents) {
            if (is_null($request->documents_type)) {
                $flasher->option('position', 'top-center')->addError('Document Type field is required');
                return redirect()->back()->with('message', 'Student updated Successfully');
            }
        }

        $student = Student::find($id);
        if (!$student) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('students.index')->with('error', 'Id not found');
        }

        if ($request->has('course_id')) {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required',
                'intake' => 'required',
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
        }

        if ($request->course_id) {
            $student->course_id = $request->course_id;
        }
        if ($request->intake) {
            $student->intake = $request->intake;
        }
        if ($request->previous_cas) {
            $student->previous_cas = $request->previous_cas;
        }
        if ($request->traveling_alone) {
            $student->traveling_alone = $request->traveling_alone;
        }
        if ($request->dependant_no) {
            $student->dependant_no = $request->dependant_no;
        }
        if ($request->academic_history) {
            $student->academic_history = $request->academic_history;
        }
        if ($request->work_experience) {
            $student->work_experience = $request->work_experience;
        }
        if ($request->travel_history) {
            $student->travel_history = $request->travel_history;
        }
        if ($request->notes) {
            $student->notes = $request->notes;
        }
        if ($request->preferred_method) {
            $student->preferred_method = $request->preferred_method;
        }
        if ($request->agent_id) {
            $student->agent_id = $request->agent_id;
        }
        if ($request->referral) {
            $student->referral = $request->referral;
        }
        if ($request->stakeholder) {
            $student->stakeholder = $request->stakeholder;
        }
        if ($request->screened_by) {
            $student->screened_by = $request->screened_by;
        }

        $student->updated_by = auth()->user()->id;

        $student->save();

        if ($student) {
            $studentId = $student->id;
            $dependantIds = $request->input('dependant_id', []);
            foreach ($dependantIds as $dependantId) {
                StudentDependant::updateOrCreate(
                    ['student_id' => $studentId, 'dependant_id' => $dependantId]
                );
            }


            if ($request->has('files')) {
                $timestamp = Carbon::now()->timestamp;

                foreach ($request->documents as $key => $file) {

                    if ($file instanceof \Illuminate\Http\UploadedFile) {

                        $extension = $file->getClientOriginalExtension();
                        $filename = $file->getClientOriginalName() . '_' . rand(999, 2345) . '_' . $timestamp . '.' . $extension;
                        $file->move(public_path('assets/studentFiles'), $filename);

                        StudentMedia::create([
                            'student_id' => $student->id,
                            'document_name' => $request->documents_type,
                            $request->documents_type => $filename,
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id
                        ]);
                    }
                }
            }
        }

        $flasher->option('position', 'top-center')->addSuccess('Student updated Successfully');
        return redirect()->back()->with('message', 'Student updated Successfully');
    }

    public function delete($id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return $this->errorResponse('Student id not found', null, 404);
            }

            $student->delete();
            return $this->successResponse('Student deleted successfully', null, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete student', $e->getMessage());
        }
    }

    public function mediaDelete($id)
    {

        $student = StudentMedia::find($id);

        if (!$student) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->back()->with('message', 'Media deleted Successfully');
        }
        $student->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('Media deleted Successfully');
        return redirect()->back()->with('message', 'Media deleted Successfully');
    }
}
