<?php

namespace Ramivel\Application\Http\Middleware;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Ramivel\Application\Http\Middleware\Localization::class,
        ],
    ];
}
