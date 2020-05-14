<?php

// This Function alow you to return data from setting table
if (! function_exists('setting')) {
	function setting(){
		return \App\Setting::OrderBy('id','desc')->first();
	}
}

// This Function alow you to upload 'Image, file ...etc' to server
if (! function_exists('up')) {
	function up(){
		return new \App\Http\Controllers\Admin\UploadController;
	}
}


// This Function alow you to return translate data from server
if (! function_exists('transdata')) {
	function transdata($data = null, $lang = null){
		if($lang == null){
			$language = LaravelLocalization::getCurrentLocale();
		}else{
			$language = $lang;
		}
		return json_decode($data, true)[$language] != null ? json_decode($data, true)[$language] : $data;
	}
}

// This Function alow you to return translate data value form for from server
if (! function_exists('transvalue')) {
	function transvalue($data = null, $lang = null){
		if($lang == null){
			$language = LaravelLocalization::getCurrentLocale();
		}else{
			$language = $lang;
		}
		return json_decode($data, true)[$language];
	}
}

// This Function alow you to access the backend and front end layouts
if (! function_exists('theme')) {
    function theme($path)
    {
        $config = app('config')->get('cms.theme');
        //return url('/themes/default/assets/cms/'.$path);
        return url($config['folder'].'/'.$config['active'].'/assets/'.$path);
    }
}

// This Function alow you to shortness the admin url
if (! function_exists('aurl')) {
	function aurl($url=null){
		return url('admin/'.$url);
	}
}

// This Function alow you to fetch the active admin menu 
if (! function_exists('active_menu')) {
	function active_menu($link){
		if(preg_match('/'.$link.'/i',Request::segment(2))){
			return ['toggled active open','cus-dis','active-link'];
		}else{
			return ['','',''];
		}
	}
}

// This function return the number of Rows at selected tabel
if (! function_exists('count_row')){
	function count_row($model=null ){
		if($model == null){
			return '';
		}else{
			return '{{ \App\\'.$model.'::count() }}';
		}
	}
}