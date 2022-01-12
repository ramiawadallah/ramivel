<?php

namespace Ramivel\Application\Http\Middleware;

use Closure;

class Maintenance
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
        if(setting()->maintenance === 'close'){
            return redirect('maintenance');
        }else{
            return $next($request);
        }
    }
}
