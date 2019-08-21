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
                'address_jordan'           =>  ['required', 'min:3'],
                'address_sudan'           =>  ['required', 'min:3'],
            ],
                'mainvideo'         =>  ['required', 'min:3'],
                'email_jordan'      =>  ['required', 'min:3'],
                'phone_jordan'      =>  ['required', 'min:3'],
                'fax_jordan'        =>  ['required', 'min:3'],
                'pobox_jordan'      =>  ['required', 'min:3'],
                'map_jordan'        =>  ['required', 'min:3'],

                'email_sudan'       =>  ['required', 'min:3'],
                'phone_sudan'       =>  ['required', 'min:3'],
                'fax_sudan'         =>  ['required', 'min:3'],
                'pobox_sudan'       =>  ['required', 'min:3'],
                'map_sudan'         =>  ['required', 'min:3'],

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
                'address_sudan'     =>  trans('lang.address_sudan'),
                'address_jordan'    =>  trans('lang.address_jordan'),
                'subtitle'          =>  trans('lang.subtitle'),
                'logo'              =>  trans('lang.logo'), 
                'mainvideo'         =>  trans('lang.mainvideo'),
                
                'email_jordan'      =>  trans('lang.email_jordan'),
                'phone_jordan'      =>  trans('lang.phone_jordan'),
                'fax_jordan'        =>  trans('lang.fax_jordan'),
                'pobox_jordan'      =>  trans('lang.pobox_jordan'),
                'map_jordan'        =>  trans('lang.map_jordan'),

                'email_sudan'       =>  trans('lang.email_sudan'),
                'phone_sudan'       =>  trans('lang.phone_sudan'),
                'fax_sudan'         =>  trans('lang.fax_sudan'),
                'pobox_sudan'       =>  trans('lang.pobox_sudan'),
                'map_sudan'         =>  trans('lang.map_sudan'),
                
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


        if(request()->hasFile('image_one')) {
           $data['image_one'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'image_one',
                'path'          =>  'settings',
                'upload_type'   =>  'single',
                'delete_file'   =>  setting()->image_one,
           ]); 
        }else{
            $data['image_one'] = setting()->image_one;
        }


        if(request()->hasFile('image_two')) {
           $data['image_two'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'image_two',
                'path'          =>  'settings',
                'upload_type'   =>  'single',
                'delete_file'   =>  setting()->image_two,
           ]); 
        }else{
            $data['image_two'] = setting()->image_two;
        }

        return \Control::update($request,1,'setting',[
        'mainvideo' => $request->mainvideo,
        'maintenance' => $request->maintenance,
        
        'email_jordan' => $request->email_jordan,
        'phone_jordan' => $request->phone_jordan,
        'fax_jordan' => $request->fax_jordan,
        'pobox_jordan' => $request->pobox_jordan,
        'map_jordan' => $request->map_jordan,

        'email_sudan' => $request->email_sudan,
        'phone_sudan' => $request->phone_sudan,
        'fax_sudan' => $request->fax_sudan,
        'pobox_sudan' => $request->pobox_sudan,
        'map_sudan' => $request->map_sudan,

        'keywords' => $request->keywords,
        'facebook' => $request->facebook,
        'twitter' => $request->twitter,
        'linkedin' => $request->linkedin,
        'youtube' => $request->youtube,
        'instagram' => $request->instagram,
        'logo' => $data['logo'],
        'image_one' => $data['image_one'],
        'image_two' => $data['image_two'],
        'updated_by' => Auth::user()->name,
        'translate'=>['title','subtitle','desc','copyright','address_jordan','address_sudan'],
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
