<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dependant;
use Carbon\Carbon;
use Validator;
use Redirect;

class DependantController extends Controller
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

        $dependantQuery = Dependant::orderBy('id', 'DESC');

        $filters = [
            'name' => 'name',
            'nationality' => 'nationality',
            'date_of_birth' => 'date_of_birth',
        ];

        foreach ($filters as $requestKey => $column) {
            if ($request->filled($requestKey)) {
                $dependantQuery->where($column, 'like', '%' . $request->$requestKey . '%');
            }
        }

        $dependants = $dependantQuery->get();

        return view('dependants.index', compact('dependants'));
    }

    public function create()
    {
        return view('dependants.create');
    }

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'nationality' => 'required',
            'date_of_birth' => 'required',
            'financial_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'qualification_doc.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'pay_slip.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'employer_letter.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'marriage_certificate.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',
            'birth_certificate.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp',


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
            $data['nationality'] = $request->nationality;
            $data['date_of_birth'] = $request->date_of_birth;
            $data['travel_outside'] = $request->travel_outside;
            $data['travel_history'] = $request->travel_history;
            $data['officer_note'] = $request->officer_note;

            $timestamp = Carbon::now()->timestamp;
            $documents = ['financial_doc', 'qualification_doc', 'pay_slip', 'employer_letter', 'marriage_certificate', 'birth_certificate'];

            foreach ($documents as $doc) {
                if ($request->hasFile($doc)) {
                    $filenames = [];
                    foreach ($request->file($doc) as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = rand(99999, 234567) . $timestamp . '.' . $extension;
                        $file->move(public_path('assets/DependantDoc'), $filename);

                        $filenames[] = $filename;
                    }

                    $data[$doc] = implode(',', $filenames);
                }
            }

            Dependant::create($data);

            $flasher->option('position', 'top-center')->addSuccess('Dependant added Successfully');
            return redirect()->route('dependants.index')->with('message', 'Dependant added Successfully');
        } catch (\Exception $e) {

            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('dependants.index')->with('message', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $dependant = Dependant::findOrFail($id);
        return view('dependants.edit', compact('dependant'));
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $dependant = Dependant::find($id);

        if (!$dependant) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('dependants.index')->with('error', 'Id not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'nationality' => 'required',
            'date_of_birth' => 'required',
            'financial_doc.*' => 'nullable|mimes:pdf,jpg,jpeg,png,webp',
            'qualification_doc.*' => 'nullable|mimes:pdf,jpg,jpeg,png,webp',
            'pay_slip.*' => 'nullable|mimes:pdf,jpg,jpeg,png,webp',
            'employer_letter.*' => 'nullable|mimes:pdf,jpg,jpeg,png,webp',
            'marriage_certificate.*' => 'nullable|mimes:pdf,jpg,jpeg,png,webp',
            'birth_certificate.*' => 'nullable|mimes:pdf,jpg,jpeg,png,webp',


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
        $documents = ['financial_doc', 'qualification_doc', 'pay_slip', 'employer_letter', 'marriage_certificate', 'birth_certificate'];
        $validatedData = [];
        foreach ($documents as $field) {
            if ($request->hasFile($field)) {
                $newFilesArray = [];
                foreach ($request->file($field) as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(99999, 234567) . $timestamp . '.' . $extension;
                    $file->move(public_path('assets/DependantDoc'), $filename);
                    $newFilesArray[] = $filename;
                }

                $validatedData[$field] = implode(',', $newFilesArray);
            }
        }

        if ($request->name) {
            $validatedData['name'] = $request->name;
        }
        if ($request->nationality) {
            $validatedData['nationality'] = $request->nationality;
        }
        if ($request->date_of_birth) {
            $validatedData['date_of_birth'] = $request->date_of_birth;
        }
        if ($request->travel_outside) {
            $validatedData['travel_outside'] = $request->travel_outside;
        }
        if ($request->travel_history) {
            $validatedData['travel_history'] = $request->travel_history;
        }
        if ($request->officer_note) {
            $validatedData['officer_note'] = $request->officer_note;
        }


        $dependant->update($validatedData);
        $flasher->option('position', 'top-center')->addSuccess('Dependant updated Successfully');
        return redirect()->route('dependants.index')->with('message', 'Dependant updated Successfully');
    }

    public function delete($id, FlasherInterface $flasher)
    {
        $dependant = Dependant::find($id);

        if (!$dependant) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('dependants.index')->with('error', 'Id not found');
        }
        $dependant->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('Dependant deleted Successfully');
        return redirect()->route('dependants.index')->with('message', 'Dependant deleted Successfully');
    }
}
