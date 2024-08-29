<?php

namespace App\Http\Controllers;
use App\Models\PreCasApplicationCourse;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use App\Models\PreCasApplication;
use Illuminate\Http\Request;
use App\Models\Course;
use Carbon\Carbon;
use Validator;
use Redirect;

class PreCasApplicationController extends Controller
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
        $preCasQuery = PreCasApplication::orderBy('id', 'DESC');

        $filters = [
            'date_of_interview' => 'date_of_interview',
            'name_of_interviewer' => 'name_of_interviewer'
        ];

        foreach ($filters as $requestKey => $column) {
            if ($request->filled($requestKey)) {
                $preCasQuery->where($column, 'like', '%' . $request->$requestKey . '%');
            }
        }
        $preCas = $preCasQuery->get();

        return view('precasapplications.index', compact('preCas'));
    }

    public function create()
    {
        $courses = Course::orderBy('id', 'DESC')->get();

        return view('precasapplications.create', compact('courses'));
    }

    public function view($id)
    {
        $preCas = PreCasApplication::findOrFail($id);
        return view('precasapplications.view', compact('preCas'));
    }

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'interview_questions.*' => 'required|file|mimes:pdf,jpg,jpeg,png,webp',
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
            $data['date_of_interview'] = $request->date_of_interview;
            $data['name_of_interviewer'] = $request->name_of_interviewer;
            $data['note'] = $request->note;
            $data['date_of_referral'] = $request->date_of_referral;
            $data['student_notified'] = $request->student_notified;
            $data['date_of_interview2'] = $request->date_of_interview2;
            $data['name_of_interviewer2'] = $request->name_of_interviewer2;
            $data['note2'] = $request->note2;
            $data['outcome'] = $request->outcome;


            $timestamp = Carbon::now()->timestamp;
            $documents = ['interview_questions'];

            foreach ($documents as $doc) {
                if ($request->hasFile($doc)) {
                    $filenames = [];
                    foreach ($request->file($doc) as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = rand(99999, 234567) . $timestamp . '.' . $extension;
                        $file->move(public_path('assets/PreCasApplicationDoc'), $filename);

                        $filenames[] = $filename;
                    }

                    $data[$doc] = implode(',', $filenames);
                }
            }


            $preCas = PreCasApplication::create($data);
            if ($preCas) {
                $preCasId = $preCas->id;
                $courseIds = $request->course_id ?? [];
                foreach ($courseIds as $courseId) {
                    PreCasApplicationCourse::create([
                        'pre_cas_application_id' => $preCasId,
                        'course_id' => $courseId
                    ]);
                }
            }

            $flasher->option('position', 'top-center')->addSuccess('Pre Cas Application added Successfully');
            return redirect()->route('precas.index')->with('message', 'Pre Cas Application added Successfully');
        } catch (\Exception $e) {
            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('precas.index')->with('message', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $preCas = PreCasApplication::findOrFail($id);
        $courses = Course::all();
        $selectedCourses = $preCas->courses->pluck('id')->toArray();

        return view('precasapplications.edit', compact('preCas', 'courses', 'selectedCourses'));
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $preCas = PreCasApplication::find($id);
        if (!$preCas) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('precas.index')->with('error', 'Id not found');
        }

        $validator = Validator::make($request->all(), [
            'interview_questions.*' => 'required|file|mimes:pdf,jpg,jpeg,png,webp',

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
            'interview_questions'
        ];

        $validatedData = [];
        foreach ($documentFields as $field) {
            if ($request->hasFile($field)) {
                $newFilesArray = [];
                foreach ($request->file($field) as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(99999, 234567) . $timestamp . '.' . $extension;
                    $file->move(public_path('assets/PreCasApplicationDoc'), $filename);
                    $newFilesArray[] = $filename;
                }

                $validatedData[$field] = implode(',', $newFilesArray);
            }
        }

        if ($request->date_of_interview) {
            $validatedData['date_of_interview'] = $request->date_of_interview;
        }
        if ($request->name_of_interviewer) {
            $validatedData['name_of_interviewer'] = $request->name_of_interviewer;
        }
        if ($request->note) {
            $validatedData['note'] = $request->note;
        }
        if ($request->date_of_referral) {
            $validatedData['date_of_referral'] = $request->date_of_referral;
        }
        if ($request->student_notified) {
            $validatedData['student_notified'] = $request->student_notified;
        }
        if ($request->date_of_interview2) {
            $validatedData['date_of_interview2'] = $request->date_of_interview2;
        }
        if ($request->name_of_interviewer2) {
            $validatedData['name_of_interviewer2'] = $request->name_of_interviewer2;
        }
        if ($request->note2) {
            $validatedData['note2'] = $request->note2;
        }
        if ($request->outcome) {
            $validatedData['outcome'] = $request->outcome;
        }

        $preCas->update($validatedData);

        if ($preCas) {
            $preCasId = $preCas->id;
            $courseIds = $request->input('course_id', []);
            foreach ($courseIds as $courseId) {
                PreCasApplicationCourse::updateOrCreate(
                    ['pre_cas_application_id' => $preCasId, 'course_id' => $courseId],
                    ['pre_cas_application_id' => $preCasId, 'course_id' => $courseId]
                );
            }
        }

        $flasher->option('position', 'top-center')->addSuccess('Pre Cas Application updated Successfully');
        return redirect()->route('precas.index')->with('message', 'Student updated Successfully');
    }

    public function delete($id, FlasherInterface $flasher)
    {
        $preCas = PreCasApplication::find($id);

        if (!$preCas) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('precas.index')->with('error', 'Id not found');
        }
        $preCas->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('Pre Cas Application deleted Successfully');
        return redirect()->route('precas.index')->with('message', 'Pre Cas Application deleted Successfully');
    }
}
