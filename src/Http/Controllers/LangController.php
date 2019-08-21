<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Lang;
use Auth;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only'=>'show']);
    }

    public function index()
    {
        return \Control::index('lang');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('lang');
        // return view('admin.langs.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
        'name'=>'required',
        'code'=>'required',
        'direction'=>'required',
        ]);
        if(request()->has('default'))
        {
            Lang::where('default',1)->update(['default'=>0]);
        }
        $checkCount = Lang::where('code',request('code'))->count();
        if ($checkCount > 0) 
        {
            return response(trans('lang.lang_exists'), 300);
        }
        else{
            $add = new Lang;
            $add->name = request('name');
            $add->code = request('code');
            $add->default = request('default',0);
            $add->direction = request('direction');
            $add->created_by = Auth::user()->name;
            $add->save();
            @full_copy(base_path('resources/lang/en'),base_path('resources/lang/'.request('code')));

            alert()->success(trans('lang.added'), trans('lang.lang'));

             session()->flash('success',trans('lang.system_updated'));
        return redirect('admin/langs');
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
        return \Control::show('langs',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        //$lang = Lang::find($id);
        //return view('admin_rule.langs.edit',compact('lang'));
        return \Control::edit('langs',$id);
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
            'name'=>'required',
            'code'=>'required',
            'direction'=>'required',
            ],[],[
            'name'=>trans('lang.lang_name'),
            'code'=>trans('lang.lang_code'),
            ]);
        if($request->has('default'))
        {
            Lang::where('default',1)->update(['default'=>0]);
        }
            $add = Lang::find($id);
            $add->name = $request->name;
            rename(base_path('resources/lang/'.$add->code), base_path('resources/lang/'.$request->code));
            $add->code = $request->code;
            $add->default = $request->has('default') ? 1 : 0;
            $add->direction = $request->direction;
            $add->updated_by = Auth::user()->name;
            $add->save();

            alert()->success(trans('lang.updated'), trans('lang.lang'));

            session()->flash('success',trans('lang.system_updated'));
            return redirect('admin/langs');
    }

    public function updateFiles(Request $request)
    {
        $lang = Lang::find($request->lang)->code;
        
        $contents = [];
        foreach ($request->fileName as $key => $file) 
        {
            $ary = [];
            foreach ($request->{'keys_'.str_replace('.', '_', $file)} as $k => $v) 
            {
                $ary[$v] = $request->{'content_'.str_replace('.', '_', $file)}[$k];
                $contents[$file]= $ary;
            }
        }
            foreach ($contents as $filename => $data) 
            {
            $fileContent = '<?php
        return [
        ';
                        $file_path = base_path('resources/lang/'.$lang.'/'.$filename);
                        foreach ($data as $kk => $vv) 
                        {
        $fileContent .= "   '".$kk."'  => '".$vv."',
        ";
                        }
                    $fileContent .= '];';
                            file_put_contents($file_path,$fileContent);
                        
                    }
        alert()->success(trans('lang.updated'), trans('lang.lang_system'));

        session()->flash('success',trans('lang.system_updated'));
        return redirect('admin/langs');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        if (Lang::where('id',$request->lang)->count() > 0) 
        {
                # code...
            $lang = Lang::find($request->lang);
            $files = glob(base_path('resources/lang/'.$lang->code.'/*.*'));
            foreach ($files as  $file) 
            {
                @unlink($file);
            }
            @rmdir(base_path('resources/lang/'.$lang->code));
            $lang_name = $lang->name;
            \App\Language::where('lang',$lang->id)->delete();
            $lang->delete(); 
        }

        alert()->success(trans('lang.deleted'), trans('lang.lang'));

        return back();
       
    }

    public function order(Request $request)
    {
        return \Control::order($request->data,'lang',0);
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Lang::destroy(request('item'));
      }else{
        Lang::find(request('item'))->delete();
      }
      alert()->success(trans('lang.deleted'), trans('lang.lang'));
      return back();
    }

}
