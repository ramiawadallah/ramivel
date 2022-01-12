<?php

namespace App\Http\Controllers\Admin; 

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Models\Guard;

class CommendController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }

    // Guard Function and methods  
    public function indexGuard(){
    	$guards = Guard::all();
    	return view('admin.guards.index',compact('guards', $guards));
    }

    public function createGuard(){
    	return view('admin.guards.create');
    }

    public function storeGuard(Request $request){
    	$request->validate(['name' => 'required|unique:guards,name']);
        $guard = Guard::create($request->all());
    	Artisan::call('ramivel:make '. $request->name);
        return redirect(route('admin.guards'))->with('message', 'New guard is stored successfully');
    }

    public function destroyGuard(Guard $guard){
    	$name = $guard['name'];
    	Artisan::call('ramivel:rollback '. strtolower($name));
    	$guard->delete();
    	return redirect(route('admin.guards'))->with('message', 'You have deleted guard successfully');
    }


    //Databass Commends
    public function migrate(){
        Artisan::call('migrate --seed');
        return redirect(route('admin.home'))->with('message', 'You have migrate successfully');
    }

    public function migrateFresh(){
        Artisan::call('migrate:fresh');
        return redirect(route('admin.home'))->with('message', 'You have migrate:fresh successfully');
    }

    public function migrateInstall(){
        Artisan::call('migrate:install');
        return redirect(route('admin.home'))->with('message', 'You have migrate:install successfully');
    }

    public function migrateRefresh(){
        Artisan::call('migrate:refresh');
        return redirect(route('admin.home'))->with('message', 'You have migrate:refresh successfully');
    }

    public function migrateReset(){
        Artisan::call('migrate:reset');
        return redirect(route('admin.home'))->with('message', 'You have migrate:reset successfully');
    }

    public function migrateRollback(){
        Artisan::call('migrate:rollback');
        return redirect(route('admin.home'))->with('message', 'You have migrate:rollback successfully');
    }


    public function migrateStatus(){
        Artisan::call('migrate:status');
        return redirect(route('admin.home'))->with('message', 'You have migrate:status successfully');
    }
   
    //Controller function and methods 
    

}
