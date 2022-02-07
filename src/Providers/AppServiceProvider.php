<?php

namespace Ramivel\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Ramivel\Application\View\ThemeViewFinder;
use Ramivel\Application\View\Composers;
use Illuminate\Support\Facades\View; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::enableForeignKeyConstraints();
        Schema::defaultStringLength(191);
        $this->app['view']->composer('layouts.frontend', Composers\InjectPages::class);
        // $this->app['view']->setFinder($this->app['theme.finder']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('theme.finder', function ($app) {
          $finder = new ThemeViewFinder($app['files'], $app['config']['view.paths']);

          $config = $app['config']['cms.theme'];
          $finder->setBasePath($app['path.public'].'/'.$config['folder']);
          $finder->setActiveTheme($config['active']);

          return $finder;
        });
    }
}
