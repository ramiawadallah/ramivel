<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use App\Slider;

class SliderController extends Controller
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
        return \Control::index('slider');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('slider');
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
            'stutes' => 'required',
            'photo' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/sliders',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = null;
        }

        return \Control::store($request,'slider',[
            'translate' => ['title'],
            'stutes' => $request->stutes,
            'photo' => $data['photo'],
        ],aurl().'/sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('slider',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('slider',$id);
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
            'stutes' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/sliders',
                'upload_type'   =>  'single',
                'delete_file'   =>  Slider::find($id)->photo,
           ]); 
        }else{
          $data['photo'] = Slider::find($id)->photo;
        }

        return \Control::update($request,$id,'slider',[
            'translate' => ['title'],
            'stutes' => $request->stutes,
            'photo' => $data['photo'],
        ],aurl().'/sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $sliders = Slider::findOrFail($id);
        \Storage::delete($sliders->photo);
        $sliders->delete();
        session()->flash('success',trans('lang.deleted'));
        return back();
        //return \Control::destroy($request,$id,'slider');
    }

}
