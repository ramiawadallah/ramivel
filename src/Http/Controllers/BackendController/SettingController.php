<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Auth;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Schema::hasTable('settings')) 
        {
            if(Setting::count() == 0){
                $data = [
                    'title' => 'Ramivel',
                    'subtitle' => 'Ramivel CMS',
                    'email' => 'rami.moh.awadallah@gmail.com',
                    'phone' => '+962 79 8961076',
                    'address' => 'Amman-Jordan',
                    'fax' => '+962 79 8961076',
                    'pobox' => '11118',
                    'map' => null,
                    'mainvideo' => null,
                    // About your website
                    'content' => 'Ramivel is a laravel admin & multiauth package ',
                    'logo' => null,
                    'icon' => null,
                    'maintenance' => null,
                    'keywords' => null,
                    'copyright' => null,
                    // Social media
                    'facebook' => null,
                    'twitter' => null,
                    'instagram' => null,
                    'linkedin' => null,
                    'youtube' => null,

                    'updated_by' => 'admin'
                ];
                $settings = Setting::create($data);
                return redirect(route('admin.settings.edit'))->with('message', 'New Role is stored successfully');
            } 
                return redirect(route('admin.settings.edit'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $setting = Setting::all()->first();
        return view('admin.settings.index',compact('setting',$setting));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Setting $setting, Request $request)
    {
        if(request()->hasFile('logo')) {
           $data['logo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'logo',
                'path'          =>  'public/settings',
                'upload_type'   =>  'single',
                'delete_file'   =>  setting()->logo,
           ]); 
        }else{
            $data['logo'] = setting()->logo;
        }

        if(request()->hasFile('icon')) {
           $data['icon'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'icon',
                'path'          =>  'public/settings',
                'upload_type'   =>  'single',
                'delete_file'   =>  setting()->icon,
           ]); 
        }else{
            $data['icon'] = setting()->icon;
        }

        $data = [
            'title' => $request->title,
            'subtitle'  => $request->subtitle,
            'content'  => $request->content,
            'address'  => $request->address,
            'copyright'  => $request->copyright,

            'mainvideo' => $request->mainvideo,
            'maintenance' => $request->maintenance,
            
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'pobox' => $request->pobox,
            'map' => $request->map,

            'keywords' => $request->keywords,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'logo' => $data['logo'],
            'icon' => $data['icon'],
            'updated_by' => Auth::user('admin')->name,

        ];
        
        $setting->update($data);
        return redirect(route('admin.settings.edit'))->with('message', 'You have updated Setting successfully');
    }

    public function updateTheme(Request $request, $id){
        $setting = Setting::find($id);
        $setting->theme = $request->theme;
        $setting->save();
        return redirect()->back()->with('message', 'You have updated theme color successfully to be '. $setting->theme);
    }

}
