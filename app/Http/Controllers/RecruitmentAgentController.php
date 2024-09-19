<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use App\Models\RecruitmentAgent;
use Illuminate\Http\Request;
use Validator;
use Redirect;

class RecruitmentAgentController extends Controller
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
        $recruitmentQuery = RecruitmentAgent::orderBy('id', 'DESC');

        $filters = [
            'name' => 'name',
            'company_register_number' => 'company_register_number',
            'date_of_registration' => 'date_of_registration',
        ];

        foreach ($filters as $requestKey => $column) {
            if ($request->filled($requestKey)) {
                $recruitmentQuery->where($column, 'like', '%' . $request->$requestKey . '%');
            }
        }
        $recruitments = $recruitmentQuery->get();

        return view('recruitments.index', compact('recruitments'));
    }

    public function create()
    {
        return view('recruitments.create');
    }

    public function view()
    {
        return view('recruitments.view');
    }

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'directors' => 'required|max:255',
            'company_register_number' => 'required|max:255',
            'payment_method' => 'required',
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
            $data['directors'] = $request->directors;
            $data['company_register_number'] = $request->company_register_number;
            $data['date_of_registration'] = $request->date_of_registration;
            $data['payment_method'] = $request->payment_method;
            $data['account_name'] = $request->account_name;
            $data['account_number'] = $request->account_number;
            $data['institutions'] = $request->institutions;
            $data['career_history'] = $request->career_history;
            $data['address_uk'] = $request->address_uk;
            $data['address'] = $request->address;
            $data['compliance_check'] = $request->compliance_check;

            RecruitmentAgent::create($data);

            if($request->student_form){
                $flasher->option('position', 'top-center')->addSuccess('Recruitment added Successfully');
                return redirect()->back()->with('message', 'Recruitment added Successfully');
            }else{
                $flasher->option('position', 'top-center')->addSuccess('Recruitment added Successfully');
                return redirect()->route('recruitments.index')->with('message', 'Recruitment added Successfully');
            }

        } catch (\Exception $e) {
            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('recruitments.index')->with('message', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $recruitment = RecruitmentAgent::findOrFail($id);
        return view('recruitments.edit', compact('recruitment'));
    }

    public function updateAgent(Request $request, FlasherInterface $flasher){


        $recruitment = RecruitmentAgent::find($request->id);

        if (!$recruitment) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('recruitments.index')->with('error', 'Id not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'directors' => 'required|max:255',
            'company_register_number' => 'nullable|max:255',
            'date_of_registration' => 'nullable|date',
            'payment_method' => 'required',
            'account_name' => 'nullable|max:255',
            'account_number' => 'nullable|max:255',
            'institutions' => 'nullable|max:255',
            'career_history' => 'nullable|max:255',
            'address_uk' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'compliance_check' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                $flasher->options([
                    'timeout' => 3000,
                    'position' => 'top-center',
                ])->addError('Validation Error', $error);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recruitment->update($validator->validated());

        $flasher->option('position', 'top-center')->addSuccess('Recruitment updated Successfully');
        return redirect()->back()->with('message', 'Recruitment updated Successfully');
    }



    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $recruitment = RecruitmentAgent::find($id);

        if (!$recruitment) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('recruitments.index')->with('error', 'Id not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'directors' => 'required|max:255',
            'company_register_number' => 'nullable|max:255',
            'date_of_registration' => 'nullable|date',
            'payment_method' => 'required',
            'account_name' => 'nullable|max:255',
            'account_number' => 'nullable|max:255',
            'institutions' => 'nullable|max:255',
            'career_history' => 'nullable|max:255',
            'address_uk' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'compliance_check' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                $flasher->options([
                    'timeout' => 3000,
                    'position' => 'top-center',
                ])->addError('Validation Error', $error);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recruitment->update($validator->validated());

        $flasher->option('position', 'top-center')->addSuccess('Recruitment updated Successfully');
        return redirect()->route('recruitments.index')->with('message', 'Recruitment updated Successfully');
    }

    public function delete($id, FlasherInterface $flasher)
    {
        $recruitment = RecruitmentAgent::find($id);

        if (!$recruitment) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('recruitments.index')->with('error', 'Id not found');
        }
        $recruitment->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('Recruitment deleted Successfully');
        return redirect()->route('recruitments.index')->with('message', 'Recruitment deleted Successfully');
    }
}
