<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use App\Setting;

class SettingController extends Controller
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
        $id = 1;
        $settings = Setting::find($id);
        return view('admin.settings.index',compact('settings',$settings));
        
    }

    public function update(Request $request, $id)
    {
        $data = [];

        foreach ($request->all() as $key => $value) {
            if(is_array($value))
            {
                  $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
            } else {
                  $data[$key] = $value;
            }
        }

        $this->validate($request,[
            'title.*' => 'required|max:255',
            'subtitle.*' => 'required',
            'address.*' => 'required',
            'copyright.*' => 'required',
            'content.*' => 'required',
            'mainvideo' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'pobox' => 'required',
            'map' => 'required',
            'keywords' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
            'maintenance' => 'required',
        ]);

        $setting = Setting::where('id', '=', $id)->first();

        //Request Photo Upload
        if(request()->hasFile('logo')) {
           $data['logo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'logo',
                'path'          =>  'public/settings',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['logo'] = $setting->logo;
        }

        $setting->title = $data['title']; 
        $setting->subtitle = $data['subtitle']; 
        $setting->address = $data['address']; 
        $setting->copyright = $data['copyright']; 
        $setting->content = $data['content']; 
        $setting->mainvideo = $data['mainvideo']; 
        $setting->email = $data['email']; 
        $setting->phone = $data['phone']; 
        $setting->fax = $data['fax']; 
        $setting->pobox = $data['pobox']; 
        $setting->map = $data['map']; 
        $setting->keywords = $data['keywords']; 
        $setting->facebook = $data['facebook']; 
        $setting->twitter = $data['twitter']; 
        $setting->linkedin = $data['linkedin']; 
        $setting->instagram = $data['instagram']; 
        $setting->youtube = $data['youtube']; 
        $setting->logo = $data['logo']; 
        $setting->maintenance = $data['maintenance']; 
        $setting->update();
        session()->flash('success',trans('lang.updated'));
        return  redirect()->back();
    }


}
