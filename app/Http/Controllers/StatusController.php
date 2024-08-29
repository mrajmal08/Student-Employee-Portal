<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Status;
use Validator;
use Redirect;

class StatusController extends Controller
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
        $statusQuery = Status::orderBy('id', 'DESC');

        $filters = [
            'name' => 'name',
        ];

        foreach ($filters as $requestKey => $column) {
            if ($request->filled($requestKey)) {
                $statusQuery->where($column, 'like', '%' . $request->$requestKey . '%');
            }
        }
        $users = $statusQuery->get();

        return view('statuses.index', compact('users'));
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                $flasher->options([
                    'timeout' => 3000,
                    'position' => 'top-center',
                ])->addError('Validation Error', $error);
            }
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            Status::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $flasher->option('position', 'top-center')->addSuccess('Status added Successfully');
            return redirect()->route('status.index')->with('message', 'Status added Successfully');
        } catch (\Exception $e) {
            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('status.index')->with('message', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $status = Status::findOrFail($id);
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, FlasherInterface $flasher, $id)
    {
        $status = Status::find($id);
        if (!$status) {
            $flasher->option('position', 'top-center')->addError('Status not found');
            return redirect()->route('status.index')->with('error', 'Status not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
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

        if ($request->name) {
            $status->name = $request->name;
        }
        if ($request->description) {
            $status->description = $request->description;
        }

        $status->save();

        $flasher->option('position', 'top-center')->addSuccess('Status updated successfully.');
        return redirect()->route('status.index');
    }

    public function delete($id, FlasherInterface $flasher)
    {
        $status = Status::find($id);

        if (!$status) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('status.index')->with('error', 'Id not found');
        }
        $status->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('status deleted Successfully');
        return redirect()->route('status.index')->with('message', 'Status deleted Successfully');
    }
}

