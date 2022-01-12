<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Project;
use Auth;


class ProjectController extends Controller
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
        return \Control::index('project');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('project');
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
                'title' => 'required',
                'content' => 'required',
            ],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'video' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/projects',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = null;
        }

        return \Control::store($request,'project',[
            'translate' => ['title','content'],
            'status' => $request->status,
            'partner_id' => $request->partner_id,
            'uri' => $request->uri,
            'video' => $request->video,
            'created_by' => Auth::user('admin')->name,
            'photo' => $data['photo'],
        ],aurl().'/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('project',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('project',$id);
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
                'title' => 'required',
                'content' => 'required',
            ],
            'partner_id' => 'required',
            'status' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/projects',
                'upload_type'   =>  'single',
                'delete_file'   =>  Project::find($id)->photo,
           ]); 
        }else{
          $data['photo'] = Project::find($id)->photo;
        }

        return \Control::update($request,$id,'project',[
            'translate' => ['title','content'],
            'status' => $request->status,
            'partner_id' => $request->partner_id,
            'uri' => $request->uri,
            'video' => $request->video,
            'updated_by' => Auth::user('admin')->name,
            'photo' => $data['photo'],
        ],aurl().'/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $photos = Project::findOrFail($id);
        $photos->delete();
        return back()->with('message', 'Your project is deleted successfully');
    }

    public function upload_file($id){
        //Request Photo Upload
        if(request()->hasFile('file')) {
            $fid = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'file',
                'path'          =>  'public/pro-photos/'.$id,
                'upload_type'   =>  'files',
                'file_type'     =>  'photo',
                'delete_file'   =>  '',
                'relation_id'   =>  $id,
            ]);
            return response(['stutes'=>true, 'id' => $fid], 200);
        }
    }


    public function delete_file(){
        //Request Photo Upload
        if(request()->has('id')) {
            Up()->delete(request('id'));
        }
    }

}
