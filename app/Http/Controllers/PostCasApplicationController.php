<?php

namespace App\Http\Controllers;

use App\Models\PostCasApplication;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
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
            'brp_start_date' => 'brp_start_date',
            'brp_end_date' => 'brp_end_date',
            'sms_reporting_date' => 'sms_reporting_date'
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

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'cas_no' => 'required',
            'vignette_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'vignette_stamp_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'e_ticket.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'sms_screen_shot.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'brp_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
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
            $data['cas_no'] = $request->cas_no;
            $data['cas_date'] = $request->cas_date;
            $data['after_vignette'] = $request->after_vignette;
            $data['before_vignette'] = $request->before_vignette;
            $data['student_notified'] = $request->student_notified;
            $data['date_of_entry'] = $request->date_of_entry;
            $data['is_egates'] = $request->is_egates;
            $data['brp_received'] = $request->brp_received;
            $data['brp_error'] = $request->brp_error;
            $data['brp_start_date'] = $request->brp_start_date;
            $data['brp_end_date'] = $request->brp_end_date;
            $data['reporting_date'] = $request->reporting_date;
            $data['sms_reporting_date'] = $request->sms_reporting_date;
            $data['brp_correction_note'] = $request->brp_correction_note;
            $data['correct_identified'] = $request->correct_identified;

            $timestamp = Carbon::now()->timestamp;
            $documents = ['vignette_doc', 'vignette_stamp_doc', 'e_ticket', 'sms_screen_shot', 'brp_doc'];

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
            return redirect()->route('postcas.index')->with('message', 'Post Cas Application added Successfully');
        } catch (\Exception $e) {
            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('postcas.index')->with('message', 'Something went wrong');
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
            'cas_no' => 'required',
            'vignette_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'vignette_stamp_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'e_ticket.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'sms_screen_shot.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'brp_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',

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
            'vignette_doc',
            'vignette_stamp_doc',
            'e_ticket',
            'sms_screen_shot',
            'brp_doc',
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

        if ($request->cas_no) {
            $validatedData['cas_no'] = $request->cas_no;
        }
        if ($request->cas_date) {
            $validatedData['cas_date'] = $request->cas_date;
        }
        if ($request->after_vignette) {
            $validatedData['after_vignette'] = $request->after_vignette;
        }
        if ($request->before_vignette) {
            $validatedData['before_vignette'] = $request->before_vignette;
        }
        if ($request->student_notified) {
            $validatedData['student_notified'] = $request->student_notified;
        }
        if ($request->date_of_entry) {
            $validatedData['date_of_entry'] = $request->date_of_entry;
        }
        if ($request->is_egates) {
            $validatedData['is_egates'] = $request->is_egates;
        }
        if ($request->brp_received) {
            $validatedData['brp_received'] = $request->brp_received;
        }
        if ($request->brp_error) {
            $validatedData['brp_error'] = $request->brp_error;
        }
        if ($request->brp_start_date) {
            $validatedData['brp_start_date'] = $request->brp_start_date;
        }
        if ($request->brp_end_date) {
            $validatedData['brp_end_date'] = $request->brp_end_date;
        }
        if ($request->reporting_date) {
            $validatedData['reporting_date'] = $request->reporting_date;
        }
        if ($request->sms_reporting_date) {
            $validatedData['sms_reporting_date'] = $request->sms_reporting_date;
        }
        if ($request->brp_correction_note) {
            $validatedData['brp_correction_note'] = $request->brp_correction_note;
        }
        if ($request->correct_identified) {
            $validatedData['correct_identified'] = $request->correct_identified;
        }

        $postCas->update($validatedData);

        $flasher->option('position', 'top-center')->addSuccess('Post Cas Application updated Successfully');
        return redirect()->route('postcas.index')->with('message', 'Post Cas Application updated Successfully');
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
        return redirect()->route('postcas.index')->with('message', 'Post Cas Application deleted Successfully');
    }
}
