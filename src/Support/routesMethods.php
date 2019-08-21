<?php 
/* Routes */
function resource($url,$controller,$as=null)
{
    $name = !empty($as) ? $as : $url;
     Route::resource($url,$controller,['names'=>[
        'index'=>$name.'.index',
        'create'=>$name.'.create',
        'store'=>$name.'.store',
        'show'=>$name.'.show',
        'edit'=>$name.'.edit',
        'update'=>$name.'.update',
        'destroy'=>$name.'.destroy',
        ]]);
     Route::delete($url,['as'=>$name,'uses'=>$controller.'@destroy']);
     Route::post($url.'/order',['as'=>$name,'uses'=>$controller.'@order']);
}

function get($url,$controller,$as=null)
{
    $name = !empty($as) ? $as : $url;
    return Route::get($url,['as'=>$name,'uses'=>$controller]);
}

function post($url,$controller,$as=null)
{
    $name = !empty($as) ? $as : $url;
    return Route::post($url,['as'=>$name,'uses'=>$controller]);
}

function put($url,$controller,$as=null)
{
    $name = !empty($as) ? $as : $url;
    return Route::put($url,['as'=>$name,'uses'=>$controller]);
}

function patch($url,$controller,$as=null)
{
    $name = !empty($as) ? $as : $url;
    return Route::patch($url,['as'=>$name,'uses'=>$controller]);
}

function eny($url,$controller,$as=null)
{
    $name = !empty($as) ? $as : $url;
    return Route::eny($url,['as'=>$name,'uses'=>$controller]);
}

function delete($url,$controller,$as=null)
{
    $name = !empty($as) ? $as : $url;
    return Route::delete($url,['as'=>$name,'uses'=>$controller]);
}

function group($array = [],$calback)
{
    return Route::group($array,$calback);
}
/* /Routes */
