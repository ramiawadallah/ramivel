<?php

namespace Ramivel\Application\Providers;

use App\Model\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\File;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // LOADF HELPER FILE FOR MAC AND LINUX
        if (File::exists(str_replace('/Providers','',__DIR__ . '/Helper/Helpers.php'))) {
           require_once str_replace('/Providers','',__DIR__ . '/Helper/Helpers.php');
        }

        // LOADF HELPER FILE FOR WINDOWS
        if (File::exists(str_replace('\Providers','',__DIR__ . '\Helper\Helpers.php'))) {
           require_once str_replace('\Providers','',__DIR__ . '\Helper\Helpers.php');
        }

        $this->registerPolicies();
        Gate::before(function ($admin, $ability) {
            if ($admin instanceof Admin) {
                if ($this->isSuperAdmin($admin)) {
                    return true;
                }
                return $admin->hasPermission($ability);
            }
        });
        
    }

    protected function isSuperAdmin($admin)
    {
        return in_array('super', $admin->roles->pluck('name')->toArray());

    }
}
