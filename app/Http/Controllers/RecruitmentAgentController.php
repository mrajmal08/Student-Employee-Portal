<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
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


        if ($request->has('name')) {
            $recruitmentQuery->where(function ($query) use ($request) {
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:recruitement_agents,email',
            'phone_no' => 'required',
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
            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['email'] = $request->email;
            $data['phone_no'] = $request->phone_no;
            $data['date_of_birth'] = $request->date_of_birth;
            $data['gender'] = $request->gender;
            $data['passport'] = $request->passport;
            $data['nationality'] = $request->nationality;
            $data['address'] = $request->address;
            $data['notes'] = $request->notes;

            RecruitmentAgent::create($data);

            $flasher->option('position', 'top-center')->addSuccess('Recruitment added Successfully');
            return redirect()->route('recruitments.index')->with('message', 'Recruitment added Successfully');
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

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $recruitment = RecruitmentAgent::find($id);

        if (!$recruitment) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('recruitments.index')->with('error', 'Id not found');
        }

        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'email' => 'required',
            'phone_no' => 'required',
        ]);

        $recruitment->update($validatedData);
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
