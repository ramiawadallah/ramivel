<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Admin;
use Auth;

class TeamController extends Controller
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
        return \Control::index('team');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('team');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'translate' => [
                'name' => 'required',
                'content' => 'required',
            ],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/teams',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = null;
        }

        //Request Photo Upload
        if(request()->hasFile('cover')) {
           $data['cover'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'cover',
                'path'          =>  'public/teams',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['cover'] = null;
        }

        return \Control::store($request,'team',[
            'translate' => ['name','title','content'],
            'status' => $request->status,
            'uri' => $request->uri,
            'photo' => $data['photo'],
            'cover' => $data['cover'],
            'created_by'    => Auth::user('admin')->name,
        ],aurl().'/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('team',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('team',$id);
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
            'translate' => [
                'name' => 'required',
                'content' => 'required',
            ],
            'status' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/teams',
                'upload_type'   =>  'single',
                'delete_file'   =>  Team::find($id)->photo,
           ]); 
        }else{
          $data['photo'] = Team::find($id)->photo;
        }

        //Request Photo Upload
        if(request()->hasFile('cover')) {
           $data['cover'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'cover',
                'path'          =>  'public/teams',
                'upload_type'   =>  'single',
                'delete_file'   =>  Team::find($id)->cover,
           ]); 
        }else{
          $data['cover'] = Team::find($id)->cover;
        }

        return \Control::update($request,$id,'team',[
            'translate' => ['name','title','content'],
            'status' => $request->status,
            'uri' => $request->uri,
            'photo' => $data['photo'],
            'cover' => $data['cover'],
            'updated_by'    => Auth::user('admin')->name,
        ],aurl().'/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $name = 'teams';
        $teams = Team::findOrFail($id);
        \Storage::delete($teams->photo);
        $teams->delete();
        return back()->with('message', 'Your one of team is deleted successfully');
    }

    public function order(Request $request)
    {
        return \Control::order($request->data,'team',0);
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Team::destroy(request('item'));
      }else{
        Team::find(request('item'))->delete();
      }
      return back();
    }

}
