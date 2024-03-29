<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Routing\Controller;
use App\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('parent');
        return view('admin.roles.create', compact('permissions'));
    }

    public function edit(Role $role)
    {
        $role        = $role->load('permissions');
        $permissions = Permission::all()->groupBy('parent');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        $role = Role::create($request->all());
        $role->addPermission($request->permissions);
        return redirect(route('admin.roles'))->with('message', 'New Role is stored successfully');
    }

    public function update(Role $role, Request $request)
    {
        $request->validate(['name' => 'required']);
        $role->update($request->all());
        $role->syncPermissions($request->permissions);

        return redirect(route('admin.roles'))->with('message', 'You have updated Role successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back()->with('message', 'You have deleted Role successfully');
    }
}
