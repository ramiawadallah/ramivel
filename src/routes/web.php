<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SendEmailController;

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

Route::middleware(['locale'])->group(function () {
  Route::group(['middleware'=>'maintenance'], function(){
      /* Pages Route if Pages Table is Exists*/
      if (Schema::hasTable('pages')) {
        foreach (\App\Models\Page::all() as $key => $page) {
            Route::get($page->uri, ['as'=>$page->name, function() use ($page){
                return App()->call('App\Http\Controllers\Frontend\FrontendController@show', [
                    'page' => $page,
                    'parameters'=> Route::current()->parameters(),
                ]);
            }]);
        }      
      } 

      // Get project by url
      Route::get('work/{uri}',[FrontendController::class,'work']);

      // Get Partner by url
      Route::get('partner/{uri}',[FrontendController::class,'partner']);

      // Get Post by url
      Route::get('/blog/{uri}',[FrontendController::class,'post']);

      /* Send Email */
      Route::post('send_email',[SendEmailController::class,'sendEmail'])->name('send_email');
      
  });
});


// Maintenance Route design 
Route::get('maintenance',function(){
  if(setting()->maintenance === 'open'){
      return redirect('/');
  }
  return view('partials.maintenance');
});


