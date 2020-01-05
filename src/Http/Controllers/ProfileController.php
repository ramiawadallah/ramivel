<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use App\Profile;
use App\Admin;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return \Control::index('profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = Admin::find($request->admin_id)->id;

        $profile = Profile::where('admin_id', $admin)->get();

        if(count($profile) >= 1 ){
            session()->flash('error',trans('lang.he_she_has_profile'));
            return redirect('/admin/profiles/'. $request->admin_id .'/edit/');
        }else{

            $this->validate($request,[
                'admin_id' => 'required',
            ]);

            //Request Photo Upload
            if(request()->hasFile('photo')) {
               $data['photo'] = Up()->upload([
                    // 'new_name'      =>  '',
                    'file'          =>  'photo',
                    'path'          =>  'public/profiles/'.$request->admin_id,
                    'upload_type'   =>  'single',
                    'delete_file'   =>  '',
               ]); 
            }else{
              $data['photo'] = null;
            }

            //Request File -- CV -- ANY - pdf Upload
            if(request()->hasFile('cv')) {
               $data['cv'] = Up()->upload([
                    // 'new_name'      =>  '',
                    'file'          =>  'cv',
                    'path'          =>  'public/profiles/'.$request->admin_id,
                    'upload_type'   =>  'single',
                    'delete_file'   =>  '',
               ]); 
            }else{
              $data['cv'] = null;
            }

            return \Control::store($request,'profile',[
                'admin_id' => $request->admin_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'specialization' => $request->specialization,
                'phone' => $request->phone,
                'birth' => $request->birth,
                'location' => $request->location,
                'bio' => $request->bio,
                'photo' => $data['photo'],
                'cv' => $data['cv'],
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'github' => $request->github,
                'behance' => $request->behance,
                'pinterest' => $request->pinterest,
                'youtube' => $request->youtube,
                'created_by'    => Auth::user('admin')->name,
            ],aurl().'/profiles');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('profile',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('profile',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'admin_id' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/profiles/'.$request->admin_id,
                'upload_type'   =>  'single',
                'delete_file'   =>  Profile::find($id)->photo,
           ]); 
        }else{
          $data['photo'] = Profile::find($id)->photo;
        }

        //Request File -- CV -- ANY - pdf Upload
        if(request()->hasFile('cv')) {
           $data['cv'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'cv',
                'path'          =>  'public/profiles/'.$request->admin_id,
                'upload_type'   =>  'single',
                'delete_file'   =>  Profile::find($id)->cv,
           ]); 
        }else{
          $data['cv'] = Profile::find($id)->cv;
        }

        return \Control::update($request,$id,'profile',[
            'admin_id' => $request->admin_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'specialization' => $request->specialization,
            'phone' => $request->phone,
            'birth' => $request->birth,
            'location' => $request->location,
            'bio' => $request->bio,
            'photo' => $data['photo'],
            'cv' => $data['cv'],
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'github' => $request->github,
            'behance' => $request->behance,
            'pinterest' => $request->pinterest,
            'youtube' => $request->youtube,
            'updated_by'    => Auth::user('admin')->name,
        ],aurl().'/profiles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $name = 'profiles';
        $profiles = Profile::findOrFail($id);
        \Storage::delete($profiles->photo);
        $profiles->delete();
        session()->flash('success',trans('lang.delete',['var'=>trans('lang.'.$name)]));
        return back();
    }

    public function order(Request $request)
    {
        return \Control::order($request->data,'profile',0);
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Profile::destroy(request('item'));
      }else{
        Profile::find(request('item'))->delete();
      }
      alert()->success(trans('lang.deleted'), trans('lang.profile'));
      return back();
    }

}
