<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use App\Models\RolePermission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('users.id', 'users.name', 'users.username', 'roles.name as role_name', 'users.phone', 'users.email')
                    ->leftJoin('roles', 'users.role_id', 'roles.id')
                    ->get();
        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select()->get();
        return view('users.create')
            ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'username' => 'required|unique:users',
                'role' => 'required',
                'phone' => 'required|unique:users|min:11|regex:/^[0-9]+$/',
                'email' => 'required|email|unique:users',
                'address' => 'required',
                'password' => 'required|confirmed|min:6',
                'gender' => 'required',
                'status' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect('/users/create')
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = [];
        $inputs['name'] = $request['name'];
        $inputs['username'] = $request['username'];
        $inputs['role_id'] = $request['role'];
        $inputs['phone'] = $request['phone'];
        $inputs['email'] = $request['email'];
        $inputs['address'] = $request['address'];
        $inputs['password'] = bcrypt($request['password']);
        $inputs['gender'] = $request['gender'];
        $inputs['is_active'] = $request['status'];

        User::insert($inputs);
        session()->flash('message', 'You saved the record successfully!');
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::select('users.id', 'users.name', 'users.username', 'roles.name as role_name', 'users.phone', 'users.email', 
                'users.address', 'users.gender','users.is_active as status')
                ->leftJoin('roles', 'roles.id', 'users.role_id')
                ->where('users.id', $user->id)
                ->first();

        return view('users.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::select()->get();
        return view('users.edit')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'username' => 'required|unique:users,username,' . $user->id,
                'role' => 'required',
                'phone' => 'required|min:11|regex:/^[0-9]+$/|unique:users,phone,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'address' => 'required',
                'gender' => 'required',
                'status' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect('/users/' . $user->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = [];
        $inputs['name'] = $request['name'];
        $inputs['username'] = $request['username'];
        $inputs['role_id'] = $request['role'];
        $inputs['phone'] = $request['phone'];
        $inputs['email'] = $request['email'];
        $inputs['address'] = $request['address'];
        $inputs['gender'] = $request['gender'];
        $inputs['is_active'] = $request['status'];

        User::where('id', $user->id)->update($inputs);
        session()->flash('message', 'You updated the record successfully!');
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::where('id', $user->id)->delete();
        return response()->json('You deleted the record successfully!', 200);
    }
}
