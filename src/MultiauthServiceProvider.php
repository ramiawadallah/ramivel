<?php

namespace Ramivel\Multiauth;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Ramivel\Multiauth\Console\Commands\Install;
use Ramivel\Multiauth\Console\Commands\RoleCmd;
use Ramivel\Multiauth\Console\Commands\SeedCmd;
use Ramivel\Multiauth\Exception\MultiAuthHandler;
use Ramivel\Multiauth\Http\Middleware\AdminPermitTo;
use Ramivel\Multiauth\Providers\AuthServiceProvider;
use Ramivel\Multiauth\Console\Commands\PermissionCommand;
use Ramivel\Multiauth\Http\Middleware\AdminPermitToParent;
use Ramivel\Multiauth\Console\Commands\MakeMultiAuthCommand;
use Ramivel\Multiauth\Console\Commands\RollbackMultiAuthCommand;
use Ramivel\Multiauth\Http\Middleware\redirectIfAuthenticatedAdmin;
use Ramivel\Multiauth\Http\Middleware\redirectIfNotWithRoleOfAdmin;
use Ramivel\Multiauth\Providers\AppServiceProvider;
use Ramivel\Multiauth\Console\Commands\ViewCommand;
use Ramivel\Multiauth\Console\Commands\ControllerCommand;

class MultiauthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->canHaveAdminBackend()) {
            $this->loadViewsFrom(__DIR__ . '/views', 'multiauth');
            $this->registerRoutes();
            $this->publisheThings();
            $this->mergeAuthFileFrom(__DIR__ . '/../config/auth.php', 'auth');
            $this->mergeConfigFrom(__DIR__ . '/../config/multiauth.php', 'multiauth');
            $this->loadBladeSyntax();
            $this->loadAdminCommands();
        }
        $this->loadCommands();
    }

    public function register()
    {
        if ($this->canHaveAdminBackend()) {
            $this->loadFactories();
            $this->loadMiddleware();
            $this->registerExceptionHandler();
            app()->register(AuthServiceProvider::class);
            app()->register(AppServiceProvider::class);      
        } 
    }

    protected function loadFactories()
    {
        $appFactories = scandir(database_path('/factories'));
        $factoryPath  = !in_array('AdminFactory.php', $appFactories) ? __DIR__ . '/factories' : database_path('/factories');

        $this->app->make(Factory::class)->load($factoryPath);
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        });
    }

    /**
     * Get the Blogg route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace'  => "App\Http\Controllers\Admin",
            'middleware' => 'web',
            'prefix'     => config('multiauth.prefix', 'admin'),
        ];
    }

    protected function loadRoutesFrom($path)
    {
        $prefix   = config('multiauth.prefix', 'admin');
        $routeDir = base_path('routes');
        if (file_exists($routeDir)) {
            $appRouteDir = scandir($routeDir);
            if (!$this->app->routesAreCached()) {
                $path = in_array("{$prefix}.php", $appRouteDir) ? base_path("routes/{$prefix}.php") : $path;
            }
        }

        if (!app('router')->has('login')) {
            Route::get('/login', function () {
            })->name('login');
        }

        require $path;
    }

    protected function loadMiddleware()
    {
        app('router')->aliasMiddleware('admin', redirectIfAuthenticatedAdmin::class);
        app('router')->aliasMiddleware('role', redirectIfNotWithRoleOfAdmin::class);
        app('router')->aliasMiddleware('permitTo', AdminPermitTo::class);
        app('router')->aliasMiddleware('permitToParent', AdminPermitToParent::class);
    }

    protected function registerExceptionHandler()
    {
        \App::singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            MultiAuthHandler::class
        );
    }

    protected function mergeAuthFileFrom($path, $key)
    {
        $original = $this->app['config']->get($key, []);
        $this->app['config']->set($key, $this->multi_array_merge(require $path, $original));
    }

    protected function multi_array_merge($toMerge, $original)
    {
        $auth = [];
        foreach ($original as $key => $value) {
            if (isset($toMerge[$key])) {
                $auth[$key] = array_merge($value, $toMerge[$key]);
            } else {
                $auth[$key] = $value;
            }
        }

        return $auth;
    }

    protected function publisheThings()
    {
        $prefix = config('multiauth.prefix', 'admin');
        $this->publishes([
            __DIR__ . '/Model' => app_path("Model"),                                        //  Model
            __DIR__ . '/Http/BackendControllers' => app_path("Http/Controllers/Admin"),     //  Admin Controller
            __DIR__ . '/database/migrations/' => database_path('migrations'),               //  Database migration   
            __DIR__ . '/views' => resource_path('views'),                                   //  Admin view reaource
            __DIR__ . '/database/factories' => database_path('factories'),                  //  Run firs data on database
            __DIR__ . '/../config/multiauth.php' => config_path('multiauth.php'),           //  MultiAuth Configration
            __DIR__ . '/config/lang.php' => resource_path('lang/en/lang.php'),              //  Lang Configration
            __DIR__ . '/routes/routes.php' => base_path("routes/{$prefix}.php"),            //  Route design for backend
            __DIR__ . '/Helpers' => app_path('Helpers'),                                    //  Helper function 
            __DIR__ . '/View' => app_path('View/'),                                         //  View For Template Engine
            __DIR__ . '/Themes' => public_path('/themes/'),                                 //  Public file JS & CSS
            __DIR__ . '/routes/web.php' => base_path("routes/web.php"),                     //  Route design for frontend 
            __DIR__ . '/database/migrations/' => database_path('migrations'),               //  Database migration 
        ], 'ramivel:publish');
    }

    protected function loadBladeSyntax()
    {
        Blade::if('admin', function ($role) {
            if (!auth('admin')->check()) {
                return  false;
            }
            $role = explode(',', $role);
            $role[] = 'super';
            $roles = auth('admin')->user()->roles()->pluck('name');
            $match = count(array_intersect($role, $roles->toArray()));

            return (bool) $match;
        });

        Blade::if('permitTo', function ($permission) {
            if (!auth('admin')->check()) {
                return  false;
            }
            $permission = explode(',', $permission);
            $permissions = auth('admin')->user()->allPermissions();
            $permissions = array_map(function ($permission) {
                return $permission['name'];
            }, $permissions);
            $match = count(array_intersect($permission, $permissions));

            return !!$match;
        });

        Blade::if('permitToParent', function ($permission) {
            if (!auth('admin')->check()) {
                return  false;
            }
            $permission = explode(',', $permission);
            $permissions = auth('admin')->user()->allPermissions();
            $parent = array_map(function ($permission) {
                return $permission['parent'];
            }, $permissions);

            $match = count(array_intersect($permission, $parent));

            return (bool) $match;
        });
    }

    protected function loadAdminCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SeedCmd::class,
                RoleCmd::class,
            ]);
        }
    }

    protected function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeMultiAuthCommand::class,
                RollbackMultiAuthCommand::class,
                PermissionCommand::class,
                Install::class,
            ]);
        }
    }

    protected function canHaveAdminBackend()
    {
        return config('multiauth.admin_active', true);
    }
}
