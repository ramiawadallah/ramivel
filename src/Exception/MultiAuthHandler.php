<?php

namespace Ramivel\Multiauth\Exception;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as AppHandler;

class MultiAuthHandler extends AppHandler
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                return redirect()->guest(route('admin.login'));

            default:
                return redirect()->guest('/login');
                break;
        }
    }
}
