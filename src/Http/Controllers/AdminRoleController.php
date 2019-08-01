<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Role;
use Illuminate\Routing\Controller;

class AdminRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super');
    }

    public function attach(Admin $admin, Role $role)
    {
        $admin->roles()->attach($role->id);

        return redirect()->back();
    }

    public function detach(Admin $admin, Role $role)
    {
        $admin->roles()->detach($role->id);

        return redirect()->back();
    }
}
