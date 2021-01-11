<?php

namespace Ramivel\Application\Http\Middleware;

use Closure;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class LogAdminActivity
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
        if(Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('admin-is-online-' . Auth::user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}
