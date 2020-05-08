<?php

namespace Ramivel\Multiauth\Http\Middleware;

use Closure;

class AdminPermitToParent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $permissions = auth('admin')->user()->allPermissions();

        $permissions = array_map(function ($permission) {
            return $permission['parent'];
        }, $permissions);

        $given_permissions = explode(';', $permission);

        $match = count(array_intersect($given_permissions, $permissions));

        if (!$match) {
            return redirect(route('admin.login'));
        }

        return $next($request);
    }
}
