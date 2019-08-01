<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Front end Locale Route design */
Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/', function () {
  return view('welcome');
});


Route::group(['middleware'=>'maintenance'], function(){

    /* Pages Route if Pages Table is Exists*/
    if (Schema::hasTable('pages')) {

      foreach (\App\Page::all() as $key => $page) {
      
          Route::get($page->uri, ['as'=>$page->name, function() use ($page){
              return App()->call('App\Http\Controllers\Frontend\PagesController@show', [
                  'page' => $page,
                  'parameters'=> Route::current()->parameters(),
              ]);
          }]);
      }      
    } 

});

Route::group(['middleware' => 'web'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});

// Maintenance Route design 
Route::get('maintenance',function(){
  if(setting()->maintenance === 'open'){
      return redirect('/');
  }
  return view('partials.maintenance');
});