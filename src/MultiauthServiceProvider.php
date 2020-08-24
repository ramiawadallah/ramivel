<?php

namespace Ramivel\Application;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Ramivel\Application\Console\Commands\Install;
use Ramivel\Application\Console\Commands\RoleCmd;
use Ramivel\Application\Console\Commands\SeedCmd;
use Ramivel\Application\Exception\MultiAuthHandler;
use Ramivel\Application\Http\Middleware\AdminPermitTo;
use Ramivel\Application\Providers\AuthServiceProvider;
use Ramivel\Application\Console\Commands\PermissionCommand;
use Ramivel\Application\Http\Middleware\AdminPermitToParent;
use Ramivel\Application\Console\Commands\MakeMultiAuthCommand;
use Ramivel\Application\Console\Commands\RollbackMultiAuthCommand;
use Ramivel\Application\Http\Middleware\redirectIfAuthenticatedAdmin;
use Ramivel\Application\Http\Middleware\redirectIfNotWithRoleOfAdmin;

class MultiauthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->canHaveAdminBackend()) {
            $this->loadViewsFrom(__DIR__ . '/views', 'application');
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
            'namespace'  => "App\Http\Controllers",
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

        $prefix = config('application.prefix', 'admin');

        $this->publishes([
               __DIR__ . '/database/migrations/'        => database_path('migrations'),            //  Migrations
               __DIR__ . '/Http/Controllers'            => app_path('Http/Controllers/admin/'),    //  Controllers
               __DIR__ . '/views'                       => resource_path('views/'),                //  Views & Layout
               __DIR__ . '/factories'                   => database_path('factories'),             //  Factories
               __DIR__ . '/../config/multiauth.php'     => config_path('multiauth.php'),           //  Multiauth
               __DIR__ . '/routes/routes.php'           => base_path("routes/{$prefix}.php"),      //  Routes
               __DIR__ . '/Model'                       => app_path(),                             //  Model
           ]
        ,'ramivel:publish');

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
