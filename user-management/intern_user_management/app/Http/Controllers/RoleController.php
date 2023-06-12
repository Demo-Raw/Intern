<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;
use Carbon\Carbon;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::select('id', 'name')->get();
        return view('roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_feature_permissions = Permission::select('permissions.id', 'permissions.name', 'features.name as feature_name')
                                    ->leftJoin('features', 'features.id', 'permissions.feature_id')
                                    ->where('permissions.feature_id', 1)
                                    ->get();
        
        $role_feature_permissions = Permission::select('permissions.id', 'permissions.name', 'features.name as feature_name')
                                    ->leftJoin('features', 'features.id', 'permissions.feature_id')
                                    ->where('permissions.feature_id', 2)
                                    ->get();

        $all_access_permission = Permission::select('permissions.id', 'permissions.name', 'features.name as feature_name')
                                    ->leftJoin('features', 'features.id', 'permissions.feature_id')
                                    ->where('permissions.feature_id', 3)
                                    ->first();

        return view('roles.create')
            ->with('user_feature_permissions', $user_feature_permissions)
            ->with('role_feature_permissions', $role_feature_permissions)
            ->with('all_access_permission', $all_access_permission);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:roles'
            ]
        );

        if ($validator->fails()) {
            return redirect('/roles/create')
                ->withErrors($validator)
                ->withInput();
        }

        $inputsRole['name'] = $request['name'];
        Role::insert($inputsRole);

        $role = Role::select('id')->where('name', $request['name'])->first();

        if ($request->has('all_access')) {
            $inputs = [];
            $inputs['role_id'] = $role->id;
            $inputs['permission_id'] = $request['all_access'];
            RolePermission::insert($inputs);
        }
        else {
            if ($request->has('view_user')) {
                $inputs['role_id'] = $role->id;
                $inputs['permission_id'] = $request['view_user'];
                RolePermission::insert($inputs);
            }
            if ($request->has('create_user')) {
                $inputs['role_id'] = $role->id;
                $inputs['permission_id'] = $request['create_user'];
                RolePermission::insert($inputs);
            }
            if ($request->has('update_user')) {
                $inputs['role_id'] = $role->id;
                $inputs['permission_id'] = $request['update_user'];
                RolePermission::insert($inputs);
            }
            if ($request->has('delete_user')) {
                $inputs['role_id'] = $role->id;
                $inputs['permission_id'] = $request['delete_user'];
                RolePermission::insert($inputs);
            }
            if ($request->has('view_role')) {
                $inputs['role_id'] = $role->id;
                $inputs['permission_id'] = $request['view_role'];
                RolePermission::insert($inputs);
            }
            if ($request->has('create_role')) {
                $inputs['role_id'] = $role->id;
                $inputs['permission_id'] = $request['create_role'];
                RolePermission::insert($inputs);
            }
            if ($request->has('update_role')) {
                $inputs['role_id'] = $role->id;
                $inputs['permission_id'] = $request['update_role'];
                RolePermission::insert($inputs);
            }
            if ($request->has('delete_role')) {
                $inputs['role_id'] = $role->id;
                $inputs['permission_id'] = $request['delete_role'];
                RolePermission::insert($inputs);
            }
        }
        session()->flash('message', 'You created the record successfully');

        return redirect('/roles');
    }
    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role_id = $role->id;
        $role = Role::select('name')->where('id', $role_id)->first();
        $role_permissions = RolePermission::select('permissions.name as permission_name')
                            ->leftJoin('permissions', 'role_permissions.permission_id', 'permissions.id')
                            ->where('role_permissions.role_id', $role_id)
                            ->get();

        $permission_names = '';

        foreach ($role_permissions as $key => $value) {
            $permission_name = $value['permission_name'];
            $permission_name = str_replace('_', ' ', $permission_name);
            $permission_names .= ucfirst($permission_name) . ', ';
        }
        $permission_names = rtrim($permission_names, ', ');
        
        $role_name = $role->name;

        return view('roles.show')
            ->with('role_name', $role_name)
            ->with('permission_names', $permission_names);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {                           
        $user_feature_permissions = Permission::select('permissions.id', 'permissions.name', 'features.name as feature_name')
                                    ->leftJoin('features', 'features.id', 'permissions.feature_id')
                                    ->where('permissions.feature_id', 1)
                                    ->get();
        
        $role_feature_permissions = Permission::select('permissions.id', 'permissions.name', 'features.name as feature_name')
                                    ->leftJoin('features', 'features.id', 'permissions.feature_id')
                                    ->where('permissions.feature_id', 2)
                                    ->get();

        $all_access_permission = Permission::select('permissions.id', 'permissions.name', 'features.name as feature_name')
                                    ->leftJoin('features', 'features.id', 'permissions.feature_id')
                                    ->where('permissions.feature_id', 3)
                                    ->first();
                                
        $role_permissions = RolePermission::select('permission_id')
                                ->where('role_id', $role->id)
                                ->get()
                                ->pluck('permission_id')
                                ->toArray();

        return view('roles.edit')
            ->with('role', $role)
            ->with('user_feature_permissions', $user_feature_permissions)
            ->with('role_feature_permissions', $role_feature_permissions)
            ->with('all_access_permission', $all_access_permission)
            ->with('role_permissions', $role_permissions);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:roles,name,' . $role->id
            ]
        );

        if ($validator->fails()) {
            return redirect('/roles/' . $role->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $inputsRole['name'] = $request['name'];
        $inputsRole['updated_at'] = Carbon::now();
        Role::where('id', $role->id)->update($inputsRole);

        $selectedPermissions = [];
        $permissions = ['all_access', 'view_user', 'create_user', 'update_user', 'delete_user', 'view_role', 'create_role', 'update_role', 'delete_role'];

        foreach ($permissions as $permission) {
            if ($request->has($permission)) {
                $selectedPermissions[] = $request->input($permission);
            }
        }
    
        $currentPermissions = RolePermission::where('role_id', $role->id)
            ->pluck('permission_id')
            ->toArray();
    
        $permissionsToInsert = array_diff($selectedPermissions, $currentPermissions);
        foreach ($permissionsToInsert as $permissionId) {
            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $permissionId,
            ]);
        }
    
        $permissionsToDelete = array_diff($currentPermissions, $selectedPermissions);
        RolePermission::where('role_id', $role->id)
            ->whereIn('permission_id', $permissionsToDelete)
            ->delete();

        session()->flash('message', 'You updated the record successfully!');
        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Role::where('id', $role->id)->delete();
        RolePermission::where('role_id', $role->id)->delete();
        return response()->json('You deleted the record successfully!');
    }
}
