<?php 
// This Function alow you to access the backend and front end layouts
// This Function can help you as shourtcuts for your app 
if (! function_exists('theme')) {
    function theme($path)
    {
        $config = app('config')->get('cms.theme');
        // return url('/themes/default/assets/cms/'.$path);
        return url($config['folder'].'/'.$config['active'].'/assets/'.$path);
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
	function count_row($model=null){
		if($model == null){
			return '';
		}else{
			return App\Models\Admin::count();
		}
	}
}

// Function TO Upload any media files
if (! function_exists('up')) {
	function up(){
		return new \App\Http\Controllers\Upload;
	}
}

//Direct Setting Data
if (! function_exists('setting')) {
	function setting(){
		return \App\Models\Setting::OrderBy('id','desc')->first();
	}
}

if (! function_exists('aurl')) {
	function aurl($url=null){
		return url('admin/'.$url);
	}
}

if (! function_exists('media')) {
	function media($data){
		$path = '';
		return url(Storage::url($path.$data));
	}
}

if( ! function_exists('readMore')){

    function readMore($text, $limit, $url, $readMoreText = 'Read More') {
        $end = "<br><br><a href=\"$url\">$readMoreText</a>";
        return str_limit($text, $limit, $end);
    }

}




