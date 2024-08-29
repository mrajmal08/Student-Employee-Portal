<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Redirect;

class UserController extends Controller
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
        $userQuery = User::orderBy('id', 'DESC');

        $filters = [
            'name' => 'name',
            'email' => 'email',
            'phone_no' => 'phone_no',
        ];

        foreach ($filters as $requestKey => $column) {
            if ($request->filled($requestKey)) {
                $userQuery->where($column, 'like', '%' . $request->$requestKey . '%');
            }
        }
        $users = $userQuery->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function insert(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
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

        if (isset($request->password) && isset($request->confirm_password)) {
            if ($request->password == $request->confirm_password) {
                $user['password'] = $request->password;
            } else {
                $flasher->option('position', 'top-center')->addError('Password Not Matched');
            }
        }

        try {
            $hashedPassword = Hash::make($request->password);
            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'password' => $hashedPassword,
                'role_id' => 2,
            ]);

            $flasher->option('position', 'top-center')->addSuccess('User added Successfully');
            return redirect()->route('user.index')->with('message', 'User added Successfully');
        } catch (\Exception $e) {
            $flasher->option('position', 'top-center')->addError('Something went wrong');
            return redirect()->route('user.index')->with('message', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, FlasherInterface $flasher, $id)
    {
        $user = User::find($id);
        if (!$user) {
            $flasher->option('position', 'top-center')->addError('User not found');
            return redirect()->route('user.index')->with('error', 'User not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_no' => 'required',
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable',
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
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->phone_no) {
            $user->phone_no = $request->phone_no;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $flasher->option('position', 'top-center')->addSuccess('User updated successfully.');
        return redirect()->route('user.index');
    }

    public function delete($id, FlasherInterface $flasher)
    {
        $user = User::find($id);

        if (!$user) {
            $flasher->option('position', 'top-center')->addError('Id not found');
            return redirect()->route('user.index')->with('error', 'Id not found');
        }
        $user->delete();
        $flasher->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addSuccess('user deleted Successfully');
        return redirect()->route('user.index')->with('message', 'user deleted Successfully');
    }
}
