<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use App\Models\Dependant;
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


        if ($request->has('name')) {
            $dependantQuery->where('name', 'like', '%' . $request->name . '%');
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

            Dependant::create($data);
            $flasher->option('position', 'top-center')->addSuccess('Dependant added Successfully');

            return redirect()->route('dependants.index')->with('message', 'Dependant added Successfully');
        } catch (\Exception $e) {
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

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

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
