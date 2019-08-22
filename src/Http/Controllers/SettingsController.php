<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Setting;
use Auth;

class SettingsController extends Controller
{
    protected $sttings;

    public function __construct(Setting $settings){
        $this->middleware('auth:admin');
        $this->settings = $settings;
    }
    
    public function index()
    {
        $id = 1;
        $settings = Setting::find($id);
        //return view('admin/setting/edit', compact('settings'));
        return view('admin.settings.index',compact('settings'));
    }

   public function update(Request $request){
    
        $data = $this->validate(request(),[
            'translate'             => [
                'title'             =>  ['required', 'min:3'],
                'subtitle'          =>  ['required', 'min:3'],
                'copyright'         =>  ['required', 'min:3'],
                'address'           =>  ['required', 'min:3'],
            ],
                'mainvideo'         =>  ['required', 'min:3'],
                'email'             =>  ['required', 'min:3'],
                'phone'             =>  ['required', 'min:3'],
                'fax'               =>  ['required', 'min:3'],
                'pobox'             =>  ['required', 'min:3'],
                'map'               =>  ['required', 'min:3'],

                'logo'              =>  validate_image(),
                'facebook'          =>  ['required', 'min:3'],
                'twitter'           =>  ['required', 'min:3'],
                'instagram'         =>  ['required', 'min:3'],
                'linkedin'          =>  ['required', 'min:3'],   
                'youtube'           =>  ['required', 'min:3'],
        ],[],
        [
                'title'             =>  trans('lang.title'),
                'subtitle'          =>  trans('lang.subtitle'),
                'copyright'         =>  trans('lang.copyright'),
                'address'           =>  trans('lang.address'),
                'subtitle'          =>  trans('lang.subtitle'),
                'logo'              =>  trans('lang.logo'), 
                'mainvideo'         =>  trans('lang.mainvideo'),
            
                'email'             =>  trans('lang.email'),
                'phone'             =>  trans('lang.phone'),
                'fax'               =>  trans('lang.fax'),
                'pobox'             =>  trans('lang.pobox'),
                'map'               =>  trans('lang.map'),
                
                'facebook'          =>  trans('lang.facebook'),
                'twitter'           =>  trans('lang.twitter'),
                'instagram'         =>  trans('lang.instagram'),
                'linkedin'          =>  trans('lang.linkedin'),   
                'youtube'           =>  trans('lang.youtube'),
        ]
    );


        if(request()->hasFile('logo')) {
           $data['logo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'logo',
                'path'          =>  'settings',
                'upload_type'   =>  'single',
                'delete_file'   =>  setting()->logo,
           ]); 
        }else{
            $data['logo'] = setting()->logo;
        }

        return \Control::update($request,1,'setting',[
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
            'updated_by' => Auth::user('admin')->name,
            'translate'=>['title','subtitle','content','copyright','address'],
        ] );

    }

    public function lang($lang)
    {
        $lang = \App\Lang::where('code',$lang);
        $default = \App\Lang::where('default',1);
        if ($lang->exists()) 
        {
            $local = $lang->first()->code;
        }else{
            if ($default->exists()) {
                # code...
                $local = $default->first()->code;
            }else{
                
                $local = 'ar';
            }
        }
           \Cookie::queue(\Cookie::make('locale', $local, 43200));
        return back();
    }

    public function maintenance()
    {
        if (site('maintenance') == 'open') 
        {
           return redirect('/');
        }else{
            
            return view('Helper::maintenance');
        }
    }
}
