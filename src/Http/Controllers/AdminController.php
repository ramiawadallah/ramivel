<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only'=>'show']);
    }

    public function index()
    {
        return view('admin.home');
    }

    public function show()
    {
        $admins = Admin::where('id', '!=', auth()->id())->get();

        return view('admin.admins.show', compact('admins'));
    }

    public function showChangePasswordForm()
    {
        return view('admin.admins.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'oldPassword'   => 'required',
            'password'      => 'required|confirmed',
        ]);
        auth()->user()->update(['password' => bcrypt($data['password'])]);

        return redirect(route('admin.home'))->with('message', 'Your password is changed successfully');
    }
}
