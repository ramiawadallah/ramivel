<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use App\Service;

class ServiceController extends Controller
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
        return \Control::index('service');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('service');
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
            'stutes' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/services',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = null;
        }

        return \Control::store($request,'service',[
            'translate' => ['title','content'],
            'stutes' => $request->stutes,
            'uri' => $request->uri,
            'photo' => $data['photo'],
        ],aurl().'/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('service',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('service',$id);
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
            'stutes' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/services',
                'upload_type'   =>  'single',
                'delete_file'   =>  Service::find($id)->photo,
           ]); 
        }else{
          $data['photo'] = Service::find($id)->photo;
        }

        return \Control::update($request,$id,'service',[
            'translate' => ['title','content'],
            'stutes' => $request->stutes,
            'uri' => $request->uri,
            'photo' => $data['photo'],
        ],aurl().'/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $services = Service::findOrFail($id);
        \Storage::delete($services->photo);
        $services->delete();
        session()->flash('success',trans('lang.deleted'));
        return back();

        //return \Control::destroy($request,$id,'service');
    }

}
