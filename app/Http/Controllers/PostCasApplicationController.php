<?php

namespace App\Http\Controllers;

use App\Models\PostCasApplication;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Redirect;

class PostCasApplicationController extends Controller
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
        $postCasQuery = PostCasApplication::orderBy('id', 'DESC');

        $filters = [
            'cas_no' => 'cas_no',
            'cas_date' => 'cas_date',
            'date_of_entry' => 'date_of_entry',
            'brp_start_date' => 'brp_start_date',
            'brp_end_date' => 'brp_end_date'
        ];

        foreach ($filters as $requestKey => $column) {
            if ($request->filled($requestKey)) {
                $postCasQuery->where($column, 'like', '%' . $request->$requestKey . '%');
            }
        }
        $postCas = $postCasQuery->get();

        return view('postcasapplications.index', compact('postCas'));
    }

    public function create()
    {

        return view('postcasapplications.create');
    }

    public function view($id)
    {
        $postCas = PostCasApplication::findOrFail($id);
        return view('postcasapplications.view', compact('postCas'));
    }

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'interview_questions.*' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',
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
                        $file->move(public_path('assets/PostCasApplicationDoc'), $filename);

                        $filenames[] = $filename;
                    }

                    $data[$doc] = implode(',', $filenames);
                }
            }

            PostCasApplication::create($data);

            $flasher->option('position', 'top-center')->addSuccess('Post Cas Application added Successfully');
            return redirect()->route('postCas.index')->with('message', 'Post Cas Application added Successfully');
        } catch (\Exception $e) {
            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('postCas.index')->with('message', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $postCas = PostCasApplication::findOrFail($id);

        return view('postcasapplications.edit', compact('postCas'));
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $postCas = PostCasApplication::find($id);
        if (!$postCas) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('postCas.index')->with('error', 'Id not found');
        }

        $validator = Validator::make($request->all(), [
            'interview_questions.*' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:4096',

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
                    $file->move(public_path('assets/postCasApplicationDoc'), $filename);
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

        $postCas->update($validatedData);

        $flasher->option('position', 'top-center')->addSuccess('Post Cas Application updated Successfully');
        return redirect()->route('postCas.index')->with('message', 'Student updated Successfully');
    }

    public function delete($id, FlasherInterface $flasher)
    {
        $postCas = PostCasApplication::find($id);

        if (!$postCas) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('postCas.index')->with('error', 'Id not found');
        }
        $postCas->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('Post Cas Application deleted Successfully');
        return redirect()->route('postCas.index')->with('message', 'Post Cas Application deleted Successfully');
    }
}
