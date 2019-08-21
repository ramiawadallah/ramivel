<?php


if (! function_exists('setting')) {
	function setting(){
		return \App\Setting::OrderBy('id','desc')->first();
	}
}

if (! function_exists('up')) {
	function up(){
		return new \App\Http\Controllers\Upload;
	}
}

if (! function_exists('theme')) {
    function theme($path)
    {
        $config = app('config')->get('cms.theme');
        //return url('/themes/default/assets/cms/'.$path);
        return url($config['folder'].'/'.$config['active'].'/assets/'.$path);
    }
}

if (! function_exists('aurl')) {
	function aurl($url=null){
		return url('admin/'.$url);
	}
}

if (! function_exists('adminGuard')) {
	function adminGuard(){
		return auth()->guard('admin');
	}
}


if (! function_exists('active_menu')) {
	function active_menu($link){
		if(preg_match('/'.$link.'/i',Request::segment(2))){
			return ['toggled active open','cus-dis','active-link'];
		}else{
			return ['','',''];
		}
	}
}


if (! function_exists('validate_image')){
	function validate_image($ext=null){
		if($ext == null){
			return 'image|mimes:jpeg,png,jpg,gif,svg';
		}else{
			return 'image|mimes:'.$ext;
		}
	}
}


if (! function_exists('count_row')){
	function count_row($model=null ){
		if($model == null){
			return '';
		}else{
			return '{{ \App\\'.$model.'::count() }}';
		}
	}
}



