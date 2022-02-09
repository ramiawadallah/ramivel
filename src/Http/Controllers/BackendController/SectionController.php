<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Admin;
use Auth;

class SectionController extends Controller
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
        return \Control::index('section');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('section');
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
            ],
            'status'  => 'required',
            'order' => 'required',
            'page_id' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/sections',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = null;
        }

        return \Control::store($request,'section',[
            'translate' => ['title','subtitle','content'],
            'status' => $request->status,
            'page_id' => $request->page_id,
            'type' => $request->type,
            'order' => $request->order,
            'content_publish' => $request->content_publish,
            'photo' => $data['photo'],
            'updated_by'    => Auth::user('admin')->name,
        ],aurl().'/sections');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('section',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('section',$id);
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
            ],
            'status'  => 'required',
            'order' => 'required',
            'page_id' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/sections',
                'upload_type'   =>  'single',
                'delete_file'   =>  Section::find($id)->photo,
           ]); 
        }else{
          $data['photo'] = Section::find($id)->photo;
        }

        return \Control::update($request,$id,'section',[
            'translate' => ['title','content'],
            'status' => $request->status,
            'page_id' => $request->page_id,
            'type' => $request->type,
            'order' => $request->order,
            'content_publish' => $request->content_publish,
            'photo' => $data['photo'],
            'updated_by'    => Auth::user('admin')->name,
        ],aurl().'/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $name = 'sections';
        $sections = Section::findOrFail($id);
        \Storage::delete($sections->photo);
        $sections->delete();
        return back()->with('message', 'Your Section is deleted successfully');
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Section::destroy(request('item'));
      }else{
        Section::find(request('item'))->delete();
      }
      return back();
    }



}
