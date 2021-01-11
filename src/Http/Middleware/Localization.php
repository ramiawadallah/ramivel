<?php

namespace Ramivel\Application\Http\Middleware;

use Closure;
use Carbon\Carbon;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if ( \Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));
 
            // You also can set the Carbon locale
            Carbon::setLocale(\Session::get('locale'));
        }else
        {
            $default_locale = \App\Model\Lang::where('default',1);
            if ($default_locale->exists()) 
            {
                 \App::setLocale($default_locale->first()->code);
            }
        }
        
        return $next($request);
    }
}
