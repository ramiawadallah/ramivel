<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Setting;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{
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
        $setting->update($request->all());
        return redirect(route('admin.settings.edit'))->with('message', 'You have updated Setting successfully');
    }

}
