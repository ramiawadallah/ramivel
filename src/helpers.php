<?php 



// This Function alow you to access the backend and front end layouts
if (! function_exists('theme')) {
    function theme($path)
    {
        $config = app('config')->get('cms.theme');
        //return url('/themes/default/assets/cms/'.$path);
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
	function count_row($model=null ){
		if($model == null){
			return '';
		}else{
			return '{{ \App\\'.$model.'::count() }}';
		}
	}
}