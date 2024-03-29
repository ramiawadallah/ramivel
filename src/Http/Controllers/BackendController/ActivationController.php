<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ActivationController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->adminModel = config('multiauth.models.admin');
    }

    public function activate(Admin $admin)
    {
        $this->authorize('UpdateAdmin', $this->adminModel);
        $admin->update(['active' => true]);
        return redirect()->back();
    }

    public function deactivate(Admin $admin)
    {
        $this->authorize('UpdateAdmin', $this->adminModel);
        $admin->update(['active' => false]);
        return redirect()->back();
    }
}
